<?php
/**
 * INTECARE 2026 — SECURE TRACKING MODAL DIALOG
 * Accessible HTML5 dialog component for two-factor nomination status lookup & visual progress stepper.
 */
if (session_status() === PHP_SESSION_NONE) {
    @session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
  <!-- ==========================================================================
       TRACKING MODAL (HTML5 Dialog - Option A)
       ========================================================================== -->
  <dialog id="trackingModal" class="luxury-dialog" aria-labelledby="trackingModalTitle">
    <div class="dialog-inner">
      <div class="dialog-header">
        <div>
          <h2 class="dialog-title" id="trackingModalTitle">Track Nomination Status</h2>
          <p class="dialog-sub">INTECARE EXCELLENCE AWARD 2026 • 27 NOV GALA PRESENTATION</p>
        </div>
        <button type="button" class="dialog-close-btn" aria-label="Close dialog">×</button>
      </div>

      <div class="dialog-body">
        
        <!-- View 1: Two-Factor Identity Verification Form -->
        <div id="trackingLookupView">
          <form id="trackingForm" novalidate>
            <input type="hidden" name="csrf_token" id="trackingCsrfToken" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

            <div id="trackingFormAlert" class="nomination-alert alert-danger" style="display: none; margin-bottom: 1.25rem;" role="alert"></div>

            <p style="color: #6E8A93; font-size: 0.88rem; line-height: 1.5; margin-bottom: 1.25rem;">
              Enter your official tracking reference to view the latest nomination status.
            </p>

            <div class="form-group" style="margin-bottom: 1.5rem;">
              <label for="trackRefInput" class="form-label">Official Tracking Reference *</label>
              <input type="text" id="trackRefInput" name="tracking_reference" class="form-control"
                placeholder="INT26-XXXXXXXX" required style="font-family: monospace; text-transform: uppercase; font-weight: 700; letter-spacing: 0.05em; font-size: 1rem;">
            </div>

            <div class="dialog-actions">
              <button type="button" class="btn btn-secondary close-modal-btn">Cancel</button>
              <button type="submit" class="btn btn-lime">
                <span>CHECK STATUS</span>
                <span class="btn-arrow" aria-hidden="true">→</span>
              </button>
            </div>
          </form>
        </div>

        <!-- View 2: Status Progress Stepper & Official Information -->
        <div id="trackingResultView" style="display: none;">
          <!-- Dynamically populated by assets/js/main.js -->
        </div>

      </div>
    </div>
  </dialog>
