<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Enterprise Software & Automation Experts | Digiserv.id'; ?></title>
    <meta name="description" content="<?php echo $pageDescription ?? 'Digiserv.id — Premium digital agency specializing in high-performance web applications, AI integration, and scalable solutions.'; ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Playfair+Display:ital,wght@0,400;0,600;1,400;1,600&amp;display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Inter', 'sans-serif'],
              serif: ['Playfair Display', 'serif'],
            },
            colors: {
              'brand-black': '#0A0A0A',
              'brand-gray': '#666666',
              'brand-light': '#FAFAFA',
              'brand-border': '#EAEAEA',
            }
          }
        }
      }
      
    </script>
    <style>
      body { background-color: #FFFFFF; color: #0A0A0A; }
      .editorial-italic { font-family: 'Playfair Display', serif; font-style: italic; font-weight: 500; letter-spacing: -0.02em; }
      .hero-title { letter-spacing: -0.04em; line-height: 1.1; }
      .dashed-border-y { border-top: 1px dashed #EAEAEA; border-bottom: 1px dashed #EAEAEA; }
      .dashed-border-l { border-left: 1px dashed #EAEAEA; }
      .selection-style::selection { background-color: #000; color: #fff; }
      .glass-nav { 
          background: rgba(255, 255, 255, 0.6); 
          backdrop-filter: blur(20px); 
          -webkit-backdrop-filter: blur(20px); 
          border: 1px solid rgba(255, 255, 255, 0.3);
          box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
      }
      .nav-pill {
          padding: 6px 20px;
          border-radius: 9999px;
          transition: all 0.3s;
      }
      .nav-pill:hover {
          background: rgba(0,0,0,0.05);
      }
      .nav-pill.active {
          background: rgba(0,0,0,0.1);
          border: 1px solid rgba(0,0,0,0.1);
      }
      article p { margin-bottom: 2rem; line-height: 1.8; color: #444; }
      article h2 { font-family: 'Playfair Display', serif; font-weight: 600; font-size: 2rem; margin-top: 3rem; margin-bottom: 1.5rem; color: #0A0A0A; }
      
    </style>
  </head>
  <body class="antialiased selection-style">
    <?php $base = $basePath ?? './'; ?>
    <div class="fixed top-6 left-0 right-0 z-100 px-6">
      <header class="max-w-6xl mx-auto glass-nav rounded-full p-2 flex justify-between items-center">
        <div class="flex items-center gap-3 pl-4">
            <a class="flex items-center gap-2" href="<?php echo $base; ?>index.php">
                <img class="w-8 h-8 rounded-full object-cover" src="<?php echo $base; ?>img/logo.jpg" alt="Digiserv Logo">
                <span class="font-bold text-lg tracking-tight text-brand-black">Digiserv</span>
            </a>
        </div>
        <nav class="hidden space-x-2 text-sm font-medium text-brand-gray md:flex">
            <a class="nav-pill transition hover:text-brand-black" href="<?php echo $base; ?>index.php#about">About</a>
            <a class="nav-pill transition hover:text-brand-black" href="<?php echo $base; ?>index.php#work">Work</a>
            <a class="nav-pill transition hover:text-brand-black" href="<?php echo $base; ?>blog/index.php">Journal</a>
        </nav>
        <div class="flex items-center gap-2 pr-2">
            <a class="bg-white text-brand-black text-xs font-bold px-6 rounded-full transition shadow-sm py-2.5 hover:bg-gray-50 border border-gray-100" href="https://wa.link/byybuo">Whatsapp</a>
            <a class="bg-blue-600 text-white text-xs font-bold px-6 rounded-full transition shadow-lg py-2.5 hover:bg-blue-700" href="mailto:hidayat@digiserv.id">Email</a>
        </div>
      </header>
    </div>
    <div class="h-28"></div>
