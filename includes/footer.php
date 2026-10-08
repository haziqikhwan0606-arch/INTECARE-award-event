<?php
/**
 * INTECARE 2026 — GLOBAL COMPREHENSIVE FOOTER
 * Unifies verified contact channels, official partner logos, navigation portals, and nomination CTAs.
 */

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
  <?php if (($activePage ?? '') !== 'event' && empty($hideFooterCtaBanner)): ?>
  <!-- ==========================================================================
       SECTION: PRE-FOOTER CALL TO ACTION BANNER
       ========================================================================== -->
  <section class="global-footer-cta-banner" aria-label="Nomination Call to Action">
    <div class="footer-cta-container">
      <div class="footer-cta-glow" aria-hidden="true"></div>
      <div class="footer-cta-text">
        <h2 class="footer-cta-title">
          BE RECOGNISED FOR THE IMPACT <span class="text-lime-glow">YOU CREATE.</span>
        </h2>
        <p class="footer-cta-sub">
          Celebrate professional achievement, clinical integrity, healthcare innovation, and ecosystem development across 40 distinguished award categories.
        </p>
      </div>
      <div class="footer-cta-actions">
        <a href="<?= $basePath ?>/assets/downloads/INTECARE_2026_Nomination_Form.pdf" download="INTECARE_2026_Nomination_Form.pdf" class="btn btn-lime btn-lg" aria-label="Download Nomination Form">
          <span>DOWNLOAD FORM</span>
          <span class="btn-arrow" aria-hidden="true">↓</span>
        </a>
        <button type="button" class="btn btn-outline-pill open-tracking-btn">
          <span>TRACK NOMINATION STATUS</span>
        </button>
        <a href="<?= $basePath ?>/awards" class="btn btn-outline-pill">
          <span>VIEW 40 CATEGORIES</span>
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- ==========================================================================
       SECTION: COMPREHENSIVE GLOBAL FOOTER
       ========================================================================== -->
  <footer class="site-footer comprehensive-footer" id="siteFooter">
    <!-- Editorial Environmental/Urban Background Artwork -->
    <div class="footer-artwork-wrap" aria-hidden="true">
      <picture>
        <source srcset="<?= $basePath ?>/assets/images/footer-bg.webp" type="image/webp">
        <img src="<?= $basePath ?>/assets/images/footer-bg.png" alt="" class="footer-artwork-img" loading="lazy">
      </picture>
    </div>

    <div class="comprehensive-footer-inner">

      <!-- 4-Column Editorial Matrix -->
      <div class="footer-matrix-grid">

        <!-- Column 1: Brand & Identity -->
        <div class="footer-col col-brand">
          <a href="<?= $basePath ?>/" class="footer-logo-link" aria-label="INTECARE 2026 Home">
            <img src="<?= $basePath ?>/assets/images/logo-intecare.png" alt="INTECARE 2026" class="footer-brand-logo" width="170" height="64" loading="lazy">
          </a>
          <p class="footer-brand-motto">
            One Ecosystem. Brighter Tomorrows. Uniting healthcare, wellness, education, technology, enterprise, and industry across the complete human health lifecycle.
          </p>
          <div class="footer-event-pill">
            <span class="live-dot" aria-hidden="true"></span>
            <span>27 NOV 2026 • HOTEL ROYALE CHULAN DAMANSARA</span>
          </div>
          <div class="footer-event-subinfo">
            <span>7:30 PM – 11:00 PM (Friday) • Formal Gala Dinner</span>
          </div>
        </div>

        <!-- Column 2: Navigation Portals -->
        <div class="footer-col col-links">
          <h3 class="footer-col-title">NAVIGATION</h3>
          <ul class="footer-nav-list">
            <li><a href="<?= $basePath ?>/">Home</a></li>
            <li><a href="<?= $basePath ?>/about">About INTECARE 2026</a></li>
            <li><a href="<?= $basePath ?>/awards">40 Excellence Awards</a></li>
            <li><a href="<?= $basePath ?>/hwed-ecosystem">HWED Ecosystem</a></li>
            <li><a href="<?= $basePath ?>/organisers">Organisers &amp; Partners</a></li>
            <li><a href="<?= $basePath ?>/event-details">Event Details &amp; Gala</a></li>
            <li><a href="javascript:void(0)" class="open-tracking-btn text-lime-link">Track Nomination Status →</a></li>
            <li><a href="javascript:void(0)" class="open-nomination-btn text-lime-link">Submit Nomination Dossier →</a></li>
          </ul>
        </div>

        <!-- Column 3: Strategic Alliance & Partners -->
        <div class="footer-col col-partners">
          <h3 class="footer-col-title">STRATEGIC ALLIANCE</h3>
          <p class="footer-partners-subtext">
            Organised through the strategic collaboration of leading national healthcare and economic development platforms:
          </p>
          <div class="footer-partners-deck">
            <div class="footer-partner-item">
              <img src="<?= $basePath ?>/assets/images/logo-hwed.png" alt="Healthcare &amp; Wellness Economy Development (HWED)" class="footer-partner-logo" width="140" height="42" loading="lazy">
              <div class="footer-partner-label">Ecosystem Enabler</div>
            </div>
            <div class="footer-partner-item">
              <img src="<?= $basePath ?>/assets/images/logo-miha.png" alt="Malaysian Integrative Health Association (MIHA)" class="footer-partner-logo" width="140" height="42" loading="lazy">
              <div class="footer-partner-label">National Integrative Authority</div>
            </div>
            <div class="footer-partner-item">
              <img src="<?= $basePath ?>/assets/images/logo-olympia.png" alt="Olympia Education Group" class="footer-partner-logo" width="130" height="38" loading="lazy">
              <div class="footer-partner-label">Academic Convocation Partner</div>
            </div>
          </div>
        </div>

        <!-- Column 4: Contact & Secretariat Channels -->
        <div class="footer-col col-contact" id="contact">
          <h3 class="footer-col-title">OFFICIAL SECRETARIAT</h3>
          <p class="footer-contact-desc">
            Direct your inquiries regarding nominations, corporate tables, partnerships, or media accreditation to the official secretariat:
          </p>
          <ul class="footer-contact-channels">
            <li class="contact-channel-item">
              <span class="channel-icon" aria-hidden="true">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"></rect><path d="m22 7-10 7L2 7"></path></svg>
              </span>
              <div class="channel-details">
                <span class="channel-label">General &amp; Event Secretariat</span>
                <a href="mailto:secretariat@intecare.org" class="channel-link">secretariat@intecare.org</a>
              </div>
            </li>
            <li class="contact-channel-item">
              <span class="channel-icon" aria-hidden="true">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
              </span>
              <div class="channel-details">
                <span class="channel-label">Nomination Dossier Desk</span>
                <a href="mailto:nominations@intecare.org" class="channel-link">nominations@intecare.org</a>
              </div>
            </li>
            <li class="contact-channel-item">
              <span class="channel-icon" aria-hidden="true">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
              </span>
              <div class="channel-details">
                <span class="channel-label">Secretariat Hotline [Verified Placeholder]</span>
                <span class="channel-text">+60 (03) 7955 - [OFFICIAL LINE]</span>
              </div>
            </li>
            <li class="contact-channel-item">
              <span class="channel-icon" aria-hidden="true">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
              </span>
              <div class="channel-details">
                <span class="channel-label">Event Venue</span>
                <span class="channel-text">Grand Ballroom, Hotel Royale Chulan Damansara, 47810 Petaling Jaya, Selangor, Malaysia</span>
              </div>
            </li>
          </ul>
        </div>

      </div>

      <!-- Bottom Bar: Social Channels & Legal -->
      <div class="footer-bottom-bar">
        <div class="footer-legal-text">
          <span>© 2026 INTECARE Excellence Award. Organised through the strategic collaboration of HWED and MIHA. All rights reserved.</span>
        </div>

        <div class="footer-social-links" aria-label="Social Channels">
          <a href="https://www.facebook.com/hwedmalaysia/" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="social-icon-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
            </svg>
          </a>
          <a href="https://www.instagram.com/hwedmalaysia?stkn=djEwZDJpazlrMWQz" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="social-icon-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
            </svg>
          </a>
          <a href="https://www.tiktok.com/@hwedmalaysia?_r=1&_t=ZS-9AN8waRC9yu" target="_blank" rel="noopener noreferrer" aria-label="TikTok" class="social-icon-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
            </svg>
          </a>
        </div>
      </div>

    </div>
  </footer>
