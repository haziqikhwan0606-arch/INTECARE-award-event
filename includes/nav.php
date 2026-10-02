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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  <link rel="icon" href="<?= $basePath ?>/assets/images/logo-intecare.png" type="image/png">

  <!-- Global Font System: Barlow Condensed (Display & Headings) + Manrope (Body & UI) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Manrope:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= $basePath ?>/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
  <link rel="stylesheet" href="<?= $basePath ?>/assets/css/assistant.css?v=<?= filemtime(__DIR__ . '/../assets/css/assistant.css') ?>">
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
      </div>
    </div>
  </div>

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
        <button type="button" class="btn btn-nav-cta open-nomination-btn">
          <span>SUBMIT NOMINATION</span>
          <span class="btn-arrow" aria-hidden="true">→</span>
        </button>
        <button type="button" class="mobile-toggle" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation menu">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>
  </header>
