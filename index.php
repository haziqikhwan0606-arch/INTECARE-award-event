<?php
/**
 * INTECARE EXCELLENCE AWARDS 2026 — OFFICIAL HOMEPAGE
 * Layout and design structure in the format of realestatepillars.com
 * Content, categories, patrons, packages & data 100% grounded in the official INTECARE 2026 Sponsorship Booklet.
 */

// Compute dynamic basePath for XAMPP (/INTECARE2) vs root domain
$requestUri = $_SERVER['REQUEST_URI'] ?? '';
if (preg_match('#^/([^/]+)#i', $requestUri, $matches)) {
    $basePath = '/' . $matches[1];
} else {
    $basePath = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>INTECARE EXCELLENCE AWARDS 2026 | Hotel Royale Chulan Damansara | 27 November 2026</title>

    <link rel="icon" href="<?= $basePath ?>/assets/images/logo-intecare2.png" type="image/png">

    <!-- CSS Files (realestatepillars.com format)
    ================================================== -->
    <link href="<?= $basePath ?>/assets/realestate/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="<?= $basePath ?>/assets/realestate/css/vendors.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="<?= $basePath ?>/assets/realestate/css/gallery-slider.css" />
    <link href="<?= $basePath ?>/assets/realestate/css/style.css" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="<?= $basePath ?>/assets/realestate/css/scheme-01.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts & Luxury Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800;900&family=Manrope:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome & Icon CDNs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@icon/icofont@1.0.1-alpha.1/icofont.min.css">

    <!-- ═══════════════════════════════════════════
         PRIMARY SEO META TAGS
    ═══════════════════════════════════════════ -->
    <meta name="title" content="INTECARE EXCELLENCE AWARDS 2026 | Hotel Royale Chulan Damansara | 27 November 2026">
    <meta name="description" content="INTECARE Excellence Awards 2026 — Healthier People | Better Care | Stronger Economy. Recognising excellence across healthcare, wellness, education, enterprise and the longevity economy. Hotel Royale Chulan Damansara, 27 November 2026.">
    <meta name="keywords" content="INTECARE Excellence Awards 2026, HWED, MIHA, Olympia Education, healthcare awards Malaysia, wellness excellence awards 2026, healthcare economy development">
    <meta name="robots" content="index, follow">
    <meta name="author" content="INTECARE 2026 Secretariat">

    <style>
        :root {
            /* INTECARE Official Color Palette — Dark Imperial Emerald & Champagne Gold */
            --intecare-navy-dark: #020705;
            --intecare-navy: #040d0a;
            --intecare-navy-light: #071a15;
            --intecare-royal-blue: #044b36;
            --intecare-blue-light: #10b981;
            
            --intecare-emerald: #10b981;
            --intecare-emerald-dark: #059669;
            --intecare-emerald-light: #34d399;
            --intecare-teal: #00838f;
            
            --intecare-gold: #c9a227;
            --intecare-gold-light: #f5d061;
            --intecare-gold-dark: #996515;
            
            /* Logo Triple & Dual Gradients */
            --brand-logo-gradient: linear-gradient(135deg, #10b981 0%, #00838f 48%, #c9a227 100%);
            --blue-emerald-gradient: linear-gradient(135deg, #044b36 0%, #00838f 50%, #10b981 100%);
            --emerald-gold-gradient: linear-gradient(135deg, #10b981 0%, #f5d061 60%, #c9a227 100%);
            --gold-gradient: linear-gradient(135deg, #fce08b 0%, #d4af37 50%, #996515 100%);
            --blue-gradient: linear-gradient(135deg, #10b981 0%, #044b36 100%);
            
            /* Core UI Foundations — Imperial Dark Emerald */
            --navy: #040d0a;
            --navy-light: #071a15;
            --navy-card: rgba(7, 26, 21, 0.85);
            --gold: #c9a227;
            --gold-light: #f5d061;
            --emerald: #10b981;
            --teal-accent: #00838f;
            --royal-blue: #10b981;
            --text-muted: #94a3b8;
            --bg-dark: #040d0a;
            --font-display: 'Cinzel', serif;
            --font-sans: 'Manrope', 'Plus Jakarta Sans', sans-serif;
        }

        /* ══════════════════════════════════════════════════════
           GLOBAL OVERRIDES: Defeat Vendor Flat Black (#000)
           ══════════════════════════════════════════════════════ */
        html, body, body.dark-scheme, #wrapper, #content {
            background-color: #040d0a !important;
            color: #e2e8f0;
            font-family: var(--font-sans);
        }

        .dark-scheme section, 
        section, 
        section.bg-dark, 
        section.section-dark, 
        .bg-dark, 
        .bg-dark-1, 
        .bg-dark-2,
        .w2animated-dark,
        section#Categories1,
        #section-table,
        #section-patrons,
        #section-about {
            background-color: #040d0a !important;
        }

        /* Alternating Sections for Subtle Gala Depth */
        section:nth-of-type(even), 
        #why-Sponsor, 
        #section-faq,
        #sponsorship {
            background-color: #071a15 !important;
        }

        /* Sticky & Transparent Header Overrides */
        header, header.transparent {
            background: rgba(4, 13, 10, 0.75) !important;
            backdrop-filter: blur(14px) !important;
            -webkit-backdrop-filter: blur(14px) !important;
            border-bottom: 1px solid rgba(201, 162, 39, 0.2) !important;
        }

        header.smaller, 
        header.smaller.scroll-dark, 
        header.smaller.header-dark, 
        header.header-mobile, 
        .dark-scheme header.header-mobile {
            background: rgba(4, 13, 10, 0.96) !important;
            backdrop-filter: blur(16px) !important;
            -webkit-backdrop-filter: blur(16px) !important;
            border-bottom: 1px solid rgba(201, 162, 39, 0.35) !important;
            box-shadow: 0 10px 32px rgba(0, 0, 0, 0.85) !important;
        }

        /* Hero Overlay */
        .sw-overlay, .sw-overlay.op-5, .sw-overlay.op-9 {
            background: linear-gradient(180deg, rgba(4, 13, 10, 0.55) 0%, rgba(4, 13, 10, 0.92) 100%) !important;
        }

        /* Footer */
        footer, .dark-scheme footer {
            background: #020806 !important;
            border-top: 1px solid rgba(201, 162, 39, 0.22) !important;
        }

        /* Luxury Typography */
        h1, h2, h3, h4, .cinzel-font {
            font-family: var(--font-display);
            letter-spacing: 0.5px;
            color: #ffffff;
        }

        .gold-gradient-text {
            background: var(--gold-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        .brand-logo-text {
            background: var(--brand-logo-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        /* Navigation Links & Header Layout */
        header .de-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        header .de-flex > .de-flex-col:first-child {
            margin-right: 45px;
            flex-shrink: 0;
        }

        header .de-flex > .de-flex-col:last-child {
            margin-left: 25px;
            flex-shrink: 0;
        }

        #mainmenu {
            display: flex;
            align-items: center;
            margin: 0 !important;
            padding: 0;
            list-style: none;
        }

        #mainmenu > li {
            margin: 0 14px !important;
            display: inline-flex;
            align-items: center;
        }

        #mainmenu > li > a {
            color: #e2e8f0;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 30px 0 !important;
            white-space: nowrap;
            text-transform: uppercase;
            transition: color 0.25s ease;
        }

        header.smaller #mainmenu > li > a {
            padding: 20px 0 !important;
        }

        #mainmenu > li > a:hover,
        #mainmenu > li > a.active {
            color: var(--gold) !important;
        }

        /* Golden Luxury CTA Button */
        .btn-main, a.btn-main {
            background: linear-gradient(135deg, #fce08b 0%, #d4af37 50%, #996515 100%) !important;
            color: #040d0a !important;
            font-weight: 700 !important;
            border: none !important;
            box-shadow: 0 4px 18px rgba(201, 162, 39, 0.35) !important;
            transition: all 0.3s ease !important;
        }

        .btn-main:hover, a.btn-main:hover {
            box-shadow: 0 6px 25px rgba(201, 162, 39, 0.6), 0 0 15px rgba(252, 224, 139, 0.4) !important;
            transform: translateY(-2px);
            color: #020705 !important;
        }

        /* Glassmorphism Luxury Cards (Smoked Emerald Velvet) */
        .luxury-card {
            background: var(--navy-card);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(201, 162, 39, 0.28);
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.65), 0 0 15px rgba(201, 162, 39, 0.1);
            transition: all 0.35s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .luxury-card:hover {
            border-color: rgba(201, 162, 39, 0.65);
            transform: translateY(-5px);
            box-shadow: 0 18px 50px rgba(0, 0, 0, 0.8), 0 0 25px rgba(16, 185, 129, 0.22), 0 0 15px rgba(201, 162, 39, 0.2);
            background: rgba(11, 40, 32, 0.95);
        }

        /* Hero Event Badges */
        .event-ticket-badge {
            background: rgba(7, 26, 21, 0.92);
            border: 1px solid rgba(201, 162, 39, 0.45);
            border-radius: 50px;
            padding: 12px 28px;
            display: inline-flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 8px 26px rgba(0, 0, 0, 0.65), 0 0 16px rgba(201, 162, 39, 0.15);
            backdrop-filter: blur(12px);
        }

        .event-ticket-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            font-size: 14.5px;
            font-weight: 600;
        }

        .event-ticket-item i {
            color: var(--gold);
            font-size: 16px;
        }

        .event-ticket-divider {
            width: 1px;
            height: 20px;
            background: rgba(255, 255, 255, 0.18);
        }

        /* 4 Lifecycle Pillar Cards */
        .pillar-card {
            background: rgba(7, 26, 21, 0.82);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 24px 20px;
            text-align: center;
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
        }

        .pillar-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--brand-logo-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .pillar-card:hover {
            transform: translateY(-6px);
            border-color: rgba(201, 162, 39, 0.55);
            background: rgba(11, 40, 32, 0.95);
            box-shadow: 0 14px 38px rgba(0, 0, 0, 0.65), 0 0 18px rgba(16, 185, 129, 0.22);
        }

        .pillar-card:hover::before {
            opacity: 1;
        }

        .pillar-icon-box {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: rgba(201, 162, 39, 0.12);
            border: 1px solid rgba(201, 162, 39, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: var(--gold);
            font-size: 22px;
            transition: all 0.3s ease;
        }

        .pillar-card:hover .pillar-icon-box {
            background: var(--gold);
            color: #040d0a;
            transform: scale(1.1);
            box-shadow: 0 0 18px rgba(201, 162, 39, 0.5);
        }

        .pillar-title {
            font-family: var(--font-display);
            font-size: 18px;
            color: #fff;
            margin-bottom: 6px;
            font-weight: 700;
        }

        .pillar-subtitle {
            font-size: 13.5px;
            color: var(--gold-light);
            margin: 0;
            font-weight: 500;
        }

        /* 4 Specific Pillar Quadrant Colors from Logo */
        .pillar-card.pillar-stay-well .pillar-icon-box {
            color: var(--intecare-emerald);
            border-color: rgba(16, 185, 129, 0.4);
            background: rgba(16, 185, 129, 0.12);
        }
        .pillar-card.pillar-stay-well:hover {
            border-color: var(--intecare-emerald);
            box-shadow: 0 14px 35px rgba(0,0,0,0.6), 0 0 20px rgba(16, 185, 129, 0.25);
        }
        .pillar-card.pillar-stay-well:hover .pillar-icon-box {
            background: var(--intecare-emerald);
            color: #040d0a;
            box-shadow: 0 0 18px rgba(16, 185, 129, 0.5);
        }

        .pillar-card.pillar-get-well .pillar-icon-box {
            color: var(--intecare-blue-light);
            border-color: rgba(16, 185, 129, 0.4);
            background: rgba(16, 185, 129, 0.12);
        }
        .pillar-card.pillar-get-well:hover {
            border-color: var(--intecare-blue-light);
            box-shadow: 0 14px 35px rgba(0,0,0,0.6), 0 0 20px rgba(16, 185, 129, 0.25);
        }
        .pillar-card.pillar-get-well:hover .pillar-icon-box {
            background: var(--intecare-blue-light);
            color: #040d0a;
            box-shadow: 0 0 18px rgba(16, 185, 129, 0.5);
        }

        .pillar-card.pillar-recover-well .pillar-icon-box {
            color: var(--intecare-teal);
            border-color: rgba(0, 131, 143, 0.4);
            background: rgba(0, 131, 143, 0.12);
        }
        .pillar-card.pillar-recover-well:hover {
            border-color: var(--intecare-teal);
            box-shadow: 0 14px 35px rgba(0,0,0,0.6), 0 0 20px rgba(0, 131, 143, 0.25);
        }
        .pillar-card.pillar-recover-well:hover .pillar-icon-box {
            background: var(--intecare-teal);
            color: #040d0a;
            box-shadow: 0 0 18px rgba(0, 131, 143, 0.5);
        }

        .pillar-card.pillar-age-well .pillar-icon-box {
            color: var(--intecare-gold);
            border-color: rgba(201, 162, 39, 0.4);
            background: rgba(201, 162, 39, 0.12);
        }
        .pillar-card.pillar-age-well:hover {
            border-color: var(--intecare-gold);
            box-shadow: 0 14px 35px rgba(0,0,0,0.6), 0 0 20px rgba(201, 162, 39, 0.25);
        }
        .pillar-card.pillar-age-well:hover .pillar-icon-box {
            background: var(--intecare-gold);
            color: #040d0a;
            box-shadow: 0 0 18px rgba(201, 162, 39, 0.5);
        }

        /* 8 Special Highlights Grid */
        .highlight-box {
            background: rgba(7, 26, 21, 0.78);
            border: 1px solid rgba(201, 162, 39, 0.25);
            border-radius: 10px;
            padding: 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s ease;
        }

        .highlight-box:hover {
            border-color: var(--emerald);
            background: rgba(11, 40, 32, 0.95);
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.5), 0 0 16px rgba(16, 185, 129, 0.18);
        }

        .highlight-num {
            font-family: var(--font-display);
            font-size: 28px;
            font-weight: 800;
            color: var(--gold);
            line-height: 1;
            min-width: 40px;
        }

        .highlight-info h4 {
            font-size: 16px;
            color: #fff;
            margin: 0 0 4px;
            font-weight: 700;
        }

        .highlight-info p {
            font-size: 13px;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.4;
        }

        /* Marquee Ribbon Styles */
        .marquee-section {
            overflow: hidden;
            padding: 30px 0;
            position: relative;
            background: #040d0a;
        }

        .marquee-ribbon {
            width: 110vw;
            margin-left: -5vw;
            overflow: hidden;
            position: relative;
            padding: 16px 0;
            display: flex;
            user-select: none;
        }

        .marquee-ribbon.rot-top {
            transform: rotate(1.5deg);
            z-index: 2;
            background: linear-gradient(135deg, #fce08b 0%, #d4af37 50%, #996515 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.7);
        }

        .marquee-ribbon.rot-bottom {
            transform: rotate(-1deg);
            z-index: 3;
            margin-top: -16px;
            background: #071e17;
            border-top: 1px solid rgba(16, 185, 129, 0.5);
            border-bottom: 1px solid rgba(201, 162, 39, 0.5);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.8);
        }

        .marquee-track {
            display: flex;
            width: max-content;
            flex-shrink: 0;
            will-change: transform;
        }

        .marquee-track-left {
            animation: marqueeLeftInfinite 55s linear infinite;
        }

        .marquee-track-right {
            animation: marqueeRightInfinite 55s linear infinite;
        }

        .marquee-ribbon:hover .marquee-track {
            animation-play-state: paused;
        }

        .marquee-content {
            display: flex;
            align-items: center;
            flex-shrink: 0;
            white-space: nowrap;
        }

        .marquee-text-dark {
            font-size: 22px;
            font-weight: 800;
            color: #040d0a;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 0 16px;
            display: inline-block;
        }

        .marquee-text-light {
            font-size: 22px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 0 16px;
            display: inline-block;
        }

        .marquee-star-emerald {
            font-size: 20px;
            color: #044b36;
            padding: 0 8px;
        }

        .marquee-star-gold {
            font-size: 20px;
            color: #c9a227;
            padding: 0 8px;
        }

        .marquee-star-teal {
            font-size: 20px;
            color: #10b981;
            padding: 0 8px;
        }

        @keyframes marqueeLeftInfinite {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        @keyframes marqueeRightInfinite {
            0% { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }

        /* Patron Profile Cards */
        .patron-card {
            background: linear-gradient(145deg, rgba(8, 28, 22, 0.95), rgba(4, 14, 11, 0.98));
            border: 1px solid rgba(201, 162, 39, 0.38);
            border-radius: 16px;
            padding: 35px;
            position: relative;
            box-shadow: 0 15px 40px rgba(0,0,0,0.65), 0 0 22px rgba(201, 162, 39, 0.12);
        }

        .patron-portrait-frame {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            border: 2px solid rgba(201, 162, 39, 0.55);
            box-shadow: 0 10px 30px rgba(0,0,0,0.7);
        }

        .patron-portrait-frame img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
        }

        .patron-card:hover .patron-portrait-frame img {
            transform: scale(1.03);
        }

        .patron-quote-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            background: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #040d0a;
            font-size: 20px;
            box-shadow: 0 4px 15px rgba(201, 162, 39, 0.5);
        }

        /* Category Filter Tabs */
        .category-filter-nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 35px;
        }

        .filter-btn {
            background: rgba(7, 26, 21, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #cbd5e1;
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover, .filter-btn.active {
            background: linear-gradient(135deg, #fce08b 0%, #d4af37 50%, #996515 100%);
            color: #040d0a;
            border-color: var(--gold);
            font-weight: 700;
            box-shadow: 0 4px 20px rgba(201, 162, 39, 0.45);
        }

        /* Categories Section Grid & Cards */
        .category-section {
            margin-bottom: 40px;
        }

        .category-name h2 {
            color: var(--gold);
            font-size: 22px;
            margin-bottom: 18px;
            border-bottom: 1px solid rgba(201, 162, 39, 0.28);
            padding-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .category-cards {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
        }

        .category-card {
            background: linear-gradient(145deg, rgba(10, 34, 27, 0.78) 0%, rgba(5, 18, 14, 0.9) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(201, 162, 39, 0.25);
            border-radius: 14px;
            padding: 22px 20px;
            cursor: pointer;
            transition: all 0.35s cubic-bezier(0.2, 0.8, 0.2, 1);
            position: relative;
            display: flex;
            align-items: center;
            min-height: 112px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5), inset 0 1px 1px rgba(255, 255, 255, 0.12);
        }

        /* Diagonal Light Sheen Shimmer */
        .category-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -60%;
            width: 40%;
            height: 200%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.14), transparent);
            transform: rotate(25deg);
            transition: left 0.65s ease;
            pointer-events: none;
        }

        .category-card:hover::after {
            left: 130%;
        }

        .category-card:hover {
            background: linear-gradient(145deg, rgba(14, 48, 38, 0.92) 0%, rgba(7, 24, 19, 0.98) 100%);
            border-color: rgba(201, 162, 39, 0.75);
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.75), 0 0 25px rgba(201, 162, 39, 0.25), inset 0 1px 1px rgba(255, 255, 255, 0.25);
        }

        .category-card h3.category-heading {
            font-size: 14px;
            color: #ffffff;
            margin: 0;
            line-height: 1.5;
            font-weight: 600;
            font-family: var(--font-sans);
            transition: color 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .category-card:hover h3.category-heading {
            color: #fce08b;
        }

        /* Pillar & Domain Badge Pills */
        .pillar-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            padding: 3px 9px;
            border-radius: 20px;
            margin-bottom: 8px;
            width: fit-content;
            line-height: 1.2;
        }

        .pillar-pill.pillar-stay-well {
            background: rgba(16, 185, 129, 0.18);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.45);
        }

        .pillar-pill.pillar-get-well {
            background: rgba(16, 185, 129, 0.18);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.45);
        }

        .pillar-pill.pillar-recover-well {
            background: rgba(0, 131, 143, 0.22);
            color: #2dd4bf;
            border: 1px solid rgba(0, 131, 143, 0.5);
        }

        .pillar-pill.pillar-age-well {
            background: rgba(201, 162, 39, 0.22);
            color: #fce08b;
            border: 1px solid rgba(201, 162, 39, 0.55);
        }

        .pillar-pill.pillar-corp-org {
            background: rgba(148, 163, 184, 0.16);
            color: #cbd5e1;
            border: 1px solid rgba(148, 163, 184, 0.35);
        }

        .pillar-pill.pillar-corp-tech {
            background: rgba(6, 182, 212, 0.18);
            color: #67e8f9;
            border: 1px solid rgba(6, 182, 212, 0.45);
        }

        .pillar-pill.pillar-corp-workforce {
            background: rgba(139, 92, 246, 0.18);
            color: #c4b5fd;
            border: 1px solid rgba(139, 92, 246, 0.45);
        }

        .pillar-pill.pillar-corp-ecosystem {
            background: rgba(245, 158, 11, 0.18);
            color: #fcd34d;
            border: 1px solid rgba(245, 158, 11, 0.45);
        }

        /* Modal Styles */
        #categoryModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(4, 13, 10, 0.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999999;
            padding: 20px;
        }

        #categoryModal .modal-content {
            background: linear-gradient(145deg, #092c22 0%, #04100c 100%);
            border: 1px solid rgba(201, 162, 39, 0.6);
            border-radius: 14px;
            max-width: 620px;
            width: 100%;
            padding: 35px;
            position: relative;
            box-shadow: 0 22px 60px rgba(0, 0, 0, 0.9), 0 0 30px rgba(201, 162, 39, 0.22);
        }

        #categoryModal .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            color: #fff;
            font-size: 28px;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s ease;
        }

        #categoryModal .close-btn:hover {
            color: var(--gold);
        }

        #categoryModal .modal-title {
            color: var(--gold);
            font-size: 22px;
            margin-bottom: 16px;
            line-height: 1.35;
        }

        #categoryModal .modal-list {
            color: #e2e8f0;
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        /* Venue Modal Styles */
        #venueModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(4, 13, 10, 0.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999999;
            padding: 20px;
            overflow-y: auto;
        }

        #venueModal .modal-content {
            background: linear-gradient(145deg, #092c22 0%, #04100c 100%);
            border: 1px solid rgba(201, 162, 39, 0.6);
            border-radius: 16px;
            max-width: 960px;
            width: 100%;
            padding: 28px 30px;
            position: relative;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.95), 0 0 35px rgba(201, 162, 39, 0.25);
            max-height: 90vh;
            overflow-y: auto;
        }

        #venueModal .close-btn {
            position: absolute;
            top: 16px;
            right: 20px;
            color: #cbd5e1;
            font-size: 28px;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s ease, transform 0.2s ease;
            background: none;
            border: none;
            outline: none;
        }

        #venueModal .close-btn:hover {
            color: var(--gold);
            transform: scale(1.15);
        }

        .venue-img-frame {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid rgba(201, 162, 39, 0.35);
            margin-bottom: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
        }

        .venue-img-frame img {
            width: 100%;
            height: 190px;
            object-fit: cover;
            display: block;
        }

        .venue-map-frame {
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid rgba(201, 162, 39, 0.35);
            height: 190px;
            margin-bottom: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
        }

        .venue-info-box {
            background: rgba(7, 26, 21, 0.7);
            border: 1px solid rgba(201, 162, 39, 0.2);
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 10px;
        }

        .venue-info-box h5 {
            color: var(--gold);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 4px;
            font-weight: 700;
        }

        .venue-info-box p {
            color: #cbd5e1;
            font-size: 13px;
            line-height: 1.5;
            margin: 0;
        }

        /* Why Sponsor Grid Wrap */
        .grid-wrap {
            max-width: 1300px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            margin-top: 30px;
        }

        .feature-box {
            background: rgba(7, 26, 21, 0.82);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            padding: 30px 26px;
            transition: all 0.35s ease;
            backdrop-filter: blur(10px);
        }

        .feature-box:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.65), 0 0 20px rgba(16, 185, 129, 0.18);
            border-color: var(--emerald);
            background: rgba(11, 40, 32, 0.95);
        }

        .feature-box .bar {
            width: 36px;
            height: 4px;
            background: linear-gradient(90deg, #c9a227, #10b981);
            border-radius: 2px;
            margin-bottom: 18px;
            transition: width 0.35s ease;
        }

        .feature-box:hover .bar {
            width: 58px;
        }

        .feature-box h3 {
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 12px 0;
            line-height: 1.35;
        }

        .feature-box p {
            color: var(--text-muted);
            font-size: 14.5px;
            line-height: 1.65;
            margin: 0;
        }

        /* Table NDF */
        .ndf {
            width: 100%;
            border-collapse: collapse;
            color: #fff;
            margin-top: 20px;
            min-width: 900px;
            border-radius: 8px;
            overflow: hidden;
        }

        .ndf th, .ndf td {
            padding: 16px 14px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            text-align: center;
            font-size: 14px;
            vertical-align: middle;
        }

        .ndf tr:first-child th, .ndf tr:first-child td {
            background: #082c23;
            font-weight: bold;
            color: var(--gold);
            font-size: 15px;
            border-bottom: 2px solid rgba(201, 162, 39, 0.4);
        }

        .ndf th:first-child {
            text-align: left;
            font-weight: 600;
            background: rgba(7, 26, 21, 0.75);
            color: #e2e8f0;
        }

        .ndf tr:nth-child(even) td {
            background: rgba(7, 26, 21, 0.45);
        }

        .ndf tr:hover td {
            background: rgba(201, 162, 39, 0.15);
        }

        .ndf i.fa-check {
            color: var(--emerald);
            font-size: 16px;
        }

        /* Stepper Milestone Ribbon */
        .journey-milestones {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: rgba(7, 26, 21, 0.9);
            border: 1px solid rgba(201, 162, 39, 0.4);
            border-radius: 50px;
            padding: 14px 28px;
            margin: 30px auto;
            max-width: 980px;
            flex-wrap: wrap;
            box-shadow: 0 10px 28px rgba(0,0,0,0.55);
        }

        .journey-step {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.5px;
        }

        .journey-step-num {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--gold);
            color: #040d0a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
        }

        .journey-arrow {
            color: var(--gold);
            opacity: 0.6;
            font-size: 14px;
        }

        /* ==========================================
           DEDICATED FAQ ACCORDION COMPONENT
           ========================================== */
        .faq-accordion {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .faq-item {
            background: rgba(7, 26, 21, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .faq-item:hover {
            border-color: rgba(201, 162, 39, 0.5);
            background: rgba(11, 40, 32, 0.95);
        }

        .faq-item.active {
            border-color: var(--gold);
            background: rgba(11, 40, 32, 0.98);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.6), 0 0 18px rgba(201, 162, 39, 0.18);
        }

        .faq-header {
            width: 100%;
            padding: 20px 24px;
            background: transparent;
            border: none;
            outline: none;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: left;
            user-select: none;
            transition: all 0.25s ease;
        }

        .faq-header-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
            transition: color 0.25s ease;
            margin: 0;
            line-height: 1.4;
        }

        .faq-header-title i {
            color: var(--gold);
            font-size: 17px;
            flex-shrink: 0;
        }

        .faq-item:hover .faq-header-title,
        .faq-item.active .faq-header-title {
            color: var(--gold);
        }

        .faq-chevron {
            color: var(--gold);
            font-size: 14px;
            transition: transform 0.35s cubic-bezier(0.2, 0.8, 0.2, 1);
            margin-left: 16px;
            flex-shrink: 0;
        }

        .faq-item.active .faq-chevron {
            transform: rotate(180deg);
        }

        .faq-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
            opacity: 0;
        }

        .faq-item.active .faq-body {
            max-height: 600px;
            opacity: 1;
        }

        .faq-content {
            padding: 16px 24px 22px;
            color: #cbd5e1;
            font-size: 14.5px;
            line-height: 1.7;
            border-top: 1px solid rgba(201, 162, 39, 0.18);
        }

        .faq-content p {
            margin-bottom: 8px;
        }

        .faq-content p:last-child {
            margin-bottom: 0;
        }

        .faq-content strong {
            color: #ffffff;
        }

        /* 3D Animated About Cards */
        .w2animated-dark {
            overflow: visible;
            position: relative;
        }

        .abt-col-text {
            position: relative;
            z-index: 10;
        }

        .abt-col-visual {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1500px;
            min-height: 560px;
        }

        .abt-tag {
            color: var(--gold, #C5A059);
            font-weight: 700;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
            display: inline-block;
        }

        h1.abt-head {
            font-size: 46px;
            font-weight: 800;
            line-height: 1.15;
            text-transform: uppercase;
            letter-spacing: -0.5px;
            color: #ffffff;
            margin-bottom: 22px;
        }

        .container2 {
            position: relative;
            width: 70% !important;
            aspect-ratio: 1 / 1;
            transform-style: preserve-3d;
            transform: translate3d(30px, 0, -520px) !important;
            margin: 0 auto !important;
        }

        .container2 .inner {
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            animation: rotate linear 30s infinite;
        }

        .container2 .card-wrapper {
            position: absolute;
            inset: 0;
            margin: auto;
            height: 100% !important;
            aspect-ratio: 9/16;
            transform-style: preserve-3d;
            backface-visibility: visible;
        }

        .container2 .card-wrapper:nth-child(1) { transform: rotateY(45deg) translateX(145%) !important; }
        .container2 .card-wrapper:nth-child(2) { transform: rotateY(90deg) translateX(145%) !important; }
        .container2 .card-wrapper:nth-child(3) { transform: rotateY(135deg) translateX(145%) !important; }
        .container2 .card-wrapper:nth-child(4) { transform: rotateY(180deg) translateX(145%) !important; }
        .container2 .card-wrapper:nth-child(5) { transform: rotateY(225deg) translateX(145%) !important; }
        .container2 .card-wrapper:nth-child(6) { transform: rotateY(270deg) translateX(145%) !important; }
        .container2 .card-wrapper:nth-child(7) { transform: rotateY(315deg) translateX(145%) !important; }
        .container2 .card-wrapper:nth-child(8) { transform: rotateY(360deg) translateX(145%) !important; }

        .container2 .card-wrapper img {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 20px !important;
            object-fit: cover;
            filter: grayscale(0.08);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.85);
            border: 1px solid rgba(201, 162, 39, 0.4);
            transform: rotateY(90deg);
        }

        @media (max-width: 1200px) {
            .category-cards { grid-template-columns: repeat(4, 1fr); }
        }

        @media (max-width: 991px) {
            .grid-wrap { grid-template-columns: repeat(2, 1fr); }
            .journey-milestones { border-radius: 16px; justify-content: center; }
            .abt-col-visual { min-height: 480px; margin-top: 30px; }
            .container2 { width: 75% !important; transform: translate3d(0, 0, -450px) !important; margin: 30px auto 0 !important; }
            .category-cards { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 767px) {
            .grid-wrap { grid-template-columns: 1fr; }
            .event-ticket-badge { flex-direction: column; gap: 10px; border-radius: 16px; width: 100%; }
            .event-ticket-divider { display: none; }
            h1.abt-head { font-size: 28px !important; }
            .fs-32 { font-size: 18px !important; }
            section#Categories1 { margin-top: 30px !important; }
            .ndf { font-size: 12px; }
            .ndf th, .ndf td { padding: 10px 8px; }
            .container2 { width: 85% !important; transform: translate3d(0, 0, -320px) !important; }
            .category-cards { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        }

        @media (max-width: 480px) {
            .category-cards { grid-template-columns: 1fr; }
        }
    </style>
</head>

<body class="dark-scheme">

    <div id="wrapper">

        <div class="float-text show-on-scroll">
            <span><a href="#">Scroll to top</a></span>
        </div>
        <div class="scrollbar-v show-on-scroll"></div>

        <!-- page preloader begin -->
        <div id="de-loader"></div>
        <!-- page preloader close -->

        <!-- header section -->
        <header class="transparent">
            <div class="container" style="max-width: 1560px; width: 96%;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex">
                            <div class="de-flex-col">
                                <!-- logo -->
                                <a href="<?= $basePath ?>/">
                                    <img src="<?= $basePath ?>/assets/images/logo-intecare.png" alt="INTECARE 2026" style="height: 48px;">
                                </a>
                            </div>

                            <div class="de-flex-col">
                                <div class="de-flex-col header-col-mid">
                                    <ul id="mainmenu">
                                        <li><a class="menu-item active" href="#section-hero">HOME</a></li>
                                        <li><a class="menu-item" href="#section-about">ABOUT US</a></li>
                                        <li><a class="menu-item" href="#section-patrons">PATRONS</a></li>
                                        <li><a class="menu-item" href="#Categories1">CATEGORIES</a></li>
                                        <li><a class="menu-item" href="#Nominations">NOMINATIONS</a></li>
                                        <li><a class="menu-item" href="#why-Sponsor">WHY SPONSOR</a></li>
                                        <li><a class="menu-item" href="#sponsorship">PACKAGES</a></li>
                                        <li><a class="menu-item" href="#contact-us">CONTACT US</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="de-flex-col">
                                <a class="btn-main fx-slide w-100" href="<?= $basePath ?>/assets/downloads/INTECARE_2026_Nomination_Form.pdf" download="INTECARE_2026_Nomination_Form.pdf"><span><i class="fa fa-download me-2"></i>DOWNLOAD FORM</span></a>

                                <div class="menu_side_area">
                                    <span id="menu-btn"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header section ends-->

        <!-- ==========================================================================
             HERO: GALA COVER SPREAD (Booklet Page 1)
             ========================================================================== -->
        <section id="section-hero" class="section-dark text-light jarallax relative" style="background: url('<?= $basePath ?>/assets/realestate/images/2026/Main-Header-BG-Emerald.jpg') top center / cover no-repeat; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 130px 0 70px;">
            <img src="<?= $basePath ?>/assets/realestate/images/2026/Main-Header-BG-Emerald.jpg" class="jarallax-img" alt="INTECARE Header BG">
            <div class="sw-overlay op-5"></div>
            <div class="z-2 w-100" style="position: relative;">
                <div class="container wow scaleIn" data-wow-duration="2s">
                    <div class="row g-4 justify-content-center text-center align-items-center">
                        <div class="col-lg-11 col-xl-10">
                            
                            <!-- Official Booklet Emblem -->
                            <div class="mb-3">
                                <img src="<?= $basePath ?>/assets/images/logo-intecare2.png" alt="INTECARE 2026 Logo" title="INTECARE Excellence Awards 2026" style="max-width: 380px; width: 75%; filter: drop-shadow(0 10px 25px rgba(0,0,0,0.6));">
                            </div>

                            <h2 class="gold-gradient-text text-uppercase mb-2" style="font-size: clamp(22px, 3.5vw, 36px); letter-spacing: 2px;">
                                EXCELLENCE AWARDS 2026
                            </h2>
                            
                            <p style="font-family: var(--font-sans); font-size: clamp(15px, 2vw, 20px); font-weight: 800; color: #fff; letter-spacing: 2.5px; margin: 0 0 22px; text-transform: uppercase;">
                                Healthier People <span style="color: var(--gold);">|</span> Better Care <span style="color: var(--gold);">|</span> Stronger Economy
                            </p>

                            <!-- VIP Gala Ticket Details -->
                            <div class="mb-4">
                                <div class="event-ticket-badge">
                                    <div class="event-ticket-item">
                                        <i class="fa fa-calendar-check-o"></i>
                                        <span>27 November 2026 (Friday)</span>
                                    </div>
                                    <div class="event-ticket-divider"></div>
                                    <div class="event-ticket-item">
                                        <i class="fa fa-map-marker"></i>
                                        <span>Hotel Royale Chulan Damansara, PJ</span>
                                    </div>
                                    <div class="event-ticket-divider"></div>
                                    <div class="event-ticket-item">
                                        <i class="fa fa-clock-o"></i>
                                        <span>07.30pm – 11.00pm</span>
                                    </div>
                                </div>
                            </div>

                            <!-- CTAs -->
                            <div class="d-flex justify-content-center gap-3 flex-wrap mb-4">
                                <a class="btn-main fx-slide" href="#Nominations"><span><i class="fa fa-pencil-square-o me-2"></i> Submit Nomination</span></a>
                                <a class="btn-main fx-slide" href="#sponsorship" style="background: transparent; border: 1px solid var(--gold); color: #fff;"><span><i class="fa fa-trophy me-2"></i> View Sponsorship Packages</span></a>
                            </div>

                            <!-- Powered by & Strategic Partners Container -->
                            <div class="sopnser-setion text-center mx-auto" style="background: rgba(0, 0, 0, 0.55); border: 1px solid rgba(255, 255, 255, 0.12); border-radius: 14px; padding: 22px 28px; max-width: 860px; backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); box-shadow: 0 10px 30px rgba(0,0,0,0.4);">
                                
                                <!-- Row 1: Powered by HWED & MIHA -->
                                <div class="mb-3 text-center">
                                    <p style="color: var(--gold); font-size: 12.5px; text-transform: uppercase; letter-spacing: 2px; font-weight: 800; margin-bottom: 12px;">POWERED BY</p>
                                    <div style="display: flex; gap: 32px; align-items: center; justify-content: center; flex-wrap: wrap;">
                                        <a href="#section-about" style="display: inline-block;">
                                            <img src="<?= $basePath ?>/assets/images/logo-hwed.png" alt="Healthcare &amp; Wellness Economy Development (HWED)" style="height: 52px; width: auto; object-fit: contain; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.4));">
                                        </a>
                                        <a href="#section-about" style="display: inline-block;">
                                            <img src="<?= $basePath ?>/assets/images/logo-miha.png" alt="Malaysian Integrative Health Association (MIHA)" style="height: 50px; width: auto; object-fit: contain; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.4));">
                                        </a>
                                    </div>
                                </div>

                                <div style="width: 100%; height: 1px; background: rgba(255, 255, 255, 0.12); margin: 16px 0;"></div>

                                <!-- Row 2: Partner cards including Olympia Education -->
                                <div class="text-center">
                                    <p style="color: #94a3b8; font-size: 11.5px; text-transform: uppercase; letter-spacing: 1.5px; font-weight: 700; margin-bottom: 12px;">STRATEGIC &amp; ECOSYSTEM ALLIANCE</p>
                                    <div style="display: flex; gap: 12px; align-items: center; justify-content: center; flex-wrap: wrap;">
                                        <!-- Olympia Education Card (Original Logo) -->
                                        <div style="background: rgba(255, 255, 255, 0.95); border: 1px solid rgba(201, 162, 39, 0.4); border-radius: 8px; padding: 6px 16px; display: flex; align-items: center; justify-content: center; height: 46px; min-width: 135px; box-shadow: 0 4px 15px rgba(0,0,0,0.25); transition: transform 0.2s ease;">
                                            <img src="<?= $basePath ?>/assets/images/logo-olympia.png" alt="Olympia Education" style="max-height: 32px; width: auto; object-fit: contain;">
                                        </div>
                                        <!-- Ecosystem Partner Card 1 -->
                                        <div style="background: rgba(255, 255, 255, 0.95); border-radius: 8px; padding: 6px 14px; display: flex; align-items: center; justify-content: center; height: 46px; min-width: 105px; box-shadow: 0 4px 15px rgba(0,0,0,0.25);">
                                            <img src="<?= $basePath ?>/assets/realestate/images/2026/BT-logo-new.png" alt="Partner" style="max-height: 28px; width: auto; object-fit: contain;">
                                        </div>
                                        <!-- Ecosystem Partner Card 2 -->
                                        <div style="background: rgba(255, 255, 255, 0.95); border-radius: 8px; padding: 6px 14px; display: flex; align-items: center; justify-content: center; height: 46px; min-width: 105px; box-shadow: 0 4px 15px rgba(0,0,0,0.25);">
                                            <img src="<?= $basePath ?>/assets/realestate/images/2026/Canama-logo-new.png" alt="Partner" style="max-height: 28px; width: auto; object-fit: contain;">
                                        </div>
                                        <!-- Ecosystem Partner Card 3 -->
                                        <div style="background: rgba(255, 255, 255, 0.95); border-radius: 8px; padding: 6px 14px; display: flex; align-items: center; justify-content: center; height: 46px; min-width: 105px; box-shadow: 0 4px 15px rgba(0,0,0,0.25);">
                                            <img src="<?= $basePath ?>/assets/realestate/images/2026/lucidity-logo-new.png" alt="Partner" style="max-height: 28px; width: auto; object-fit: contain;">
                                        </div>
                                        <!-- Ecosystem Partner Card 4 -->
                                        <div style="background: rgba(255, 255, 255, 0.95); border-radius: 8px; padding: 6px 14px; display: flex; align-items: center; justify-content: center; height: 46px; min-width: 105px; box-shadow: 0 4px 15px rgba(0,0,0,0.25);">
                                            <img src="<?= $basePath ?>/assets/realestate/images/2026/the-impression-logo-new.png" alt="Partner" style="max-height: 28px; width: auto; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- hero section ends-->

        <!-- ==========================================================================
             SECTION 1: ABOUT US & HWED ECOSYSTEM (Booklet Pages 4, 5, 6, 7 & 8)
             ========================================================================== -->
        <section id="section-about" class="w2animated-dark text-light" style="padding: 100px 0;">
            <div class="container">
                
                <!-- Intro Headline -->
                <div class="row gx-lg-5 align-items-center justify-content-between mb-5">
                    <div class="col-lg-5 abt-col-text">
                        <div class="abt-tag wow fadeInUp" data-wow-delay=".2s">[ About ]</div>
                        <h1 class="wow fadeInUp abt-head" data-wow-delay=".3s">
                            ABOUT INTECARE<br>EXCELLENCE AWARD 2026
                        </h1>
                        <p class="wow fadeInUp" data-wow-delay=".4s" style="font-size: 15.5px; line-height: 1.75; color: #cbd5e1;">
                            <strong>Healthcare &amp; Wellness Economy Development (HWED)</strong> is one integrated platform connecting science, professional practice, technology, enterprise, investment, and industry designed to create value across the complete human health lifecycle.
                        </p>
                        <p class="wow fadeInUp" data-wow-delay=".5s" style="font-size: 15px; line-height: 1.75; color: #cbd5e1;">
                            In strategic collaboration with the <strong>Malaysian Integrative Health Association (MIHA)</strong> and <strong>Olympia Education</strong>, the INTECARE Excellence Award 2026 unites clinicians, healthcare SMEs, academics, researchers, and corporate innovators to celebrate meaningful achievements that advance human health and economic vitality.
                        </p>

                        <!-- Purpose vs Vision Callouts -->
                        <div class="row g-3 mt-3 mb-4">
                            <div class="col-sm-6">
                                <div class="luxury-card p-3 h-100" style="background: rgba(7, 26, 21, 0.6);">
                                    <h4 style="color: var(--gold); font-size: 14px; margin-bottom: 6px;"><i class="fa fa-bullseye me-2"></i> OUR PURPOSE</h4>
                                    <p style="font-size: 12.5px; color: var(--text-muted); margin: 0; line-height: 1.5;">To build a connected healthcare and wellness economy, not a collection of separate industries.</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="luxury-card p-3 h-100" style="background: rgba(7, 26, 21, 0.6);">
                                    <h4 style="color: var(--gold); font-size: 14px; margin-bottom: 6px;"><i class="fa fa-eye me-2"></i> OUR VISION</h4>
                                    <p style="font-size: 12.5px; color: var(--text-muted); margin: 0; line-height: 1.5;">A globally connected health economy enabling people to stay well, get well, recover well and age well.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex flex-wrap gap-3 mt-2 wow fadeInUp" data-wow-delay=".6s">
                            <a href="#Categories1" class="btn-main" style="padding: 11px 26px; font-weight: 700; font-size: 13px; letter-spacing: 1px; border-radius: 6px;">AWARD CATEGORIES</a>
                            <a href="#section-sponsorship" class="btn-main btn-line" style="padding: 11px 26px; font-weight: 700; font-size: 13px; letter-spacing: 1px; border-radius: 6px; border: 1px solid var(--gold); color: #fff;">SPONSORSHIP PACKAGES</a>
                        </div>
                    </div>

                    <!-- 8-Image Photo 3D Rotating Showcase -->
                    <div class="col-lg-7 abt-col-visual mt-4 mt-lg-0">
                        <div class="container2">
                            <div class="inner">
                                <div class="card-wrapper">
                                    <img src="<?= $basePath ?>/assets/images/about1.jpg" alt="INTECARE Gala Celebration">
                                </div>
                                <div class="card-wrapper">
                                    <img src="<?= $basePath ?>/assets/images/home1.jpg" alt="HWED Ecosystem">
                                </div>
                                <div class="card-wrapper">
                                    <img src="<?= $basePath ?>/assets/images/home2.jpg" alt="Clinical Excellence">
                                </div>
                                <div class="card-wrapper">
                                    <img src="<?= $basePath ?>/assets/images/gala-ballroom.jpg" alt="Hotel Royale Chulan Damansara">
                                </div>
                                <div class="card-wrapper">
                                    <img src="<?= $basePath ?>/assets/images/awards-individual.jpg" alt="Individual Awards">
                                </div>
                                <div class="card-wrapper">
                                    <img src="<?= $basePath ?>/assets/images/awards-corporate.jpg" alt="Corporate Awards">
                                </div>
                                <div class="card-wrapper">
                                    <img src="<?= $basePath ?>/assets/images/award-trophy-concept.jpg" alt="INTECARE Trophy">
                                </div>
                                <div class="card-wrapper">
                                    <img src="<?= $basePath ?>/assets/realestate/images/2026/abt8.jpg" alt="Networking">
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4 Human Health Lifecycle Pillars (Booklet Page 4) -->
                <div class="row g-4 mt-4">
                    <div class="col-12 text-center mb-2">
                        <div class="subtitle" style="color: var(--gold); font-weight: 700; text-transform: uppercase;">At the Heart of HWED</div>
                        <h2 style="font-size: 28px;">THE HUMAN HEALTH LIFECYCLE</h2>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="pillar-card pillar-stay-well h-100">
                            <div class="pillar-icon-box">
                                <i class="fa fa-heartbeat"></i>
                            </div>
                            <h3 class="pillar-title">STAY WELL</h3>
                            <p class="pillar-subtitle" style="color: var(--intecare-emerald-light);">Prevention &amp; Wellness</p>
                            <p style="font-size: 13px; color: var(--text-muted); margin-top: 10px; line-height: 1.5;">Proactive health promotion, lifestyle medicine, nutrition, mental resilience, and disease prevention.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="pillar-card pillar-get-well h-100">
                            <div class="pillar-icon-box">
                                <i class="fa fa-user-md"></i>
                            </div>
                            <h3 class="pillar-title">GET WELL</h3>
                            <p class="pillar-subtitle" style="color: var(--intecare-blue-light);">Quality Healthcare</p>
                            <p style="font-size: 13px; color: var(--text-muted); margin-top: 10px; line-height: 1.5;">Integrative medical practice, patient-centred care, evidence-informed therapies, and diagnostic precision.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="pillar-card pillar-recover-well h-100">
                            <div class="pillar-icon-box">
                                <i class="fa fa-wheelchair"></i>
                            </div>
                            <h3 class="pillar-title">RECOVER WELL</h3>
                            <p class="pillar-subtitle" style="color: #26c6da;">Recovery &amp; Rehabilitation</p>
                            <p style="font-size: 13px; color: var(--text-muted); margin-top: 10px; line-height: 1.5;">Physical rehabilitation, functional restoration, chronic pain care, mental recovery, and independent living.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="pillar-card pillar-age-well h-100">
                            <div class="pillar-icon-box">
                                <i class="fa fa-trophy"></i>
                            </div>
                            <h3 class="pillar-title">AGE WELL</h3>
                            <p class="pillar-subtitle" style="color: var(--intecare-gold-light);">Healthy Ageing &amp; Longevity</p>
                            <p style="font-size: 13px; color: var(--text-muted); margin-top: 10px; line-height: 1.5;">Active ageing advocacy, longevity science, geriatric healthcare innovation, vitality, and quality of life.</p>
                        </div>
                    </div>
                </div>

                <!-- Special Gala Highlights (Booklet Page 8 & 10) -->
                <div class="luxury-card mt-5 p-4" style="background: rgba(14, 21, 38, 0.85); border-color: rgba(201, 162, 39, 0.35);">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-3 text-lg-start text-center border-lg-end" style="border-color: rgba(255,255,255,0.1) !important;">
                            <div class="subtitle" style="color: var(--gold); font-weight: 700;">GALA PROGRAMME</div>
                            <h3 style="font-size: 22px; color: #fff; margin: 0 0 6px;">SPECIAL HIGHLIGHTS</h3>
                            <p style="font-size: 13px; color: var(--text-muted); margin: 0;">Four milestone features during the gala evening at Hotel Royale Chulan Damansara.</p>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="highlight-box">
                                        <div class="highlight-num">01</div>
                                        <div class="highlight-info">
                                            <h4>Official Launch of HWED</h4>
                                            <p>National introduction of the Healthcare &amp; Wellness Economy Development platform.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="highlight-box">
                                        <div class="highlight-num">02</div>
                                        <div class="highlight-info">
                                            <h4>Olympia Education Convocation</h4>
                                            <p>Official graduation ceremony celebrating 45 academic healthcare leaders.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="highlight-box">
                                        <div class="highlight-num">03</div>
                                        <div class="highlight-info">
                                            <h4>Nanotech Sanitiser Launch</h4>
                                            <p>Official product reveal of the breakthrough Nanotech sanitisation technology.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="highlight-box">
                                        <div class="highlight-num">04</div>
                                        <div class="highlight-info">
                                            <h4>Presentation of 40 Awards</h4>
                                            <p>Conferment of 20 Individual and 20 Corporate Crystal DNA Excellence Awards.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- about section ends-->

        <!-- ==========================================================================
             MARQUEE TICKERS: 40 EXCELLENCE AWARDS (Booklet Pages 15 & 16)
             ========================================================================== -->
        <section class="marquee-section p-0" aria-label="Marquee Tickers">
            <!-- Top Ribbon (Gold - Individual Excellence Awards) -->
            <div class="marquee-ribbon rot-top">
                <div class="marquee-track marquee-track-left">
                    <div class="marquee-content">
                        <span class="marquee-text-dark">Preventive Health Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Community Health Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Wellness &amp; Lifestyle Medicine</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Integrative Healthcare Professional</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Patient-Centred Care Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Clinical Excellence Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Rehabilitation Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Healthy Ageing Advocacy</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Active Ageing Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Longevity &amp; Lifestyle Innovation</span>
                        <span class="marquee-star-emerald">✦</span>
                    </div>
                    <div class="marquee-content" aria-hidden="true">
                        <span class="marquee-text-dark">Preventive Health Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Community Health Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Wellness &amp; Lifestyle Medicine</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Integrative Healthcare Professional</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Patient-Centred Care Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Clinical Excellence Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Rehabilitation Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Healthy Ageing Advocacy</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Active Ageing Leadership</span>
                        <span class="marquee-star-emerald">✦</span>
                        <span class="marquee-text-dark">Longevity &amp; Lifestyle Innovation</span>
                        <span class="marquee-star-emerald">✦</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Ribbon (Sapphire / Navy - Corporate & Ecosystem Awards) -->
            <div class="marquee-ribbon rot-bottom">
                <div class="marquee-track marquee-track-right">
                    <div class="marquee-content">
                        <span class="marquee-text-light">Healthcare Organisation Excellence</span>
                        <span class="marquee-star-gold">✦</span>
                        <span class="marquee-text-light">Digital Health Transformation</span>
                        <span class="marquee-star-teal">✦</span>
                        <span class="marquee-text-light">Health Technology Excellence</span>
                        <span class="marquee-star-gold">✦</span>
                        <span class="marquee-text-light">Employer of Choice – Healthcare &amp; Wellness</span>
                        <span class="marquee-star-teal">✦</span>
                        <span class="marquee-text-light">Sustainable Healthcare Excellence</span>
                        <span class="marquee-star-gold">✦</span>
                        <span class="marquee-text-light">Healthcare Ecosystem Partnership</span>
                        <span class="marquee-star-teal">✦</span>
                        <span class="marquee-text-light">Healthcare Investment &amp; Growth</span>
                        <span class="marquee-star-gold">✦</span>
                        <span class="marquee-text-light">Outstanding Contribution to Healthcare Economy</span>
                        <span class="marquee-star-teal">✦</span>
                    </div>
                    <div class="marquee-content" aria-hidden="true">
                        <span class="marquee-text-light">Healthcare Organisation Excellence</span>
                        <span class="marquee-star-gold">✦</span>
                        <span class="marquee-text-light">Digital Health Transformation</span>
                        <span class="marquee-star-teal">✦</span>
                        <span class="marquee-text-light">Health Technology Excellence</span>
                        <span class="marquee-star-gold">✦</span>
                        <span class="marquee-text-light">Employer of Choice – Healthcare &amp; Wellness</span>
                        <span class="marquee-star-teal">✦</span>
                        <span class="marquee-text-light">Sustainable Healthcare Excellence</span>
                        <span class="marquee-star-gold">✦</span>
                        <span class="marquee-text-light">Healthcare Ecosystem Partnership</span>
                        <span class="marquee-star-teal">✦</span>
                        <span class="marquee-text-light">Healthcare Investment &amp; Growth</span>
                        <span class="marquee-star-gold">✦</span>
                        <span class="marquee-text-light">Outstanding Contribution to Healthcare Economy</span>
                        <span class="marquee-star-teal">✦</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             SECTION 2: PATRON FOREWORDS (Booklet Pages 2 & 3)
             ========================================================================== -->
        <section id="section-patrons" class="bg-dark section-dark text-light relative jarallax" aria-label="Patrons" style="padding: 100px 0; background: url('<?= $basePath ?>/assets/realestate/images/2026/Main-Header-BG-Emerald.jpg') center / cover no-repeat;">
            <img src="<?= $basePath ?>/assets/realestate/images/2026/Main-Header-BG-Emerald.jpg" class="jarallax-img" alt="Patrons Section Background">
            <div class="sw-overlay op-9" style="background: linear-gradient(180deg, rgba(4, 13, 10, 0.8) 0%, rgba(4, 13, 10, 0.94) 100%);"></div>
            <div class="container relative z-4" style="position: relative; z-index: 4;">
                
                <div class="row mb-5 text-center">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="subtitle" style="color: var(--gold); font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">Leadership &amp; Patronage</div>
                        <h2 style="font-size: clamp(28px, 3.5vw, 40px); margin-bottom: 12px;">FOREWORDS FROM THE PATRONS</h2>
                        <p style="color: var(--text-muted); font-size: 15.5px;">Guidance and visionary perspectives on advancing an integrated healthcare and wellness economy.</p>
                    </div>
                </div>

                <!-- Patron 1: Tan Sri Yusof Noor -->
                <div class="patron-card mb-5">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-4 col-md-5 text-center">
                            <div class="patron-portrait-frame">
                                <img src="<?= $basePath ?>/assets/images/tansri.jpg" alt="YBhg. Tan Sri Dato' Seri Dr. Haji Mohamed Yusof Bin Haji Mohamed Noor">
                            </div>
                        </div>

                        <div class="col-lg-8 col-md-7">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="badge" style="background: rgba(201, 162, 39, 0.15); border: 1px solid var(--gold); color: var(--gold); font-size: 12px; padding: 6px 14px; border-radius: 20px;">PATRON'S ADDRESS</span>
                            </div>
                            
                            <h3 style="font-size: 20px; line-height: 1.65; color: #fff; font-family: var(--font-display); font-weight: 600; margin-bottom: 20px;">
                                "This distinguished occasion represents an important celebration of excellence, contribution and impact across the healthcare and wellness ecosystem. HWED recognises that healthcare and wellness must create value across the complete human health lifecycle, enabling people to Stay Well, Get Well, Recover Well and Age Well."
                            </h3>

                            <div style="border-top: 1px solid rgba(201, 162, 39, 0.3); padding-top: 18px;">
                                <h4 class="gold-gradient-text" style="font-size: 19px; margin: 0 0 4px; font-weight: 800;">
                                    YBhg. Tan Sri Dato' Seri Dr. Haji Mohamed Yusof Bin Haji Mohamed Noor
                                </h4>
                                <p style="color: #e2e8f0; font-size: 13.5px; margin: 0 0 2px; font-weight: 600;">Honorary Chairman &amp; Chancellor, Olympia Education Malaysia / Pro-Chancellor, Universiti Sultan Zainal Abidin (UniSZA)</p>
                                <p style="color: var(--gold-light); font-size: 13px; margin: 0;">Chairman, Healthcare &amp; Wellness Economy Development (HWED) / Patron, Intecare Excellence Award 2026</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patron 2: YB Dato' Hajjah Hanifah Hajar Taib -->
                <div class="patron-card">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-8 col-md-7 order-2 order-md-1">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="badge" style="background: rgba(201, 162, 39, 0.15); border: 1px solid var(--gold); color: var(--gold); font-size: 12px; padding: 6px 14px; border-radius: 20px;">PATRON'S ADDRESS</span>
                            </div>

                            <h3 style="font-size: 20px; line-height: 1.65; color: #fff; font-family: var(--font-display); font-weight: 600; margin-bottom: 20px;">
                                "The development of a healthier society requires collaboration across many sectors. The collaboration between Healthcare &amp; Wellness Economy Development (HWED) and the Malaysian Integrative Health Association (MIHA) provides a platform for connecting diverse contributions across Stay Well, Get Well, Recover Well and Age Well to build an integrated healthcare and wellness ecosystem."
                            </h3>

                            <div style="border-top: 1px solid rgba(201, 162, 39, 0.3); padding-top: 18px;">
                                <h4 class="gold-gradient-text" style="font-size: 19px; margin: 0 0 4px; font-weight: 800;">
                                    YB. Dato' Hajjah Hanifah Hajar Taib
                                </h4>
                                <p style="color: #e2e8f0; font-size: 13.5px; margin: 0 0 2px; font-weight: 600;">Deputy Minister of Health Malaysia / Timbalan Menteri Kesihatan Malaysia</p>
                                <p style="color: var(--gold-light); font-size: 13px; margin: 0;">Ahli Parlimen P213 Mukah, Sarawak / Patron, Intecare Excellence Award 2026</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-5 order-1 order-md-2 text-center">
                            <div class="patron-portrait-frame">
                                <img src="<?= $basePath ?>/assets/images/hajjah.jpg" alt="YB. Dato' Hajjah Hanifah Hajar Taib">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             SECTION 3: 40 EXCELLENCE AWARDS & INTERACTIVE MODAL (Booklet Pages 13, 15 & 16)
             ========================================================================== -->
        <section style="padding: 100px 0;" id="Categories1" class="bg-dark section-dark text-light">
            <div class="container" style="max-width: 1400px;">
                <div class="row g-4">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <div class="subtitle mb-2" style="display: inline-block; color: var(--gold); text-transform: uppercase; font-weight: 700; letter-spacing: 2px;">Recognising Excellence. Celebrating Impact.</div>
                        <h2 style="font-size: clamp(28px, 3.5vw, 42px); margin-bottom: 15px;">40 EXCELLENCE AWARDS</h2>
                        <p style="color: var(--text-muted); font-size: 16px; margin-bottom: 30px;">
                            The official Gala programme features <strong>40 Excellence Awards</strong> presented in two distinguished segments: <strong>20 Individual Excellence Awards</strong> and <strong>20 Corporate Excellence Awards</strong>. Click any award card below to view the official criteria and recognition focus.
                        </p>
                    </div>
                </div>

                <!-- Category Segment Filter Tabs (Separated into Individual and Corporate) -->
                <div class="category-filter-nav">
                    <button class="filter-btn active" data-filter="all">All 40 Awards</button>
                    <button class="filter-btn" data-filter="individual"><i class="fa fa-user me-2"></i> Individual Awards (20)</button>
                    <button class="filter-btn" data-filter="corporate"><i class="fa fa-building me-2"></i> Corporate Awards (20)</button>
                </div>

                <!-- Award Cards Container -->
                <div id="Categories" class="awards-categories">
                    <div id="categoriesContainer"></div>
                </div>

                <!-- Interactive Modal -->
                <div class="modal" id="categoryModal">
                    <div class="modal-content">
                        <span class="close-btn">&times;</span>
                        <div class="modal-left">
                            <div id="modalBadges" class="d-flex align-items-center gap-2 flex-wrap mb-3">
                                <span class="badge" style="background: rgba(201, 162, 39, 0.2); color: var(--gold); border: 1px solid var(--gold); font-size: 11px; padding: 5px 12px; border-radius: 20px;">OFFICIAL AWARD CRITERIA</span>
                            </div>
                            <h2 class="modal-title" id="modalTitle"></h2>
                            <div class="modal-list" id="modalText"></div>
                            <div id="modalSubmitBtn" class="d-flex gap-3">
                                <a class="btn-main fx-slide" href="<?= $basePath ?>/assets/downloads/INTECARE_2026_Nomination_Form.pdf" download="INTECARE_2026_Nomination_Form.pdf"><span><i class="fa fa-download me-2"></i>Download Nomination Form</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- categories section ends-->

        <!-- ==========================================================================
             SECTION 4: AWARD TROPHY & DESIGN CONCEPT (Booklet Page 14)
             ========================================================================== -->
        <section class="bg-dark section-dark text-light relative jarallax" style="padding: 90px 0; background: #0a0e1c;">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-5 text-center">
                        <div class="luxury-card p-3" style="border-color: var(--gold);">
                            <img src="<?= $basePath ?>/assets/images/award-trophy-rendered.jpg" alt="INTECARE 2026 Crystal DNA Trophy" style="width: 100%; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.6);">
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="subtitle" style="color: var(--gold); font-weight: 700; text-transform: uppercase;">A Symbol of Excellence</div>
                        <h2 style="font-size: 36px; margin-bottom: 18px;">THE CRYSTAL DNA TROPHY</h2>
                        <p style="color: #cbd5e1; font-size: 16px; line-height: 1.75; margin-bottom: 20px;">
                            The official <strong>INTECARE Excellence Award 2026 Trophy</strong> represents the synthesis of biological science, clinical mastery, and human vitality. Enclosed within a crystal-clear prism is a precision-crafted double-helix DNA strand resting upon a luminous LED-illuminated luxury base.
                        </p>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="highlight-box">
                                    <div class="pillar-icon-box" style="width: 42px; height: 42px; font-size: 16px; margin: 0;">
                                        <i class="fa fa-diamond"></i>
                                    </div>
                                    <div class="highlight-info">
                                        <h4>Crystal Prism Top</h4>
                                        <p>Precision-faceted crystal clear optic with DNA helix core.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="highlight-box">
                                    <div class="pillar-icon-box" style="width: 42px; height: 42px; font-size: 16px; margin: 0;">
                                        <i class="fa fa-lightbulb-o"></i>
                                    </div>
                                    <div class="highlight-info">
                                        <h4>Illuminated Base</h4>
                                        <p>Custom obsidian black base with integrated LED light system.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="highlight-box">
                                    <div class="pillar-icon-box" style="width: 42px; height: 42px; font-size: 16px; margin: 0;">
                                        <i class="fa fa-gift"></i>
                                    </div>
                                    <div class="highlight-info">
                                        <h4>Packaging Concept</h4>
                                        <p>Presented in a bespoke emerald &amp; gold VIP presentation casing.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="highlight-box">
                                    <div class="pillar-icon-box" style="width: 42px; height: 42px; font-size: 16px; margin: 0;">
                                        <i class="fa fa-certificate"></i>
                                    </div>
                                    <div class="highlight-info">
                                        <h4>Official Certificate</h4>
                                        <p>Accompanied by a framed Certificate of National Recognition.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             SECTION 5: NOMINATIONS JOURNEY & SUBMISSION (Booklet Pages 9, 10, 17 & 18)
             ========================================================================== -->
        <section style="padding: 100px 0;" class="bg-dark section-dark text-light relative jarallax" aria-label="Nominations" id="Nominations">
            <div class="container relative z-4">
                
                <div class="row g-4 justify-content-center text-center mb-4">
                    <div class="col-lg-8">
                        <div class="subtitle" style="color: var(--gold); font-weight: 700; text-transform: uppercase;">From Contribution To Impact</div>
                        <h2 style="font-size: clamp(28px, 3.5vw, 40px); margin-bottom: 15px;">SUBMIT YOUR NOMINATION</h2>
                        <p style="color: var(--text-muted); font-size: 16px;">
                            Your contribution to healthcare, clinical practice, wellness innovation and longevity deserves to be celebrated on a national stage.
                        </p>
                    </div>
                </div>

                <!-- 6-Step Journey Stepper Ribbon (Booklet Page 9) -->
                <div class="journey-milestones">
                    <div class="journey-step">
                        <span class="journey-step-num">1</span>
                        <span>CONNECT</span>
                    </div>
                    <span class="journey-arrow">→</span>

                    <div class="journey-step">
                        <span class="journey-step-num">2</span>
                        <span>CELEBRATE</span>
                    </div>
                    <span class="journey-arrow">→</span>

                    <div class="journey-step">
                        <span class="journey-step-num">3</span>
                        <span>LAUNCH</span>
                    </div>
                    <span class="journey-arrow">→</span>

                    <div class="journey-step">
                        <span class="journey-step-num">4</span>
                        <span>RECOGNISE</span>
                    </div>
                    <span class="journey-arrow">→</span>

                    <div class="journey-step">
                        <span class="journey-step-num">5</span>
                        <span>EDUCATE</span>
                    </div>
                    <span class="journey-arrow">→</span>

                    <div class="journey-step">
                        <span class="journey-step-num">6</span>
                        <span>INSPIRE</span>
                    </div>
                </div>

                <!-- Nomination Guide Box -->
                <div class="row align-items-center g-5 mt-2">
                    <div class="col-lg-4 text-center">
                        <div class="luxury-card p-4 text-center">
                            <div class="pillar-icon-box" style="margin-bottom: 15px;">
                                <i class="fa fa-calendar-o"></i>
                            </div>
                            <h3 style="font-size: 20px; color: #fff; margin-bottom: 5px;">GALA CEREMONY</h3>
                            <p class="gold-gradient-text" style="font-size: 22px; font-weight: 800; margin-bottom: 5px;">27 November 2026</p>
                            <div class="d-flex flex-column gap-2">
                                <a class="btn-main fx-slide w-100" href="<?= $basePath ?>/assets/downloads/INTECARE_2026_Nomination_Form.pdf" download="INTECARE_2026_Nomination_Form.pdf"><span><i class="fa fa-download me-2"></i>Download Nomination Form</span></a>
                                <a class="btn-main fx-slide w-100" href="mailto:secretariat@intecare.org?subject=INTECARE%202026%20Nomination%20Enquiry" style="background: transparent; border: 1px solid var(--gold); color: #fff;"><span><i class="fa fa-envelope-o me-2"></i>Email Dossier</span></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="luxury-card p-4">
                            <h3 style="font-size: 20px; color: var(--gold); margin-bottom: 15px;">Nomination Guidelines &amp; Submission Steps</h3>
                            <ul style="color: #cbd5e1; font-size: 14.5px; line-height: 1.8; padding-left: 20px; margin: 0;">
                                <li><strong>Select Category:</strong> Choose from the 20 Individual or 20 Corporate Excellence categories.</li>
                                <li><strong>Prepare Executive Dossier:</strong> Detail measurable contributions across Stay Well, Get Well, Recover Well, or Age Well.</li>
                                <li><strong>Supporting Documentation:</strong> Attach relevant clinical credentials, project portfolios, publications, or verified CSR impacts.</li>
                                <li><strong>Submit via Email:</strong> Send your complete PDF nomination package directly to <a href="mailto:secretariat@intecare.org" style="color: var(--gold); font-weight: 700;">secretariat@intecare.org</a>.</li>
                                <li><strong>Evaluation:</strong> Nominations are assessed by the HWED &amp; MIHA Academic &amp; Clinical Committee.</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==========================================================================
             SECTION 6: WHY SPONSOR — 6 PILLARS OF VALUE (Booklet Page 19)
             ========================================================================== -->
        <section id="why-Sponsor" class="bg-dark section-dark text-light" style="padding: 100px 0; background: #070a12;">
            <div class="container">
                <div class="row g-4 justify-content-center text-center mb-4">
                    <div class="col-lg-8">
                        <div class="subtitle" style="color: var(--gold); font-weight: 700; text-transform: uppercase;">Strategic Sponsorship</div>
                        <h2 style="font-size: clamp(28px, 3.5vw, 40px); margin-bottom: 15px;">THE OPPORTUNITY FOR SPONSORSHIP</h2>
                        <p style="color: var(--text-muted); font-size: 16px;">Position your brand at the forefront of the regional healthcare and longevity economy.</p>
                    </div>
                </div>

                <div class="grid-wrap">
                    <div class="feature-box">
                        <div class="bar"></div>
                        <h3>Brand Positioning</h3>
                        <p>Associate your organisation with healthcare excellence, wellness innovation, and the development of a stronger healthcare economy through the INTECARE platform.</p>
                    </div>

                    <div class="feature-box">
                        <div class="bar"></div>
                        <h3>Thought Leadership</h3>
                        <p>Create opportunities to share perspectives, clinical expertise and solutions across integrative healthcare, preventative wellness, and digital longevity.</p>
                    </div>

                    <div class="feature-box">
                        <div class="bar"></div>
                        <h3>Stakeholder Engagement</h3>
                        <p>Connect directly with healthcare professionals, educators, medical researchers, clinic owners, hospital networks, enterprise leaders and investors.</p>
                    </div>

                    <div class="feature-box">
                        <div class="bar"></div>
                        <h3>Business Storytelling</h3>
                        <p>Move beyond conventional advertising to communicate how your brand creates measurable impact towards healthier people, better care, and a stronger economy.</p>
                    </div>

                    <div class="feature-box">
                        <div class="bar"></div>
                        <h3>Long-Term Relationship</h3>
                        <p>Use INTECARE Excellence Award 2026 as a launchpad to build lasting institutional partnerships and cross-sector ventures across the HWED ecosystem.</p>
                    </div>

                    <div class="feature-box">
                        <div class="bar"></div>
                        <h3>Ecosystem Opportunities</h3>
                        <p>Generate high-value opportunities for strategic collaborations, medical technology commercialisation, enterprise incubation, and market expansion.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             SECTION 7: STRATEGIC SPONSORSHIP & PACKAGES (Booklet Pages 17, 19 & 20)
             ========================================================================== -->
        <section id="sponsorship" class="bg-dark section-dark text-light pt-80 relative jarallax" aria-label="Sponsorship" style="padding: 100px 0; background: url('<?= $basePath ?>/assets/realestate/images/2026/sponsorship-bkg.jpeg') center / cover no-repeat;">
            <div class="sw-overlay op-9" style="background: rgba(7, 10, 18, 0.94);"></div>
            <div class="container relative z-2" style="position: relative; z-index: 2;">
                
                <div class="row g-4 justify-content-center text-center mb-4">
                    <div class="col-lg-10">
                        <div class="subtitle mb-2" style="color: var(--gold); font-weight: 700; text-transform: uppercase;">Partnership &amp; Entitlements Matrix</div>
                        <h2 style="font-size: clamp(28px, 3.5vw, 42px); margin-bottom: 12px;">STRATEGIC SPONSORSHIP &amp; AWARD PACKAGES</h2>
                        <p style="color: var(--text-muted); font-size: 16px; max-width: 820px; margin: 0 auto;">
                            Choose the partnership tier tailored to your corporate objectives: <strong>Principal Partner (RM100,000)</strong>, <strong>Strategic Partner (RM50,000)</strong>, <strong>Supporting Partner (RM25,000)</strong>, <strong>Corporate Award (RM30,000)</strong>, and <strong>Individual Award (RM20,000)</strong>.
                        </p>
                    </div>
                </div>

                <div class="row g-4 justify-content-center">
                    <div class="col-lg-12">
                        <div style="overflow-x: auto; border-radius: 12px; border: 1px solid rgba(201, 162, 39, 0.3); background: rgba(4, 13, 10, 0.95);">
                            <table class="ndf">
                                <tbody>
                                    <tr>
                                        <th>Entitlement / Benefits</th>
                                        <td>Diamond (Principal)<br><strong style="color: var(--gold); font-size: 16px;">RM 100,000</strong></td>
                                        <td>Platinum (Strategic)<br><strong style="color: var(--gold); font-size: 16px;">RM 50,000</strong></td>
                                        <td>Gold (Supporting)<br><strong style="color: var(--gold); font-size: 16px;">RM 25,000</strong></td>
                                        <td>Corporate Award<br><strong style="color: var(--gold); font-size: 16px;">RM 30,000</strong></td>
                                        <td>Individual Award<br><strong style="color: var(--gold); font-size: 16px;">RM 20,000</strong></td>
                                    </tr>

                                    <tr>
                                        <th>Designation</th>
                                        <td>Co-Organizer / Powered By</td>
                                        <td>Strategic Partner</td>
                                        <td>Supporting Partner</td>
                                        <td>Associate Partner</td>
                                        <td>Associate Partner</td>
                                    </tr>

                                    <tr>
                                        <th>Main Screen &amp; Logo Visibility</th>
                                        <td>Highest Priority</td>
                                        <td>High Priority</td>
                                        <td>Medium Priority</td>
                                        <td>Standard</td>
                                        <td>Standard</td>
                                    </tr>

                                    <tr>
                                        <th>Banner Placement</th>
                                        <td>4 Banners (Entrance, Lobby, Hall)</td>
                                        <td>2 Banners</td>
                                        <td>1 Banner</td>
                                        <td>—</td>
                                        <td>—</td>
                                    </tr>

                                    <tr>
                                        <th>Corporate Video Broadcast</th>
                                        <td>2 Minutes on Main Screen</td>
                                        <td>30 Seconds on Main Screen</td>
                                        <td>15 Seconds on Main Screen</td>
                                        <td>—</td>
                                        <td>—</td>
                                    </tr>

                                    <tr>
                                        <th>Award Nomination Included</th>
                                        <td>Corporate &amp; Individual (Honour)</td>
                                        <td>1 Corporate (Honour)</td>
                                        <td>1 Corporate / Individual</td>
                                        <td>1 Corporate Award</td>
                                        <td>1 Individual Award</td>
                                    </tr>

                                    <tr>
                                        <th>Emcee Acknowledgement</th>
                                        <td><i class="fa fa-check"></i> Throughout Event</td>
                                        <td><i class="fa fa-check"></i> Sponsorship Mention</td>
                                        <td><i class="fa fa-check"></i> Special Mention</td>
                                        <td>—</td>
                                        <td>—</td>
                                    </tr>

                                    <tr>
                                        <th>Gala Dinner Pass (10 Seats Table)</th>
                                        <td>10 Seats (VVIP Seating)</td>
                                        <td>10 Seats (VVIP Seating)</td>
                                        <td>10 Seats (VIP Seating)</td>
                                        <td>10 Seats Table</td>
                                        <td>10 Seats Table</td>
                                    </tr>

                                    <tr>
                                        <th>INTECARE Publishing (A3 Size)</th>
                                        <td>2 Pages Article + 2 Pages Ad</td>
                                        <td>1 Page Article + 1 Page Ad</td>
                                        <td>Half Page Article + Half Ad</td>
                                        <td>Quarter Page Feature</td>
                                        <td>Quarter Page Feature</td>
                                    </tr>

                                    <tr>
                                        <th>Networking Priority</th>
                                        <td>Highest Priority</td>
                                        <td>High Priority</td>
                                        <td>Medium Priority</td>
                                        <td>Standard</td>
                                        <td>Standard</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a class="btn-main fx-slide" href="#contact-us"><span><i class="fa fa-envelope-o me-2"></i> Reserve Your Sponsorship / Table</span></a>
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             SECTION 8: FAQ ACCORDION (Booklet Insights)
             ========================================================================== -->
        <section id="section-faq" class="bg-dark section-dark text-light" style="padding: 100px 0; background: #070a12;">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <div class="subtitle" style="color: var(--gold); font-weight: 700; text-transform: uppercase;">Clear Answers</div>
                        <h2 style="font-size: clamp(28px, 3.5vw, 40px); margin-bottom: 15px;">FREQUENTLY ASKED QUESTIONS</h2>
                        <p style="color: var(--text-muted); font-size: 15.5px; line-height: 1.7;">
                            Key questions regarding eligibility, nomination procedures, award packages, and gala dinner attendance for INTECARE Excellence Awards 2026.
                        </p>
                    </div>

                    <div class="col-lg-7">
                        <div class="faq-accordion">
                            <!-- FAQ Item 1 (Active by default) -->
                            <div class="faq-item active">
                                <button class="faq-header" type="button">
                                    <span class="faq-header-title">
                                        <i class="fa fa-question-circle"></i>
                                        Who can be nominated for the Awards?
                                    </span>
                                    <i class="fa fa-chevron-down faq-chevron"></i>
                                </button>
                                <div class="faq-body">
                                    <div class="faq-content">
                                        <p><strong>Corporate / Organisations:</strong> Healthcare Providers, Wellness Organisations, Wellness Brands, Healthcare SMEs, Start-Ups, Corporations, Education &amp; Knowledge Institutions, Technology Companies, Care Economy Providers, Industry Organisations, Social Enterprises, Government &amp; Public Sector, and NGOs.</p>
                                        <p><strong>Individuals:</strong> Healthcare Professionals, Wellness Professionals, Healthcare Leaders, Educators, Researchers, Entrepreneurs, Innovators, Community Health Leaders, Care Professionals, Technology Professionals, and Industry Practitioners.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 2 -->
                            <div class="faq-item">
                                <button class="faq-header" type="button">
                                    <span class="faq-header-title">
                                        <i class="fa fa-gift"></i>
                                        What is included in the Award Packages?
                                    </span>
                                    <i class="fa fa-chevron-down faq-chevron"></i>
                                </button>
                                <div class="faq-body">
                                    <div class="faq-content">
                                        <p><strong>Individual Award (RM 20,000):</strong> Official Crystal DNA Trophy, Official Certificate of Recognition, 10 Seats at Gala Dinner Ceremony, and Individual Profile Recognition across event publications.</p>
                                        <p><strong>Corporate Award (RM 30,000):</strong> Official Crystal DNA Trophy, Official Certificate of Recognition, 10 Seats at Gala Dinner Ceremony, and Corporate Logo &amp; Brand Recognition across event publications.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 3 -->
                            <div class="faq-item">
                                <button class="faq-header" type="button">
                                    <span class="faq-header-title">
                                        <i class="fa fa-heartbeat"></i>
                                        What are the 4 Human Health Lifecycle Pillars?
                                    </span>
                                    <i class="fa fa-chevron-down faq-chevron"></i>
                                </button>
                                <div class="faq-body">
                                    <div class="faq-content">
                                        <p>1. <strong>Stay Well:</strong> Prevention, wellness, and health promotion.</p>
                                        <p>2. <strong>Get Well:</strong> Healthcare delivery, clinical care, and patient outcomes.</p>
                                        <p>3. <strong>Recover Well:</strong> Rehabilitation, restorative healthcare, and independence.</p>
                                        <p>4. <strong>Age Well:</strong> Healthy ageing, longevity, vitality, and quality of life.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 4 -->
                            <div class="faq-item">
                                <button class="faq-header" type="button">
                                    <span class="faq-header-title">
                                        <i class="fa fa-star"></i>
                                        What are the Special Highlights of the Gala Evening?
                                    </span>
                                    <i class="fa fa-chevron-down faq-chevron"></i>
                                </button>
                                <div class="faq-body">
                                    <div class="faq-content">
                                        <p>The gala night on <strong>27 November 2026</strong> features: (1) Official Launch of HWED Ecosystem, (2) Olympia Education Convocation for 45 graduates, (3) Nanotech Sanitiser Product Launch, and (4) Presentation of the 40 Crystal Excellence Awards.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==========================================================================
             SECTION 9: CONTACT US & SECRETARIAT (Booklet Page 22)
             ========================================================================== -->
        <section id="contact-us" class="bg-dark section-dark text-light pt-80 relative jarallax" style="padding: 90px 0; background: #0a0e1c;">
            <div class="container relative z-2">
                <div class="row g-4">
                    <div class="col-md-12 mb-3 text-center text-md-start">
                        <div class="subtitle" style="color: var(--gold); font-weight: 700;">Get in Touch</div>
                        <h2 style="font-size: 36px; color: #fff;">SECRETARIAT &amp; ENQUIRIES</h2>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="luxury-card p-4 h-100">
                            <div class="d-flex align-items-center mb-3">
                                <div class="pillar-icon-box" style="width: 46px; height: 46px; font-size: 18px; margin: 0 14px 0 0;">
                                    <i class="fa fa-building-o"></i>
                                </div>
                                <div>
                                    <h4 style="color: #fff; font-size: 17px; margin: 0;">INTECARE Secretariat</h4>
                                    <p style="color: var(--gold); font-size: 12.5px; margin: 0;">Sponsorship &amp; Tables</p>
                                </div>
                            </div>
                            <p style="color: #cbd5e1; font-size: 14px; margin-bottom: 6px;">
                                <i class="fa fa-phone me-2 text-gold"></i> <a href="tel:+60378808822" style="color: #cbd5e1; text-decoration: none;">+60 3 7880 8822</a>
                            </p>
                            <p style="color: #cbd5e1; font-size: 14px; margin: 0;">
                                <i class="fa fa-envelope me-2 text-gold"></i> <a href="mailto:sponsorship@intecare.org" style="color: #cbd5e1; text-decoration: none;">sponsorship@intecare.org</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="luxury-card p-4 h-100">
                            <div class="d-flex align-items-center mb-3">
                                <div class="pillar-icon-box" style="width: 46px; height: 46px; font-size: 18px; margin: 0 14px 0 0;">
                                    <i class="fa fa-graduation-cap"></i>
                                </div>
                                <div>
                                    <h4 style="color: #fff; font-size: 17px; margin: 0;">Olympia Education Group</h4>
                                    <p style="color: var(--gold); font-size: 12.5px; margin: 0;">Academic Secretariat</p>
                                </div>
                            </div>
                            <p style="color: #cbd5e1; font-size: 14px; margin-bottom: 6px;">
                                <i class="fa fa-phone me-2 text-gold"></i> <a href="tel:+60378808825" style="color: #cbd5e1; text-decoration: none;">+60 3 7880 8825</a>
                            </p>
                            <p style="color: #cbd5e1; font-size: 14px; margin: 0;">
                                <i class="fa fa-envelope me-2 text-gold"></i> <a href="mailto:secretariat@intecare.org" style="color: #cbd5e1; text-decoration: none;">secretariat@intecare.org</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="luxury-card p-4 h-100" id="galaVenueCard" style="cursor: pointer;">
                            <div class="d-flex align-items-center mb-3">
                                <div class="pillar-icon-box" style="width: 46px; height: 46px; font-size: 18px; margin: 0 14px 0 0;">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div>
                                    <h4 style="color: #fff; font-size: 17px; margin: 0;">Gala Venue</h4>
                                    <p style="color: var(--gold); font-size: 12.5px; margin: 0;">27 November 2026</p>
                                </div>
                            </div>
                            <p style="color: #cbd5e1; font-size: 13.5px; line-height: 1.5; margin: 0;">
                                Hotel Royale Chulan Damansara, No. 2, Jalan PJU 7/3, Mutiara Damansara, 47810 Petaling Jaya, Selangor.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact us section ends -->

        <!-- Venue Details Modal -->
        <div class="modal" id="venueModal" tabindex="-1" role="dialog" aria-label="Gala Venue Modal">
            <div class="modal-content">
                <button type="button" class="close-btn" id="closeVenueBtn" aria-label="Close">&times;</button>
                
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge" style="background: rgba(201, 162, 39, 0.2); color: var(--gold); border: 1px solid var(--gold); font-size: 11px; padding: 4px 10px; border-radius: 20px;">
                        <i class="fa fa-map-marker me-1"></i> OFFICIAL GALA VENUE
                    </span>
                    <span class="badge" style="background: rgba(16, 185, 129, 0.2); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.4); font-size: 11px; padding: 4px 10px; border-radius: 20px;">
                        <i class="fa fa-calendar me-1"></i> 27 NOV 2026
                    </span>
                </div>
                
                <h3 style="font-family: var(--font-display); color: #fff; font-size: 22px; font-weight: 700; margin: 0 0 4px;">
                    Hotel Royale Chulan Damansara
                </h3>
                <p style="color: var(--gold); font-size: 13px; font-weight: 600; margin-bottom: 20px;">
                    Grand Ballroom &bull; Mutiara Damansara, Petaling Jaya, Selangor
                </p>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="venue-img-frame">
                            <picture>
                                <source srcset="<?= $basePath ?>/assets/images/gala-ballroom.webp" type="image/webp">
                                <img src="<?= $basePath ?>/assets/images/gala-ballroom.jpg" alt="Royale Chulan Damansara Grand Ballroom" loading="lazy">
                            </picture>
                        </div>
                        <div class="venue-map-frame">
                            <iframe
                                src="https://maps.google.com/maps?q=Hotel+Royale+Chulan+Damansara,+47810+Petaling+Jaya,+Selangor&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                                style="width: 100%; height: 100%; border: 0;"
                                title="Google Maps location for Hotel Royale Chulan Damansara"
                                loading="lazy"
                                allowfullscreen=""
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="https://www.google.com/maps/dir/?api=1&amp;destination=Hotel+Royale+Chulan+Damansara+2+Jalan+PJU+7%2F3+Mutiara+Damansara+47810+Petaling+Jaya+Selangor" target="_blank" rel="noopener noreferrer" class="btn btn-sm flex-grow-1 text-center" style="background: var(--gold); color: #04100c; font-weight: 700; font-size: 12px; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                                <i class="fa fa-location-arrow me-1"></i> Google Maps
                            </a>
                            <a href="https://waze.com/ul?q=Hotel+Royale+Chulan+Damansara" target="_blank" rel="noopener noreferrer" class="btn btn-sm flex-grow-1 text-center" style="background: rgba(201, 162, 39, 0.15); color: #fff; border: 1px solid var(--gold); font-weight: 700; font-size: 12px; padding: 8px 12px; border-radius: 6px; text-decoration: none;">
                                <i class="fa fa-car me-1"></i> Waze
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="venue-info-box">
                            <h5><i class="fa fa-map-pin me-1"></i> Full Address</h5>
                            <p>No. 2, Jalan PJU 7/3, Mutiara Damansara, 47810 Petaling Jaya, Selangor Darul Ehsan, Malaysia.</p>
                        </div>

                        <div class="venue-info-box">
                            <h5><i class="fa fa-subway me-1"></i> Public Transit (MRT)</h5>
                            <p><strong>MRT Mutiara Damansara (Kajang Line - KG08)</strong> &mdash; 5 min direct sheltered walk via pedestrian links at The Curve.</p>
                        </div>

                        <div class="venue-info-box">
                            <h5><i class="fa fa-road me-1"></i> Highway Access</h5>
                            <p>Direct accessibility via <strong>LDP, DASH, SPRINT (Penchala Link) &amp; NKVE</strong>.</p>
                        </div>

                        <div class="venue-info-box">
                            <h5><i class="fa fa-car me-1"></i> Parking &amp; Valet</h5>
                            <p>Covered basement parking with flat rate for gala attendees + VIP valet drop-off at main lobby.</p>
                        </div>

                        <div class="venue-info-box mb-0">
                            <h5><i class="fa fa-clock-o me-1"></i> Event Schedule</h5>
                            <p>Guest Reception: <strong>6:00 PM</strong> | Gala Dinner: <strong>7:30 PM &ndash; 11:00 PM</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- footer begin -->
    <footer class="text-light footer relative jarallax" style="background: linear-gradient(rgba(5, 8, 17, 0.88), rgba(5, 8, 17, 0.95)), url('<?= $basePath ?>/assets/images/event2.webp') center / cover no-repeat; padding: 75px 0 30px; border-top: 1px solid rgba(201, 162, 39, 0.25);">
        <div class="container relative z-2">
            <div class="row g-4 align-items-center">
                <div class="col-md-12 text-center">
                    <img class="footer-logo mb-3" src="<?= $basePath ?>/assets/images/logo-intecare.png" alt="INTECARE 2026 Logo" style="max-width: 210px;"><br>
                    <p style="color: var(--gold); font-size: 14.5px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; margin-bottom: 12px;">Healthier People | Better Care | Stronger Economy</p>
                    <p style="color: #cbd5e1; font-size: 14px; max-width: 680px; margin: 0 auto 24px; line-height: 1.6;">Organised by Healthcare &amp; Wellness Economy Development (HWED) and Malaysian Integrative Health Association (MIHA) in partnership with Olympia Education.</p>
                    <div class="social-icons mb-sm-30" style="display: flex; justify-content: center; gap: 15px;">
                        <a href="https://www.facebook.com/hwedmalaysia/" target="_blank" rel="noopener noreferrer" aria-label="Facebook" style="color: var(--gold); font-size: 18px; width: 40px; height: 40px; line-height: 40px; border-radius: 50%; background: rgba(201, 162, 39, 0.1); border: 1px solid rgba(201, 162, 39, 0.3); display: inline-flex; align-items: center; justify-content: center; transition: all 0.3s ease;"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/hwedmalaysia?stkn=djEwZDJpazlrMWQz" target="_blank" rel="noopener noreferrer" aria-label="Instagram" style="color: var(--gold); font-size: 18px; width: 40px; height: 40px; line-height: 40px; border-radius: 50%; background: rgba(201, 162, 39, 0.1); border: 1px solid rgba(201, 162, 39, 0.3); display: inline-flex; align-items: center; justify-content: center; transition: all 0.3s ease;"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.tiktok.com/@hwedmalaysia?_r=1&_t=ZS-9AN8waRC9yu" target="_blank" rel="noopener noreferrer" aria-label="TikTok" style="color: var(--gold); font-size: 18px; width: 40px; height: 40px; line-height: 40px; border-radius: 50%; background: rgba(201, 162, 39, 0.1); border: 1px solid rgba(201, 162, 39, 0.3); display: inline-flex; align-items: center; justify-content: center; transition: all 0.3s ease;"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="subfooter relative z-2" style="margin-top: 40px; padding-top: 22px; border-top: 1px solid rgba(255,255,255,0.08);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center copyright">
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Copyright &copy; 2026 INTECARE EXCELLENCE AWARDS. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- Javascript Files
    ================================================== -->
    <script src="<?= $basePath ?>/assets/realestate/js/vendors.js"></script>
    <script src="<?= $basePath ?>/assets/realestate/js/designesia.js"></script>
    <script src="<?= $basePath ?>/assets/realestate/js/custom-marquee.js"></script>

    <script>
        // 40 Exact Categories from Booklet (Pages 15 & 16) - Grouped into Individual & Corporate with Pillars
        const allCategories = [
            {
                type: "individual",
                name: "INDIVIDUAL EXCELLENCE AWARDS",
                count: "20 Awards",
                icon: "fa-user-md",
                desc: "Honouring exceptional clinicians, medical researchers, wellness leaders, and healthcare innovators across Malaysia categorized under the 4 Lifecycle Pillars (Stay Well, Get Well, Recover Well, Age Well).",
                items: [
                    // --- STAY WELL (Prevention, Wellness & Mental Wellbeing) ---
                    {
                        title: "Preventive Health Leadership Award 2026",
                        pillar: "Stay Well",
                        pillarClass: "pillar-stay-well",
                        pillarIcon: "fa-heartbeat",
                        detail: "Recognition Focus: Individuals advancing evidence-based preventative health, proactive lifestyle medicine, and holistic approaches to maintaining health before illness occurs."
                    },
                    {
                        title: "Community Health Leadership Award 2026",
                        pillar: "Stay Well",
                        pillarClass: "pillar-stay-well",
                        pillarIcon: "fa-users",
                        detail: "Recognition Focus: Individuals leading grassroots community wellbeing, public health empowerment, and accessible health initiatives."
                    },
                    {
                        title: "Wellness & Lifestyle Medicine Leadership Award 2026",
                        pillar: "Stay Well",
                        pillarClass: "pillar-stay-well",
                        pillarIcon: "fa-leaf",
                        detail: "Recognition Focus: Clinicians and wellness leaders promoting nutritional medicine, physical health, stress resilience, and lifestyle interventions."
                    },
                    {
                        title: "Mental Wellbeing Advocacy Award 2026",
                        pillar: "Stay Well",
                        pillarClass: "pillar-stay-well",
                        pillarIcon: "fa-smile-o",
                        detail: "Recognition Focus: Champions advancing mental wellness education, emotional health, psychological resilience, and holistic self-care."
                    },
                    {
                        title: "Health Promotion Innovation Award 2026",
                        pillar: "Stay Well",
                        pillarClass: "pillar-stay-well",
                        pillarIcon: "fa-bullhorn",
                        detail: "Recognition Focus: Innovators creating novel health promotion campaigns, digital wellness media, and educational health literacy programmes."
                    },

                    // --- GET WELL (Integrative Practice & Clinical Mastery) ---
                    {
                        title: "Integrative Healthcare Professional Leadership Award 2026",
                        pillar: "Get Well",
                        pillarClass: "pillar-get-well",
                        pillarIcon: "fa-stethoscope",
                        detail: "Recognition Focus: Medical practitioners pioneering the integration of conventional clinical practice with evidence-informed complementary therapies."
                    },
                    {
                        title: "Patient-Centred Care Leadership Award 2026",
                        pillar: "Get Well",
                        pillarClass: "pillar-get-well",
                        pillarIcon: "fa-heart",
                        detail: "Recognition Focus: Practitioners setting exemplary standards in empathetic communication, bedside manner, and patient-first care delivery."
                    },
                    {
                        title: "Evidence-Based Medicine Leadership Award 2026",
                        pillar: "Get Well",
                        pillarClass: "pillar-get-well",
                        pillarIcon: "fa-flask",
                        detail: "Recognition Focus: Medical researchers and practitioners demonstrating rigorous scientific evidence, clinical protocols, and treatment integrity."
                    },
                    {
                        title: "Healthcare Innovation in Care Delivery Award 2026",
                        pillar: "Get Well",
                        pillarClass: "pillar-get-well",
                        pillarIcon: "fa-hospital-o",
                        detail: "Recognition Focus: Trailblazers implementing novel clinical workflows, diagnostic precision, and innovative treatment pathways."
                    },
                    {
                        title: "Clinical Excellence Leadership Award 2026",
                        pillar: "Get Well",
                        pillarClass: "pillar-get-well",
                        pillarIcon: "fa-user-md",
                        detail: "Recognition Focus: Outstanding doctors, surgeons, and clinicians demonstrating highest levels of clinical mastery and medical excellence."
                    },

                    // --- RECOVER WELL (Rehabilitation & Functional Health) ---
                    {
                        title: "Rehabilitation Leadership Award 2026",
                        pillar: "Recover Well",
                        pillarClass: "pillar-recover-well",
                        pillarIcon: "fa-wheelchair",
                        detail: "Recognition Focus: Physiotherapists, occupational therapists, and rehabilitation clinicians restoring physical function and patient independence."
                    },
                    {
                        title: "Recovery & Functional Healthcare Leadership Award 2026",
                        pillar: "Recover Well",
                        pillarClass: "pillar-recover-well",
                        pillarIcon: "fa-medkit",
                        detail: "Recognition Focus: Clinicians dedicated to functional recovery, chronic pain management, neuromuscular restoration, and movement health."
                    },
                    {
                        title: "Integrated Recovery Care Leadership Award 2026",
                        pillar: "Recover Well",
                        pillarClass: "pillar-recover-well",
                        pillarIcon: "fa-refresh",
                        detail: "Recognition Focus: Leaders developing multidisciplinary post-operative and long-term transitional recovery protocols."
                    },
                    {
                        title: "Mental Health Recovery Leadership Award 2026",
                        pillar: "Recover Well",
                        pillarClass: "pillar-recover-well",
                        pillarIcon: "fa-shield",
                        detail: "Recognition Focus: Mental healthcare professionals providing transformative trauma recovery, psychosocial rehabilitation, and psychiatric support."
                    },
                    {
                        title: "Independent Living & Social Care Leadership Award 2026",
                        pillar: "Recover Well",
                        pillarClass: "pillar-recover-well",
                        pillarIcon: "fa-life-ring",
                        detail: "Recognition Focus: Care advocates and social care leaders empowering individuals with disabilities and chronic conditions to live with dignity."
                    },

                    // --- AGE WELL (Longevity, Active Ageing & Quality of Life) ---
                    {
                        title: "Healthy Ageing Advocacy Award 2026",
                        pillar: "Age Well",
                        pillarClass: "pillar-age-well",
                        pillarIcon: "fa-hourglass-half",
                        detail: "Recognition Focus: Advocates dedicated to promoting active, purpose-driven ageing, senior vitality, and age-friendly communities."
                    },
                    {
                        title: "Active Ageing Leadership Award 2026",
                        pillar: "Age Well",
                        pillarClass: "pillar-age-well",
                        pillarIcon: "fa-child",
                        detail: "Recognition Focus: Leaders empowering older adults through physical fitness, social engagement, and lifelong active living."
                    },
                    {
                        title: "Longevity & Lifestyle Innovation Award 2026",
                        pillar: "Age Well",
                        pillarClass: "pillar-age-well",
                        pillarIcon: "fa-trophy",
                        detail: "Recognition Focus: Researchers and clinicians pioneering cellular vitality, longevity science, and preventative anti-ageing protocols."
                    },
                    {
                        title: "Age-Friendly Healthcare Leadership Award 2026",
                        pillar: "Age Well",
                        pillarClass: "pillar-age-well",
                        pillarIcon: "fa-home",
                        detail: "Recognition Focus: Healthcare providers and geriatric specialists designing age-adapted clinical services and elder care."
                    },
                    {
                        title: "Excellence in Ageing & Quality of Life Leadership Award 2026",
                        pillar: "Age Well",
                        pillarClass: "pillar-age-well",
                        pillarIcon: "fa-star",
                        detail: "Recognition Focus: Visionary leaders dedicated to enhancing senior quality of life, palliative comfort, and elder dignity."
                    }
                ]
            },
            {
                type: "corporate",
                name: "CORPORATE EXCELLENCE AWARDS",
                count: "20 Awards",
                icon: "fa-building",
                desc: "Honouring leading hospitals, healthcare enterprises, MedTech innovators, and ecosystem organisations driving national health vitality.",
                items: [
                    {
                        title: "Healthcare Organisation Excellence Award 2026",
                        pillar: "Organisation Excellence",
                        pillarClass: "pillar-corp-org",
                        pillarIcon: "fa-building-o",
                        detail: "Recognition Focus: Hospitals, healthcare groups, and tertiary centres demonstrating outstanding clinical governance, patient care, and operational excellence."
                    },
                    {
                        title: "Wellness Organisation Excellence Award 2026",
                        pillar: "Organisation Excellence",
                        pillarClass: "pillar-corp-org",
                        pillarIcon: "fa-leaf",
                        detail: "Recognition Focus: Wellness institutions, wellness resorts, and integrative centres delivering verified health outcomes and premier standards."
                    },
                    {
                        title: "Healthcare Brand Excellence Award 2026",
                        pillar: "Brand Leadership",
                        pillarClass: "pillar-corp-org",
                        pillarIcon: "fa-certificate",
                        detail: "Recognition Focus: Healthcare and wellness brands with exceptional trust, public reputation, patient loyalty, and ethical branding."
                    },
                    {
                        title: "Emerging Healthcare Enterprise Excellence Award 2026",
                        pillar: "Enterprise Growth",
                        pillarClass: "pillar-corp-org",
                        pillarIcon: "fa-rocket",
                        detail: "Recognition Focus: Fast-growing healthcare startups and SMEs making a breakthrough impact in the healthcare market."
                    },
                    {
                        title: "Excellence in Healthcare Impact Award 2026",
                        pillar: "Public Health Impact",
                        pillarClass: "pillar-corp-org",
                        pillarIcon: "fa-line-chart",
                        detail: "Recognition Focus: Organisations delivering measurable health improvements, expanding patient access, and lowering care barriers."
                    },
                    {
                        title: "Healthcare Innovation Excellence Award 2026",
                        pillar: "Innovation & MedTech",
                        pillarClass: "pillar-corp-tech",
                        pillarIcon: "fa-lightbulb-o",
                        detail: "Recognition Focus: Organisations pioneering breakthrough medical innovations, novel care models, and clinical advancements."
                    },
                    {
                        title: "Digital Health Transformation Excellence Award 2026",
                        pillar: "Digital Transformation",
                        pillarClass: "pillar-corp-tech",
                        pillarIcon: "fa-laptop",
                        detail: "Recognition Focus: Platforms leading telemedicine, digital patient records, and health system interoperability."
                    },
                    {
                        title: "Health Technology Excellence Award 2026",
                        pillar: "Health Technology",
                        pillarClass: "pillar-corp-tech",
                        pillarIcon: "fa-microchip",
                        detail: "Recognition Focus: Technology firms delivering advanced MedTech devices, diagnostic equipment, and smart health systems."
                    },
                    {
                        title: "Integrative Healthcare Innovation Award 2026",
                        pillar: "Integrative Innovation",
                        pillarClass: "pillar-corp-tech",
                        pillarIcon: "fa-plus-circle",
                        detail: "Recognition Focus: Enterprises effectively bridging conventional clinical medicine with integrative therapies."
                    },
                    {
                        title: "Future of Healthcare Excellence Award 2026",
                        pillar: "Future Medicine & AI",
                        pillarClass: "pillar-corp-tech",
                        pillarIcon: "fa-compass",
                        detail: "Recognition Focus: Visionary companies shaping the future of medicine through AI, biotechnology, and precision health."
                    },
                    {
                        title: "Employer of Choice – Healthcare & Wellness Excellence Award 2026",
                        pillar: "Workforce & Talent",
                        pillarClass: "pillar-corp-workforce",
                        pillarIcon: "fa-users",
                        detail: "Recognition Focus: Healthcare employers demonstrating superior staff empowerment, professional development, and workplace satisfaction."
                    },
                    {
                        title: "Healthcare Workforce Development Excellence Award 2026",
                        pillar: "Workforce & Talent",
                        pillarClass: "pillar-corp-workforce",
                        pillarIcon: "fa-graduation-cap",
                        detail: "Recognition Focus: Institutions excelling in medical training, continuous clinical education, and nursing talent cultivation."
                    },
                    {
                        title: "Excellence in Employee Wellbeing Award 2026",
                        pillar: "Workforce Wellbeing",
                        pillarClass: "pillar-corp-workforce",
                        pillarIcon: "fa-smile-o",
                        detail: "Recognition Focus: Corporate enterprises with outstanding holistic employee health, mental wellbeing, and fitness programmes."
                    },
                    {
                        title: "Community Partnership Excellence Award 2026",
                        pillar: "Community & Ecosystem",
                        pillarClass: "pillar-corp-ecosystem",
                        pillarIcon: "fa-handshake-o",
                        detail: "Recognition Focus: Organisations building high-impact community alliances to address public health priorities."
                    },
                    {
                        title: "Social Impact & Community Development Healthcare Award 2026",
                        pillar: "Social Impact & CSR",
                        pillarClass: "pillar-corp-ecosystem",
                        pillarIcon: "fa-globe",
                        detail: "Recognition Focus: CSR and philanthropic healthcare initiatives delivering sustainable care to underserved populations."
                    },
                    {
                        title: "Sustainable Healthcare Excellence Award 2026",
                        pillar: "ESG & Sustainability",
                        pillarClass: "pillar-corp-ecosystem",
                        pillarIcon: "fa-recycle",
                        detail: "Recognition Focus: Facilities leading ESG standards, energy-efficient hospitals, medical waste reduction, and green healthcare."
                    },
                    {
                        title: "Healthcare Ecosystem Partnership Excellence Award 2026",
                        pillar: "Ecosystem Partnership",
                        pillarClass: "pillar-corp-ecosystem",
                        pillarIcon: "fa-link",
                        detail: "Recognition Focus: Multi-sector partnerships connecting science, enterprise, academia, and healthcare delivery."
                    },
                    {
                        title: "Excellence in Healthcare Enterprise Development Award 2026",
                        pillar: "Enterprise Development",
                        pillarClass: "pillar-corp-ecosystem",
                        pillarIcon: "fa-cogs",
                        detail: "Recognition Focus: Organisations driving commercialisation, health SME incubation, and health-tech venture expansion."
                    },
                    {
                        title: "Healthcare Investment & Growth Excellence Award 2026",
                        pillar: "Investment & Capital",
                        pillarClass: "pillar-corp-ecosystem",
                        pillarIcon: "fa-money",
                        detail: "Recognition Focus: Investment funds and enterprises providing strategic capital to fuel healthcare infrastructure and innovation."
                    },
                    {
                        title: "Outstanding Contribution to the Healthcare & Wellness Economy Award 2026",
                        pillar: "National Health Economy",
                        pillarClass: "pillar-corp-ecosystem",
                        pillarIcon: "fa-star",
                        detail: "Recognition Focus: The premier corporate honour celebrating sustained industry leadership and national economic contribution."
                    }
                ]
            }
        ];

        const container = document.getElementById("categoriesContainer");
        const logoIntecare = "<?= $basePath ?>/assets/images/logo-intecare2.png";

        function renderCategories(filter = "all") {
            container.innerHTML = "";

            allCategories.forEach(cat => {
                if (filter === "all" || filter === cat.type) {
                    const section = document.createElement("div");
                    section.className = "category-section mb-5";
                    section.innerHTML = `
                        <div class="category-name d-flex justify-content-between align-items-center mb-3">
                            <h2>
                                <i class="fa ${cat.icon}" style="color: var(--gold); font-size: 20px;"></i> 
                                ${cat.name}
                            </h2>
                            <span class="badge" style="background: rgba(201, 162, 39, 0.15); color: var(--gold); border: 1px solid rgba(201, 162, 39, 0.4); font-size: 13px; padding: 6px 14px; border-radius: 20px;">
                                ${cat.count}
                            </span>
                        </div>
                        <p style="color: var(--text-muted); font-size: 14.5px; margin-top: -8px; margin-bottom: 22px;">
                            ${cat.desc}
                        </p>
                        <div class="category-cards"></div>
                    `;
                    container.appendChild(section);

                    const cardsContainer = section.querySelector(".category-cards");
                    cat.items.forEach(item => {
                        const card = document.createElement("div");
                        card.className = "category-card card-modal";
                        card.dataset.title = item.title;
                        card.dataset.text = item.detail;
                        card.dataset.pillar = item.pillar || '';
                        card.dataset.pillClass = item.pillarClass || '';
                        card.dataset.pillarIcon = item.pillarIcon || '';
                        card.dataset.type = cat.type === 'individual' ? 'Individual Award' : 'Corporate Award';
                        card.innerHTML = `
                            <h3 class="category-heading">
                                <img src="${logoIntecare}" alt="INTECARE" style="height: 18px; width: auto; vertical-align: -3px; display: inline-block; margin-right: 7px;">${item.title}
                            </h3>
                        `;
                        cardsContainer.appendChild(card);
                    });
                }
            });
        }

        // Filter tab handlers
        document.querySelectorAll(".filter-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active"));
                this.classList.add("active");
                renderCategories(this.dataset.filter);
            });
        });

        // Initial render
        renderCategories("all");

        // Modal Logic
        const modal = document.getElementById("categoryModal");
        const modalBadges = document.getElementById("modalBadges");
        const modalTitle = document.getElementById("modalTitle");
        const modalText = document.getElementById("modalText");
        const closeBtn = document.querySelector("#categoryModal .close-btn");

        document.addEventListener("click", e => {
            const card = e.target.closest(".category-card");
            if (card) {
                modal.style.display = "flex";
                const pillarBadge = card.dataset.pillar ? `
                    <span class="pillar-pill ${card.dataset.pillClass}" style="font-size: 11px; padding: 4px 12px; margin-bottom: 0;">
                        <i class="fa ${card.dataset.pillarIcon}"></i> ${card.dataset.pillar}
                    </span>
                ` : '';
                const typeBadge = card.dataset.type ? `
                    <span class="badge" style="background: rgba(201, 162, 39, 0.15); color: var(--gold); border: 1px solid rgba(201, 162, 39, 0.4); font-size: 11px; padding: 5px 12px; border-radius: 20px;">
                        <i class="fa fa-check-circle me-1"></i> ${card.dataset.type}
                    </span>
                ` : '';
                
                if (modalBadges) {
                    modalBadges.innerHTML = `
                        <span class="badge" style="background: rgba(201, 162, 39, 0.2); color: var(--gold); border: 1px solid var(--gold); font-size: 11px; padding: 5px 12px; border-radius: 20px;">OFFICIAL AWARD CRITERIA</span>
                        ${pillarBadge}
                        ${typeBadge}
                    `;
                }
                modalTitle.innerHTML = `<div class="d-flex align-items-center gap-2 mb-2"><img src="${logoIntecare}" alt="INTECARE" style="height: 24px; width: auto; vertical-align: middle; display: inline-block;"><span>${card.dataset.title}</span></div>`;
                modalText.innerHTML = card.dataset.text;
            }
        });

        if (closeBtn) {
            closeBtn.onclick = () => modal.style.display = "none";
        }

        // Venue Modal Logic
        const venueModal = document.getElementById("venueModal");
        const closeVenueBtn = document.getElementById("closeVenueBtn");
        const galaVenueCard = document.getElementById("galaVenueCard");

        if (galaVenueCard && venueModal) {
            galaVenueCard.addEventListener("click", () => {
                venueModal.style.display = "flex";
            });
        }

        if (closeVenueBtn && venueModal) {
            closeVenueBtn.addEventListener("click", () => {
                venueModal.style.display = "none";
            });
        }

        window.addEventListener("click", e => {
            if (e.target === modal) modal.style.display = "none";
            if (e.target === venueModal) venueModal.style.display = "none";
        });

        window.addEventListener("keydown", e => {
            if (e.key === "Escape") {
                if (modal) modal.style.display = "none";
                if (venueModal) venueModal.style.display = "none";
            }
        });

        // FAQ Accordion Interactivity
        document.addEventListener('click', function(e) {
            const header = e.target.closest('.faq-header');
            if (!header) return;
            e.preventDefault();
            
            const currentItem = header.closest('.faq-item');
            if (!currentItem) return;
            const isCurrentlyActive = currentItem.classList.contains('active');

            // Close all other FAQ items
            document.querySelectorAll('.faq-item').forEach(item => {
                if (item !== currentItem) {
                    item.classList.remove('active');
                }
            });

            // Toggle clicked item
            if (isCurrentlyActive) {
                currentItem.classList.remove('active');
            } else {
                currentItem.classList.add('active');
            }
        });
    </script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="<?= $basePath ?>/assets/realestate/js/gallery_slider.js"></script>

</body>
</html>
