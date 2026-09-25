<?php
$pageTitle = 'Digiserv.id | Enterprise Software & Automation Experts | Digiserv.id';
$pageDescription = 'Digiserv.id — Premium digital agency specializing in high-performance web applications, AI integration, and scalable solutions.';
$basePath = './';
require_once 'billing/db.php';
$db = get_db_connection();

// Fetch dynamic settings
$settings_raw = $db->query("SELECT setting_key, setting_value FROM site_settings")->fetchAll();
$settings = [];
foreach ($settings_raw as $s) {
  $settings[$s['setting_key']] = $s['setting_value'];
}

// Fetch projects
$projects = $db->query("SELECT * FROM projects ORDER BY created_at DESC")->fetchAll();

// Fetch testimonials
$testimonials = $db->query("SELECT * FROM testimonials ORDER BY created_at DESC")->fetchAll();

include 'includes/header.php';
?>

<main class="max-w-6xl mx-auto px-6 pb-24">
  <section class="pt-24 pb-20 text-center flex flex-col items-center">
    <div class="inline-flex items-center bg-white border border-dashed border-gray-300 rounded-full px-5 py-2 mb-10">
      <div class="flex -space-x-2 mr-4">
        <img class="w-7 h-7 rounded-full border-2 border-white object-cover" src="img/testimoni-2.webp" alt="client">
        <img class="w-7 h-7 rounded-full border-2 border-white object-cover" src="img/testimoni-3.jpeg" alt="client">
        <img class="w-7 h-7 rounded-full border-2 border-white object-cover" src="img/testimoni-4.webp" alt="client">
      </div>
      <span class="text-xs font-medium text-gray-600">100+ companies trust us</span>
    </div>
    <h1 class="text-5xl font-semibold hero-title max-w-4xl mx-auto text-brand-black mb-10 md:text-8xl">Architecting
      digital systems with <span class="editorial-italic font-normal">precision.</span></h1>
    <p class="text-lg text-brand-gray max-w-2xl mx-auto mb-12 leading-relaxed md:text-xl">At
      <strong>Digiserv.id</strong>, we bring an analytical, systems-thinking approach to software engineering.
      Enterprise partner for automation, production-grade applications, and resilient architectures.</p>
    <div class="flex gap-4">
      <a class="bg-brand-black text-white text-base font-medium px-10 py-4 rounded-xl transition shadow-xl transform duration-300 hover:bg-gray-800 hover:scale-105"
        href="#work">View Work</a>
      <a class="bg-white text-brand-black border border-gray-200 text-base font-medium px-10 py-4 rounded-xl transition shadow-lg hover:bg-gray-50"
        href="jasabikinwebsite/index">Automation Agency</a>
    </div>
  </section>

  <section class="max-w-6xl mx-auto mb-32">
    <div class="dashed-border-y grid grid-cols-2 py-12 md:grid-cols-4">
      <div class="px-8 flex flex-col items-start justify-center">
        <span class="text-sm text-brand-gray mb-2">Experience</span>
        <span
          class="text-4xl font-semibold text-brand-black"><?php echo $settings['experience_years'] ?? '5+ Years'; ?></span>
      </div>
      <div class="px-8 flex flex-col items-start justify-center dashed-border-l">
        <span class="text-sm text-brand-gray mb-2">Successful deploys</span>
        <span
          class="text-4xl font-semibold text-brand-black"><?php echo $settings['successful_deploys'] ?? '500+'; ?></span>
      </div>
      <div
        class="px-8 flex flex-col items-start justify-center dashed-border-l mt-10 pt-10 border-t border-dashed border-gray-200 md:mt-0 md:border-t-0 md:pt-0">
        <span class="text-sm text-brand-gray mb-2">In generated revenue</span>
        <span
          class="text-4xl font-semibold text-brand-black"><?php echo $settings['generated_revenue'] ?? '$1M+'; ?></span>
      </div>
      <div
        class="px-8 flex flex-col items-start justify-center dashed-border-l mt-10 pt-10 border-t border-dashed border-gray-200 md:mt-0 md:border-t-0 md:pt-0">
        <span class="text-sm text-brand-gray mb-2">Client retention rate</span>
        <span
          class="text-4xl font-semibold text-brand-black"><?php echo $settings['client_retention'] ?? '98%'; ?></span>
      </div>
    </div>
  </section>

  <section class="mb-32 grid grid-cols-1 gap-16 items-center md:grid-cols-2" id="about">
    <div>
      <div class="text-xs font-bold tracking-widest text-brand-gray mb-6 uppercase">About Us</div>
      <h2 class="text-4xl font-semibold hero-title mb-10 md:text-6xl">Expertise in digital <span
          class="editorial-italic font-normal">innovation.</span></h2>
      <p class="text-brand-gray leading-relaxed mb-6">We are passionate about writing <strong>clean, maintainable
          code</strong> that solves real business problems. Our seasoned team build everything from educational
        platforms and enterprise management systems to AI agents and scalable web applications.</p>
      <div class="flex gap-12 mt-10">
        <div>
          <div class="text-xs font-bold text-brand-gray uppercase mb-2">Core Focus</div>
          <div class="text-sm font-semibold">Web Performance</div>
        </div>
        <div>
          <div class="text-xs font-bold text-brand-gray uppercase mb-2">Specialty</div>
          <div class="text-sm font-semibold">AI Integration</div>
        </div>
      </div>
    </div>
    <div class="bg-brand-light p-12 rounded-3xl border border-gray-100 grid grid-cols-2 gap-8">
      <div class="space-y-2">
        <div class="text-xs font-bold text-brand-gray uppercase">Frontend</div>
        <div class="text-sm font-semibold">React, Next.js, Vue</div>
      </div>
      <div class="space-y-2">
        <div class="text-xs font-bold text-brand-gray uppercase">Backend</div>
        <div class="text-sm font-semibold">Node.js, Python, Go</div>
      </div>
      <div class="space-y-2">
        <div class="text-xs font-bold text-brand-gray uppercase">Database</div>
        <div class="text-sm font-semibold">PostgreSQL, Redis</div>
      </div>
      <div class="space-y-2">
        <div class="text-xs font-bold text-brand-gray uppercase">Cloud</div>
        <div class="text-sm font-semibold">AWS, Docker, CI/CD</div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section class="mb-32" id="services">
    <div class="text-xs font-bold tracking-widest text-brand-gray mb-12 uppercase text-center">Services</div>
    <div class="text-center mb-16">
      <h2 class="text-4xl font-semibold hero-title md:text-6xl">What we <span class="editorial-italic font-normal">build.</span></h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="p-10 rounded-3xl border border-gray-100 bg-brand-light group hover:border-gray-300 transition-all duration-300">
        <div class="text-3xl mb-6">🌐</div>
        <h3 class="text-xl font-semibold mb-3">Web Applications</h3>
        <p class="text-brand-gray text-sm leading-relaxed">Production-grade web apps built with modern stacks — from internal dashboards to public-facing platforms at scale.</p>
      </div>
      <div class="p-10 rounded-3xl border border-gray-100 bg-brand-light group hover:border-gray-300 transition-all duration-300">
        <div class="text-3xl mb-6">🤖</div>
        <h3 class="text-xl font-semibold mb-3">AI Integration</h3>
        <p class="text-brand-gray text-sm leading-relaxed">Embed intelligent automation into your workflow — chatbots, document processing, predictive analytics, and LLM-powered features.</p>
      </div>
      <div class="p-10 rounded-3xl border border-gray-100 bg-brand-light group hover:border-gray-300 transition-all duration-300">
        <div class="text-3xl mb-6">⚙️</div>
        <h3 class="text-xl font-semibold mb-3">Business Automation</h3>
        <p class="text-brand-gray text-sm leading-relaxed">Eliminate repetitive manual tasks. We build custom automation pipelines that connect your tools and let your team focus on what matters.</p>
      </div>
      <div class="p-10 rounded-3xl border border-gray-100 bg-brand-light group hover:border-gray-300 transition-all duration-300">
        <div class="text-3xl mb-6">🏗️</div>
        <h3 class="text-xl font-semibold mb-3">Enterprise Systems</h3>
        <p class="text-brand-gray text-sm leading-relaxed">ERP, AMS, CRM, and custom management systems tailored to your operations — built for reliability, scale, and long-term maintainability.</p>
      </div>
      <div class="p-10 rounded-3xl border border-gray-100 bg-brand-light group hover:border-gray-300 transition-all duration-300">
        <div class="text-3xl mb-6">📱</div>
        <h3 class="text-xl font-semibold mb-3">Mobile Apps</h3>
        <p class="text-brand-gray text-sm leading-relaxed">Cross-platform mobile experiences using Flutter and React Native — fast to market, native-quality performance on both iOS and Android.</p>
      </div>
      <div class="p-10 rounded-3xl border border-gray-100 bg-brand-light group hover:border-gray-300 transition-all duration-300">
        <div class="text-3xl mb-6">🔒</div>
        <h3 class="text-xl font-semibold mb-3">Consulting & Audits</h3>
        <p class="text-brand-gray text-sm leading-relaxed">Architecture reviews, security audits, and tech strategy sessions. Get an expert second opinion before committing to a direction.</p>
      </div>
    </div>
  </section>

  <!-- How We Work Section -->
  <section class="mb-32" id="process">
    <div class="text-xs font-bold tracking-widest text-brand-gray mb-12 uppercase text-center">How We Work</div>
    <div class="text-center mb-16">
      <h2 class="text-4xl font-semibold hero-title md:text-6xl">Simple, transparent <span class="editorial-italic font-normal">process.</span></h2>
      <p class="text-brand-gray mt-6 max-w-xl mx-auto">No surprises. From first call to final handover — here's exactly how we work together.</p>
    </div>
    <div class="relative">
      <!-- Vertical line -->
      <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-px bg-gray-100 -translate-x-1/2"></div>
      <div class="space-y-12">
        <!-- Step 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div class="md:text-right md:pr-16">
            <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-brand-black text-white text-sm font-bold mb-4 md:ml-auto md:block">1</div>
            <h3 class="text-2xl font-semibold mb-3">Discovery Call</h3>
            <p class="text-brand-gray text-sm leading-relaxed">We start with a free 30-minute call to understand your goals, challenges, timeline, and budget. No hard sell — just honest conversation.</p>
          </div>
          <div class="md:pl-16">
            <div class="p-8 rounded-3xl bg-brand-light border border-gray-100">
              <div class="text-sm font-medium text-brand-gray">Deliverable</div>
              <div class="text-base font-semibold mt-1">Project scope summary + initial timeline estimate</div>
            </div>
          </div>
        </div>
        <!-- Step 2 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div class="md:order-2 md:pl-16">
            <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-brand-black text-white text-sm font-bold mb-4">2</div>
            <h3 class="text-2xl font-semibold mb-3">Proposal & Planning</h3>
            <p class="text-brand-gray text-sm leading-relaxed">We prepare a detailed proposal with milestones, tech stack recommendation, and fixed pricing. You know exactly what you're getting before signing.</p>
          </div>
          <div class="md:order-1 md:pr-16 md:text-right">
            <div class="p-8 rounded-3xl bg-brand-light border border-gray-100">
              <div class="text-sm font-medium text-brand-gray">Deliverable</div>
              <div class="text-base font-semibold mt-1">Proposal doc, milestone plan, contract</div>
            </div>
          </div>
        </div>
        <!-- Step 3 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div class="md:text-right md:pr-16">
            <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-brand-black text-white text-sm font-bold mb-4 md:ml-auto md:block">3</div>
            <h3 class="text-2xl font-semibold mb-3">Design & Build</h3>
            <p class="text-brand-gray text-sm leading-relaxed">Our team gets to work in focused sprints. You receive progress updates weekly and have a shared staging environment to review at any time.</p>
          </div>
          <div class="md:pl-16">
            <div class="p-8 rounded-3xl bg-brand-light border border-gray-100">
              <div class="text-sm font-medium text-brand-gray">Deliverable</div>
              <div class="text-base font-semibold mt-1">Working builds, weekly reports, staging access</div>
            </div>
          </div>
        </div>
        <!-- Step 4 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div class="md:order-2 md:pl-16">
            <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-brand-black text-white text-sm font-bold mb-4">4</div>
            <h3 class="text-2xl font-semibold mb-3">Launch & Handover</h3>
            <p class="text-brand-gray text-sm leading-relaxed">We deploy to production, run final QA, and hand over all assets with full documentation. Post-launch support included for 30 days.</p>
          </div>
          <div class="md:order-1 md:pr-16 md:text-right">
            <div class="p-8 rounded-3xl bg-brand-light border border-gray-100">
              <div class="text-sm font-medium text-brand-gray">Deliverable</div>
              <div class="text-base font-semibold mt-1">Live product, source code, documentation, 30-day support</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="mb-32" id="work">
    <div class="text-xs font-bold tracking-widest text-brand-gray mb-12 uppercase text-center">Selected Work</div>
    <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
      <?php foreach ($projects as $project): ?>
        <div class="group">
          <div class="aspect-video bg-brand-light rounded-3xl border border-gray-100 mb-6 overflow-hidden">
            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              src="<?php echo htmlspecialchars($project['image_path']); ?>"
              alt="<?php echo htmlspecialchars($project['title']); ?>">
          </div>
          <h3 class="text-2xl font-semibold mb-2"><?php echo htmlspecialchars($project['title']); ?></h3>
          <p class="text-brand-gray text-sm mb-4"><?php echo htmlspecialchars($project['description']); ?></p>
          <div class="flex gap-2">
            <?php
            $tags = explode(',', $project['tags']);
            foreach ($tags as $tag):
              ?>
              <span
                class="font-bold uppercase tracking-widest bg-gray-100 px-2 py-1 rounded text-[10px]"><?php echo trim($tag); ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Why Choose Us Section -->
  <section class="mb-32" id="why-us">
    <div class="text-xs font-bold tracking-widest text-brand-gray mb-12 uppercase text-center">Why Choose Us</div>
    <div class="text-center mb-16">
      <h2 class="text-4xl font-semibold hero-title md:text-6xl">Built different, <span class="editorial-italic font-normal">on purpose.</span></h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="p-10 rounded-3xl border border-gray-100 bg-brand-light">
        <div class="flex items-start gap-4">
          <div class="flex-shrink-0 w-10 h-10 rounded-full bg-brand-black text-white flex items-center justify-center text-base">✓</div>
          <div>
            <h3 class="text-lg font-semibold mb-2">Fixed-Price Delivery</h3>
            <p class="text-brand-gray text-sm leading-relaxed">No hourly billing surprises. We scope the project, agree on a price, and deliver. Overruns are our problem, not yours.</p>
          </div>
        </div>
      </div>
      <div class="p-10 rounded-3xl border border-gray-100 bg-brand-light">
        <div class="flex items-start gap-4">
          <div class="flex-shrink-0 w-10 h-10 rounded-full bg-brand-black text-white flex items-center justify-center text-base">✓</div>
          <div>
            <h3 class="text-lg font-semibold mb-2">Senior-Only Team</h3>
            <p class="text-brand-gray text-sm leading-relaxed">No junior handoffs. Every project is led and built by experienced engineers with real production track records.</p>
          </div>
        </div>
      </div>
      <div class="p-10 rounded-3xl border border-gray-100 bg-brand-light">
        <div class="flex items-start gap-4">
          <div class="flex-shrink-0 w-10 h-10 rounded-full bg-brand-black text-white flex items-center justify-center text-base">✓</div>
          <div>
            <h3 class="text-lg font-semibold mb-2">Full Transparency</h3>
            <p class="text-brand-gray text-sm leading-relaxed">You own the code, the repo, the servers. Weekly progress updates keep you in the loop without micromanaging.</p>
          </div>
        </div>
      </div>
      <div class="p-10 rounded-3xl border border-gray-100 bg-brand-light">
        <div class="flex items-start gap-4">
          <div class="flex-shrink-0 w-10 h-10 rounded-full bg-brand-black text-white flex items-center justify-center text-base">✓</div>
          <div>
            <h3 class="text-lg font-semibold mb-2">Long-Term Partnership</h3>
            <p class="text-brand-gray text-sm leading-relaxed">98% of our clients come back for more. We build relationships, not just software — your growth is our metric.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="mb-32" id="testimonials">
    <div class="text-xs font-bold tracking-widest text-brand-gray mb-12 uppercase text-center">Client Stories</div>
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
      <?php foreach ($testimonials as $t): ?>
        <div
          class="p-10 rounded-3xl border border-gray-100 bg-brand-light italic text-brand-gray text-sm leading-relaxed">
          "<?php echo htmlspecialchars($t['testimonial']); ?>"
          <div class="mt-8 not-italic flex items-center gap-4">
            <img class="w-10 h-10 rounded-full grayscale" src="<?php echo htmlspecialchars($t['image_path']); ?>"
              alt="client">
            <div>
              <div class="text-brand-black font-bold"><?php echo htmlspecialchars($t['client_name']); ?></div>
              <div class="text-wider uppercase text-[10px]"><?php echo htmlspecialchars($t['company_name']); ?></div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- FAQ Section -->
  <section class="mb-32" id="faq">
    <div class="text-xs font-bold tracking-widest text-brand-gray mb-12 uppercase text-center">FAQ</div>
    <div class="text-center mb-16">
      <h2 class="text-4xl font-semibold hero-title md:text-6xl">Common <span class="editorial-italic font-normal">questions.</span></h2>
    </div>
    <div class="max-w-3xl mx-auto space-y-3" id="faq-list">
      <details class="group p-8 rounded-3xl border border-gray-100 bg-brand-light cursor-pointer">
        <summary class="flex justify-between items-center font-semibold text-base list-none">
          How long does a typical project take?
          <span class="text-2xl font-light text-brand-gray group-open:rotate-45 transition-transform duration-300">+</span>
        </summary>
        <p class="text-brand-gray text-sm leading-relaxed mt-4">It depends on scope. A landing page or simple web app typically takes 2–4 weeks. Enterprise systems and complex integrations run 6–16 weeks. We'll give you an accurate estimate after our discovery call.</p>
      </details>
      <details class="group p-8 rounded-3xl border border-gray-100 bg-brand-light cursor-pointer">
        <summary class="flex justify-between items-center font-semibold text-base list-none">
          Do you work with international clients?
          <span class="text-2xl font-light text-brand-gray group-open:rotate-45 transition-transform duration-300">+</span>
        </summary>
        <p class="text-brand-gray text-sm leading-relaxed mt-4">Yes, absolutely. We work remotely with clients across Southeast Asia, the Middle East, Europe, and North America. Communication is in English and we adapt to your timezone for key meetings.</p>
      </details>
      <details class="group p-8 rounded-3xl border border-gray-100 bg-brand-light cursor-pointer">
        <summary class="flex justify-between items-center font-semibold text-base list-none">
          What's your payment structure?
          <span class="text-2xl font-light text-brand-gray group-open:rotate-45 transition-transform duration-300">+</span>
        </summary>
        <p class="text-brand-gray text-sm leading-relaxed mt-4">We use a milestone-based payment model: 40% upfront to begin, 40% at mid-project delivery, and 20% upon final handover. This keeps risk balanced for both sides.</p>
      </details>
      <details class="group p-8 rounded-3xl border border-gray-100 bg-brand-light cursor-pointer">
        <summary class="flex justify-between items-center font-semibold text-base list-none">
          Who owns the source code?
          <span class="text-2xl font-light text-brand-gray group-open:rotate-45 transition-transform duration-300">+</span>
        </summary>
        <p class="text-brand-gray text-sm leading-relaxed mt-4">You do, 100%. Upon final payment, all source code, assets, and documentation are transferred to you. We retain no rights or backdoors.</p>
      </details>
      <details class="group p-8 rounded-3xl border border-gray-100 bg-brand-light cursor-pointer">
        <summary class="flex justify-between items-center font-semibold text-base list-none">
          Can you maintain the project after launch?
          <span class="text-2xl font-light text-brand-gray group-open:rotate-45 transition-transform duration-300">+</span>
        </summary>
        <p class="text-brand-gray text-sm leading-relaxed mt-4">Yes. We offer monthly retainer packages for ongoing maintenance, feature additions, and priority support. Many of our clients stay on retainer long-term.</p>
      </details>
      <details class="group p-8 rounded-3xl border border-gray-100 bg-brand-light cursor-pointer">
        <summary class="flex justify-between items-center font-semibold text-base list-none">
          Do you sign NDAs?
          <span class="text-2xl font-light text-brand-gray group-open:rotate-45 transition-transform duration-300">+</span>
        </summary>
        <p class="text-brand-gray text-sm leading-relaxed mt-4">Yes, we sign NDAs for all client projects as a standard part of our contract. Your business ideas, data, and technical details stay confidential.</p>
      </details>
    </div>
  </section>

  <section class="text-center pt-24 pb-16" id="contact">
    <h2 class="text-5xl font-semibold hero-title mb-12 md:text-7xl">Let's <span
        class="editorial-italic font-normal">work</span> together.</h2>
    <div class="flex flex-col justify-center gap-6 sm:flex-row">
      <a class="bg-brand-black text-white text-lg font-medium px-12 py-5 rounded-2xl transition shadow-2xl hover:bg-gray-800"
        href="https://wa.link/byybuo">WhatsApp Us</a>
      <a class="bg-white text-brand-black border border-gray-200 text-lg font-medium px-12 py-5 rounded-2xl transition shadow-lg hover:bg-gray-50"
        href="mailto:hidayat@digiserv.id">Send Email</a>
    </div>
  </section>
</main>

<?php include 'includes/footer.php'; ?>