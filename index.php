<?php
/**
 * INTECARE EXCELLENCE AWARD 2026 — OFFICIAL HOMEPAGE
 * Unified PHP Template Architecture with Modular Partials & WebP Optimization
 */

$activePage = 'home';
$pageTitle = 'INTECARE EXCELLENCE AWARD 2026 — Official Website';
$pageDescription = 'INTECARE 2026 brings together healthcare, wellness, education, professional practice, innovation, technology, enterprise and industry celebrating excellence across the healthcare and wellness economy.';

require_once __DIR__ . '/includes/nav.php';
?>

  <main>
    <!-- ==========================================================================
         SECTION 2: HERO SECTION
         Bold, oversized editorial typography, art-directed collage & neon lime accents
         ========================================================================== -->
    <section class="hero-section" id="home" aria-label="Hero Section">
      <!-- Background Video Layer -->
      <video class="hero-video" autoplay muted loop playsinline preload="auto">
        <source src="<?= $basePath ?>/assets/videos/hero.mp4" type="video/mp4">
      </video>

      <!-- Video Overlay for Readability & Brand Depth -->
      <div class="hero-video-overlay" aria-hidden="true"></div>

      <div class="hero-container">

        <!-- Left Editorial Column -->
        <div class="hero-content">
          <div class="hero-meta-eyebrow">
            27 NOV 2026 <span class="meta-slash">♦</span> HOTEL ROYALE CHULAN DAMANSARA
          </div>

          <!-- Official Gala Countdown Integrated Plaque -->
          <aside class="hero-countdown-floating hero-countdown-integrated" id="eventCountdown"
            aria-label="Official Gala Countdown to 27 November 2026" role="region" tabindex="0">
            <div class="cd-floating-header">
              <div class="cd-header-left">
                <span class="countdown-live-dot" aria-hidden="true"></span>
                <span class="cd-floating-tag">GALA COUNTDOWN</span>
              </div>
              <div class="cd-calendar-wrap">
                <button type="button" class="btn-cal-add" id="btnAddToCal" aria-label="Add Gala Dinner to Calendar" aria-haspopup="true" aria-expanded="false" title="Add Gala to Calendar">
                  <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                  <span>+ CALENDAR</span>
                </button>
                <div class="cd-cal-menu" id="calMenu" role="menu" aria-label="Calendar Options">
                  <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=INTECARE+Excellence+Award+2026+Gala+Dinner&dates=20261127T113000Z/20261127T150000Z&details=Official+Gala+Dinner+and+Awards+Presentation+for+INTECARE+2026.+Recognising+visionary+individuals+and+organisations+across+Healthcare,+Wellness,+Education,+and+Disability.&location=Grand+Ballroom,+Hotel+Royale+Chulan+Damansara,+Petaling+Jaya,+Malaysia" target="_blank" rel="noopener noreferrer" class="cd-cal-item" role="menuitem">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 0C5.372 0 0 5.373 0 12s5.372 12 12 12c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zm1 4h-2v7h6v-2h-4V6z"/></svg>
                    <span>Google Calendar</span>
                  </a>
                  <button type="button" class="cd-cal-item" id="btnDownloadIcs" role="menuitem">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span>Apple / iCal / Outlook (.ics)</span>
                  </button>
                  <a href="https://outlook.live.com/calendar/0/deeplink/compose?subject=INTECARE+Excellence+Award+2026+Gala+Dinner&startdt=2026-11-27T19:30:00+08:00&enddt=2026-11-27T23:00:00+08:00&body=Official+Gala+Dinner+and+Awards+Presentation+for+INTECARE+2026.&location=Grand+Ballroom,+Hotel+Royale+Chulan+Damansara" target="_blank" rel="noopener noreferrer" class="cd-cal-item" role="menuitem">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                    <span>Outlook Web</span>
                  </a>
                </div>
              </div>
            </div>
            <div class="cd-floating-digits">
              <div class="cd-unit-group">
                <strong id="cdDays" class="cd-floating-num">--</strong>
                <span class="cd-floating-label">DAYS</span>
              </div>
              <span class="cd-floating-sep" aria-hidden="true">:</span>
              <div class="cd-unit-group">
                <strong id="cdHours" class="cd-floating-num">--</strong>
                <span class="cd-floating-label">HOURS</span>
              </div>
              <span class="cd-floating-sep" aria-hidden="true">:</span>
              <div class="cd-unit-group">
                <strong id="cdMins" class="cd-floating-num">--</strong>
                <span class="cd-floating-label">MINS</span>
              </div>
              <span class="cd-floating-sep" aria-hidden="true">:</span>
              <div class="cd-unit-group">
                <strong id="cdSecs" class="cd-floating-num">--</strong>
                <span class="cd-floating-label">SECS</span>
              </div>
            </div>
          </aside>

          <h1 class="hero-title-massive">
            INTECARE<br>2026
          </h1>

          <div class="hero-tagline-accent">
            HEALTHIER PEOPLE.<br>
            BETTER CARE.<br>
            STRONGER ECONOMY.
          </div>

          <p class="hero-lead-text">
            Recognising visionary individuals and organisations driving innovation in healthcare, wellness and the
            economy.
          </p>

          <div class="hero-actions-group">
            <button type="button" class="btn btn-lime open-nomination-btn">
              <span>SUBMIT NOMINATION</span>
              <span class="btn-arrow" aria-hidden="true">→</span>
            </button>
            <a href="<?= $basePath ?>/awards" class="btn btn-outline-pill">
              <span>DISCOVER THE AWARDS</span>
            </a>
          </div>
        </div>

      </div>

      <!-- Minimal Subtle Scroll Indicator -->
      <div class="hero-scroll-prompt" aria-hidden="true">
        <span>SCROLL</span>
        <span class="prompt-arrow">↓</span>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 2: AWARDS TEASER PANEL
         Clean white background, trophy focal visual, 20/20 category stats & CTA
         ========================================================================== -->
    <section class="teaser-section bg-white-section" id="awards" aria-label="INTECARE Excellence Awards Teaser">
      <div class="teaser-container">
        <div class="teaser-split-grid">

          <!-- Left: Narrative, Stats & CTA -->
          <div class="teaser-content-col reveal-left">
            <h2 class="teaser-title reveal-heading">
              BENCHMARKING EXCELLENCE IN <span style="color: #087F8C;">HEALTHCARE &amp; WELLNESS</span>
            </h2>

            <p class="teaser-lead reveal-standard">
              Honouring 40 visionary individuals and pioneering organisations driving transformative impact across
              clinical care, enterprise innovation, and community health.
            </p>

            <div class="teaser-awards-stats reveal-card-group">
              <div class="teaser-stat-badge">
                <span class="teaser-stat-num">20</span>
                <span class="teaser-stat-text">Individual Excellence Awards</span>
              </div>
              <div class="teaser-stat-badge">
                <span class="teaser-stat-num">20</span>
                <span class="teaser-stat-text">Corporate Excellence Awards</span>
              </div>
            </div>

            <div class="teaser-actions reveal-standard">
              <a href="<?= $basePath ?>/awards" class="btn btn-lime">
                <span>EXPLORE THE AWARDS</span>
                <span class="btn-arrow" aria-hidden="true">→</span>
              </a>
            </div>
          </div>

          <!-- Right: Trophy Focal Visual -->
          <div class="teaser-visual-col reveal-right">
            <div class="teaser-trophy-frame reveal-image">
              <picture>
                <source srcset="<?= $basePath ?>/assets/images/award-trophy-rendered.webp" type="image/webp">
                <img src="<?= $basePath ?>/assets/images/award-trophy-rendered.jpg"
                  alt="INTECARE 2026 Excellence Award handcrafted trophy sculpture" class="teaser-trophy-img" width="480"
                  height="380" loading="lazy">
              </picture>
              <div class="teaser-trophy-badge">
                <span>40 EXCELLENCE AWARDS</span>
                <span style="color: var(--color-lime-accent);">✦ 2026 COHORT</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 3: ABOUT INTECARE TEASER PANEL
         Deep midnight background, editorial split layout with research visual
         ========================================================================== -->
    <section class="teaser-section bg-midnight" id="about" aria-label="About INTECARE Teaser">
      <div class="teaser-container">
        <div class="teaser-split-grid reversed">

          <!-- Left: Innovation Visual -->
          <div class="teaser-visual-col reveal-left">
            <div class="teaser-image-frame reveal-image">
              <picture>
                <source srcset="<?= $basePath ?>/assets/images/home2.webp" type="image/webp">
                <img src="<?= $basePath ?>/assets/images/home2.jpg"
                  alt="INTECARE 2026 unified healthcare and wellness continuum" width="480" height="380"
                  loading="lazy">
              </picture>
            </div>
          </div>

          <!-- Right: Editorial Introduction & CTA -->
          <div class="teaser-content-col reveal-right">
            <h2 class="teaser-title reveal-heading">
              ONE ECOSYSTEM. ONE VISION.<br>
              <span class="text-lime-glow">A HEALTHIER FUTURE.</span>
            </h2>

            <p class="teaser-lead reveal-standard">
              Intecare Excellence Award 2026 unites healthcare practitioners, wellness providers, educators,
              researchers, and enterprise pioneers on a single collaborative stage, celebrating transformative
              leadership across the complete human health continuum.
            </p>

            <div class="teaser-actions reveal-standard">
              <a href="<?= $basePath ?>/about" class="btn btn-outline-pill">
                <span>DISCOVER INTECARE</span>
                <span class="btn-arrow" aria-hidden="true">→</span>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 4: HWED ECOSYSTEM TEASER PANEL
         Deep navy teal background, multi-sector domain pills & strategic blueprint preview
         ========================================================================== -->
    <section class="teaser-section bg-deep-teal" id="ecosystem" aria-label="HWED Ecosystem Teaser">
      <div class="teaser-container">
        <div class="teaser-split-grid">

          <!-- Left: Ecosystem Narrative & Domain Chips -->
          <div class="teaser-content-col reveal-left">
            <h2 class="teaser-title reveal-heading">
              A CONNECTED ECOSYSTEM FOR <span class="text-lime-glow">SUSTAINABLE HEALTHCARE</span>
            </h2>

            <p class="teaser-lead reveal-standard">
              The Healthcare &amp; Wellness Economy Development (HWED) multi-sector initiative bridges science, capital,
              enterprise, and policy to accelerate sustainable health transformation nationwide.
            </p>

            <!-- Domain Keywords -->
            <div class="teaser-chips-grid">
              <span class="teaser-domain-chip">
                <span class="teaser-chip-dot" aria-hidden="true"></span>
                <span>KNOWLEDGE &amp; EDUCATION</span>
              </span>
              <span class="teaser-domain-chip">
                <span class="teaser-chip-dot" aria-hidden="true"></span>
                <span>TECHNOLOGY &amp; DIGITAL</span>
              </span>
              <span class="teaser-domain-chip">
                <span class="teaser-chip-dot" aria-hidden="true"></span>
                <span>ENTERPRISE &amp; COMMERCE</span>
              </span>
              <span class="teaser-domain-chip">
                <span class="teaser-chip-dot" aria-hidden="true"></span>
                <span>INVESTMENT &amp; CAPITAL</span>
              </span>
              <span class="teaser-domain-chip">
                <span class="teaser-chip-dot" aria-hidden="true"></span>
                <span>INDUSTRY &amp; POLICY</span>
              </span>
            </div>

            <div class="teaser-actions reveal-standard">
              <a href="<?= $basePath ?>/hwed-ecosystem" class="btn btn-lime">
                <span>EXPLORE THE ECOSYSTEM</span>
                <span class="btn-arrow" aria-hidden="true">→</span>
              </a>
            </div>
          </div>

          <!-- Right: Architecture Visual Card -->
          <div class="teaser-visual-col reveal-right">
            <div class="teaser-image-frame reveal-image" style="border-color: rgba(198, 242, 77, 0.3);">
              <picture>
                <source srcset="<?= $basePath ?>/assets/images/home1.webp" type="image/webp">
                <img src="<?= $basePath ?>/assets/images/home1.jpg"
                  alt="HWED Connected Ecosystem for Sustainable Healthcare" width="480" height="380"
                  loading="lazy">
              </picture>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 5: ORGANISERS & STRATEGIC ALLIANCE — CONTINUOUS LOGO MARQUEE
         Clean white background, seamless horizontal infinite loop animation
         ========================================================================== -->
    <section class="teaser-section bg-white-section" id="organisers" aria-label="Organisers and Strategic Alliance">
      <div class="teaser-container" style="text-align: center;">
        <h2 class="teaser-title teaser-title-organisers reveal-heading"
          style="margin-inline: auto; max-width: 860px; text-align: center;">
          OUR ORGANISERS &amp;<br>
          <span class="text-lime-glow">STRATEGIC ALLIANCE</span>
        </h2>

        <p class="teaser-lead reveal-standard" style="margin-inline: auto; text-align: center; max-width: 640px; color: #4A656F;">
          INTECARE 2026 brings together distinguished national healthcare authorities, economic development platforms,
          and academic convocation partners.
        </p>

        <!-- Continuous Logo Marquee Track -->
        <div class="teaser-marquee-wrapper reveal-up" aria-label="Official partner logos ticker">
          <div class="teaser-marquee-track">

            <!-- Set 1 (Interactive & Accessible) -->
            <div class="marquee-logo-card">
              <img src="<?= $basePath ?>/assets/images/logo-hwed.png" alt="Healthcare &amp; Wellness Economy Development (HWED)"
                class="marquee-logo-img" width="160" height="48" loading="lazy">
              <span class="marquee-logo-role">Ecosystem Enabler</span>
            </div>
            <div class="marquee-logo-card">
              <img src="<?= $basePath ?>/assets/images/logo-miha.png" alt="Malaysian Integrative Health Association (MIHA)"
                class="marquee-logo-img" width="160" height="48" loading="lazy">
              <span class="marquee-logo-role">National Integrative Authority</span>
            </div>
            <div class="marquee-logo-card">
              <img src="<?= $basePath ?>/assets/images/logo-olympia.png" alt="Olympia Education Group" class="marquee-logo-img"
                width="160" height="48" loading="lazy">
              <span class="marquee-logo-role">Academic Convocation Partner</span>
            </div>
            <div class="marquee-logo-card">
              <img src="<?= $basePath ?>/assets/images/logo-hwed.png" alt="Healthcare &amp; Wellness Economy Development (HWED)"
                class="marquee-logo-img" width="160" height="48" loading="lazy">
              <span class="marquee-logo-role">Ecosystem Enabler</span>
            </div>
            <div class="marquee-logo-card">
              <img src="<?= $basePath ?>/assets/images/logo-miha.png" alt="Malaysian Integrative Health Association (MIHA)"
                class="marquee-logo-img" width="160" height="48" loading="lazy">
              <span class="marquee-logo-role">National Integrative Authority</span>
            </div>
            <div class="marquee-logo-card">
              <img src="<?= $basePath ?>/assets/images/logo-olympia.png" alt="Olympia Education Group" class="marquee-logo-img"
                width="160" height="48" loading="lazy">
              <span class="marquee-logo-role">Academic Convocation Partner</span>
            </div>

            <!-- Set 2 (Duplicated for Seamless Infinite Loop, Hidden from Screen Readers) -->
            <div class="marquee-logo-card" aria-hidden="true">
              <img src="<?= $basePath ?>/assets/images/logo-hwed.png" alt="" class="marquee-logo-img" width="160" height="48"
                loading="lazy">
              <span class="marquee-logo-role">Ecosystem Enabler</span>
            </div>
            <div class="marquee-logo-card" aria-hidden="true">
              <img src="<?= $basePath ?>/assets/images/logo-miha.png" alt="" class="marquee-logo-img" width="160" height="48"
                loading="lazy">
              <span class="marquee-logo-role">National Integrative Authority</span>
            </div>
            <div class="marquee-logo-card" aria-hidden="true">
              <img src="<?= $basePath ?>/assets/images/logo-olympia.png" alt="" class="marquee-logo-img" width="160" height="48"
                loading="lazy">
              <span class="marquee-logo-role">Academic Convocation Partner</span>
            </div>
            <div class="marquee-logo-card" aria-hidden="true">
              <img src="<?= $basePath ?>/assets/images/logo-hwed.png" alt="" class="marquee-logo-img" width="160" height="48"
                loading="lazy">
              <span class="marquee-logo-role">Ecosystem Enabler</span>
            </div>
            <div class="marquee-logo-card" aria-hidden="true">
              <img src="<?= $basePath ?>/assets/images/logo-miha.png" alt="" class="marquee-logo-img" width="160" height="48"
                loading="lazy">
              <span class="marquee-logo-role">National Integrative Authority</span>
            </div>
            <div class="marquee-logo-card" aria-hidden="true">
              <img src="<?= $basePath ?>/assets/images/logo-olympia.png" alt="" class="marquee-logo-img" width="160" height="48"
                loading="lazy">
              <span class="marquee-logo-role">Academic Convocation Partner</span>
            </div>

          </div>
        </div>

        <div class="teaser-actions reveal-standard" style="margin-top: 1.75rem; text-align: center;">
          <a href="<?= $basePath ?>/organisers" class="btn btn-outline-pill">
            <span>MEET OUR ORGANISERS</span>
            <span class="btn-arrow" aria-hidden="true">→</span>
          </a>
        </div>

      </div>
    </section>

    <!-- ==========================================================================
         SECTION 6: EVENT DETAILS TEASER PANEL
         Deep midnight background, gala ballroom visual, compact specifications & CTA
         ========================================================================== -->
    <section class="teaser-section bg-midnight" id="event" aria-label="Event Details Teaser">
      <div class="teaser-container">
        <div class="teaser-split-grid reversed">

          <!-- Left: Ballroom Visual -->
          <div class="teaser-visual-col reveal-left">
            <div class="teaser-image-frame reveal-image" style="border-color: rgba(198, 242, 77, 0.35);">
              <picture>
                <source srcset="<?= $basePath ?>/assets/images/gala-ballroom.webp" type="image/webp">
                <img src="<?= $basePath ?>/assets/images/gala-ballroom.jpg" alt="Hotel Royale Chulan Damansara Grand Ballroom host setting"
                  width="480" height="380" loading="lazy">
              </picture>
            </div>
          </div>

          <!-- Right: Gala Specifications & CTA -->
          <div class="teaser-content-col reveal-right">
            <h2 class="teaser-title reveal-heading">
              THE GALA DINNER &amp;<br>
              <span class="text-lime-glow">AWARDS PRESENTATION</span>
            </h2>

            <p class="teaser-lead reveal-standard">
              Join healthcare leaders, clinical innovators, corporate partners, and distinguished delegates for a
              signature evening at Royale Chulan Damansara.
            </p>

            <!-- Compact Specs Grid -->
            <div class="teaser-event-specs-grid reveal-card-group">
              <div class="teaser-event-spec-item">
                <div class="teaser-event-spec-label">DATE</div>
                <div class="teaser-event-spec-val">27 NOV 2026</div>
                <div class="teaser-event-spec-sub">Friday Evening</div>
              </div>
              <div class="teaser-event-spec-item">
                <div class="teaser-event-spec-label">HOURS</div>
                <div class="teaser-event-spec-val">7:30 PM – 11:00 PM</div>
                <div class="teaser-event-spec-sub">Registration 6:30 PM</div>
              </div>
              <div class="teaser-event-spec-item">
                <div class="teaser-event-spec-label">OFFICIAL VENUE</div>
                <div class="teaser-event-spec-val" style="font-size: 0.95rem;">ROYALE CHULAN DAMANSARA</div>
                <div class="teaser-event-spec-sub">Grand Ballroom, Petaling Jaya</div>
              </div>
              <div class="teaser-event-spec-item">
                <div class="teaser-event-spec-label">DRESS CODE</div>
                <div class="teaser-event-spec-val">BLACK TIE / FORMAL</div>
                <div class="teaser-event-spec-sub">Evening Gown / Tuxedo</div>
              </div>
            </div>

            <div class="teaser-actions reveal-standard">
              <a href="<?= $basePath ?>/event-details" class="btn btn-lime">
                <span>VIEW EVENT DETAILS</span>
                <span class="btn-arrow" aria-hidden="true">→</span>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>

<?php
require_once __DIR__ . '/includes/footer.php';
require_once __DIR__ . '/includes/nomination-modal.php';
?>
