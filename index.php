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
      <span class="text-xs font-medium text-gray-600">2000+ companies trust us</span>
    </div>
    <h1 class="text-5xl font-semibold hero-title max-w-4xl mx-auto text-brand-black mb-10 md:text-8xl">Architecting digital systems with <span class="editorial-italic font-normal">precision.</span></h1>
    <p class="text-lg text-brand-gray max-w-2xl mx-auto mb-12 leading-relaxed md:text-xl">At <strong>Digiserv.id</strong>, we bring an analytical, systems-thinking approach to software engineering. Enterprise partner for automation, production-grade applications, and resilient architectures.</p>
    <div class="flex gap-4">
      <a class="bg-brand-black text-white text-base font-medium px-10 py-4 rounded-xl transition shadow-xl transform duration-300 hover:bg-gray-800 hover:scale-105" href="#work">View Work</a>
      <a class="bg-white text-brand-black border border-gray-200 text-base font-medium px-10 py-4 rounded-xl transition shadow-lg hover:bg-gray-50" href="jasabikinwebsite/index">Automation Agency</a>
    </div>
  </section>

  <section class="max-w-6xl mx-auto mb-32">
    <div class="dashed-border-y grid grid-cols-2 py-12 md:grid-cols-4">
      <div class="px-8 flex flex-col items-start justify-center">
        <span class="text-sm text-brand-gray mb-2">Experience</span>
        <span class="text-4xl font-semibold text-brand-black"><?php echo $settings['experience_years'] ?? '5+ Years'; ?></span>
      </div>
      <div class="px-8 flex flex-col items-start justify-center dashed-border-l">
        <span class="text-sm text-brand-gray mb-2">Successful deploys</span>
        <span class="text-4xl font-semibold text-brand-black"><?php echo $settings['successful_deploys'] ?? '500+'; ?></span>
      </div>
      <div class="px-8 flex flex-col items-start justify-center dashed-border-l mt-10 pt-10 border-t border-dashed border-gray-200 md:mt-0 md:border-t-0 md:pt-0">
        <span class="text-sm text-brand-gray mb-2">In generated revenue</span>
        <span class="text-4xl font-semibold text-brand-black"><?php echo $settings['generated_revenue'] ?? '$1M+'; ?></span>
      </div>
      <div class="px-8 flex flex-col items-start justify-center dashed-border-l mt-10 pt-10 border-t border-dashed border-gray-200 md:mt-0 md:border-t-0 md:pt-0">
        <span class="text-sm text-brand-gray mb-2">Client retention rate</span>
        <span class="text-4xl font-semibold text-brand-black"><?php echo $settings['client_retention'] ?? '98%'; ?></span>
      </div>
    </div>
  </section>

  <section class="mb-32 grid grid-cols-1 gap-16 items-center md:grid-cols-2" id="about">
    <div>
      <div class="text-xs font-bold tracking-widest text-brand-gray mb-6 uppercase">01 / About Us</div>
      <h2 class="text-4xl font-semibold hero-title mb-10 md:text-6xl">Expertise in digital <span class="editorial-italic font-normal">innovation.</span></h2>
      <p class="text-brand-gray leading-relaxed mb-6">We are passionate about writing <strong>clean, maintainable code</strong> that solves real business problems. Our seasoned team build everything from educational platforms and enterprise management systems to AI agents and scalable web applications.</p>
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

  <section class="mb-32" id="work">
    <div class="text-xs font-bold tracking-widest text-brand-gray mb-12 uppercase text-center">02 / Selected Work</div>
    <div class="grid grid-cols-1 gap-12 md:grid-cols-2">
      <?php foreach ($projects as $project): ?>
      <div class="group">
        <div class="aspect-video bg-brand-light rounded-3xl border border-gray-100 mb-6 overflow-hidden">
          <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="<?php echo htmlspecialchars($project['image_path']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
        </div>
        <h3 class="text-2xl font-semibold mb-2"><?php echo htmlspecialchars($project['title']); ?></h3>
        <p class="text-brand-gray text-sm mb-4"><?php echo htmlspecialchars($project['description']); ?></p>
        <div class="flex gap-2">
          <?php 
          $tags = explode(',', $project['tags']);
          foreach ($tags as $tag): 
          ?>
          <span class="font-bold uppercase tracking-widest bg-gray-100 px-2 py-1 rounded text-[10px]"><?php echo trim($tag); ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="mb-32" id="testimonials">
    <div class="text-xs font-bold tracking-widest text-brand-gray mb-12 uppercase text-center">03 / Client Stories</div>
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
      <?php foreach ($testimonials as $t): ?>
      <div class="p-10 rounded-3xl border border-gray-100 bg-brand-light italic text-brand-gray text-sm leading-relaxed">
        "<?php echo htmlspecialchars($t['testimonial']); ?>"
        <div class="mt-8 not-italic flex items-center gap-4">
          <img class="w-10 h-10 rounded-full grayscale" src="<?php echo htmlspecialchars($t['image_path']); ?>" alt="client">
          <div>
            <div class="text-brand-black font-bold"><?php echo htmlspecialchars($t['client_name']); ?></div>
            <div class="text-wider uppercase text-[10px]"><?php echo htmlspecialchars($t['company_name']); ?></div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="text-center pt-24 pb-16" id="contact">
    <h2 class="text-5xl font-semibold hero-title mb-12 md:text-7xl">Let's <span class="editorial-italic font-normal">work</span> together.</h2>
    <div class="flex flex-col justify-center gap-6 sm:flex-row">
      <a class="bg-brand-black text-white text-lg font-medium px-12 py-5 rounded-2xl transition shadow-2xl hover:bg-gray-800" href="https://wa.link/byybuo">WhatsApp Us</a>
      <a class="bg-white text-brand-black border border-gray-200 text-lg font-medium px-12 py-5 rounded-2xl transition shadow-lg hover:bg-gray-50" href="mailto:hidayat@digiserv.id">Send Email</a>
    </div>
  </section>
</main>

<?php include 'includes/footer.php'; ?>
