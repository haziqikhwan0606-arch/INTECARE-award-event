<?php
$activePage = 'organisers';
$pageTitle = 'Organisers & Strategic Alliance — INTECARE 2026';
$pageDescription = 'Meet the official organisers and strategic partners behind INTECARE 2026: Healthcare & Wellness Economy Development (HWED), Malaysian Integrative Health Association (MIHA), and Olympia Education Group.';
require_once __DIR__ . '/includes/nav.php';
?>

  <main>
    <!-- ==========================================================================
         HERO: MATCHING ABOUT.PHP VISUAL SYSTEM & TEMPLATE EXACTLY
         Uses identical markup, classes, layout, typography, and responsive rules
         ========================================================================== -->
    <section class="page-editorial-hero" aria-label="Official Organisers &amp; Strategic Alliance">
      <div class="page-hero-container">
        <div class="about-hero-grid">
          
          <!-- Left: Editorial Headline & Narrative -->
          <div class="about-hero-text">
            <h1 class="about-hero-title">
              THE STRATEGIC ALLIANCE:<br>
              <span class="text-lime-glow">HWED &amp; MIHA</span>
            </h1>

            <p class="about-hero-lead">
              Intecare Excellence Award 2026 is organised through the strategic collaboration of Healthcare &amp; Wellness Economy Development (HWED) and Malaysian Integrative Health Association (MIHA), uniting clinical integrity, enterprise growth, and academic achievement.
            </p>

            <div class="about-hero-actions" style="margin-top: 1.75rem;">
              <button type="button" class="btn btn-lime open-nomination-btn">
                <span>SUBMIT NOMINATION</span>
                <span class="btn-arrow" aria-hidden="true">→</span>
              </button>
            </div>
          </div>

          <!-- Right: Floating Visual Art Stage (Matching About exactly) -->
          <div class="about-hero-art-stage" aria-hidden="true">
            <div class="about-hero-ambient-glow"></div>
            
            <!-- Layer 1: Futuristic Medical Technology 3D Sculpture -->
            <img src="<?= $basePath ?>/assets/images/org1.jpg"
              alt="Medical Innovation 3D element"
              class="about-hero-float-primary"
              width="360"
              height="412"
              loading="eager">

            <!-- Layer 2: Editorial Supporting Visual Callout Badge -->
            <img src="<?= $basePath ?>/assets/images/org2.jpg"
              alt="Ecosystem Innovation Badge"
              class="about-hero-float-secondary"
              width="180"
              height="180"
              loading="eager">
          </div>

        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 1: THE TWO PILLARS OF THE ALLIANCE (HWED & MIHA)
         Interactive 2-partner showcase presenting both co-organising entities equally.
         ========================================================================== -->
    <section class="page-editorial-section bg-midnight" id="alliance" aria-label="Co-Organising Entities">
      <div class="section-editorial-wrap">
        <h2 class="section-head-title">
          TWO INSTITUTIONS. <span class="text-lime-glow">ONE UNIFIED MISSION.</span>
        </h2>
        <p class="section-head-lead">
          A powerful partnership uniting cross-sector economic development with clinical medical excellence.
        </p>

        <div class="organisers-alliance-grid">

          <!-- Card 1: HWED -->
          <article class="partner-showcase-card card-hwed" id="cardHwed" tabindex="0" aria-label="Healthcare &amp; Wellness Economy Development Details">
            <div class="partner-card-header">
              <div class="partner-logo-wrap">
                <img src="<?= $basePath ?>/assets/images/logo-hwed.png" alt="Healthcare &amp; Wellness Economy Development Logo" loading="lazy">
              </div>
              <span class="partner-tag-pill">ECOSYSTEM ENABLER</span>
            </div>

            <h3 class="partner-name-title">
              Healthcare &amp; Wellness Economy Development
            </h3>
            <div class="partner-tagline">
              One Ecosystem. Brighter Tomorrows.
            </div>

            <p class="partner-overview-text">
              HWED is established to build a connected healthcare and wellness economy, not a collection of separate industries. Its ecosystem brings together people, knowledge, technology, enterprise, and investment, creating opportunities for collaboration and development across the healthcare and wellness landscape.
            </p>

            <!-- Expandable Detailed Dossier Section -->
            <div class="partner-detailed-drawer" id="hwedDrawer">
              <div class="partner-vision-box">
                <div class="vision-box-label">OUR VISION</div>
                <div class="vision-box-text">
                  A globally connected healthcare &amp; wellness economy enabling people to stay well, get well, recover well and age well.
                </div>
              </div>

              <div class="partner-domains-list" aria-label="HWED Key Domains">
                <span class="domain-tag">Science</span>
                <span class="domain-tag">Professional Practice</span>
                <span class="domain-tag">Technology</span>
                <span class="domain-tag">Enterprise</span>
                <span class="domain-tag">Investment</span>
                <span class="domain-tag">Industry</span>
              </div>

              <div class="partner-focus-footnote">
                Platform Focus: Cross-sector integration &amp; enterprise scaling.
              </div>
            </div>

            <button type="button" class="partner-toggle-btn" data-target="hwedDrawer" aria-expanded="true" aria-controls="hwedDrawer">
              <span class="btn-text">Hide Detailed Profile</span>
              <span class="btn-icon">▲</span>
            </button>
          </article>

          <!-- Card 2: MIHA -->
          <article class="partner-showcase-card card-miha" id="cardMiha" tabindex="0" aria-label="Malaysian Integrative Health Association Details">
            <div class="partner-card-header">
              <div class="partner-logo-wrap">
                <img src="<?= $basePath ?>/assets/images/logo-miha.png" alt="Malaysian Integrative Health Association Logo" loading="lazy">
              </div>
              <span class="partner-tag-pill" style="border-color: rgba(119, 217, 200, 0.4); color: #77D9C8;">NATIONAL AUTHORITY</span>
            </div>

            <h3 class="partner-name-title">
              Malaysian Integrative Health Association
            </h3>
            <div class="partner-tagline">
              Uniting Integrative Health in Malaysia
            </div>

            <p class="partner-overview-text">
              MIHA is a national platform uniting healthcare professionals across disciplines to advance integrative health, holistic care, evidence-based practice, and innovation in Malaysia through interdisciplinary collaboration, research, training, education, and professional development.
            </p>

            <!-- Expandable Detailed Dossier Section -->
            <div class="partner-detailed-drawer" id="mihaDrawer">
              <div class="partner-vision-box">
                <div class="vision-box-label">OUR MISSION</div>
                <div class="vision-box-text">
                  To unify healthcare practitioners and promote holistic, evidence-based care through interdisciplinary collaboration, research, training, and education.
                </div>
              </div>

              <div class="partner-domains-list" aria-label="MIHA Key Domains">
                <span class="domain-tag">Professional Excellence</span>
                <span class="domain-tag">Evidence-Based Care</span>
                <span class="domain-tag">Collaboration</span>
                <span class="domain-tag">Education</span>
                <span class="domain-tag">Research</span>
                <span class="domain-tag">Innovation</span>
              </div>

              <div class="partner-focus-footnote">
                Clinical Focus: Holistic medical excellence &amp; professional integrity.
              </div>
            </div>

            <button type="button" class="partner-toggle-btn" data-target="mihaDrawer" aria-expanded="true" aria-controls="mihaDrawer">
              <span class="btn-text">Hide Detailed Profile</span>
              <span class="btn-icon">▲</span>
            </button>
          </article>

        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 2: ACADEMIC PARTNER — OLYMPIA EDUCATION GROUP
         Contrasting light warm / pale mint background with milestone stat card.
         ========================================================================== -->
    <section class="olympia-academic-section" id="academic-partner" aria-label="Academic Partner">
      <div class="olympia-academic-wrap">
        <div class="olympia-feature-grid">
          <!-- Left: Logo & Milestone Callout Box -->
          <div class="olympia-card-box">
            <div class="olympia-logo-stage">
              <img src="<?= $basePath ?>/assets/images/logo-olympia.png" alt="Olympia Education Group Logo" loading="lazy">
            </div>
            <span class="page-hero-pill" style="border-color: #0E6C80; color: #0E6C80; font-weight: 800;">OFFICIAL ACADEMIC PARTNER</span>

            <!-- Milestone Card Callout -->
            <div class="olympia-convocation-badge" role="region" aria-label="Convocation Milestone">
              <div class="convocation-stat-num">45</div>
              <div class="convocation-stat-details">
                <strong>Graduating Professionals</strong>
                <span>Certified in Integrative Healthcare &amp; Wellness Disciplines</span>
              </div>
            </div>
          </div>

          <!-- Right: Editorial Narrative -->
          <div>
            <div style="font-family: var(--font-heading); font-size: 0.85rem; font-weight: 800; color: #0E6C80; letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 0.5rem;">
              WORKFORCE DEVELOPMENT &amp; ACADEMIC EXCELLENCE
            </div>
            <h3 style="font-family: var(--font-heading); font-size: clamp(2rem, 3.2vw, 2.8rem); font-weight: 800; color: #06232B; text-transform: uppercase; letter-spacing: -0.02em; line-height: 1.1; margin-bottom: 1.25rem;">
              OLYMPIA EDUCATION GROUP CONVOCATION
            </h3>
            <p style="font-size: 1.02rem; color: #365761; line-height: 1.7; margin-bottom: 1.25rem;">
              As the official Academic Partner of INTECARE 2026, Olympia Education Group will host its official Convocation Ceremony alongside the Gala Dinner, honouring <strong>45 graduating professionals</strong> who have completed certified professional qualifications in integrative healthcare and wellness disciplines.
            </p>
            <p style="font-size: 0.95rem; color: #537580; line-height: 1.65; margin: 0;">
              This milestone reinforces the HWED mission of nurturing qualified, future-ready healthcare practitioners committed to patient-centred care, ethical practice, and lifelong learning.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 3: GOVERNANCE & EVALUATION INTEGRITY
         Interactive 3-stage governance explorer with numbered progression and panel.
         ========================================================================== -->
    <section class="governance-section" id="governance" aria-label="Governance &amp; Selection Integrity">
      <div class="governance-wrap">
        <h2 class="section-head-title">
          RIGOROUS, TRANSPARENT <span class="text-lime-glow">GOVERNANCE</span>
        </h2>
        <p class="section-head-lead">
          The INTECARE Excellence Award evaluation process is managed through a multi-tiered oversight framework ensuring strict credibility, ethical standards, and independent assessment.
        </p>

        <!-- Connected Numbered Steps / Selectable Tabs -->
        <div class="governance-stepper" role="tablist" aria-label="Governance Evaluation Stages">
          
          <!-- Stage 1 -->
          <button type="button" class="governance-step-btn active" data-gov-stage="1" role="tab" aria-selected="true" aria-controls="govDetailCard">
            <span class="step-num">01</span>
            <div class="step-meta">
              <span class="step-eyebrow">STAGE 01</span>
              <strong class="step-title">Independent Panel</strong>
            </div>
          </button>

          <!-- Stage 2 -->
          <button type="button" class="governance-step-btn" data-gov-stage="2" role="tab" aria-selected="false" aria-controls="govDetailCard">
            <span class="step-num">02</span>
            <div class="step-meta">
              <span class="step-eyebrow">STAGE 02</span>
              <strong class="step-title">Evidence Auditing</strong>
            </div>
          </button>

          <!-- Stage 3 -->
          <button type="button" class="governance-step-btn" data-gov-stage="3" role="tab" aria-selected="false" aria-controls="govDetailCard">
            <span class="step-num">03</span>
            <div class="step-meta">
              <span class="step-eyebrow">STAGE 03</span>
              <strong class="step-title">No Commercial Bias</strong>
            </div>
          </button>

        </div>

        <!-- Dedicated Content Panel -->
        <div class="governance-detail-card" id="govDetailCard" role="tabpanel" aria-live="polite">
          <div class="gov-detail-watermark" id="govWatermark" aria-hidden="true">01</div>
          <span class="gov-detail-badge" id="govBadge">RIGOROUS OVERSIGHT • STAGE 01</span>
          <h3 class="gov-detail-title" id="govTitle">01. INDEPENDENT PANEL</h3>
          <p class="gov-detail-desc" id="govDesc">
            Dossiers are scored independently by senior healthcare professionals, medical educators, and enterprise leaders without conflict of interest.
          </p>

          <div class="gov-detail-guarantee">
            <span class="guarantee-icon" aria-hidden="true">✦</span>
            <span>INTECARE Integrity Guarantee: Multi-tiered evaluation ensuring zero conflict of interest and genuine impact.</span>
          </div>
        </div>

      </div>
    </section>
  </main>

<?php
require_once __DIR__ . '/includes/footer.php';
require_once __DIR__ . '/includes/nomination-modal.php';
?>
