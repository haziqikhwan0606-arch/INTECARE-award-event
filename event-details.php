<?php
$activePage = 'event';
$pageTitle = 'Event Details & Gala Night — INTECARE 2026';
$pageDescription = 'Official event schedule, venue guide, programme highlights, and gala dinner information for the INTECARE Excellence Award 2026 on 27 November 2026 at Hotel Royale Chulan Damansara.';
require_once __DIR__ . '/includes/nav.php';
?>

  <main>
    <!-- ==========================================================================
         HERO: EDITORIAL AWARDS GALA INVITATION & PRESENTATION COVER
         Deep emerald background, gold accents, structured event specifications,
         and refined luxury awards image composition.
         ========================================================================== -->
    <section class="page-editorial-hero event-editorial-hero" aria-label="Event Details &amp; Gala Night">
      <div class="page-hero-container">
        <div class="event-hero-grid">
          
          <!-- Left: Dominant Editorial Title, Event Metadata Strip & Lead Description -->
          <div class="event-hero-content">
            <h1 class="event-hero-title">
              <span class="event-title-line-1">THE GALA DINNER &amp;</span>
              <span class="event-title-line-2 text-gold-glow">AWARDS PRESENTATION</span>
            </h1>

            <!-- Editorial Event Information Matrix (2x2 Balanced Luxury Layout) -->
            <div class="event-hero-meta-grid" role="region" aria-label="Key Event Details">
              <div class="event-meta-card meta-date-card">
                <div class="meta-icon-frame" aria-hidden="true">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
                <div class="meta-content-wrap">
                  <span class="meta-sub-tag">EVENT DATE</span>
                  <strong class="meta-main-val text-gold-glow">27 NOV 2026 (FRIDAY)</strong>
                </div>
              </div>

              <div class="event-meta-card">
                <div class="meta-icon-frame" aria-hidden="true">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <div class="meta-content-wrap">
                  <span class="meta-sub-tag">TIME &amp; SCHEDULE</span>
                  <strong class="meta-main-val">7:30 PM – 11:00 PM</strong>
                </div>
              </div>

              <div class="event-meta-card">
                <div class="meta-icon-frame" aria-hidden="true">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                </div>
                <div class="meta-content-wrap">
                  <span class="meta-sub-tag">OFFICIAL VENUE</span>
                  <strong class="meta-main-val">HOTEL ROYALE CHULAN DAMANSARA</strong>
                </div>
              </div>

              <div class="event-meta-card">
                <div class="meta-icon-frame" aria-hidden="true">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                </div>
                <div class="meta-content-wrap">
                  <span class="meta-sub-tag">DRESS CODE</span>
                  <strong class="meta-main-val">BLACK TIE / FORMAL</strong>
                </div>
              </div>
            </div>

            <p class="event-hero-description">
              Intecare Excellence Award 2026 is a signature evening bringing together distinguished healthcare and wellness professionals, healthcare providers, educators, researchers, industry leaders, organisations, graduates, strategic partners, and distinguished guests.
            </p>
          </div>

          <!-- Right: Refined Editorial Visual Composition Stage -->
          <div class="event-hero-stage" aria-hidden="true">
            <div class="event-hero-ambient-glow"></div>
            
            <div class="event-hero-visual-frame">
              <!-- Primary Visual: Gala Dinner Awards & Honorees -->
              <div class="event-hero-main-visual">
                <img src="<?= $basePath ?>/assets/images/event1.jpg"
                  alt="INTECARE 2026 Gala Dinner and Awards Presentation"
                  class="event-hero-main-img"
                  width="720"
                  height="720"
                  loading="eager">
              </div>

              <!-- Supporting Contextual Venue Badge Card -->
              <div class="event-hero-venue-card">
                <img src="<?= $basePath ?>/assets/images/event2.jpg"
                  alt="Hotel Royale Chulan Damansara Venue"
                  class="event-venue-thumb"
                  width="309"
                  height="232"
                  loading="eager">
                <div class="event-venue-caption">
                  <span class="venue-micro-pill">OFFICIAL VENUE</span>
                  <span class="venue-title">Grand Ballroom • Royale Chulan Damansara</span>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ==========================================================================
         SECTION 1: KEY EVENT SNAPSHOT DASHBOARD (EVENT AT A GLANCE)
         Compact, responsive 4-card dashboard on white background.
         ========================================================================== -->
    <section class="page-editorial-section bg-white-section" id="overview" aria-label="Event Specifications">
      <div class="section-editorial-wrap">
        <h2 class="section-head-title">
          KEY EVENT <span class="text-lime-glow">SPECIFICATIONS</span>
        </h2>
        <p class="section-head-lead">
          Verified details and essential operational information for guests, nominees, and partners attending the gala evening.
        </p>

        <div class="event-glance-grid">
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
        <h2 class="section-head-title">
          PROGRAMME <span class="text-lime-glow">HIGHLIGHTS</span>
        </h2>
        <p class="section-head-lead">
          Verified milestones comprising the ceremony and gala experience. Select any milestone below to inspect details:
        </p>

        <div class="programme-interactive-wrap">
          
          <!-- Left: 7 Interactive Milestone Selectors -->
          <div class="programme-timeline-track" role="tablist" aria-label="Gala Programme Timeline">
            
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
          <div class="programme-detail-card" id="programmeDetailCard" role="tabpanel" aria-live="polite">
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
          <div class="venue-info-box">
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
          <div>
            <div class="venue-ballroom-card">
              <img src="<?= $basePath ?>/assets/images/gala-ballroom.jpg"
                alt="Royale Chulan Damansara Grand Ballroom setting"
                class="venue-ballroom-img"
                width="800"
                height="450"
                loading="lazy">
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
        <h2 class="section-head-title">
          HOTEL ROYALE CHULAN <span class="text-lime-glow">DAMANSARA</span>
        </h2>
        <p class="section-head-lead">
          47810 Petaling Jaya, Selangor, Malaysia
        </p>

        <div class="venue-location-grid">
          <!-- Left: Google Maps Interactive Embed -->
          <div class="venue-map-column">
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
          <div class="venue-info-panel">
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
        <div class="reservations-cta-wrap">
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
  </main>

<?php
$hideFooterCtaBanner = true;
require_once __DIR__ . '/includes/footer.php';
require_once __DIR__ . '/includes/nomination-modal.php';
?>
