<?php
$pageTitle = 'Enterprise Automation & Solutions | Digiserv.id';
$pageDescription = 'Digiserv.id — Premium digital agency specializing in production-grade automation, invoice systems, and educational technology.';
$basePath = '../';
include '../includes/header.php';
?>

<main class="max-w-6xl mx-auto px-6 pb-24">
  <section class="pt-24 pb-20 text-center flex flex-col items-center">
    <div class="inline-flex items-center bg-white border border-dashed border-gray-300 rounded-full px-5 py-2 mb-10">
      <div class="flex -space-x-2 mr-4">
        <img class="w-7 h-7 rounded-full border-2 border-white object-cover" src="../img/testimoni-2.webp" alt="client">
        <img class="w-7 h-7 rounded-full border-2 border-white object-cover" src="../img/testimoni-3.jpeg" alt="client">
        <img class="w-7 h-7 rounded-full border-2 border-white object-cover" src="../img/testimoni-4.webp" alt="client">
      </div>
      <span class="text-xs font-medium text-gray-600">2000+ companies trust us</span>
    </div>
    <h1 class="text-5xl font-semibold hero-title max-w-4xl mx-auto text-brand-black mb-10 md:text-8xl">Built for those who want <span class="editorial-italic font-normal">better.</span></h1>
    <p class="text-lg text-brand-gray max-w-2xl mx-auto mb-12 leading-relaxed md:text-xl">Buat program pakai AI memang mudah, tapi untuk <span class="font-bold">production-grade</span> butuh keahlian. Digiserv membantu otomatisasi workflow untuk bisnis dan institusi Anda.</p>
    <a class="bg-brand-black text-white text-base font-medium px-10 py-4 rounded-xl transition shadow-xl transform duration-300 hover:bg-gray-800 hover:scale-105" href="#services">Explore Services</a>
  </section>

  <section class="max-w-6xl mx-auto mb-32">
    <div class="dashed-border-y grid grid-cols-2 py-12 md:grid-cols-4">
      <div class="px-8 flex flex-col items-start justify-center">
        <span class="text-sm text-brand-gray mb-2">Projects completed</span>
        <span class="text-4xl font-semibold text-brand-black">120+</span>
      </div>
      <div class="px-8 flex flex-col items-start justify-center dashed-border-l">
        <span class="text-sm text-brand-gray mb-2">Satisfaction rate</span>
        <span class="text-4xl font-semibold text-brand-black">95%</span>
      </div>
      <div class="px-8 flex flex-col items-start justify-center dashed-border-l mt-10 pt-10 border-t border-dashed border-gray-200 md:mt-0 md:border-t-0 md:pt-0">
        <span class="text-sm text-brand-gray mb-2">In generated revenue</span>
        <span class="text-4xl font-semibold text-brand-black">$1M+</span>
      </div>
      <div class="px-8 flex flex-col items-start justify-center dashed-border-l mt-10 pt-10 border-t border-dashed border-gray-200 md:mt-0 md:border-t-0 md:pt-0">
        <span class="text-sm text-brand-gray mb-2">Client retention rate</span>
        <span class="text-4xl font-semibold text-brand-black">80%</span>
      </div>
    </div>
  </section>

  <section class="mb-32" id="services">
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
      <a class="group block p-10 rounded-3xl border border-gray-100 bg-brand-light hover_border-gray-200 transition-all duration-300 hover:shadow-xl" href="jasa-script-otomatis.php">
        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 mb-8 text-brand-black transition-transform group-hover:scale-110">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="16 18 22 12 16 6"></polyline>
            <polyline points="8 6 2 12 8 18"></polyline>
          </svg>
        </div>
        <h3 class="text-2xl font-semibold mb-4">Script Otomatis</h3>
        <p class="text-brand-gray leading-relaxed text-sm">Otomasi pekerjaan kantor dan bimbel dengan script yang handal. Built for production, not just a "vibe".</p>
      </a>
      <a class="group block p-10 rounded-3xl border border-gray-100 bg-brand-light hover_border-gray-200 transition-all duration-300 hover:shadow-xl" href="invoice-otomatis.php">
        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 mb-8 text-brand-black transition-transform group-hover:scale-110">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
          </svg>
        </div>
        <h3 class="text-2xl font-semibold mb-4">Invoice Otomatis</h3>
        <p class="text-brand-gray leading-relaxed text-sm">Sistem penagihan otomatis yang presisi. Nol kesalahan nominal, efisiensi administrasi maksimal.</p>
      </a>
      <a class="group block p-10 rounded-3xl border border-gray-100 bg-brand-light hover_border-gray-200 transition-all duration-300 hover:shadow-xl" href="aplikasi-sekolah-rapor.php">
        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm border border-gray-100 mb-8 text-brand-black transition-transform group-hover:scale-110">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
          </svg>
        </div>
        <h3 class="text-2xl font-semibold mb-4">Aplikasi Rapor</h3>
        <p class="text-brand-gray leading-relaxed text-sm">Manajemen nilai digital yang aman dan sesuai standar kurikulum. Fokus mengajar, biarkan kami menangani data.</p>
      </a>
    </div>
  </section>

  <section class="text-center pt-24 pb-16" id="contact">
    <h2 class="text-5xl font-semibold hero-title mb-12 md:text-7xl">Ready for <span class="editorial-italic font-normal">production?</span></h2>
    <div class="flex flex-col justify-center gap-6 sm:flex-row">
      <a class="bg-brand-black text-white text-lg font-medium px-12 py-5 rounded-2xl transition shadow-2xl hover:bg-gray-800" href="https://wa.link/byybuo">WhatsApp Us</a>
      <a class="bg-white text-brand-black border border-gray-200 text-lg font-medium px-12 py-5 rounded-2xl transition shadow-lg hover:bg-gray-50" href="mailto:hidayat@digiserv.id">Send Email</a>
    </div>
  </section>
</main>

<?php include '../includes/footer.php'; ?>
