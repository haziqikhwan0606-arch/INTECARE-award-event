<?php
$activePage = 'awards';
$pageTitle = '40 Excellence Awards — INTECARE 2026';
$pageDescription = 'Explore the 40 distinguished award categories of the INTECARE Excellence Award 2026: 20 Individual and 20 Corporate Excellence Awards celebrating leadership, innovation, and care.';
require_once __DIR__ . '/includes/nav.php';
?>

  <main>
    <!-- ==========================================================================
         HERO: MATCHING ABOUT.PHP VISUAL SYSTEM & TEMPLATE EXACTLY
         Uses identical markup, classes, layout, typography, and responsive rules
         ========================================================================== -->
    <section class="page-editorial-hero" aria-label="INTECARE 2026 Awards Overview">
      <div class="page-hero-container">
        <div class="about-hero-grid">
          
          <!-- Left: Editorial Headline & Narrative -->
          <div class="about-hero-text">
            <h1 class="about-hero-title">
              RECOGNISING EXCELLENCE.<br>
              <span class="text-lime-glow">CELEBRATING IMPACT.</span>
            </h1>

            <p class="about-hero-lead">
              The official Intecare Excellence Award 2026 programme recognises visionary clinicians, researchers, innovators, health enterprises, and organisations advancing the healthcare and wellness economy across the human lifecycle.
            </p>
          </div>

          <!-- Right: Floating Visual Art Stage (Restrained Depth & Layering) -->
          <div class="about-hero-art-stage" aria-hidden="true">
            <div class="about-hero-ambient-glow"></div>
            
            <!-- Layer 1: Futuristic Medical Technology 3D Sculpture (Transparent PNG) -->
            <img src="<?= $basePath ?>/assets/images/award1.jpg"
              alt="Medical Innovation 3D element"
              class="about-hero-float-primary"
              width="360"
              height="412"
              loading="eager">

            <!-- Layer 2: Editorial Supporting Visual Callout Badge (Transparent PNG) -->
            <img src="<?= $basePath ?>/assets/images/award2.jpg"
              alt="Ecosystem Innovation Badge"
              class="about-hero-float-secondary"
              width="180"
              height="180"
              loading="eager">
          </div>

        </div>
      </div>
    </section>

