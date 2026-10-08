<?php
$activePage = 'about';
$pageTitle = 'About INTECARE 2026 — One Ecosystem. One Vision. A Healthier Future.';
$pageDescription = 'Discover the purpose, vision, mission and strategic alliance behind the INTECARE Excellence Award 2026, uniting healthcare, wellness, education, enterprise and industry.';
require_once __DIR__ . '/includes/nav.php';
?>

  <main>
    <!-- ==========================================================================
         HERO: EDITORIAL MANIFESTO SPREAD (Full-Screen 100svh Ivory Editorial Cover)
         Asymmetrical layout: Manifesto headline + Sharp full-bleed photography
         ========================================================================== -->
    <section class="page-editorial-hero hero-about-spread" aria-label="About INTECARE 2026 Overview">
      <div class="hero-about-container">
        
        <!-- Left: Editorial Manifesto -->
        <div class="hero-about-narrative">
          <div class="hero-about-eyebrow">
            <span class="pulse-dot" aria-hidden="true"></span>
            <span>ABOUT INTECARE 2026</span>
          </div>

          <h1 class="hero-about-title">
            ONE ECOSYSTEM.<br>
            ONE VISION.<br>
            <span class="text-gradient-teal-gold">A HEALTHIER FUTURE.</span>
          </h1>

          <p class="hero-about-tagline">
            A platform connecting healthcare, wellness, innovation and economic growth.
          </p>

          <p class="hero-about-lead">
            Intecare Excellence Award 2026 unifies clinical excellence, academic achievement, health enterprise, and investment into one cohesive national platform advancing human wellbeing across all stages of life.
          </p>


        </div>

        <!-- Right: Full-Bleed Sharp Editorial Photography -->
        <div class="hero-about-visual" aria-hidden="true">
          <div class="hero-about-img-frame">
            <picture>
              <source srcset="<?= $basePath ?>/assets/images/hero-editorial-luxury.webp" type="image/webp">
              <img src="<?= $basePath ?>/assets/images/hero-editorial-luxury.jpg"
                alt="INTECARE Editorial Healthcare and Leadership Overview"
                class="hero-about-img"
                width="840"
                height="920"
                fetchpriority="high"
                loading="eager">
            </picture>
            <div class="hero-about-img-overlay"></div>
            <div class="hero-about-img-caption">
              <span class="caption-num">2026</span>
              <span class="caption-text">NATIONAL EXCELLENCE PLATFORM</span>
            </div>
          </div>
        </div>

      </div>

      <!-- Minimal Subtle Scroll Indicator -->
      <div class="hero-scroll-prompt text-dark-prompt" aria-hidden="true">
        <span>SCROLL</span>
        <span class="prompt-arrow">↓</span>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 1: PURPOSE, VISION & MANDATE
         Preserved 3-card panel design enhanced with subtle photographic backgrounds
         ========================================================================== -->
    <section class="page-editorial-section bg-light-warm" id="purpose-vision">
      <div class="section-editorial-wrap">
        <h2 class="section-head-title reveal-heading">
          BUILDING ONE HEALTHCARE &amp; <span class="text-lime-glow">WELLNESS ECOSYSTEM</span>
        </h2>
        <p class="section-head-lead reveal-standard">
          Rather than a collection of fragmented, separate industries, the future of national health and prosperity requires an interconnected continuum uniting clinical science, enterprise, and sustainable investment.
        </p>

        <div class="purpose-cards-grid reveal-card-group">
          
          <!-- Card 1: Purpose / Connected Economy (Teal Tint) -->
          <div class="purpose-photo-card card-tint-teal">
            <picture>
              <source srcset="<?= $basePath ?>/assets/images/hero/hero-healthcare-innovation.webp" type="image/webp">
              <img src="<?= $basePath ?>/assets/images/medical-innovation.jpg"
                alt="Healthcare collaboration and clinical research innovation"
                class="card-photo-bg"
                width="400"
                height="394"
                loading="lazy">
            </picture>
            <div class="card-photo-overlay" aria-hidden="true"></div>
            
            <div class="card-inner-content">
              <div class="direction-card-header">
                <div class="direction-num">01</div>
                <span class="direction-badge">PURPOSE</span>
              </div>
              <h3 class="direction-heading">CONNECTED ECONOMY</h3>
              <p class="direction-statement">
                Established to build a connected healthcare and wellness economy, not separate silos.
              </p>
              <p class="direction-detail">
                Brings together people, knowledge, technology, enterprise, and investment to unlock cross-sector collaboration across Malaysia and beyond.
              </p>
            </div>
          </div>

          <!-- Card 2: Vision / Lifelong Vitality (Lime Tint) -->
          <div class="purpose-photo-card card-tint-lime">
            <picture>
              <source srcset="<?= $basePath ?>/assets/images/hero/hero-wellness.webp" type="image/webp">
              <img src="<?= $basePath ?>/assets/images/hero/hero-wellness.jpg"
                alt="Human vitality, wellness, preventive health and healthy living"
                class="card-photo-bg"
                width="480"
                height="248"
                loading="lazy">
            </picture>
            <div class="card-photo-overlay" aria-hidden="true"></div>

            <div class="card-inner-content">
              <div class="direction-card-header">
                <div class="direction-num">02</div>
                <span class="direction-badge">VISION</span>
              </div>
              <h3 class="direction-heading">LIFELONG VITALITY</h3>
              <p class="direction-statement">
                A globally connected healthcare and wellness economy enabling all people to thrive.
              </p>
              <p class="direction-detail">
                Empowering individuals and communities to Stay Well, Get Well, Recover Well, and Age Well through evidence-informed care and sustainable growth.
              </p>
            </div>
          </div>

          <!-- Card 3: Mandate / Integrated Impact (Cyan Tint) -->
          <div class="purpose-photo-card card-tint-cyan">
            <picture>
              <source srcset="<?= $basePath ?>/assets/images/hero/hero-architecture.webp" type="image/webp">
              <img src="<?= $basePath ?>/assets/images/hero/hero-architecture.jpg"
                alt="Modern sustainable healthcare facility and advanced technology"
                class="card-photo-bg"
                width="392"
                height="332"
                loading="lazy">
            </picture>
            <div class="card-photo-overlay" aria-hidden="true"></div>

            <div class="card-inner-content">
              <div class="direction-card-header">
                <div class="direction-num">03</div>
                <span class="direction-badge">MANDATE</span>
              </div>
              <h3 class="direction-heading">INTEGRATED IMPACT</h3>
              <p class="direction-statement">
                Connecting human health needs with meaningful economic and societal opportunity.
              </p>
              <p class="direction-detail">
                Unifies clinical integrity, advanced diagnostics, health-tech innovation, and enterprise commercialisation to deliver measurable patient outcomes.
              </p>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 2: STRATEGIC ALLIANCE — CO-ORGANISERS FOR NATIONAL IMPACT
         Simplified, elegant 2-column editorial presentation for HWED and MIHA
         ========================================================================== -->
    <section class="page-editorial-section bg-deep-teal" id="strategic-alliance">
      <div class="section-editorial-wrap">
        <h2 class="section-head-title reveal-heading">
          CO-ORGANISERS FOR <span class="text-lime-glow">NATIONAL IMPACT</span>
        </h2>
        <p class="section-head-lead reveal-standard">
          An alliance between <strong>HWED</strong> and <strong>MIHA</strong>, bridging clinical integrity, enterprise innovation, and sustainable healthcare transformation.
        </p>

        <div class="alliance-twocol-grid reveal-card-group">

          <!-- HWED Profile -->
          <div class="alliance-profile-card">
            <div class="alliance-card-header">
              <img src="<?= $basePath ?>/assets/images/logo-hwed.png"
                alt="Healthcare &amp; Wellness Economy Development (HWED)"
                class="alliance-org-logo"
                width="160"
                height="48"
                loading="lazy">
              <span class="alliance-org-tag">ECOSYSTEM ENABLER</span>
            </div>

            <h3 class="alliance-org-title">Healthcare &amp; Wellness Economy Development</h3>
            <div class="alliance-org-motto">One Ecosystem. Brighter Tomorrows.</div>
            <p class="alliance-org-desc">
              Connects science, clinical practice, technology, enterprise, investment, and industry into an integrated national growth engine.
            </p>

            <ul class="alliance-points-list">
              <li class="alliance-point-item">
                <span class="alliance-point-bullet" aria-hidden="true">✦</span>
                <div class="alliance-point-text">
                  <strong>Ecosystem Catalyst:</strong> Fosters cross-sector growth and investment readiness for health enterprises.
                </div>
              </li>
              <li class="alliance-point-item">
                <span class="alliance-point-bullet" aria-hidden="true">✦</span>
                <div class="alliance-point-text">
                  <strong>Full-Lifecycle Focus:</strong> Creates value from preventive wellness through active ageing and longevity.
                </div>
              </li>
              <li class="alliance-point-item">
                <span class="alliance-point-bullet" aria-hidden="true">✦</span>
                <div class="alliance-point-text">
                  <strong>Commercialisation:</strong> Bridges scientific breakthroughs with enterprise scale and commercial impact.
                </div>
              </li>
            </ul>
          </div>

          <!-- MIHA Profile -->
          <div class="alliance-profile-card">
            <div class="alliance-card-header">
              <img src="<?= $basePath ?>/assets/images/logo-miha.png"
                alt="Malaysian Integrative Health Association (MIHA)"
                class="alliance-org-logo"
                width="160"
                height="48"
                loading="lazy">
              <span class="alliance-org-tag">NATIONAL AUTHORITY</span>
            </div>

            <h3 class="alliance-org-title">Malaysian Integrative Health Association</h3>
            <div class="alliance-org-motto">Uniting Integrative Health in Malaysia</div>
            <p class="alliance-org-desc">
              The leading national platform uniting healthcare practitioners to advance evidence-based, multidisciplinary integrative care.
            </p>

            <ul class="alliance-points-list">
              <li class="alliance-point-item">
                <span class="alliance-point-bullet" aria-hidden="true">✦</span>
                <div class="alliance-point-text">
                  <strong>Clinical Leadership:</strong> Sets benchmarks for evidence-based integrative therapies and practitioner training.
                </div>
              </li>
              <li class="alliance-point-item">
                <span class="alliance-point-bullet" aria-hidden="true">✦</span>
                <div class="alliance-point-text">
                  <strong>Multidisciplinary Bridge:</strong> Connects conventional medical doctors, wellness experts, and allied practitioners.
                </div>
              </li>
              <li class="alliance-point-item">
                <span class="alliance-point-bullet" aria-hidden="true">✦</span>
                <div class="alliance-point-text">
                  <strong>Patient-Centricity:</strong> Prioritises holistic, ethical, and clinically verified whole-person health outcomes.
                </div>
              </li>
            </ul>
          </div>

        </div>

        <div class="alliance-footer-link reveal-standard">
          <a href="<?= $basePath ?>/organisers" class="link-arrow-lime">
            <span>Learn more about our Organisers &amp; Strategic Partners</span>
            <span class="arrow-char" aria-hidden="true">→</span>
          </a>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 3: STRATEGIC CONTINUUM — HEALTH THROUGH EVERY STAGE OF LIFE
         Preserved 4-stage lifecycle structure with polished responsive spacing
         ========================================================================== -->
    <section class="page-editorial-section bg-white-section" id="continuum">
      <div class="section-editorial-wrap">
        <h2 class="section-head-title reveal-heading">
          HEALTH THROUGH EVERY <span class="text-lime-glow">STAGE OF LIFE</span>
        </h2>
        <p class="section-head-lead reveal-standard">
          Connecting the human lifecycle with sustainable economic opportunity: Stay Well, Get Well, Recover Well, and Age Well.
        </p>

        <div class="lifecycle-stages-track reveal-card-group">
          <!-- Stage 1 -->
          <div class="stage-step-card" data-stage="01">
            <div class="step-card-top">
              <div class="step-circle-badge">01</div>
              <span class="step-badge-tag">STAGE 01</span>
            </div>
            <h4 class="step-title">STAY WELL</h4>
            <span class="step-subtitle">Wellness &amp; Prevention</span>
            <div class="step-tags">Prevent • Optimise • Wellbeing</div>
            <p class="step-desc">
              Proactive wellness, lifestyle medicine, and health promotion empowering individuals before illness occurs.
            </p>
          </div>

          <!-- Stage 2 -->
          <div class="stage-step-card" data-stage="02">
            <div class="step-card-top">
              <div class="step-circle-badge">02</div>
              <span class="step-badge-tag">STAGE 02</span>
            </div>
            <h4 class="step-title">GET WELL</h4>
            <span class="step-subtitle">Healthcare &amp; Care</span>
            <div class="step-tags">Access • Diagnose • Treat</div>
            <p class="step-desc">
              Accessible, patient-centred clinical care integrating modern diagnostics and evidence-informed therapies.
            </p>
          </div>

          <!-- Stage 3 -->
          <div class="stage-step-card" data-stage="03">
            <div class="step-card-top">
              <div class="step-circle-badge">03</div>
              <span class="step-badge-tag">STAGE 03</span>
            </div>
            <h4 class="step-title">RECOVER WELL</h4>
            <span class="step-subtitle">Recovery &amp; Rehabilitation</span>
            <div class="step-tags">Restore • Recover • Independence</div>
            <p class="step-desc">
              Multidisciplinary rehabilitation and restorative support focused on regaining functional independence.
            </p>
          </div>

          <!-- Stage 4 -->
          <div class="stage-step-card" data-stage="04">
            <div class="step-card-top">
              <div class="step-circle-badge">04</div>
              <span class="step-badge-tag">STAGE 04</span>
            </div>
            <h4 class="step-title">AGE WELL</h4>
            <span class="step-subtitle">Healthy Ageing &amp; Longevity</span>
            <div class="step-tags">Live Long • Age Healthier</div>
            <p class="step-desc">
              Active ageing strategies and age-friendly healthcare that preserve dignity and vitality for seniors.
            </p>
          </div>
        </div>

        <!-- Ecosystem Ribbon -->
        <div class="about-eco-banner reveal-standard" style="margin-top: 2.25rem;">
          <span class="eco-banner-label">HWED ECOSYSTEM PILLARS:</span>
          <div class="eco-banner-pills">
            <span class="eco-tag">KNOWLEDGE</span>
            <span class="eco-tag">TECHNOLOGY</span>
            <span class="eco-tag">ENTERPRISE</span>
            <span class="eco-tag">INVESTMENT</span>
            <span class="eco-tag">INDUSTRY</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 4: OFFICIAL MANDATE — 10 STRATEGIC OBJECTIVES
         Interactive editorial experience: 2-column showcase on desktop, accordion on mobile
         ========================================================================== -->
    <section class="page-editorial-section bg-pale-teal" id="objectives">
      <div class="section-editorial-wrap">
        <h2 class="section-head-title reveal-heading">
          10 STRATEGIC OBJECTIVES: <span class="text-lime-glow">FROM EXCELLENCE TO IMPACT</span>
        </h2>
        <p class="section-head-lead reveal-standard">
          Verified objectives guiding the assessment and recognition of leadership across the healthcare and wellness economy.
        </p>

        <div class="objectives-interactive-layout reveal-standard">
          
          <!-- Left Column: Interactive Numbered List (Accessible Tabs) -->
          <div class="objectives-nav-list" role="tablist" aria-label="10 Strategic Objectives">

            <!-- Objective 01 -->
            <div class="objective-nav-item-wrap open">
              <button type="button" class="objective-nav-btn active" role="tab" aria-selected="true" aria-controls="activeObjectiveDisplay"
                data-num="01"
                data-title="Recognise Integrative Excellence"
                data-desc="Honour individuals contributing to the advancement of integrative healthcare and clinical standards.">
                <div class="objective-btn-lead">
                  <span class="objective-btn-num">01</span>
                  <span class="objective-btn-title">Recognise Integrative Excellence</span>
                </div>
                <span class="objective-btn-arrow" aria-hidden="true">→</span>
              </button>
              <div class="objective-mobile-panel">
                Honour individuals contributing to the advancement of integrative healthcare and clinical standards.
              </div>
            </div>

            <!-- Objective 02 -->
            <div class="objective-nav-item-wrap">
              <button type="button" class="objective-nav-btn" role="tab" aria-selected="false" aria-controls="activeObjectiveDisplay"
                data-num="02"
                data-title="Celebrate Professional Practice"
                data-desc="Celebrate clinicians and researchers who elevate evidence-based care, training, and healthcare delivery.">
                <div class="objective-btn-lead">
                  <span class="objective-btn-num">02</span>
                  <span class="objective-btn-title">Celebrate Professional Practice</span>
                </div>
                <span class="objective-btn-arrow" aria-hidden="true">→</span>
              </button>
              <div class="objective-mobile-panel">
                Celebrate clinicians and researchers who elevate evidence-based care, training, and healthcare delivery.
              </div>
            </div>

            <!-- Objective 03 -->
            <div class="objective-nav-item-wrap">
              <button type="button" class="objective-nav-btn" role="tab" aria-selected="false" aria-controls="activeObjectiveDisplay"
                data-num="03"
                data-title="Promote Preventive Health"
                data-desc="Highlight initiatives supporting prevention, lifestyle medicine, and proactive population wellbeing.">
                <div class="objective-btn-lead">
                  <span class="objective-btn-num">03</span>
                  <span class="objective-btn-title">Promote Preventive Health</span>
                </div>
                <span class="objective-btn-arrow" aria-hidden="true">→</span>
              </button>
              <div class="objective-mobile-panel">
                Highlight initiatives supporting prevention, lifestyle medicine, and proactive population wellbeing.
              </div>
            </div>

            <!-- Objective 04 -->
            <div class="objective-nav-item-wrap">
              <button type="button" class="objective-nav-btn" role="tab" aria-selected="false" aria-controls="activeObjectiveDisplay"
                data-num="04"
                data-title="Support Healthcare Innovation"
                data-desc="Spotlight innovation in digital health, MedTech, biotechnology, and integrated medical solutions.">
                <div class="objective-btn-lead">
                  <span class="objective-btn-num">04</span>
                  <span class="objective-btn-title">Support Healthcare Innovation</span>
                </div>
                <span class="objective-btn-arrow" aria-hidden="true">→</span>
              </button>
              <div class="objective-mobile-panel">
                Spotlight innovation in digital health, MedTech, biotechnology, and integrated medical solutions.
              </div>
            </div>

            <!-- Objective 05 -->
            <div class="objective-nav-item-wrap">
              <button type="button" class="objective-nav-btn" role="tab" aria-selected="false" aria-controls="activeObjectiveDisplay"
                data-num="05"
                data-title="Recognise Community Impact"
                data-desc="Celebrate grassroots and organizational initiatives creating tangible public health benefits.">
                <div class="objective-btn-lead">
                  <span class="objective-btn-num">05</span>
                  <span class="objective-btn-title">Recognise Community Impact</span>
                </div>
                <span class="objective-btn-arrow" aria-hidden="true">→</span>
              </button>
              <div class="objective-mobile-panel">
                Celebrate grassroots and organizational initiatives creating tangible public health benefits.
              </div>
            </div>

            <!-- Objective 06 -->
            <div class="objective-nav-item-wrap">
              <button type="button" class="objective-nav-btn" role="tab" aria-selected="false" aria-controls="activeObjectiveDisplay"
                data-num="06"
                data-title="Advance Healthcare Education"
                data-desc="Acknowledge academic institutions and training bodies cultivating the next-generation care workforce.">
                <div class="objective-btn-lead">
                  <span class="objective-btn-num">06</span>
                  <span class="objective-btn-title">Advance Healthcare Education</span>
                </div>
                <span class="objective-btn-arrow" aria-hidden="true">→</span>
              </button>
              <div class="objective-mobile-panel">
                Acknowledge academic institutions and training bodies cultivating the next-generation care workforce.
              </div>
            </div>

            <!-- Objective 07 -->
            <div class="objective-nav-item-wrap">
              <button type="button" class="objective-nav-btn" role="tab" aria-selected="false" aria-controls="activeObjectiveDisplay"
                data-num="07"
                data-title="Promote Healthy Ageing"
                data-desc="Recognize solutions sustaining mental wellbeing, active longevity, and senior quality of life.">
                <div class="objective-btn-lead">
                  <span class="objective-btn-num">07</span>
                  <span class="objective-btn-title">Promote Healthy Ageing</span>
                </div>
                <span class="objective-btn-arrow" aria-hidden="true">→</span>
              </button>
              <div class="objective-mobile-panel">
                Recognize solutions sustaining mental wellbeing, active longevity, and senior quality of life.
              </div>
            </div>

            <!-- Objective 08 -->
            <div class="objective-nav-item-wrap">
              <button type="button" class="objective-nav-btn" role="tab" aria-selected="false" aria-controls="activeObjectiveDisplay"
                data-num="08"
                data-title="Sustainable Healthcare"
                data-desc="Honor organizations integrating ESG, environmental sustainability, and ethical care operations.">
                <div class="objective-btn-lead">
                  <span class="objective-btn-num">08</span>
                  <span class="objective-btn-title">Sustainable Healthcare</span>
                </div>
                <span class="objective-btn-arrow" aria-hidden="true">→</span>
              </button>
              <div class="objective-mobile-panel">
                Honor organizations integrating ESG, environmental sustainability, and ethical care operations.
              </div>
            </div>

            <!-- Objective 09 -->
            <div class="objective-nav-item-wrap">
              <button type="button" class="objective-nav-btn" role="tab" aria-selected="false" aria-controls="activeObjectiveDisplay"
                data-num="09"
                data-title="Healthcare Enterprise &amp; SMEs"
                data-desc="Reward healthcare and wellness businesses driving economic vitality, employment, and market expansion.">
                <div class="objective-btn-lead">
                  <span class="objective-btn-num">09</span>
                  <span class="objective-btn-title">Healthcare Enterprise &amp; SMEs</span>
                </div>
                <span class="objective-btn-arrow" aria-hidden="true">→</span>
              </button>
              <div class="objective-mobile-panel">
                Reward healthcare and wellness businesses driving economic vitality, employment, and market expansion.
              </div>
            </div>

            <!-- Objective 10 -->
            <div class="objective-nav-item-wrap">
              <button type="button" class="objective-nav-btn" role="tab" aria-selected="false" aria-controls="activeObjectiveDisplay"
                data-num="10"
                data-title="Celebrate Ecosystem Leadership"
                data-desc="Recognize visionary leaders architecting sustainable partnerships across the health economy.">
                <div class="objective-btn-lead">
                  <span class="objective-btn-num">10</span>
                  <span class="objective-btn-title">Celebrate Ecosystem Leadership</span>
                </div>
                <span class="objective-btn-arrow" aria-hidden="true">→</span>
              </button>
              <div class="objective-mobile-panel">
                Recognize visionary leaders architecting sustainable partnerships across the health economy.
              </div>
            </div>

          </div>

          <!-- Right Column: Active Objective Detail Showcase (Desktop) -->
          <div class="objectives-detail-display" id="activeObjectiveDisplay" role="tabpanel" aria-live="polite">
            <div class="objective-watermark" id="activeObjectiveWatermark" aria-hidden="true">01</div>
            <span class="objective-detail-badge" id="activeObjectiveBadge">OBJECTIVE 01 OF 10 • STRATEGIC MANDATE</span>
            
            <h3 class="objective-detail-title" id="activeObjectiveTitle">
              Recognise Integrative Excellence
            </h3>

            <p class="objective-detail-desc" id="activeObjectiveDesc">
              Honour individuals contributing to the advancement of integrative healthcare and clinical standards.
            </p>

            <div class="objective-impact-pill">
              <span aria-hidden="true">✦</span>
              <span>VERIFIED MANDATE • ECOSYSTEM BENCHMARK</span>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 5: ACADEMIC CONVOCATION
         Completely redesigned as a premium, asymmetrical editorial event highlight
         ========================================================================== -->
    <section class="page-editorial-section bg-deep-teal" id="convocation">
      <div class="section-editorial-wrap">
        <div class="convocation-editorial-banner">
          
          <!-- Left Visual Composition: Photography & Layered Badge -->
          <div class="convocation-photo-wrap reveal-left">
            <img src="<?= $basePath ?>/assets/images/awards-individual.jpg"
              alt="Healthcare graduates and distinguished practitioners celebrated at formal podium"
              width="600"
              height="450"
              loading="lazy">
            <div class="convocation-photo-overlay" aria-hidden="true"></div>
            
            <div class="convocation-floating-tag">
              <span class="live-dot" aria-hidden="true"></span>
              <span>45 GRADUATING PRACTITIONERS</span>
            </div>
          </div>

          <!-- Right Editorial Content -->
          <div class="convocation-content-wrap reveal-right">
            <h3 class="convocation-heading">
              CELEBRATING 45 OLYMPIA EDUCATION GRADUATES
            </h3>

            <p class="convocation-lead">
              In collaboration with Olympia Education Group, the gala evening incorporates the official Convocation Ceremony for 45 graduates completing specialised healthcare and wellness professional qualifications.
            </p>

            <div class="convocation-partner-box">
              <img src="<?= $basePath ?>/assets/images/logo-olympia.png"
                alt="Olympia Education Group"
                class="convocation-partner-logo"
                width="140"
                height="42"
                loading="lazy">
              <div class="convocation-partner-text">
                <span class="convocation-partner-label">OFFICIAL ACADEMIC PARTNER</span>
                <span class="convocation-partner-sub">Cultivating next-generation healthcare talent &amp; certified expertise</span>
              </div>
            </div>

            <div>
              <a href="<?= $basePath ?>/event-details" class="link-arrow-lime">
                <span>Explore Gala Programme &amp; Event Details</span>
                <span class="arrow-char" aria-hidden="true">→</span>
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
