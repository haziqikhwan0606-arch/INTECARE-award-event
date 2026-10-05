<?php
$activePage = 'ecosystem';
$pageTitle = 'HWED Ecosystem — Healthcare & Wellness Economy Development';
$pageDescription = 'Discover the integrated HWED platform connecting science, technology, clinical practice, enterprise, and investment across the complete human health lifecycle.';
require_once __DIR__ . '/includes/nav.php';
?>

  <main>
    <!-- ==========================================================================
         HERO: EDITORIAL AWARDS GALA ECOSYSTEM PRESENTATION
         Grand Emerald & Gold Editorial Hero matching Gala Prestige standards
         Left: Stately National Accord Manifesto & 3-Pillar Folio
         Right: Framed Luxury Editorial Visual Showcase with Gilded Accord Plaque
         ========================================================================== -->
    <section class="page-editorial-hero hero-event-spread" aria-label="HWED National Ecosystem Accord">
      <div class="hero-event-container">
        
        <!-- Left: Stately National Accord Manifesto -->
        <div class="hero-event-poster-col">
          <div class="hero-event-title">
            <span class="title-sub" style="letter-spacing: 0.16em; color: #D4AF37;">THE SOVEREIGN ARCHITECTURE</span>
            <h1 class="title-main text-gold-glow" style="font-size: clamp(2.4rem, 4.2vw, 4.4rem); line-height: 1.05; margin-bottom: 1.5rem;">
              HEALTHCARE &amp; WELLNESS ECONOMY DEVELOPMENT
            </h1>
          </div>

          <p class="hero-event-lead" style="color: rgba(255, 255, 255, 0.88); font-size: clamp(1.02rem, 1.15vw, 1.18rem); line-height: 1.85; max-width: 640px; margin-bottom: 2rem;">
            Under the patronage of the INTECARE Excellence Framework, HWED establishes Malaysia's sovereign multi-sector platform unifying foundational research, institutional capital, transformative enterprise, and healthcare excellence across the complete human lifecycle.
          </p>

          <!-- 3 Stately Tier Dossier Bar -->
          <div class="gala-tier-dossier-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2.25rem;">
            <div class="gala-tier-dossier-card" style="padding: 1.1rem 1.2rem; border-radius: 12px; background: rgba(2, 32, 26, 0.75); border: 1px solid rgba(212, 175, 55, 0.35); box-shadow: 0 8px 24px rgba(0,0,0,0.35);">
              <span style="font-family: var(--font-heading); font-size: 0.72rem; font-weight: 800; letter-spacing: 0.14em; color: #D4AF37; display: block; margin-bottom: 0.35rem;">TIER I</span>
              <strong style="font-family: var(--font-heading); font-size: 0.88rem; font-weight: 700; color: #FFFFFF; display: block; margin-bottom: 0.25rem;">Capital &amp; Policy</strong>
              <span style="font-size: 0.74rem; color: rgba(255, 255, 255, 0.7); line-height: 1.4; display: block;">Foundational science, investment facilities &amp; PPP accords</span>
            </div>

            <div class="gala-tier-dossier-card" style="padding: 1.1rem 1.2rem; border-radius: 12px; background: rgba(2, 32, 26, 0.75); border: 1px solid rgba(212, 175, 55, 0.35); box-shadow: 0 8px 24px rgba(0,0,0,0.35);">
              <span style="font-family: var(--font-heading); font-size: 0.72rem; font-weight: 800; letter-spacing: 0.14em; color: #D4AF37; display: block; margin-bottom: 0.35rem;">TIER II</span>
              <strong style="font-family: var(--font-heading); font-size: 0.88rem; font-weight: 700; color: #FFFFFF; display: block; margin-bottom: 0.25rem;">Innovation Engine</strong>
              <span style="font-size: 0.74rem; color: rgba(255, 255, 255, 0.7); line-height: 1.4; display: block;">Clinical AI, MedTech translation &amp; enterprise scaling</span>
            </div>

            <div class="gala-tier-dossier-card" style="padding: 1.1rem 1.2rem; border-radius: 12px; background: rgba(2, 32, 26, 0.75); border: 1px solid rgba(212, 175, 55, 0.35); box-shadow: 0 8px 24px rgba(0,0,0,0.35);">
              <span style="font-family: var(--font-heading); font-size: 0.72rem; font-weight: 800; letter-spacing: 0.14em; color: #D4AF37; display: block; margin-bottom: 0.35rem;">TIER III</span>
              <strong style="font-family: var(--font-heading); font-size: 0.88rem; font-weight: 700; color: #FFFFFF; display: block; margin-bottom: 0.25rem;">Lifecycle Delivery</strong>
              <span style="font-size: 0.74rem; color: rgba(255, 255, 255, 0.7); line-height: 1.4; display: block;">Stay, Get, Recover &amp; Age Well frontline outcomes</span>
            </div>
          </div>

          <!-- Actions -->
          <div class="hero-event-action-row" style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
            <a href="<?= $basePath ?>/awards.php" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.6rem;">
              <span>VIEW 40 EXCELLENCE AWARDS</span>
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
          </div>
        </div>

        <!-- Right: Stately Framed Editorial Visual Showcase -->
        <div class="hero-event-visual-col">
          <div class="hero-event-img-composition" style="border: 1px solid rgba(212, 175, 55, 0.35); box-shadow: 0 25px 60px rgba(0,0,0,0.65), 0 0 40px rgba(212, 175, 55, 0.15);">
            <picture>
              <source srcset="<?= $basePath ?>/assets/images/medical-innovation.webp" type="image/webp">
              <img src="<?= $basePath ?>/assets/images/medical-innovation.jpg"
                alt="INTECARE HWED Sovereign Ecosystem"
                class="hero-event-main-img"
                width="720"
                height="540"
                loading="eager"
                style="object-fit: cover; filter: brightness(0.92) contrast(1.08);">
            </picture>
            <div class="hero-event-img-overlay" style="background: linear-gradient(180deg, rgba(2, 24, 19, 0.2) 0%, rgba(2, 24, 19, 0.85) 100%);"></div>

            <!-- Gilded Accord Plaque -->
            <div class="hero-event-location-plaque" style="background: rgba(2, 24, 19, 0.94); border: 1px solid rgba(212, 175, 55, 0.45); box-shadow: 0 15px 35px rgba(0,0,0,0.65);">
              <span class="plaque-pin" aria-hidden="true" style="color: #D4AF37; font-size: 1.1rem;">✦</span>
              <div>
                <strong style="font-family: var(--font-heading); font-size: 0.86rem; letter-spacing: 0.1em; color: #D4AF37; text-transform: uppercase;">THE NATIONAL ACCORD</strong>
                <span style="font-size: 0.74rem; color: #E2ECE8; display: block; margin-top: 0.15rem;">6 Connected Domains • 4 Lifecycle Pathways</span>
              </div>
            </div>
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
         SECTION 1: THE 6 CONNECTED DOMAINS — INTERACTIVE ECOSYSTEM ORBIT
         Desktop: Orbit diagram + contextual info panel.
         Mobile: Compact selectable pills + responsive card.
         ========================================================================== -->
    <section class="page-editorial-section bg-midnight" id="architecture" aria-label="Interactive Ecosystem Architecture">
      <div class="section-editorial-wrap">
        <h2 class="section-head-title reveal-heading">
          THE 6 CONNECTED DOMAINS: <span class="text-lime-glow">INTERACTIVE ORBIT</span>
        </h2>
        <p class="section-head-lead reveal-standard">
          HWED bridges traditional industry silos by coordinating six key domains around human health outcomes and economic growth. Select any domain or the central core to inspect its integrated role.
        </p>

        <!-- Mobile Domain Selector (Accessible pills displayed on small screens) -->
        <div class="hwed-mobile-domain-selector" aria-label="Mobile Domain Selector">
          <div class="hwed-mobile-pills" role="tablist">
            <button type="button" class="hwed-m-pill active" data-domain="core" role="tab" aria-selected="true">HWED Core</button>
            <button type="button" class="hwed-m-pill" data-domain="science" role="tab" aria-selected="false">01 Science</button>
            <button type="button" class="hwed-m-pill" data-domain="practice" role="tab" aria-selected="false">02 Clinical</button>
            <button type="button" class="hwed-m-pill" data-domain="technology" role="tab" aria-selected="false">03 Tech &amp; AI</button>
            <button type="button" class="hwed-m-pill" data-domain="enterprise" role="tab" aria-selected="false">04 Enterprise</button>
            <button type="button" class="hwed-m-pill" data-domain="investment" role="tab" aria-selected="false">05 Capital</button>
            <button type="button" class="hwed-m-pill" data-domain="industry" role="tab" aria-selected="false">06 Policy</button>
          </div>
        </div>

        <!-- Desktop & Tablet Orbit + Contextual Panel -->
        <div class="hwed-orbit-wrap reveal-standard">
          
          <!-- Orbit Diagram Col -->
          <div class="hwed-orbit-stage-col">
            <div class="hwed-orbit-stage" role="region" aria-label="Ecosystem Orbit Diagram">
              <!-- SVG Orbit Rings -->
              <svg class="hwed-orbit-svg" viewBox="0 0 500 500" aria-hidden="true">
                <circle cx="250" cy="250" r="215" stroke="rgba(119, 217, 200, 0.22)" stroke-width="1.5" stroke-dasharray="6 4" fill="none" />
                <circle cx="250" cy="250" r="150" stroke="rgba(198, 242, 77, 0.28)" stroke-width="1.5" fill="none" />
                <circle cx="250" cy="250" r="85" stroke="rgba(119, 217, 200, 0.15)" stroke-width="1" fill="none" />
                <!-- Subtle Radial Connecting Lines -->
                <line x1="250" y1="250" x2="250" y2="40" stroke="rgba(119, 217, 200, 0.15)" stroke-width="1" />
                <line x1="250" y1="250" x2="430" y2="145" stroke="rgba(119, 217, 200, 0.15)" stroke-width="1" />
                <line x1="250" y1="250" x2="430" y2="355" stroke="rgba(119, 217, 200, 0.15)" stroke-width="1" />
                <line x1="250" y1="250" x2="250" y2="460" stroke="rgba(119, 217, 200, 0.15)" stroke-width="1" />
                <line x1="250" y1="250" x2="70" y2="355" stroke="rgba(119, 217, 200, 0.15)" stroke-width="1" />
                <line x1="250" y1="250" x2="70" y2="145" stroke="rgba(119, 217, 200, 0.15)" stroke-width="1" />
              </svg>

              <!-- Central Core Hub Button -->
              <button type="button" class="hwed-center-hub active" id="orbitCenterHub" data-domain="core" aria-label="HWED Core Hub">
                <span class="hub-eyebrow">HWED CORE</span>
                <span class="hub-title">ONE ECOSYSTEM</span>
                <span class="hub-reset-hint">Click to Reset</span>
              </button>

              <!-- 6 Connected Domain Nodes -->
              <button type="button" class="hwed-orbit-node node-pos-1" data-domain="science" aria-label="Domain 01: Science &amp; Research">
                <span class="node-num">01</span>
                <span>Science &amp; Research</span>
              </button>

              <button type="button" class="hwed-orbit-node node-pos-2" data-domain="practice" aria-label="Domain 02: Clinical Practice">
                <span class="node-num">02</span>
                <span>Clinical Practice</span>
              </button>

              <button type="button" class="hwed-orbit-node node-pos-3" data-domain="technology" aria-label="Domain 03: Technology &amp; AI">
                <span class="node-num">03</span>
                <span>Technology &amp; AI</span>
              </button>

              <button type="button" class="hwed-orbit-node node-pos-4" data-domain="enterprise" aria-label="Domain 04: Enterprise &amp; SMEs">
                <span class="node-num">04</span>
                <span>Enterprise &amp; SMEs</span>
              </button>

              <button type="button" class="hwed-orbit-node node-pos-5" data-domain="investment" aria-label="Domain 05: Capital &amp; Investment">
                <span class="node-num">05</span>
                <span>Capital &amp; Investment</span>
              </button>

              <button type="button" class="hwed-orbit-node node-pos-6" data-domain="industry" aria-label="Domain 06: Industry &amp; Public Policy">
                <span class="node-num">06</span>
                <span>Industry &amp; Public Policy</span>
              </button>
            </div>
          </div>

          <!-- Contextual Information Panel -->
          <div class="hwed-orbit-info-card" id="orbitInfoCard" aria-live="polite">
            <span class="hwed-info-eyebrow" id="orbitDomainBadge">CENTRAL ARCHITECTURE • INTEGRATED CORE</span>
            <h3 class="hwed-info-title" id="orbitDomainTitle">ONE ECOSYSTEM</h3>
            <p class="hwed-info-desc" id="orbitDomainDesc">
              Healthcare &amp; Wellness Economy Development (HWED) serves as the unifying national platform connecting science, technology, clinical practice, enterprise, and investment into an integrated economic engine for the health lifecycle.
            </p>

            <div class="hwed-info-tags-label" id="orbitTagsLabel">Core Ecosystem Facets:</div>
            <div class="hwed-info-tags" id="orbitDomainTags">
              <span class="hwed-tag-pill">6 Connected Domains</span>
              <span class="hwed-tag-pill">5 Strategic Pillars</span>
              <span class="hwed-tag-pill">Lifelong Value Creation</span>
            </div>

            <button type="button" class="hwed-reset-hub-btn" id="orbitResetBtn">
              <span>↺</span>
              <span>Reset to Central Core</span>
            </button>
          </div>

        </div>

        <!-- Section 2 Visual Transition: CONNECTED DOMAINS → STRATEGIC ENABLERS -->
        <div class="hwed-domains-transition" aria-hidden="true">
          <div class="transition-badge">
            <span class="transition-pill highlight">CONNECTED DOMAINS</span>
            <span class="transition-arrow">→</span>
            <span class="transition-pill">STRATEGIC ENABLERS</span>
          </div>
        </div>

      </div>
    </section>

    <!-- ==========================================================================
         SECTION 2: THE 5 STRATEGIC PILLARS OF HWED ENABLERS
         5 distinct cards, each with its own dedicated photographic background,
         subtle overlay for optimal text contrast, and interactive hover states.
         ========================================================================== -->
    <section class="hwed-pillars-section" id="pillars" aria-label="5 Strategic Pillars">
      <div class="hwed-pillars-wrap">
        <h2 class="reveal-heading" style="font-family: var(--font-heading); font-size: clamp(2.2rem, 3.8vw, 3.4rem); font-weight: 800; color: #06232B; text-transform: uppercase; letter-spacing: -0.02em; line-height: 1.05; margin-bottom: 0.75rem;">
          THE 5 PILLARS OF <span style="color: #0E6C80;">HWED ENABLERS</span>
        </h2>
        <p class="reveal-standard" style="font-size: 1.02rem; color: #43646D; max-width: 780px; line-height: 1.6; margin-bottom: 2rem;">
          HWED enriches every stage of the health economy through five targeted operational mechanisms:
        </p>

        <!-- 5 Strategic Foundation Pillar Cards with Unique Background Images -->
        <div class="hwed-pillars-cards-grid reveal-card-group">
          
          <!-- Pillar 1: Knowledge & Education -->
          <div class="hwed-pillar-photo-card" tabindex="0">
            <picture>
              <source srcset="<?= $basePath ?>/assets/images/pillar-knowledge-education.webp" type="image/webp">
              <img src="<?= $basePath ?>/assets/images/pillar-knowledge-education.jpg"
                alt="Knowledge and Education in Healthcare"
                class="pillar-photo-bg"
                width="600"
                height="450"
                loading="lazy">
            </picture>
            <div class="pillar-photo-overlay" aria-hidden="true"></div>
            <div class="pillar-inner-content">
              <div class="pillar-card-top">
                <span class="pillar-num-badge">01</span>
                <span class="pillar-category-tag">ENABLER</span>
              </div>
              <h3 class="pillar-title-text">KNOWLEDGE &amp; EDUCATION</h3>
              <p class="pillar-desc-text">
                Professional certifications, continuous medical education (CME), health intelligence, independent ratings, research publications, and clinical capacity building.
              </p>
            </div>
          </div>

          <!-- Pillar 2: Technology & Digital -->
          <div class="hwed-pillar-photo-card" tabindex="0">
            <picture>
              <source srcset="<?= $basePath ?>/assets/images/pillar-technology-digital.webp" type="image/webp">
              <img src="<?= $basePath ?>/assets/images/pillar-technology-digital.jpg"
                alt="Technology and Digital Health"
                class="pillar-photo-bg"
                width="600"
                height="450"
                loading="lazy">
            </picture>
            <div class="pillar-photo-overlay" aria-hidden="true"></div>
            <div class="pillar-inner-content">
              <div class="pillar-card-top">
                <span class="pillar-num-badge">02</span>
                <span class="pillar-category-tag">ENABLER</span>
              </div>
              <h3 class="pillar-title-text">TECHNOLOGY &amp; DIGITAL</h3>
              <p class="pillar-desc-text">
                MedTech, digital health transformation, clinical analytics, health data registries, IoT diagnostics, and smart healthcare delivery solutions.
              </p>
            </div>
          </div>

          <!-- Pillar 3: Enterprise & Commerce -->
          <div class="hwed-pillar-photo-card" tabindex="0">
            <picture>
              <source srcset="<?= $basePath ?>/assets/images/pillar-enterprise-commerce.webp" type="image/webp">
              <img src="<?= $basePath ?>/assets/images/pillar-enterprise-commerce.jpg"
                alt="Enterprise and Commerce in Healthcare"
                class="pillar-photo-bg"
                width="600"
                height="450"
                loading="lazy">
            </picture>
            <div class="pillar-photo-overlay" aria-hidden="true"></div>
            <div class="pillar-inner-content">
              <div class="pillar-card-top">
                <span class="pillar-num-badge">03</span>
                <span class="pillar-category-tag">ENABLER</span>
              </div>
              <h3 class="pillar-title-text">ENTERPRISE &amp; COMMERCE</h3>
              <p class="pillar-desc-text">
                Business incubation, commercialisation assistance, healthcare SME acceleration, intellectual property support, and market development programs.
              </p>
            </div>
          </div>

          <!-- Pillar 4: Investment & Capital -->
          <div class="hwed-pillar-photo-card" tabindex="0">
            <picture>
              <source srcset="<?= $basePath ?>/assets/images/pillar-investment-capital.webp" type="image/webp">
              <img src="<?= $basePath ?>/assets/images/pillar-investment-capital.jpg"
                alt="Healthcare Investment and Capital"
                class="pillar-photo-bg"
                width="600"
                height="450"
                loading="lazy">
            </picture>
            <div class="pillar-photo-overlay" aria-hidden="true"></div>
            <div class="pillar-inner-content">
              <div class="pillar-card-top">
                <span class="pillar-num-badge">04</span>
                <span class="pillar-category-tag">ENABLER</span>
              </div>
              <h3 class="pillar-title-text">INVESTMENT &amp; CAPITAL</h3>
              <p class="pillar-desc-text">
                Connecting promising health enterprises with venture funding, institutional investors, corporate venture arms, and capital growth facilities.
              </p>
            </div>
          </div>

          <!-- Pillar 5: Industry & Policy Alliance -->
          <div class="hwed-pillar-photo-card" tabindex="0">
            <picture>
              <source srcset="<?= $basePath ?>/assets/images/pillar-industry-policy.webp" type="image/webp">
              <img src="<?= $basePath ?>/assets/images/pillar-industry-policy.jpg"
                alt="Industry and Policy Alliance in Healthcare"
                class="pillar-photo-bg"
                width="600"
                height="450"
                loading="lazy">
            </picture>
            <div class="pillar-photo-overlay" aria-hidden="true"></div>
            <div class="pillar-inner-content">
              <div class="pillar-card-top">
                <span class="pillar-num-badge">05</span>
                <span class="pillar-category-tag">ENABLER</span>
              </div>
              <h3 class="pillar-title-text">INDUSTRY &amp; POLICY ALLIANCE</h3>
              <p class="pillar-desc-text">
                Multi-sector coalitions, public-private partnerships (PPP), standardisation bodies, international trade connectivity, and ESG healthcare alignment.
              </p>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- ==========================================================================
         SECTION 3: WHAT HWED CREATES & WHO HWED SERVES
         Combined compact, interactive impact explorer on light background.
         ========================================================================== -->
    <section class="hwed-impact-section" id="impact" aria-label="Ecosystem Value Creation and Stakeholders">
      <div class="hwed-impact-wrap">
        <h2 class="reveal-heading" style="font-family: var(--font-heading); font-size: clamp(2.2rem, 3.8vw, 3.4rem); font-weight: 800; color: #06232B; text-transform: uppercase; letter-spacing: -0.02em; line-height: 1.05; margin-bottom: 0.75rem;">
          ECOSYSTEM VALUE &amp; <span style="color: #0E6C80;">STAKEHOLDERS</span>
        </h2>
        <p class="reveal-standard" style="font-size: 1.02rem; color: #43646D; max-width: 780px; line-height: 1.6; margin-bottom: 2rem;">
          Explore the tangible societal outcomes generated by HWED and the diverse sectors united under its mandate:
        </p>

        <div class="hwed-impact-twocol reveal-card-group">
          
          <!-- Column A: What HWED Creates -->
          <div class="impact-subcolumn">
            <h3 class="impact-column-title">WHAT HWED CREATES</h3>
            
            <div class="impact-pills-selector" role="tablist" aria-label="Outcomes Selector">
              <button type="button" class="impact-pill-tab active" data-outcome="1" role="tab" aria-selected="true">Healthier People</button>
              <button type="button" class="impact-pill-tab" data-outcome="2" role="tab" aria-selected="false">Stronger Economy</button>
              <button type="button" class="impact-pill-tab" data-outcome="3" role="tab" aria-selected="false">Greater Opportunities</button>
              <button type="button" class="impact-pill-tab" data-outcome="4" role="tab" aria-selected="false">Sustainable Tomorrow</button>
            </div>

            <div class="impact-detail-display" id="outcomeDisplayCard" role="tabpanel" aria-live="polite">
              <h4 class="impact-detail-title" id="outcomeTitle">HEALTHIER PEOPLE</h4>
              <p class="impact-detail-desc" id="outcomeDesc">
                Improved health, prevention, lifestyle resilience, and lifelong wellbeing across communities.
              </p>
            </div>
          </div>

          <!-- Column B: Who HWED Serves -->
          <div class="impact-subcolumn">
            <h3 class="impact-column-title">WHO HWED SERVES</h3>
            
            <div class="impact-pills-selector" role="tablist" aria-label="Stakeholders Selector">
              <button type="button" class="impact-pill-tab active" data-stakeholder="1" role="tab" aria-selected="true">Healthcare Providers</button>
              <button type="button" class="impact-pill-tab" data-stakeholder="2" role="tab" aria-selected="false">Wellness Organisations</button>
              <button type="button" class="impact-pill-tab" data-stakeholder="3" role="tab" aria-selected="false">Health Enterprises</button>
              <button type="button" class="impact-pill-tab" data-stakeholder="4" role="tab" aria-selected="false">Tech Innovators</button>
              <button type="button" class="impact-pill-tab" data-stakeholder="5" role="tab" aria-selected="false">Academia</button>
              <button type="button" class="impact-pill-tab" data-stakeholder="6" role="tab" aria-selected="false">Investors</button>
            </div>

            <div class="impact-detail-display" id="stakeholderDisplayCard" role="tabpanel" aria-live="polite">
              <h4 class="impact-detail-title" id="stakeholderTitle">HEALTHCARE PROVIDERS</h4>
              <p class="impact-detail-desc" id="stakeholderDesc">
                Hospitals, clinics, and medical centres advancing integrated care.
              </p>
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