<?php
$individualCards = [
    [
        'id' => 'stay-well',
        'theme' => 'stay',
        'title' => 'STAY WELL',
        'subtitle' => 'PREVENTION, WELLNESS & HEALTH PROMOTION',
        'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 4 13c0-4.4 3.6-8 8-8s8 3.6 8 8a7 7 0 0 1-7 7z"/><path d="M12 5v15"/><path d="M8 10l4 4 4-4"/></svg>',
        'focus' => 'Individuals who advance prevention, health promotion, wellness, healthy lifestyles, community wellbeing and holistic approaches to maintaining health.',
        'awards' => [
            ['num' => '1', 'fullNum' => '01', 'title' => 'INTECARE Preventive Health Leadership Award 2026', 'desc' => 'Honours leaders advancing preventive medicine, proactive screening protocols, and early health risk mitigation strategies.'],
            ['num' => '2', 'fullNum' => '02', 'title' => 'INTECARE Community Health Leadership Award 2026', 'desc' => 'Honours grassroots health champions delivering tangible wellness improvements and preventive education to vulnerable communities.'],
            ['num' => '3', 'fullNum' => '03', 'title' => 'INTECARE Wellness & Lifestyle Medicine Leadership Award 2026', 'desc' => 'Celebrates practitioners integrating nutrition, sleep hygiene, stress mitigation, and physical wellness into mainstream care.'],
            ['num' => '4', 'fullNum' => '04', 'title' => 'INTECARE Mental Wellbeing Advocacy Award 2026', 'desc' => 'Recognises courageous pioneers dismantling mental health stigmas, fostering workplace resilience, and expanding youth psychological support.'],
            ['num' => '5', 'fullNum' => '05', 'title' => 'INTECARE Health Promotion Innovation Award 2026', 'desc' => 'Celebrates creative digital campaigns, mobile health literacy initiatives, and public outreach models transforming wellness engagement.'],
        ]
    ],
    [
        'id' => 'get-well',
        'theme' => 'get',
        'title' => 'GET WELL',
        'subtitle' => 'HEALTHCARE, CARE & PATIENT OUTCOMES',
        'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 0 5 0"/><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/></svg>',
        'focus' => 'Individuals who advance professional healthcare practice, integrated and patient-centred care, accessible and innovative healthcare delivery and improved patient outcomes.',
        'awards' => [
            ['num' => '6', 'fullNum' => '06', 'title' => 'INTECARE Integrative Healthcare Professional Leadership Award 2026', 'desc' => 'Recognises medical practitioners unifying conventional clinical medicine with verified evidence-based complementary therapies.'],
            ['num' => '7', 'fullNum' => '07', 'title' => 'INTECARE Patient-Centred Care Leadership Award 2026', 'desc' => 'Honours clinicians championing empathetic communication, shared medical decision-making, and dignified patient journeys.'],
            ['num' => '8', 'fullNum' => '08', 'title' => 'INTECARE Evidence-Based Medicine Leadership Award 2026', 'desc' => 'Recognises researchers and clinical trialists translating rigorous scientific evidence into frontline standard-of-care guidelines.'],
            ['num' => '9', 'fullNum' => '09', 'title' => 'INTECARE Healthcare Innovation in Care Delivery Award 2026', 'desc' => 'Celebrates pioneering service redesigns, telemedicine deployments, and decentralised clinical workflows improving regional accessibility.'],
            ['num' => '10', 'fullNum' => '10', 'title' => 'INTECARE Clinical Excellence Leadership Award 2026', 'desc' => 'Honours senior consultants delivering surgical mastery, diagnostic precision, and superior clinical survival benchmarks.'],
        ]
    ],
    [
        'id' => 'recover-well',
        'theme' => 'recover',
        'title' => 'RECOVER WELL',
        'subtitle' => 'REHABILITATION, RECOVERY & INDEPENDENCE',
        'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="5" r="2.5"/><path d="M10 22v-6l-3-3 4-4 3 2 4-1"/><path d="M6 17l4-2"/></svg>',
        'focus' => 'Individuals who contribute to rehabilitation, recovery, mental wellness, functional independence and improved quality of life.',
        'awards' => [
            ['num' => '11', 'fullNum' => '11', 'title' => 'INTECARE Rehabilitation Leadership Award 2026', 'desc' => 'Honours physiotherapists, occupational specialists, and physiatrists restoring mobility, bodily agency, and dignity.'],
            ['num' => '12', 'fullNum' => '12', 'title' => 'INTECARE Recovery & Functional Healthcare Leadership Award 2026', 'desc' => 'Celebrates practitioners addressing underlying metabolic, structural, and physiological drivers of long-term impairment.'],
            ['num' => '13', 'fullNum' => '13', 'title' => 'INTECARE Integrated Recovery Care Leadership Award 2026', 'desc' => 'Recognises multi-disciplinary coordinators synchronising post-operative healing, clinical nutrition, and home health follow-ups.'],
            ['num' => '14', 'fullNum' => '14', 'title' => 'INTECARE Mental Health Recovery Leadership Award 2026', 'desc' => 'Honours psychologists and recovery counsellors rebuilding self-efficacy, emotional stability, and vocational readiness.'],
            ['num' => '15', 'fullNum' => '15', 'title' => 'INTECARE Independent Living & Social Care Leadership Award 2026', 'desc' => 'Celebrates social workers, community case managers, and disability advocates empowering citizens to live independently.'],
        ]
    ],
    [
        'id' => 'age-well',
        'theme' => 'age',
        'title' => 'AGE WELL',
        'subtitle' => 'HEALTHY AGEING, LONGEVITY & ACTIVE LIVING',
        'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="6" r="2"/><path d="m7 21 2-7 3 2 2-3 3 1"/><path d="M17 21v-4l-3-3"/><path d="M19 12h2"/></svg>',
        'focus' => 'Individuals advancing healthy ageing, longevity, active ageing, independence and quality of life across the ageing population.',
        'awards' => [
            ['num' => '16', 'fullNum' => '16', 'title' => 'INTECARE Healthy Ageing Advocacy Award 2026', 'desc' => 'Recognises community leaders championing age-inclusive civic spaces, intergenerational engagement, and senior rights protection.'],
            ['num' => '17', 'fullNum' => '17', 'title' => 'INTECARE Active Ageing Leadership Award 2026', 'desc' => 'Celebrates trainers, wellness coaches, and geriatric activity directors motivating seniors toward daily physical vibrancy.'],
            ['num' => '18', 'fullNum' => '18', 'title' => 'INTECARE Longevity & Lifestyle Innovation Award 2026', 'desc' => 'Honours researchers and wellness technologists implementing cellular longevity, precision biomarkers, and cognitive preservation.'],
            ['num' => '19', 'fullNum' => '19', 'title' => 'INTECARE Age-Friendly Healthcare Leadership Award 2026', 'desc' => 'Honours clinical leaders re-engineering geriatric care protocols, hospital accessibility, and age-adapted services.'],
            ['num' => '20', 'fullNum' => '20', 'title' => 'INTECARE Excellence in Ageing & Quality of Life Leadership Award 2026', 'desc' => 'Honours exceptional champions elevating palliative comfort, senior home-care dignity, and quality of life for the elderly.'],
        ]
    ]
];

