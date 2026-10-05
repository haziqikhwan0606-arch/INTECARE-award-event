<?php
$activePage = 'event';
$pageTitle = 'Event Details & Gala Night — INTECARE 2026';
$pageDescription = 'Official event schedule, venue guide, programme highlights, and gala dinner information for the INTECARE Excellence Award 2026 on 27 November 2026 at Hotel Royale Chulan Damansara.';
require_once __DIR__ . '/includes/nav.php';
?>

  <!-- Google Event Schema (JSON-LD Structured Data for Rich Snippets) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Event",
    "name": "INTECARE Excellence Award 2026 Gala Presentation & Dinner",
    "startDate": "2026-11-27T19:30:00+08:00",
    "endDate": "2026-11-27T23:00:00+08:00",
    "eventStatus": "https://schema.org/EventScheduled",
    "eventAttendanceMode": "https://schema.org/OfflineEventAttendanceMode",
    "location": {
      "@type": "Place",
      "name": "Grand Ballroom, Hotel Royale Chulan Damansara",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "2 Jalan PJU 7/3, Mutiara Damansara",
        "addressLocality": "Petaling Jaya",
        "addressRegion": "Selangor",
        "postalCode": "47810",
        "addressCountry": "MY"
      }
    },
    "image": "<?= htmlspecialchars($protocol . $host . $basePath . '/assets/images/logo-intecare3.png') ?>",
    "description": "Official Gala Dinner and Awards Presentation for INTECARE 2026 celebrating excellence across the healthcare, wellness, and disability ecosystem.",
    "organizer": {
      "@type": "Organization",
      "name": "INTECARE 2026 Secretariat",
      "url": "<?= htmlspecialchars($protocol . $host . $basePath . '/') ?>"
    }
  }
  </script>

  <main>
    <!-- ==========================================================================
         HERO: EDITORIAL AWARDS GALA INVITATION & PRESENTATION COVER
         Deep emerald background, gold accents, structured event specifications,
         and refined luxury awards image composition.
         ========================================================================== -->
    <!-- ==========================================================================
         HERO: LUXURY EVENT INVITATION POSTER (GALA & AWARDS)
         True full-screen editorial hero with dramatic date typography,
         event spec strip, 1-click calendar dropdown, and Grand Ballroom visual.
         ========================================================================== -->
    <section class="page-editorial-hero hero-event-spread" aria-label="Event Details &amp; Gala Night">
      <div class="hero-event-container">
        
        <!-- Left: Dominant Event Poster Layout -->
        <div class="hero-event-poster-col">
          <div class="hero-event-date-hero">
            <div class="about-hero-eyebrow" style="color: var(--color-gold-bright, #D4AF37);">
              <span class="eyebrow-accent-bar" style="background: var(--color-gold-bright, #D4AF37);"></span>
              <span>OFFICIAL GALA NIGHT &amp; INVITATION</span>
            </div>
            
            <div class="event-poster-date-display">
              <span class="poster-day">27</span>
              <div class="poster-date-stack">
                <span class="poster-month">NOVEMBER</span>
                <span class="poster-year">2026 • FRIDAY</span>
              </div>
            </div>
          </div>

          <div class="hero-event-title">
            <span class="title-sub">INTECARE EXCELLENCE AWARDS 2026</span>
            <h1 class="title-main text-gold-glow">GALA &amp; AWARDS CEREMONY</h1>
          </div>

          <!-- Event Spec Strip -->
          <div class="hero-event-spec-strip">
            <div class="event-spec-item">
              <span class="spec-label">Time</span>
              <span class="spec-val">7:30 PM – 11:00 PM</span>
            </div>
            <span class="spec-dot" aria-hidden="true">•</span>
            <div class="event-spec-item">
              <span class="spec-label">Venue</span>
              <span class="spec-val">Royale Chulan Damansara</span>
            </div>
            <span class="spec-dot" aria-hidden="true">•</span>
            
          </div>

          <!-- Actions & Calendar -->
          <div class="hero-event-action-row">
            <div class="cd-calendar-wrap">
              <button type="button" class="btn btn-primary btn-cal-add" id="btnAddToCal" aria-label="Add Gala Dinner to Calendar" aria-haspopup="true" aria-expanded="false">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                <span>ADD TO CALENDAR</span>
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
            <button type="button" class="btn btn-outline-pill" onclick="triggerGalaPrint()" aria-label="Print Formal Gala Invitation Card" title="Print Official 1-Page Gala Invitation">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
              <span>PRINT INVITATION</span>
            </button>
          </div>
        </div>

        <!-- Right: Grand Ballroom Visual Stage -->
        <div class="hero-event-visual-col">
          <div class="hero-event-img-composition">
            <picture>
              <source srcset="<?= $basePath ?>/assets/images/event1.webp" type="image/webp">
              <img src="<?= $basePath ?>/assets/images/event1.jpg"
                alt="INTECARE 2026 Grand Gala Ballroom"
                class="hero-event-main-img"
                width="720"
                height="540"
                loading="eager">
            </picture>
            <div class="hero-event-img-overlay"></div>

            <div class="hero-event-location-plaque">
              <span class="plaque-pin" aria-hidden="true">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
              </span>
              <div>
                <strong style="font-family: var(--font-heading); font-size: 0.88rem; letter-spacing: 0.05em;">GRAND BALLROOM</strong>
                <span style="font-size: 0.76rem; color: #D4E5DE;">Hotel Royale Chulan Damansara, Petaling Jaya</span>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Subtle Minimal Scroll Prompt -->
      <div class="hero-scroll-prompt" aria-hidden="true">
        <span>SCROLL</span>
        <span class="prompt-arrow">↓</span>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 1: KEY EVENT SNAPSHOT DASHBOARD (EVENT AT A GLANCE)
         Compact, responsive 4-card dashboard on white background.
         ========================================================================== -->
    <section class="page-editorial-section bg-white-section" id="overview" aria-label="Event Specifications">
      <div class="section-editorial-wrap">
        <h2 class="section-head-title reveal-heading">
          KEY EVENT <span class="text-lime-glow">SPECIFICATIONS</span>
        </h2>
        <p class="section-head-lead reveal-standard">
          Verified details and essential operational information for guests, nominees, and partners attending the gala evening.
        </p>

        <div class="event-glance-grid reveal-card-group">
          <!-- Card 1: Event Date -->
          <div class="event-glance-card">
            <div class="glance-card-header">
              <span class="glance-icon-wrap" aria-hidden="true">
                <svg class="glance-svg-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                  <line x1="16" y1="2" x2="16" y2="6"></line>
                  <line x1="8" y1="2" x2="8" y2="6"></line>
                  <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
              </span>
              <span class="glance-label">EVENT DATE</span>
            </div>
            <div class="glance-val">27 NOV 2026</div>
            <div class="glance-note">Friday Evening • Official Gala Night</div>
          </div>

          <!-- Card 2: Event Hours -->
          <div class="event-glance-card">
            <div class="glance-card-header">
              <span class="glance-icon-wrap" aria-hidden="true">
                <svg class="glance-svg-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"></circle>
                  <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
              </span>
              <span class="glance-label">EVENT HOURS</span>
            </div>
            <div class="glance-val">7:30 PM – 11:00 PM</div>
            <div class="glance-note">Registration &amp; Red Carpet opens 6:30 PM</div>
          </div>

          <!-- Card 3: Official Venue -->
          <div class="event-glance-card">
            <div class="glance-card-header">
              <span class="glance-icon-wrap" aria-hidden="true">
                <svg class="glance-svg-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
              </span>
              <span class="glance-label">OFFICIAL VENUE</span>
            </div>
            <div class="glance-val" style="font-size: 1.32rem;">ROYALE CHULAN DAMANSARA</div>
            <div class="glance-note">Grand Ballroom, Petaling Jaya, Selangor</div>
          </div>

          <!-- Card 4: Dress Code -->
          <div class="event-glance-card">
            <div class="glance-card-header">
              <span class="glance-icon-wrap" aria-hidden="true">
                <svg class="glance-svg-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 7l8 5-8 5V7z"></path>
                  <path d="M20 7l-8 5 8 5V7z"></path>
                  <circle cx="12" cy="12" r="2.5"></circle>
                </svg>
              </span>
              <span class="glance-label">DRESS CODE</span>
            </div>
            <div class="glance-val">BLACK TIE / FORMAL</div>
            <div class="glance-note">Evening Gown / Tuxedo / Formal National Attire</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 2: OFFICIAL PROGRAMME HIGHLIGHTS — INTERACTIVE TIMELINE
         Chronological vertical progression with real-time detail inspector panel.
         ========================================================================== -->
    <section class="page-editorial-section bg-deep-teal" id="programme" aria-label="Official Programme Schedule">
      <div class="section-editorial-wrap">
        <h2 class="section-head-title reveal-heading">
          PROGRAMME <span class="text-lime-glow">HIGHLIGHTS</span>
        </h2>
        <p class="section-head-lead reveal-standard">
          Verified milestones comprising the ceremony and gala experience. Select any milestone below to inspect details:
        </p>

        <div class="programme-interactive-wrap">
          
          <!-- Left: 7 Interactive Milestone Selectors -->
          <div class="programme-timeline-track reveal-card-group" role="tablist" aria-label="Gala Programme Timeline">
            
            <!-- Milestone 01 -->
            <button type="button" class="programme-timeline-btn active" data-programme-id="1" role="tab" aria-selected="true" aria-controls="programmeDetailCard">
              <span class="timeline-btn-time">6:30 PM</span>
              <div class="timeline-btn-content">
                <div class="timeline-btn-title">01. RED CARPET &amp; VVIP ARRIVAL</div>
                <div class="timeline-btn-excerpt">Arrival reception, photo opportunities, media wall interviews, and registration.</div>
              </div>
            </button>

            <!-- Milestone 02 -->
            <button type="button" class="programme-timeline-btn" data-programme-id="2" role="tab" aria-selected="false" aria-controls="programmeDetailCard">
              <span class="timeline-btn-time">7:30 PM</span>
              <div class="timeline-btn-content">
                <div class="timeline-btn-title">02. OPENING ADDRESS &amp; GALA COMMENCEMENT</div>
                <div class="timeline-btn-excerpt">Welcome addresses by the Organising Committee and leadership of HWED &amp; MIHA.</div>
              </div>
            </button>

            <!-- Milestone 03: Highlighted -->
            <button type="button" class="programme-timeline-btn featured-milestone" data-programme-id="3" role="tab" aria-selected="false" aria-controls="programmeDetailCard">
              <span class="timeline-btn-time">8:00 PM</span>
              <div class="timeline-btn-content">
                <div class="timeline-btn-title">03. OFFICIAL HWED ECOSYSTEM LAUNCH ✦</div>
                <div class="timeline-btn-excerpt">Formal national introduction of the Healthcare &amp; Wellness Economy Development initiative.</div>
              </div>
            </button>

            <!-- Milestone 04 -->
            <button type="button" class="programme-timeline-btn" data-programme-id="4" role="tab" aria-selected="false" aria-controls="programmeDetailCard">
              <span class="timeline-btn-time">8:30 PM</span>
              <div class="timeline-btn-content">
                <div class="timeline-btn-title">04. OLYMPIA EDUCATION CONVOCATION CEREMONY</div>
                <div class="timeline-btn-excerpt">Conferment ceremony honouring 45 graduating healthcare &amp; wellness professionals.</div>
              </div>
            </button>

            <!-- Milestone 05 -->
            <button type="button" class="programme-timeline-btn" data-programme-id="5" role="tab" aria-selected="false" aria-controls="programmeDetailCard">
              <span class="timeline-btn-time">9:00 PM</span>
              <div class="timeline-btn-content">
                <div class="timeline-btn-title">05. PRODUCT INNOVATION SHOWCASE</div>
                <div class="timeline-btn-excerpt">Official unveiling of the advanced Nanotech Sanitizer enterprise innovation.</div>
              </div>
            </button>

            <!-- Milestone 06: Highlighted -->
            <button type="button" class="programme-timeline-btn featured-milestone" data-programme-id="6" role="tab" aria-selected="false" aria-controls="programmeDetailCard">
              <span class="timeline-btn-time">9:30 PM</span>
              <div class="timeline-btn-content">
                <div class="timeline-btn-title">06. PRESENTATION OF 40 EXCELLENCE AWARDS ✦</div>
                <div class="timeline-btn-excerpt">Signature ceremony presenting 20 Individual and 20 Corporate Excellence Awards.</div>
              </div>
            </button>

            <!-- Milestone 07 -->
            <button type="button" class="programme-timeline-btn" data-programme-id="7" role="tab" aria-selected="false" aria-controls="programmeDetailCard">
              <span class="timeline-btn-time">10:30 PM</span>
              <div class="timeline-btn-content">
                <div class="timeline-btn-title">07. FORMAL DINNER, NETWORKING SOIRÉE &amp; CELEBRATION</div>
                <div class="timeline-btn-excerpt">Executive networking among healthcare leaders, corporate partners, and dignitaries.</div>
              </div>
            </button>

          </div>

          <!-- Right: Dedicated Detail Panel -->
          <div class="programme-detail-card reveal-standard" id="programmeDetailCard" role="tabpanel" aria-live="polite">
            <div class="programme-watermark" id="progWatermark" aria-hidden="true">01</div>
            
            <div class="programme-detail-badge-row">
              <span class="programme-time-tag" id="progTimeTag">6:30 PM</span>
              <span class="programme-status-tag" id="progStatusTag">GALA RECEPTION • MILESTONE 01</span>
            </div>

            <h3 class="programme-detail-title" id="progTitle">RED CARPET &amp; VVIP ARRIVAL</h3>
            
            <p class="programme-detail-desc" id="progDesc">
              Arrival reception, photo opportunities, media wall interviews, and registration for guests, nominees, and delegates.
            </p>

            <div class="programme-detail-foot">
              <span class="foot-dot" aria-hidden="true">✦</span>
              <span id="progFootnote">Official Event Schedule — Grand Ballroom Foyer</span>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 3: VENUE & ACCESS GUIDE (Royale Chulan Damansara)
         Split-screen showcase with ballroom imagery and functional map search links.
         ========================================================================== -->
    <section class="page-editorial-section bg-midnight" id="venue" aria-label="Official Venue Guide">
      <div class="section-editorial-wrap">
        <div class="venue-showcase-grid">
          <!-- Left: Venue Info & Access Rows -->
          <div class="venue-info-box reveal-left">
            <h2 class="venue-title-text">
              HOTEL ROYALE CHULAN <span class="text-lime-glow">DAMANSARA</span>
            </h2>
            <p class="venue-lead-text">
              Located in the heart of Mutiara Damansara, the 5-star Hotel Royale Chulan Damansara provides an upscale, prestigious setting featuring world-class ballroom banquet facilities, advanced audiovisual systems, and convenient access.
            </p>

            <div class="venue-access-list">
              <!-- Address Row -->
              <div class="venue-access-row">
                <div class="access-icon-col" aria-hidden="true">
                  <svg class="access-svg-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                  </svg>
                </div>
                <div class="access-body-col">
                  <div class="access-label">Official Address</div>
                  <p class="access-text">
                    2, Jalan PJU 7/3, Mutiara Damansara, 47810 Petaling Jaya, Selangor, Malaysia.
                  </p>
                  <a href="https://www.google.com/maps/search/?api=1&query=Hotel+Royale+Chulan+Damansara+2+Jalan+PJU+7%2F3+Mutiara+Damansara+47810+Petaling+Jaya+Selangor" target="_blank" rel="noopener noreferrer" class="venue-map-link">
                    <span>Open in Google Maps</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                  </a>
                </div>
              </div>

              <!-- Parking Row -->
              <div class="venue-access-row">
                <div class="access-icon-col" aria-hidden="true">
                  <svg class="access-svg-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="8" rx="2"></rect>
                    <path d="M5 11l2-5h10l2 5"></path>
                    <circle cx="7.5" cy="15.5" r="1.5"></circle>
                    <circle cx="16.5" cy="15.5" r="1.5"></circle>
                  </svg>
                </div>
                <div class="access-body-col">
                  <div class="access-label">Parking Facilities</div>
                  <p class="access-text">
                    On-site multi-storey hotel parking with dedicated valet service at the main lobby entrance.
                  </p>
                </div>
              </div>

              <!-- MRT Transit Row -->
              <div class="venue-access-row">
                <div class="access-icon-col" aria-hidden="true">
                  <svg class="access-svg-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="4" y="3" width="16" height="13" rx="2"></rect>
                    <line x1="4" y1="10" x2="20" y2="10"></line>
                    <line x1="8" y1="3" x2="8" y2="10"></line>
                    <line x1="16" y1="3" x2="16" y2="10"></line>
                    <circle cx="8" cy="13.5" r="1"></circle>
                    <circle cx="16" cy="13.5" r="1"></circle>
                    <path d="M6 16l-2 4M18 16l2 4"></path>
                  </svg>
                </div>
                <div class="access-body-col">
                  <div class="access-label">MRT Transit Connectivity</div>
                  <p class="access-text">
                    Mutiara Damansara MRT Station (Kajang Line) within walking distance.
                  </p>
                  <a href="https://www.google.com/maps/search/?api=1&query=Mutiara+Damansara+MRT+Station" target="_blank" rel="noopener noreferrer" class="venue-map-link">
                    <span>View MRT Station Map</span>
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Right: Official Ballroom Image Showcase -->
          <div class="reveal-right">
            <div class="venue-ballroom-card">
              <picture>
                <source srcset="<?= $basePath ?>/assets/images/gala-ballroom.webp" type="image/webp">
                <img src="<?= $basePath ?>/assets/images/gala-ballroom.jpg"
                  alt="Royale Chulan Damansara Grand Ballroom setting"
                  class="venue-ballroom-img"
                  width="800"
                  height="450"
                  loading="lazy">
              </picture>
              <div class="venue-ballroom-caption">
                Royale Chulan Damansara Grand Ballroom — Host of INTECARE 2026
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 3.5: OFFICIAL VENUE LOCATION & INTERACTIVE GOOGLE MAP
         Integrated editorial map showcase and venue specifications panel.
         ========================================================================== -->
    <section class="page-editorial-section bg-white-section" id="location" aria-label="Venue Location and Directions">
      <div class="section-editorial-wrap">
        <h2 class="section-head-title reveal-heading">
          HOTEL ROYALE CHULAN <span class="text-lime-glow">DAMANSARA</span>
        </h2>
        <p class="section-head-lead reveal-standard">
          47810 Petaling Jaya, Selangor, Malaysia
        </p>

        <div class="venue-location-grid">
          <!-- Left: Google Maps Interactive Embed -->
          <div class="venue-map-column reveal-left">
            <div class="venue-map-container">
              <iframe
                src="https://maps.google.com/maps?q=Hotel+Royale+Chulan+Damansara,+47810+Petaling+Jaya,+Selangor&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                class="venue-map-iframe"
                title="Google Maps location for Hotel Royale Chulan Damansara"
                loading="lazy"
                allowfullscreen=""
                referrerpolicy="no-referrer-when-downgrade">
              </iframe>
            </div>
          </div>

          <!-- Right: Venue Information Panel -->
          <div class="venue-info-panel reveal-right">
            <div class="venue-info-card">
              
              <!-- Venue Item -->
              <div class="venue-info-item">
                <div class="venue-info-icon" aria-hidden="true">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18"></path>
                    <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path>
                    <path d="M9 9h1"></path>
                    <path d="M9 13h1"></path>
                    <path d="M9 17h1"></path>
                    <path d="M14 9h1"></path>
                    <path d="M14 13h1"></path>
                    <path d="M14 17h1"></path>
                  </svg>
                </div>
                <div class="venue-info-content">
                  <span class="venue-item-label">VENUE</span>
                  <span class="venue-item-val">Hotel Royale Chulan Damansara</span>
                </div>
              </div>

              <!-- Address Item with Directions CTA -->
              <div class="venue-info-item">
                <div class="venue-info-icon" aria-hidden="true">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                  </svg>
                </div>
                <div class="venue-info-content">
                  <span class="venue-item-label">ADDRESS</span>
                  <span class="venue-item-val">
                    2, Jalan PJU 7/3, Mutiara Damansara,<br>
                    47810 Petaling Jaya, Selangor, Malaysia
                  </span>
                  <a href="https://www.google.com/maps/dir/?api=1&amp;destination=Hotel+Royale+Chulan+Damansara+2+Jalan+PJU+7%2F3+Mutiara+Damansara+47810+Petaling+Jaya+Selangor" 
                     target="_blank" 
                     rel="noopener noreferrer" 
                     class="venue-directions-cta"
                     aria-label="Get directions to Hotel Royale Chulan Damansara on Google Maps">
                    <span>GET DIRECTIONS &rarr;</span>
                  </a>
                </div>
              </div>

              <!-- Event Item -->
              <div class="venue-info-item">
                <div class="venue-info-icon" aria-hidden="true">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="8" r="6"></circle>
                    <path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"></path>
                  </svg>
                </div>
                <div class="venue-info-content">
                  <span class="venue-item-label">EVENT</span>
                  <span class="venue-item-val">INTECARE Excellence Award 2026</span>
                </div>
              </div>

              <!-- Date Item -->
              <div class="venue-info-item">
                <div class="venue-info-icon" aria-hidden="true">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                  </svg>
                </div>
                <div class="venue-info-content">
                  <span class="venue-item-label">DATE</span>
                  <span class="venue-item-val">Friday, 27 November 2026</span>
                </div>
              </div>

              <!-- Time Item -->
              <div class="venue-info-item">
                <div class="venue-info-icon" aria-hidden="true">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                  </svg>
                </div>
                <div class="venue-info-content">
                  <span class="venue-item-label">TIME</span>
                  <span class="venue-item-val">7:30 PM &ndash; 11:00 PM</span>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 4: TABLE RESERVATION & INQUIRY DESK
         Compact closing CTA with nomination modal and mailto link.
         ========================================================================== -->
    <section class="page-editorial-section bg-deep-teal" id="reservations" aria-label="Table Reservations and Inquiries">
      <div class="section-editorial-wrap">
        <div class="reservations-cta-wrap reveal-standard">
          <h2 class="section-head-title">
            RESERVE YOUR PRESENCE AT <span class="text-lime-glow">THE GALA</span>
          </h2>
          <p style="font-size: 1.02rem; color: #B5D4DC; line-height: 1.7; margin-bottom: 2rem;">
            Seats are strictly allocated for award nominees, healthcare leaders, corporate partners, and academic graduates. For corporate table bookings or VVIP invitations, please contact the secretariat directly.
          </p>
          <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <button type="button" class="btn btn-lime btn-lg open-nomination-btn">
              <span>SUBMIT NOMINATION DOSSIER</span>
              <span class="btn-arrow" aria-hidden="true">→</span>
            </button>
            <a href="mailto:secretariat@intecare.org?subject=INTECARE%202026%20Table%20Reservation%20Inquiry" class="btn btn-outline-pill">
              <span>INQUIRE TABLE RESERVATION</span>
              <span class="btn-arrow" aria-hidden="true">→</span>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- ==========================================================================
         OFFICIAL 1-PAGE LUXURY PRINTABLE GALA INVITATION CARD
         Rendered exclusively on @media print (A4 Portrait, 1-page fit, luxury royal gold styling)
         ========================================================================== -->
    <style id="galaPrintCardStyles">
      .gala-print-invitation {
        display: none;
      }
      @page {
        size: A4 portrait;
        margin: 6mm 8mm;
      }
      @media print {
        *, *::before, *::after {
          -webkit-print-color-adjust: exact !important;
          print-color-adjust: exact !important;
          color-adjust: exact !important;
          box-sizing: border-box !important;
        }
        html, body {
          background: #FFFFFF !important;
          color: #0E1E1C !important;
          margin: 0 !important;
          padding: 0 !important;
          width: 100% !important;
          font-family: 'Manrope', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
          font-size: 10pt !important;
        }
        /* Suppress ALL website shell and normal page sections */
        .site-header,
        .site-footer,
        .global-footer-cta-banner,
        .intecare-page-transition,
        #intecarePageTransition,
        .intecare-page-transition *,
        #intecareAssistantLauncher,
        .assistant-concierge-panel,
        .modal,
        dialog,
        button,
        .btn,
        .mobile-toggle,
        .brand-ambient-glow,
        main > *:not(.gala-print-invitation) {
          display: none !important;
          visibility: hidden !important;
          opacity: 0 !important;
          height: 0 !important;
          margin: 0 !important;
          padding: 0 !important;
          overflow: hidden !important;
          position: static !important;
          transform: none !important;
        }
        main {
          margin: 0 !important;
          padding: 0 !important;
          display: block !important;
          background: #FFFFFF !important;
        }
        .gala-print-invitation {
          display: block !important;
          visibility: visible !important;
          width: 100% !important;
          max-width: 192mm !important;
          margin: 0 auto !important;
          padding: 0 !important;
          box-sizing: border-box !important;
          page-break-inside: avoid !important;
          page-break-after: avoid !important;
          page-break-before: avoid !important;
        }
        .gala-print-invitation * {
          visibility: visible !important;
        }
        .print-card-outer {
          border: 2.5pt solid #8C6D3B !important;
          background: #FAF8F4 !important;
          padding: 3.5mm !important;
          box-sizing: border-box !important;
          position: relative !important;
          border-radius: 3px !important;
        }
        .print-card-inner {
          border: 1.2pt solid #B38F4D !important;
          background: #FFFFFF !important;
          padding: 6mm 7mm 5mm !important;
          box-sizing: border-box !important;
          position: relative !important;
          text-align: center !important;
        }
        .print-corner {
          position: absolute !important;
          font-size: 13pt !important;
          color: #8C6D3B !important;
          line-height: 1 !important;
        }
        .print-corner.top-left { top: 2.5mm; left: 2.5mm; }
        .print-corner.top-right { top: 2.5mm; right: 2.5mm; }
        .print-corner.bottom-left { bottom: 2.5mm; left: 2.5mm; }
        .print-corner.bottom-right { bottom: 2.5mm; right: 2.5mm; }
        .print-card-header {
          margin-bottom: 3.5mm !important;
          text-align: center !important;
          width: 100% !important;
        }
        .print-logo-row {
          margin-bottom: 2mm !important;
          text-align: center !important;
        }
        .print-logo {
          height: 38px !important;
          max-width: 180px !important;
          width: auto !important;
          object-fit: contain !important;
          display: inline-block !important;
          margin: 0 auto !important;
        }
        .print-org-tagline {
          font-size: 7pt !important;
          font-weight: 800 !important;
          letter-spacing: 0.12em !important;
          text-transform: uppercase !important;
          color: #003B30 !important;
          margin: 0 auto 1.5mm !important;
          text-align: center !important;
          display: block !important;
          width: 100% !important;
        }
        .print-divider {
          color: #8C6D3B !important;
          font-size: 7.5pt !important;
          margin: 1.5mm auto !important;
          display: flex !important;
          align-items: center !important;
          justify-content: center !important;
          gap: 6mm !important;
          width: 100% !important;
        }
        .print-divider::before,
        .print-divider::after {
          content: '' !important;
          display: block !important;
          width: 32mm !important;
          height: 0.75pt !important;
          background: #8C6D3B !important;
        }
        .print-invitation-lead {
          font-size: 8pt !important;
          letter-spacing: 0.06em !important;
          text-transform: uppercase !important;
          color: #444444 !important;
          margin: 2mm auto 1.5mm !important;
          font-weight: 600 !important;
          text-align: center !important;
          text-align-last: center !important;
          display: block !important;
          width: 100% !important;
        }
        .print-event-title {
          font-family: 'Cinzel', 'Playfair Display', Georgia, serif !important;
          font-size: 16.5pt !important;
          font-weight: 900 !important;
          letter-spacing: 0.04em !important;
          color: #002B24 !important;
          margin: 0 auto 1mm !important;
          line-height: 1.15 !important;
          text-transform: uppercase !important;
          text-align: center !important;
          display: block !important;
          width: 100% !important;
        }
        .print-event-subtitle {
          font-family: 'Cinzel', 'Playfair Display', Georgia, serif !important;
          font-size: 10pt !important;
          font-weight: 700 !important;
          letter-spacing: 0.08em !important;
          color: #8C6D3B !important;
          margin: 0 auto 2mm !important;
          text-transform: uppercase !important;
          text-align: center !important;
          display: block !important;
          width: 100% !important;
        }
        .print-theme-caption {
          font-style: italic !important;
          font-size: 8pt !important;
          color: #4A5B57 !important;
          margin: 0 auto !important;
          text-align: center !important;
          text-align-last: center !important;
          display: block !important;
          width: 100% !important;
          letter-spacing: 0.01em !important;
        }
        .print-specs-grid {
          display: grid !important;
          grid-template-columns: repeat(4, 1fr) !important;
          gap: 2mm !important;
          margin: 3.5mm 0 !important;
          text-align: center !important;
        }
        .print-spec-box {
          background: #F8F6F0 !important;
          border: 0.75pt solid #D6C4A5 !important;
          padding: 2.5mm 1.5mm !important;
          border-radius: 2px !important;
        }
        .print-spec-label {
          display: block !important;
          font-size: 6pt !important;
          font-weight: 800 !important;
          letter-spacing: 0.12em !important;
          text-transform: uppercase !important;
          color: #7A5B28 !important;
          margin-bottom: 0.75mm !important;
        }
        .print-spec-value {
          display: block !important;
          font-size: 8.5pt !important;
          font-weight: 800 !important;
          color: #002B24 !important;
          line-height: 1.2 !important;
          margin-bottom: 0.5mm !important;
        }
        .print-spec-sub {
          display: block !important;
          font-size: 6pt !important;
          color: #4A5B57 !important;
          line-height: 1.15 !important;
        }
        .print-programme-block {
          border-top: 0.75pt solid #D6C4A5 !important;
          border-bottom: 0.75pt solid #D6C4A5 !important;
          padding: 2.5mm 0 !important;
          margin: 2.5mm 0 !important;
        }
        .print-block-title {
          font-size: 6.5pt !important;
          font-weight: 800 !important;
          letter-spacing: 0.15em !important;
          text-transform: uppercase !important;
          color: #003B30 !important;
          margin-bottom: 2mm !important;
        }
        .print-timeline-row {
          display: flex !important;
          justify-content: space-between !important;
          align-items: flex-start !important;
          gap: 1mm !important;
        }
        .print-t-item {
          flex: 1 !important;
          text-align: center !important;
          padding: 0 0.5mm !important;
        }
        .print-t-time {
          display: block !important;
          font-size: 7.5pt !important;
          font-weight: 800 !important;
          color: #8C6D3B !important;
          margin-bottom: 0.5mm !important;
        }
        .print-t-name {
          display: block !important;
          font-size: 6pt !important;
          font-weight: 600 !important;
          color: #111111 !important;
          line-height: 1.15 !important;
        }
        .print-card-footer {
          display: flex !important;
          justify-content: space-between !important;
          align-items: flex-start !important;
          gap: 3mm !important;
          text-align: left !important;
          margin-top: 2.5mm !important;
          padding-top: 2mm !important;
        }
        .print-footer-col {
          flex: 1 !important;
        }
        .print-footer-right {
          text-align: right !important;
        }
        .print-footer-title {
          font-size: 6pt !important;
          font-weight: 800 !important;
          letter-spacing: 0.12em !important;
          text-transform: uppercase !important;
          color: #003B30 !important;
          margin-bottom: 0.75mm !important;
        }
        .print-footer-desc,
        .print-footer-contact {
          font-size: 6pt !important;
          line-height: 1.3 !important;
          color: #333333 !important;
          margin: 0 !important;
        }
        .print-card-watermark {
          font-size: 5.5pt !important;
          font-weight: 700 !important;
          letter-spacing: 0.16em !important;
          text-transform: uppercase !important;
          color: #8C6D3B !important;
          margin-top: 2.5mm !important;
          padding-top: 1.5mm !important;
          border-top: 0.5pt dashed #B38F4D !important;
          opacity: 0.9 !important;
        }
      }
    </style>

    <div class="gala-print-invitation" aria-hidden="true">
      <div class="print-card-outer">
        <div class="print-card-inner">
          
          <!-- Four Corner Classic Gold Ornaments -->
          <div class="print-corner top-left">✦</div>
          <div class="print-corner top-right">✦</div>
          <div class="print-corner bottom-left">✦</div>
          <div class="print-corner bottom-right">✦</div>

          <!-- Header & Crest -->
          <div class="print-card-header">
            <div class="print-logo-row">
              <img src="<?= $basePath ?>/assets/images/logo-intecare3.png" alt="INTECARE" class="print-logo">
            </div>
            <div class="print-org-tagline">INTERNATIONAL EXECUTIVE EDUCATION &amp; HEALTHCARE LEADERSHIP</div>
            <div class="print-divider"><span>❖</span></div>
            <p class="print-invitation-lead">CORDIALLY REQUESTS THE HONOUR OF YOUR PRESENCE AT</p>
            <h1 class="print-event-title">INTECARE EXCELLENCE AWARD 2026</h1>
            <h2 class="print-event-subtitle">&amp; INTERNATIONAL GALA NIGHT</h2>
            <p class="print-theme-caption">&ldquo;Honouring Visionary Excellence &amp; Transformative Healthcare Leadership&rdquo;</p>
          </div>

          <!-- Core Event Specifications Grid -->
          <div class="print-specs-grid">
            <div class="print-spec-box">
              <span class="print-spec-label">EVENT DATE</span>
              <strong class="print-spec-value">27 NOV 2026</strong>
              <span class="print-spec-sub">Friday Evening</span>
            </div>
            <div class="print-spec-box">
              <span class="print-spec-label">GALA HOURS</span>
              <strong class="print-spec-value">7:30 PM &ndash; 11:00 PM</strong>
              <span class="print-spec-sub">Red Carpet: 6:30 PM</span>
            </div>
            <div class="print-spec-box">
              <span class="print-spec-label">OFFICIAL VENUE</span>
              <strong class="print-spec-value">ROYALE CHULAN DAMANSARA</strong>
              <span class="print-spec-sub">Grand Ballroom, Petaling Jaya</span>
            </div>
            <div class="print-spec-box">
              <span class="print-spec-label">DRESS CODE</span>
              <strong class="print-spec-value">BLACK TIE / FORMAL</strong>
              <span class="print-spec-sub">Evening Gown / Tuxedo / Batik</span>
            </div>
          </div>

          <!-- Concise Gala Programme Strip -->
          <div class="print-programme-block">
            <div class="print-block-title">OFFICIAL GALA PROGRAMME HIGHLIGHTS</div>
            <div class="print-timeline-row">
              <div class="print-t-item">
                <span class="print-t-time">18:30</span>
                <span class="print-t-name">Arrival &amp; Red Carpet</span>
              </div>
              <div class="print-t-item">
                <span class="print-t-time">19:30</span>
                <span class="print-t-name">Opening &amp; Keynote</span>
              </div>
              <div class="print-t-item">
                <span class="print-t-time">20:00</span>
                <span class="print-t-name">Imperial Banquet</span>
              </div>
              <div class="print-t-item">
                <span class="print-t-time">20:45</span>
                <span class="print-t-name">Awards Presentation</span>
              </div>
              <div class="print-t-item">
                <span class="print-t-time">22:30</span>
                <span class="print-t-name">Royal Toast &amp; Photo</span>
              </div>
            </div>
          </div>

          <!-- Footer: Admission, RSVP & Secretariat Details -->
          <div class="print-card-footer">
            <div class="print-footer-col">
              <div class="print-footer-title">ADMISSION &amp; PROTOCOL</div>
              <p class="print-footer-desc">Admit ONE (1) table delegate per invitation. Please present this physical invitation or official digital QR pass at the registration concierge.</p>
            </div>
            <div class="print-footer-col print-footer-right">
              <div class="print-footer-title">OFFICIAL SECRETARIAT</div>
              <p class="print-footer-contact">
                <strong>Email:</strong> secretariat@intecare.org<br>
                <strong>Tel:</strong> +603-7728 8888 &nbsp;|&nbsp; <strong>Web:</strong> www.intecare.org
              </p>
            </div>
          </div>

          <div class="print-card-watermark">INTECARE EXCELLENCE AWARD 2026 &bull; OFFICIAL GALA INVITATION PASS &bull; NON-TRANSFERABLE</div>

        </div>
      </div>
    </div>

    <script>
      function triggerGalaPrint() {
        const transition = document.getElementById('intecarePageTransition');
        if (transition) {
          transition.style.setProperty('display', 'none', 'important');
          transition.style.setProperty('visibility', 'hidden', 'important');
          transition.style.setProperty('opacity', '0', 'important');
        }
        window.print();
      }

      window.addEventListener('beforeprint', function() {
        const transition = document.getElementById('intecarePageTransition');
        if (transition) {
          transition.style.setProperty('display', 'none', 'important');
          transition.style.setProperty('visibility', 'hidden', 'important');
          transition.style.setProperty('opacity', '0', 'important');
        }
      });
      window.addEventListener('afterprint', function() {
        const transition = document.getElementById('intecarePageTransition');
        if (transition) {
          transition.style.removeProperty('display');
          transition.style.removeProperty('visibility');
          transition.style.removeProperty('opacity');
        }
      });
    </script>
  </main>

<?php
$hideFooterCtaBanner = true;
require_once __DIR__ . '/includes/footer.php';
require_once __DIR__ . '/includes/nomination-modal.php';
?>
