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
            <a class="flex items-center gap-2" href="<?php echo $base; ?>index">
                <img class="w-8 h-8 rounded-full object-cover" src="<?php echo $base; ?>img/logo.jpg" alt="Digiserv Logo">
                <span class="font-bold text-lg tracking-tight text-brand-black">Digiserv</span>
            </a>
        </div>
        <nav class="hidden space-x-2 text-sm font-medium text-brand-gray md:flex">
            <a class="nav-pill transition hover:text-brand-black" href="<?php echo $base; ?>index#about">About</a>
            <a class="nav-pill transition hover:text-brand-black" href="<?php echo $base; ?>index#work">Work</a>
            <a class="nav-pill transition hover:text-brand-black" href="<?php echo $base; ?>blog/">Journal</a>
        </nav>
        <div class="flex items-center gap-2 pr-2">
            <a class="inline-flex items-center gap-2 bg-white text-brand-black text-xs font-bold px-5 rounded-full transition shadow-sm py-2.5 hover:bg-gray-50 border border-gray-100" href="https://wa.link/byybuo">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
              WhatsApp
            </a>
            <a class="inline-flex items-center gap-2 bg-brand-black text-white text-xs font-bold px-5 rounded-full transition shadow-lg py-2.5 hover:bg-gray-800" href="mailto:hidayat@digiserv.id">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
              Email
            </a>
        </div>
      </header>
    </div>
    <div class="h-28"></div>
