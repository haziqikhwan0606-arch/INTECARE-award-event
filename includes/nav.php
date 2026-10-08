<?php
/**
 * INTECARE 2026 — GLOBAL NAVIGATION HEADER
 * Preserves Barlow Condensed + Manrope typography, deep teal palette & neon lime accents.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (!isset($activePage)) {
    $activePage = 'home';
}
if (!isset($pageTitle)) {
    $pageTitle = 'INTECARE EXCELLENCE AWARD 2026 — Official Website';
}
if (!isset($pageDescription)) {
    $pageDescription = 'INTECARE 2026 brings together healthcare, wellness, education, professional practice, innovation, technology, enterprise and industry celebrating excellence across the healthcare and wellness economy.';
}

// Compute dynamic basePath for XAMPP (/INTECARE) vs root domain
if (!isset($basePath)) {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    if (preg_match('#^/(intecare)#i', $requestUri, $matches)) {
        $basePath = '/' . $matches[1];
    } else {
        $basePath = '';
    }
}

// Compute full URL for canonical and Open Graph
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$currentUrl = $protocol . $host . ($_SERVER['REQUEST_URI'] ?? '');
$ogImage = $protocol . $host . $basePath . '/assets/images/logo-intecare3.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  <link rel="icon" href="<?= $basePath ?>/assets/images/logo-intecare.png" type="image/png">
  <link rel="apple-touch-icon" href="<?= $basePath ?>/assets/images/logo-intecare.png">

  <!-- Mobile Status Bar & Browser Palette (Deep Emerald Theme) -->
  <meta name="theme-color" content="#00201B">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

  <!-- Open Graph / Social Media Preview (WhatsApp, LinkedIn, Telegram, Facebook) -->
  <meta property="og:site_name" content="INTECARE 2026">
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>">
  <meta property="og:url" content="<?= htmlspecialchars($currentUrl) ?>">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="en_MY">

  <!-- Twitter / X Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($ogImage) ?>">

  <!-- Global Structured Data (Organization Schema) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "INTECARE 2026",
    "alternateName": "INTECARE Excellence Award 2026",
    "url": "<?= htmlspecialchars($protocol . $host . $basePath . '/') ?>",
    "logo": "<?= htmlspecialchars($ogImage) ?>",
    "description": "<?= htmlspecialchars($pageDescription) ?>",
    "email": "secretariat@intecare.org"
  }
  </script>

  <!-- Global Font System: Barlow Condensed + Manrope + Plus Jakarta Sans + Cinzel (Luxury & Gala Cards) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Cinzel:wght@600;700;800;900&family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= $basePath ?>/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
  <link rel="stylesheet" href="<?= $basePath ?>/assets/css/assistant.css?v=<?= filemtime(__DIR__ . '/../assets/css/assistant.css') ?>">

  <!-- Inline Critical Transition CSS for Zero-Latency First Paint -->
  <style id="intecareCriticalTransitionCSS">
    .intecare-page-transition {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      z-index: 9999999;
      pointer-events: none;
      visibility: hidden;
      overflow: hidden;
    }
    .intecare-page-transition__sheet {
      position: absolute;
      top: 0;
      left: 0;
      width: 140vw;
      height: 100vh;
      will-change: transform;
      transform: translate3d(calc(100vw + 260px), 0, 0);
      display: flex;
    }
    .intecare-page-transition__shadow {
      width: clamp(80px, 12vw, 160px);
      height: 100%;
      flex-shrink: 0;
      background: linear-gradient(90deg, transparent 0%, rgba(0, 32, 27, 0.03) 25%, rgba(0, 32, 27, 0.12) 65%, rgba(0, 32, 27, 0.28) 100%);
      pointer-events: none;
    }
    .intecare-page-transition__fold {
      width: clamp(40px, 5.5vw, 90px);
      height: 100%;
      flex-shrink: 0;
      position: relative;
      overflow: visible;
      z-index: 3;
    }
    .intecare-page-transition__curve-svg {
      width: 100%;
      height: 100%;
      display: block;
    }
    .intecare-page-transition__paper {
      position: relative;
      flex: 1;
      height: 100%;
      background-color: #F6F3EC;
      background: linear-gradient(90deg, #F6F3EC 0%, #FAF8F3 15%, #F3EFE6 55%, #ECE5D8 90%, #E4DCB8 100%);
      z-index: 2;
      overflow: hidden;
    }
    .intecare-page-transition__sheen {
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, rgba(255, 255, 255, 0.5) 0%, rgba(255, 255, 255, 0.15) 20%, transparent 45%);
      pointer-events: none;
    }
    .intecare-page-transition__brand {
      position: absolute;
      top: 50%;
      left: 55vw;
      transform: translate(-50%, -50%);
      z-index: 3;
      display: flex;
      align-items: center;
      justify-content: center;
      pointer-events: none;
      text-align: center;
    }
    .intecare-page-transition__logo {
      width: clamp(170px, 20vw, 260px);
      height: auto;
      max-height: 90px;
      object-fit: contain;
      display: block;
      filter: drop-shadow(0 4px 16px rgba(0, 32, 27, 0.08));
    }

    @keyframes intecarePaperSweepIn {
      0% { transform: translate3d(calc(100vw + 260px), 0, 0); }
      100% { transform: translate3d(-10vw, 0, 0); }
    }
    @keyframes intecarePaperSweepOut {
      0% { transform: translate3d(-10vw, 0, 0); }
      100% { transform: translate3d(calc(-150vw - 260px), 0, 0); }
    }

    html.intecare-transitioning-in,
    html.intecare-transitioning-in body {
      overflow: hidden !important;
    }

    html.intecare-transitioning-in .intecare-page-transition,
    .intecare-page-transition.is-exiting,
    .intecare-page-transition.is-entering,
    .intecare-page-transition.is-active {
      visibility: visible !important;
      pointer-events: auto !important;
    }

    html.intecare-transitioning-in .intecare-page-transition__sheet {
      transform: translate3d(-10vw, 0, 0) !important;
      transition: none !important;
      animation: none !important;
    }

    .intecare-page-transition.is-exiting .intecare-page-transition__sheet,
    .intecare-page-transition.is-active .intecare-page-transition__sheet {
      animation: intecarePaperSweepIn 0.30s cubic-bezier(0.25, 1, 0.5, 1) forwards !important;
    }

    .intecare-page-transition.is-entering .intecare-page-transition__sheet {
      animation: intecarePaperSweepOut 0.44s cubic-bezier(0.16, 1, 0.3, 1) forwards !important;
    }

    @media print {
      #intecarePageTransition,
      .intecare-page-transition,
      .intecare-page-transition * {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        width: 0 !important;
        height: 0 !important;
        position: static !important;
        overflow: hidden !important;
        transform: none !important;
      }
    }
  </style>

  <!-- Seamless Editorial Page Transition Pre-Paint Guard -->
  <script>
    (function() {
      try {
        if (sessionStorage.getItem('intecare_editorial_transition') === 'active') {
          document.documentElement.classList.add('intecare-transitioning-in');
        }
      } catch(e) {}
    })();
  </script>
</head>
<body>

  <!-- ==========================================================================
       LUXURY EDITORIAL MAGAZINE / ART BOOK PAGE REVEAL
       A flat sheet of warm ivory paper sweeps right-to-left across the screen
       with a subtle curved leading edge, soft moving cast shadow & fold gradient.
       ========================================================================== -->
  <div class="intecare-page-transition" id="intecarePageTransition" aria-hidden="true">
    <div class="intecare-page-transition__sheet">
      <!-- Soft moving shadow projecting to the left of the curved leading edge -->
      <div class="intecare-page-transition__shadow"></div>
      
      <!-- Leading Curved Fold Element with subtle organic curve -->
      <div class="intecare-page-transition__fold">
        <svg class="intecare-page-transition__curve-svg" viewBox="0 0 120 1000" preserveAspectRatio="none" aria-hidden="true">
          <path d="M120,0 C30,320 30,680 120,1000 L120,0 Z" fill="#F5F2EA"></path>
          <path d="M120,0 C30,320 30,680 120,1000" fill="none" stroke="rgba(255, 255, 255, 0.65)" stroke-width="2.5"></path>
          <path d="M120,0 C35,320 35,680 120,1000" fill="none" stroke="rgba(215, 207, 192, 0.35)" stroke-width="4"></path>
        </svg>
      </div>

      <!-- Main Flat Warm Ivory Paper Surface -->
      <div class="intecare-page-transition__paper">
        <div class="intecare-page-transition__sheen"></div>
        <div class="intecare-page-transition__brand">
          <img src="<?= $basePath ?>/assets/images/logo-intecare3.png" alt="INTECARE 2026" class="intecare-page-transition__logo" width="220" height="70">
        </div>
      </div>
    </div>
  </div>

  <!-- Immediate Inline Transition Entry Kickoff (Zero frame gap) -->
  <script>
    (function() {
      try {
        if (sessionStorage.getItem('intecare_editorial_transition') === 'active') {
          sessionStorage.removeItem('intecare_editorial_transition');
          var overlay = document.getElementById('intecarePageTransition');
          if (overlay) {
            overlay.classList.add('is-entering');
            requestAnimationFrame(function() {
              document.documentElement.classList.remove('intecare-transitioning-in');
            });
            setTimeout(function() {
              overlay.classList.remove('is-entering');
            }, 460);
          }
        }
      } catch(e) {}
    })();
  </script>

  <!-- ==========================================================================
       GLOBAL SITE HEADER (6 Dedicated Pages + Submit Nomination CTA)
       ========================================================================== -->
  <header class="site-header" id="siteHeader">
    <div class="nav-container">
      <a href="<?= $basePath ?>/" class="brand-logo-link" aria-label="INTECARE 2026 Home">
        <img src="<?= $basePath ?>/assets/images/logo-intecare.png" alt="INTECARE 2026" class="brand-logo-img" width="160" height="60">
      </a>

      <nav class="nav-menu" id="primaryNav" aria-label="Main Navigation">
        <a href="<?= $basePath ?>/" class="nav-link <?= $activePage === 'home' ? 'active' : '' ?>">HOME</a>
        <a href="<?= $basePath ?>/about" class="nav-link <?= $activePage === 'about' ? 'active' : '' ?>">ABOUT</a>
        <a href="<?= $basePath ?>/awards" class="nav-link <?= $activePage === 'awards' ? 'active' : '' ?>">AWARDS</a>
        <a href="<?= $basePath ?>/hwed-ecosystem" class="nav-link <?= $activePage === 'ecosystem' ? 'active' : '' ?>">HWED ECOSYSTEM</a>
        <a href="<?= $basePath ?>/organisers" class="nav-link <?= $activePage === 'organisers' ? 'active' : '' ?>">ORGANISERS</a>
        <a href="<?= $basePath ?>/event-details" class="nav-link <?= $activePage === 'event' ? 'active' : '' ?>">EVENT DETAILS</a>
        <a href="javascript:void(0)" class="nav-link nav-mobile-track open-tracking-btn">TRACK STATUS</a>
      </nav>

      <div class="nav-cta-wrap">
        <button type="button" class="btn btn-nav-track open-tracking-btn" aria-label="Track Nomination Status">
          <span>TRACK STATUS</span>
        </button>
        <a href="<?= $basePath ?>/assets/downloads/INTECARE_2026_Nomination_Form.pdf" download="INTECARE_2026_Nomination_Form.pdf" class="btn btn-nav-cta" aria-label="Download Nomination Form">
          <span>DOWNLOAD FORM</span>
          <span class="btn-arrow" aria-hidden="true">↓</span>
        </a>
        <button type="button" class="mobile-toggle" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation menu">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>
  </header>