$corporateCards = [
    [
        'code' => '01',
        'theme' => 'corp-org',
        'title' => 'ORGANISATIONAL EXCELLENCE',
        'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="9" y1="22" x2="9" y2="22.01"/><line x1="15" y1="22" x2="15" y2="22.01"/><line x1="9" y1="6" x2="9" y2="6.01"/><line x1="15" y1="6" x2="15" y2="6.01"/><line x1="9" y1="10" x2="9" y2="10.01"/><line x1="15" y1="10" x2="15" y2="10.01"/><line x1="9" y1="14" x2="9" y2="14.01"/><line x1="15" y1="14" x2="15" y2="14.01"/><line x1="9" y1="18" x2="9" y2="18.01"/><line x1="15" y1="18" x2="15" y2="18.01"/></svg>',
        'focus' => 'Organisations demonstrating outstanding leadership, excellence and impactful contributions to the healthcare and wellness economy.',
        'awards' => [
            ['num' => '1', 'fullNum' => '21', 'title' => 'INTECARE Healthcare Organisation Excellence Award 2026', 'desc' => 'Celebrates healthcare institutions setting gold standards in clinical governance, patient safety, and comprehensive healthcare delivery.'],
            ['num' => '2', 'fullNum' => '22', 'title' => 'INTECARE Wellness Organisation Excellence Award 2026', 'desc' => 'Honours integrative lifestyle centres and holistic wellness providers establishing evidence-informed consumer wellbeing benchmarks.'],
            ['num' => '3', 'fullNum' => '23', 'title' => 'INTECARE Healthcare Brand Excellence Award 2026', 'desc' => 'Recognises trusted medical brands establishing transparent communication, ethical healthcare service, and community credibility.'],
            ['num' => '4', 'fullNum' => '24', 'title' => 'INTECARE Emerging Healthcare Enterprise Excellence Award 2026', 'desc' => 'Honours dynamic, high-growth healthcare enterprises demonstrating scalable care delivery models and visionary management.'],
            ['num' => '5', 'fullNum' => '25', 'title' => 'INTECARE Excellence in Healthcare Impact Award 2026', 'desc' => 'Recognises organisations driving measurable population health improvements and impactful socio-economic transformation.'],
        ]
    ],
    [
        'code' => '02',
        'theme' => 'corp-inno',
        'title' => 'INNOVATION & TRANSFORMATION',
        'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/><circle cx="12" cy="12" r="4"/></svg>',
        'focus' => 'Organisations driving innovation, digital transformation and technology to advance integrated healthcare and wellness.',
        'awards' => [
            ['num' => '6', 'fullNum' => '26', 'title' => 'INTECARE Healthcare Innovation Excellence Award 2026', 'desc' => 'Celebrates novel medical inventions, breakthrough care pathways, and clinical methodologies modernising patient recovery.'],
            ['num' => '7', 'fullNum' => '27', 'title' => 'INTECARE Digital Health Transformation Excellence Award 2026', 'desc' => 'Recognises health systems modernising hospital information systems, electronic records, and cloud clinical platforms.'],
            ['num' => '8', 'fullNum' => '28', 'title' => 'INTECARE Health Technology Excellence Award 2026', 'desc' => 'Honours MedTech developers producing superior diagnostic hardware, IoT biometric monitoring, and robotic surgical assistants.'],
            ['num' => '9', 'fullNum' => '29', 'title' => 'INTECARE Integrative Healthcare Innovation Excellence Award 2026', 'desc' => 'Recognises platforms bridging orthodox medical practitioners with validated holistic, herbal, and wellness modalities.'],
            ['num' => '10', 'fullNum' => '30', 'title' => 'INTECARE Future of Healthcare Excellence Award 2026', 'desc' => 'Celebrates forward-thinking organisations deploying artificial intelligence, genomic medicine, and predictive clinical triage.'],
        ]
    ],
    [
        'code' => '03',
        'theme' => 'corp-people',
        'title' => 'PEOPLE, WORKPLACE & COMMUNITY',
        'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
        'focus' => 'Organisations empowering people, building a positive workplace culture and creating meaningful impact in communities.',
        'awards' => [
            ['num' => '11', 'fullNum' => '31', 'title' => 'INTECARE Employer of Choice – Healthcare & Wellness Excellence Award 2026', 'desc' => 'Honours health providers fostering exceptional talent retention, psychological safety, and supportive clinical working environments.'],
            ['num' => '12', 'fullNum' => '32', 'title' => 'INTECARE Healthcare Workforce Development Excellence Award 2026', 'desc' => 'Celebrates nursing academies, medical faculties, and internal training institutes upskilling allied health specialists.'],
            ['num' => '13', 'fullNum' => '33', 'title' => 'INTECARE Excellence in Employee Wellbeing Award 2026', 'desc' => 'Recognises non-medical corporate employers deploying holistic health screening, mental wellness perks, and gym subsidies.'],
            ['num' => '14', 'fullNum' => '34', 'title' => 'INTECARE Community Partnership Excellence Award 2026', 'desc' => 'Honours cross-sector alliances uniting hospitals, non-profits, and civic groups to tackle regional health disparities.'],
            ['num' => '15', 'fullNum' => '35', 'title' => 'INTECARE Social Impact & Community Development Excellence Award 2026', 'desc' => 'Celebrates philanthropic medical foundations providing surgical sponsorships, rural outreach clinics, and health equity.'],
        ]
    ],
    [
        'code' => '04',
        'theme' => 'corp-eco',
        'title' => 'INDUSTRY, SUSTAINABILITY & ECOSYSTEM',
        'icon' => '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',
        'focus' => 'Organisations advancing a sustainable, inclusive and resilient healthcare and wellness ecosystem through strategic partnerships, enterprise development and economic contribution.',
        'awards' => [
            ['num' => '16', 'fullNum' => '36', 'title' => 'INTECARE Sustainable Healthcare Excellence Award 2026', 'desc' => 'Honours eco-conscious facilities cutting single-use clinical waste, achieving green building certs, and decarbonising energy.'],
            ['num' => '17', 'fullNum' => '37', 'title' => 'INTECARE Healthcare Ecosystem Partnership Excellence Award 2026', 'desc' => 'Celebrates collaborative networks uniting pharmaceutical manufacturers, insurers, and tertiary care centres.'],
            ['num' => '18', 'fullNum' => '38', 'title' => 'INTECARE Excellence in Healthcare Enterprise Development Award 2026', 'desc' => 'Celebrates incubators, business platforms, and enterprises creating commercial scalability and market expansion for health SMEs.'],
            ['num' => '19', 'fullNum' => '39', 'title' => 'INTECARE Healthcare Investment & Growth Excellence Award 2026', 'desc' => 'Honours venture capital funds, sovereign investors, and private equity leaders injecting growth capital into regional health tech.'],
            ['num' => '20', 'fullNum' => '40', 'title' => 'INTECARE Outstanding Contribution to the Healthcare & Wellness Economy Award 2026', 'desc' => 'The premier corporate distinction honouring institution-wide visionary stewardship establishing Malaysia as Southeast Asia’s medical hub.'],
        ]
    ]
];
?>

    <!-- ==========================================================================
         SECTION 1: 20 INDIVIDUALS EXCELLENCE AWARDS
         Faithfully matching Sponsorship Booklet Page 15
         ========================================================================== -->
    <section class="booklet-awards-section" id="categories" aria-label="Individual Excellence Awards">
      <div class="booklet-section-container">
        
        <!-- Section Header -->
        <div class="booklet-header-wrap">
          <div class="booklet-title-hero">
            <div class="hero-num-gold">20</div>
            <div class="hero-title-text">
              <span class="title-line-1">INDIVIDUALS</span>
              <span class="title-line-2">EXCELLENCE AWARDS</span>
            </div>
          </div>

          <div class="booklet-ribbon-tag">
            <span>RECOGNISING INDIVIDUALS WHO MAKE A DIFFERENCE</span>
          </div>
        </div>

        <!-- 4 CATEGORY PANELS (2x2 Grid Desktop / 1-Col Mobile) -->
        <div class="booklet-panels-grid">
          <?php foreach ($individualCards as $card): ?>
            <article class="booklet-card theme-<?= $card['theme'] ?>" id="card-<?= $card['id'] ?>">
              <!-- Leaf Watermark vector in top-right -->
              <div class="booklet-watermark" aria-hidden="true">
                <svg width="130" height="130" viewBox="0 0 100 100" fill="none">
                  <path d="M15,85 Q45,20 85,12 Q75,55 15,85 Z" fill="currentColor"/>
                  <path d="M30,68 Q55,38 80,24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                </svg>
              </div>

              <!-- Header: Circle Icon + Title + Subtitle -->
              <div class="booklet-card-top">
                <div class="booklet-circle-icon">
                  <?= $card['icon'] ?>
                </div>
                <div class="booklet-headings">
                  <h3 class="booklet-card-title"><?= $card['title'] ?></h3>
                  <div class="booklet-card-subtitle"><?= $card['subtitle'] ?></div>
                </div>
              </div>

              <!-- Recognition Focus -->
              <div class="booklet-card-focus">
                <span class="focus-label">Recognition focus:</span>
                <p class="focus-desc"><?= $card['focus'] ?></p>
              </div>

              <!-- Awards Table / List -->
              <div class="booklet-table-container">
                <div class="booklet-th">
                  <span class="th-col-no">No.</span>
                  <span class="th-col-name">Individual Award</span>
                </div>
                <ul class="booklet-rows-list">
                  <?php foreach ($card['awards'] as $award): ?>
                    <li class="booklet-row-item open-nomination-btn"
                        data-stream="individual"
                        data-award-title="<?= htmlspecialchars($award['title']) ?>"
                        data-award-num="<?= $award['fullNum'] ?>"
                        role="button"
                        tabindex="0"
                        title="Click to nominate: <?= htmlspecialchars($award['title']) ?>">
                      <div class="row-num-bubble"><?= $award['num'] ?></div>
                      <div class="row-award-text"><?= $award['title'] ?></div>
                      <div class="row-nominate-indicator" aria-hidden="true">
                        <span>Nominate</span>
                        <span class="row-arrow">→</span>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <!-- Booklet Bottom Ribbon -->
        <div class="booklet-bottom-ribbon">
          <div class="ribbon-pill-frame">
            <span class="ribbon-pill-text">DIFFERENT JOURNEYS. A HEALTHIER TOMORROW.</span>
          </div>
        </div>

      </div>
    </section>

    <!-- ==========================================================================
         SECTION 2: 20 CORPORATE EXCELLENCE AWARDS
         Faithfully matching Sponsorship Booklet Page 16
         ========================================================================== -->
    <section class="booklet-awards-section section-corporate" id="corporate-awards" aria-label="Corporate Excellence Awards">
      <div class="booklet-section-container">
        
        <!-- Section Header -->
        <div class="booklet-header-wrap">
          <div class="booklet-title-hero">
            <div class="hero-num-gold corp-gold">20</div>
            <div class="hero-title-text">
              <span class="title-line-1 corp-line-1">CORPORATE</span>
              <span class="title-line-2 corp-line-2">EXCELLENCE AWARDS</span>
            </div>
          </div>

          <div class="booklet-ribbon-tag corp-ribbon-tag">
            <span>RECOGNISING ORGANIZATIONS DRIVING IMPACT</span>
          </div>
        </div>

        <!-- 4 CATEGORY PANELS (2x2 Grid Desktop / 1-Col Mobile) -->
        <div class="booklet-panels-grid">
          <?php foreach ($corporateCards as $card): ?>
            <article class="booklet-card theme-<?= $card['theme'] ?>" id="card-corp-<?= $card['code'] ?>">
              <!-- Leaf Watermark vector in top-right -->
              <div class="booklet-watermark" aria-hidden="true">
                <svg width="130" height="130" viewBox="0 0 100 100" fill="none">
                  <path d="M15,85 Q45,20 85,12 Q75,55 15,85 Z" fill="currentColor"/>
                  <path d="M30,68 Q55,38 80,24" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
                </svg>
              </div>

              <!-- Header: Circle Icon + Number Code + Title -->
              <div class="booklet-card-top">
                <div class="booklet-circle-icon corp-icon-circle">
                  <?= $card['icon'] ?>
                </div>
                <div class="booklet-headings">
                  <div class="booklet-card-code"><?= $card['code'] ?></div>
                  <h3 class="booklet-card-title corp-card-title"><?= $card['title'] ?></h3>
                </div>
              </div>

              <!-- Recognition Focus -->
              <div class="booklet-card-focus">
                <span class="focus-label">Recognition focus:</span>
                <p class="focus-desc"><?= $card['focus'] ?></p>
              </div>

              <!-- Awards Table / List -->
              <div class="booklet-table-container">
                <div class="booklet-th corp-th">
                  <span class="th-col-no">No.</span>
                  <span class="th-col-name">Corporate Award</span>
                </div>
                <ul class="booklet-rows-list">
                  <?php foreach ($card['awards'] as $award): ?>
                    <li class="booklet-row-item open-nomination-btn"
                        data-stream="corporate"
                        data-award-title="<?= htmlspecialchars($award['title']) ?>"
                        data-award-num="<?= $award['fullNum'] ?>"
                        role="button"
                        tabindex="0"
                        title="Click to nominate: <?= htmlspecialchars($award['title']) ?>">
                      <div class="row-num-bubble corp-bubble"><?= $award['num'] ?></div>
                      <div class="row-award-text"><?= $award['title'] ?></div>
                      <div class="row-nominate-indicator" aria-hidden="true">
                        <span>Nominate</span>
                        <span class="row-arrow">→</span>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <!-- Booklet Bottom Ribbon -->
        <div class="booklet-bottom-ribbon">
          <div class="ribbon-pill-frame corp-ribbon-pill">
            <span class="ribbon-pill-text">STRONGER ORGANIZATIONS. A HEALTHIER TOMORROW.</span>
          </div>
        </div>

      </div>
    </section>

    <!-- ==========================================================================
         SECTION 3: OFFICIAL TROPHY SHOWCASE (#trophy)
         Interactive 5-item symbolism selector with compact frame
         ========================================================================== -->
    <section class="awards-trophy-showcase-section" id="trophy" aria-label="Official Trophy Showcase">
      <div class="trophy-interactive-showcase">
        <!-- Left: Trophy Image with Soft Compact Framing -->
        <div class="trophy-compact-frame">
          <img src="<?= $basePath ?>/assets/images/award-trophy-rendered.jpg" alt="Official INTECARE 2026 Excellence Trophy" class="trophy-compact-img" loading="lazy">
          <div>
            <span class="trophy-frame-pill">OFFICIAL 2026 TROPHY</span>
          </div>
        </div>

        <!-- Right: Interactive Symbolism Selector -->
        <div class="trophy-selector-container">
          <h2 class="trophy-title">
            A SYMBOL OF INTEGRATED <span style="color: #0E6C80;">EXCELLENCE</span>
          </h2>
          <p class="trophy-lead">
            The official INTECARE trophy embodies the strategic collaboration between HWED and MIHA and represents the integration of healthcare, wellness, and economic development through 5 symbolic values. Click any value to inspect its meaning:
          </p>

          <!-- 5 Interactive Symbolism Selector Tabs -->
          <div class="trophy-symbolism-tabs" role="tablist" aria-label="Trophy Symbolism Values">
            <button type="button" class="trophy-sym-tab active" data-value="people" role="tab" aria-selected="true">
              PEOPLE
            </button>
            <button type="button" class="trophy-sym-tab" data-value="health" role="tab" aria-selected="false">
              HEALTH
            </button>
            <button type="button" class="trophy-sym-tab" data-value="partnership" role="tab" aria-selected="false">
              PARTNERSHIP
            </button>
            <button type="button" class="trophy-sym-tab" data-value="sustainability" role="tab" aria-selected="false">
              SUSTAINABILITY
            </button>
            <button type="button" class="trophy-sym-tab" data-value="excellence" role="tab" aria-selected="false">
              EXCELLENCE
            </button>
          </div>

          <!-- Active Symbolism Display Card -->
          <div class="trophy-sym-active-card" id="symActiveCard" aria-live="polite">
            <div class="sym-card-header">
              <span class="sym-card-marker" aria-hidden="true">✦</span>
              <h3 class="sym-card-title" id="symCardTitle">PEOPLE</h3>
            </div>
            <p class="sym-card-desc" id="symCardDesc">
              Human health and lifelong wellbeing.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 4: NOMINATION GUIDELINES & EVALUATION DOSSIER (#guidelines)
         Accessible compact accordion with interactive milestone switcher
         ========================================================================== -->
    <section class="awards-guidelines-section" id="guidelines" aria-label="Award Nomination Guidelines">
      <div class="guidelines-wrap">
        <div class="guidelines-header">
          <h2 class="guidelines-title">
            AWARD GUIDELINES &amp; <span style="color: #17546C;">SELECTION INTEGRITY</span>
          </h2>
          <p class="guidelines-lead">
            Verified rules and assessment framework established by the Organising Committee for all 2026 nominations. Click any topic to reveal official requirements:
          </p>
        </div>

        <div class="guidelines-accordion-list" role="region" aria-label="Guidelines Accordion">
          <!-- 01: Purpose & Eligibility -->
          <div class="guideline-accordion-item open">
            <button type="button" class="guideline-acc-btn" aria-expanded="true">
              <div class="acc-title-group">
                <span class="acc-num">01</span>
                <span class="acc-heading">PURPOSE &amp; ELIGIBILITY</span>
              </div>
              <span class="acc-icon-indicator" aria-hidden="true">+</span>
            </button>
            <div class="guideline-acc-panel">
              <p>Open to organisations, institutions, clinicians, researchers, and professionals in Malaysia and internationally. Nominees must demonstrate verified achievements within the last 3 years. Both self-nominations and third-party nominations are accepted.</p>
            </div>
          </div>

          <!-- 02: Dossier Requirements -->
          <div class="guideline-accordion-item">
            <button type="button" class="guideline-acc-btn" aria-expanded="false">
              <div class="acc-title-group">
                <span class="acc-num">02</span>
                <span class="acc-heading">DOSSIER REQUIREMENTS</span>
              </div>
              <span class="acc-icon-indicator" aria-hidden="true">+</span>
            </button>
            <div class="guideline-acc-panel">
              <p>Completed nomination form accompanied by supporting evidence (project summaries, measurable impact metrics, press coverage, or testimonials). Maximum 10 supporting pages. Submissions accepted in English or Bahasa Malaysia.</p>
            </div>
          </div>

          <!-- 03: Evaluation Criteria -->
          <div class="guideline-accordion-item">
            <button type="button" class="guideline-acc-btn" aria-expanded="false">
              <div class="acc-title-group">
                <span class="acc-num">03</span>
                <span class="acc-heading">EVALUATION CRITERIA</span>
              </div>
              <span class="acc-icon-indicator" aria-hidden="true">+</span>
            </button>
            <div class="guideline-acc-panel">
              <p>Dossiers are scored independently on: (1) Relevance to HWED pillars, (2) Measurable outcomes &amp; impact, (3) Innovation &amp; best practice, (4) Sustainability &amp; scalability, and (5) Professional leadership &amp; collaboration.</p>
            </div>
          </div>

          <!-- 04: Independent Panel -->
          <div class="guideline-accordion-item">
            <button type="button" class="guideline-acc-btn" aria-expanded="false">
              <div class="acc-title-group">
                <span class="acc-num">04</span>
                <span class="acc-heading">INDEPENDENT PANEL</span>
              </div>
              <span class="acc-icon-indicator" aria-hidden="true">+</span>
            </button>
            <div class="guideline-acc-panel">
              <p>All nominations are reviewed by an independent panel of multidisciplinary medical, academic, and economic experts. Shortlisted candidates may be invited for an interview. The Organising Committee’s decision is final.</p>
            </div>
          </div>

          <!-- 05: Important Timeline (Interactive Milestone Track) -->
          <div class="guideline-accordion-item">
            <button type="button" class="guideline-acc-btn" aria-expanded="false">
              <div class="acc-title-group">
                <span class="acc-num">05</span>
                <span class="acc-heading">IMPORTANT TIMELINE &amp; MILESTONES</span>
              </div>
              <span class="acc-icon-indicator" aria-hidden="true">+</span>
            </button>
            <div class="guideline-acc-panel">
              <p style="margin-bottom: 0.65rem;">Official milestone dates scheduled by the Organising Committee for evaluation and awards presentation. Toggle milestone to inspect details:</p>
              
              <div class="timeline-interactive-track">
                <div class="timeline-milestone-switch">
                  <button type="button" class="timeline-ms-btn active" data-milestone="opening">1. Nomination Opening (28 Sept)</button>
                  <button type="button" class="timeline-ms-btn" data-milestone="gala">2. Gala Presentation (27 Nov)</button>
                </div>

                <div class="timeline-ms-card" id="timelineMsCard" aria-live="polite">
                  <div class="timeline-ms-title" id="timelineMsTitle">NOMINATION OPENING — 28 SEPTEMBER 2026</div>
                  <p class="timeline-ms-desc" id="timelineMsDesc">
                    Official call for nominations opens across all 40 categories (20 Individual and 20 Corporate). Dossier portal opens for online submissions.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- 06: Submit Today -->
          <div class="guideline-accordion-item">
            <button type="button" class="guideline-acc-btn" aria-expanded="false">
              <div class="acc-title-group">
                <span class="acc-num">06</span>
                <span class="acc-heading">SUBMISSION PORTAL &amp; NEXT STEPS</span>
              </div>
              <span class="acc-icon-indicator" aria-hidden="true">+</span>
            </button>
            <div class="guideline-acc-panel">
              <p>Be recognised on the national stage before government dignitaries, medical authorities, and health enterprise leaders. Ensure all requirements are prepared before initiating submission.</p>
              <div class="acc-nominate-btn-wrap">
                <button type="button" class="btn-teal-solid open-nomination-btn" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #0E6C80; color: #fff; padding: 0.6rem 1.25rem; border-radius: 999px; font-family: var(--font-heading); font-weight: 800; font-size: 0.85rem; border: none; cursor: pointer;">
                  <span>START NOMINATION</span>
                  <span aria-hidden="true">→</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- ==========================================================================
       AWARD DETAIL MODAL (Compact Card Deep-Dive)
       Displays complete original description and direct nomination action
       ========================================================================== -->
  <dialog id="awardDetailModal" class="award-detail-dialog" aria-labelledby="awardDetailTitle">
    <div class="award-detail-inner">
      <div class="award-detail-header">
        <div class="award-detail-meta">
          <span class="award-detail-num" id="awardDetailNum">01</span>
          <span class="award-detail-badge" id="awardDetailBadge">INDIVIDUAL</span>
        </div>
        <button type="button" class="award-detail-close-btn" id="closeAwardDetailBtn" aria-label="Close award details">✕</button>
      </div>

      <div class="award-detail-subgroup" id="awardDetailSubgroup">Stay Well • Prevention</div>
      <h2 class="award-detail-title" id="awardDetailTitle">Preventive Health Leadership Award</h2>
      
      <div class="award-detail-desc-box">
        <div class="award-detail-desc-label">Official Category Scope &amp; Criteria</div>
        <p class="award-detail-desc" id="awardDetailDesc"></p>
      </div>

      <div class="award-detail-actions">
        <button type="button" class="btn-outline-modal" id="cancelAwardDetailBtn">Close</button>
        <button type="button" class="btn-primary open-nomination-btn" id="detailNominateBtn" data-stream="individual" data-award-title="">
          <span>Nominate for This Category</span>
          <span aria-hidden="true">→</span>
        </button>
      </div>
    </div>
  </dialog>

<?php
require_once __DIR__ . '/includes/footer.php';
require_once __DIR__ . '/includes/nomination-modal.php';
?>
