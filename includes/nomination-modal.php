<?php
/**
 * INTECARE 2026 — NOMINATION MODAL DIALOG
 * Accessible HTML5 dialog component supporting 20 Individual & 20 Corporate categories
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

if (!isset($basePath)) {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '';
    if (preg_match('#^/(intecare)#i', $requestUri, $matches)) {
        $basePath = '/' . $matches[1];
    } else {
        $basePath = '';
    }
}
?>
  <!-- ==========================================================================
       NOMINATION MODAL (HTML5 Dialog)
       ========================================================================== -->
  <dialog id="nominationModal" class="luxury-dialog" aria-labelledby="modalTitle">
    <div class="dialog-inner">
      <div class="dialog-header">
        <div>
          <h2 class="dialog-title" id="modalTitle">Submit Nomination</h2>
          <p class="dialog-sub">INTECARE EXCELLENCE AWARD 2026 • 27 NOV GALA PRESENTATION</p>
        </div>
        <button type="button" class="dialog-close-btn" aria-label="Close dialog">×</button>
      </div>

      <div class="dialog-body">
        <div id="nominationFormView">
          <form id="nominationForm" novalidate>
            <!-- CSRF Security Token -->
            <input type="hidden" name="csrf_token" id="nominationCsrfToken" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

            <!-- Draft Auto-Save Recovery Banner -->
            <div id="nominationDraftBanner" class="nomination-draft-banner" style="display: none;" role="status">
              <span class="draft-text">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
                <span>Restored your saved nomination draft</span>
              </span>
              <button type="button" class="btn-clear-draft" id="btnClearNominationDraft">Clear Draft</button>
            </div>

            <!-- Global Form Alert Container -->
            <div id="nominationFormAlert" class="nomination-alert alert-danger" style="display: none; margin-bottom: 1.25rem;" role="alert"></div>

            <!-- Nominee Type Selector -->
            <div class="form-group">
              <label class="form-label">Nomination Stream *</label>
              <div class="radio-toggle-group">
                <label class="radio-pill">
                  <input type="radio" name="nomineeType" value="individual" id="typeIndividual" checked>
                  <span>Individual Excellence Award (20 Awards)</span>
                </label>
                <label class="radio-pill">
                  <input type="radio" name="nomineeType" value="corporate" id="typeCorporate">
                  <span>Corporate Excellence Award (20 Awards)</span>
                </label>
              </div>
            </div>

            <!-- Dynamic Category Dropdown -->
            <div class="form-group">
              <label for="nominationCategory" class="form-label">Select Award Category *</label>
              <select id="nominationCategory" name="category" class="form-control" required>
                <!-- Populated dynamically by assets/js/main.js -->
              </select>
            </div>

            <!-- Individual Fields -->
            <div id="individualFields">
              <div class="form-row">
                <div class="form-group">
                  <label for="nomineeName" class="form-label">Nominee Full Name (with Title) *</label>
                  <input type="text" id="nomineeName" name="nomineeName" class="form-control"
                    placeholder="e.g. Dr. Sarah Jenkins, MBBS, FRCP">
                </div>
                <div class="form-group">
                  <label for="nomineeDesignation" class="form-label">Designation / Speciality *</label>
                  <input type="text" id="nomineeDesignation" name="nomineeDesignation" class="form-control"
                    placeholder="e.g. Consultant Integrative Oncologist">
                </div>
              </div>
            </div>

            <!-- Corporate Fields -->
            <div id="corporateFields" style="display: none;">
              <div class="form-row">
                <div class="form-group">
                  <label for="companyName" class="form-label">Company / Organisation Name *</label>
                  <input type="text" id="companyName" name="companyName" class="form-control"
                    placeholder="e.g. Lifecare Integrated Health System Sdn Bhd">
                </div>
                <div class="form-group">
                  <label for="companyReg" class="form-label">Registration No. / Industry *</label>
                  <input type="text" id="companyReg" name="companyReg" class="form-control"
                    placeholder="e.g. 201801012345 (Hospital / MedTech)">
                </div>
              </div>
            </div>

            <!-- Contact Fields -->
            <div class="form-row">
              <div class="form-group">
                <label for="nominatorEmail" class="form-label">Official Work Email *</label>
                <input type="email" id="nominatorEmail" name="nominatorEmail" class="form-control"
                  placeholder="colleague@organisation.com" required>
              </div>
              <div class="form-group">
                <label for="nominatorPhone" class="form-label">Contact Number *</label>
                <input type="tel" id="nominatorPhone" name="nominatorPhone" class="form-control"
                  placeholder="+60 12 345 6789" required>
              </div>
            </div>

            <!-- Evidence Statement -->
            <div class="form-group">
              <label for="nominationRationale" class="form-label">Executive Summary of Achievements (Max 300 words) *</label>
              <textarea id="nominationRationale" name="rationale" rows="4" class="form-control"
                placeholder="Describe clinical leadership, innovation impact, patient outcomes or economic transformation..."
                required></textarea>
              <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.35rem; font-size: 0.76rem; color: #6E8A93;">
                <span>Required • Minimum 20 characters</span>
                <span id="rationaleWordCount" class="word-count-badge">0 / 300 words</span>
              </div>
            </div>

            <div class="dialog-actions">
              <button type="button" class="btn btn-secondary close-modal-btn">Cancel</button>
              <button type="submit" class="btn btn-lime">
                <span>SUBMIT NOMINATION DOSSIER</span>
                <span class="btn-arrow" aria-hidden="true">→</span>
              </button>
            </div>
          </form>
        </div>

        <!-- Success Feedback View -->
        <div id="nominationSuccessView" style="display: none; text-align: center; padding: 2rem 1rem;">
          <div style="width: 58px; height: 58px; border-radius: 50%; background: #C5A059; color: #021C16; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.15rem; box-shadow: 0 4px 14px rgba(197, 160, 89, 0.35);">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
          </div>
          <span style="display: inline-block; background: rgba(197, 160, 89, 0.12); color: #B8860B; border: 1px solid rgba(197, 160, 89, 0.4); padding: 0.35rem 0.95rem; border-radius: 6px; font-size: 0.8125rem; font-weight: 800; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 0.65rem;">STATUS: PENDING REVIEW</span>
          <h3 style="font-family: var(--font-heading); font-size: 1.8rem; font-weight: 800; color: #062E25; margin-bottom: 0.4rem;">Nomination Received</h3>
          
          <div style="background: #FAFBF8; border: 1px solid rgba(197, 160, 89, 0.3); border-radius: 8px; padding: 1.25rem; max-width: 520px; margin: 1.25rem auto; text-align: left;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.65rem; border-bottom: 1px solid rgba(197, 160, 89, 0.2); padding-bottom: 0.65rem;">
              <span style="font-size: 0.8125rem; font-weight: 800; letter-spacing: 0.1em; color: #1E352F; text-transform: uppercase;">Tracking Reference</span>
              <div style="display: flex; align-items: center; gap: 0.5rem;">
                <code id="successTrackingRef" style="font-family: monospace; font-size: 1.15rem; font-weight: 800; color: #062E25; background: #FFFFFF; border: 1px solid rgba(197, 160, 89, 0.35); padding: 0.25rem 0.65rem; border-radius: 4px;">INT26-XXXXXXXX</code>
                <button type="button" id="copyRefBtn" class="btn" style="padding: 0.35rem 0.75rem; font-size: 0.8125rem; font-weight: 700; background: #062E25; color: #FFFFFF; border: 1px solid #C5A059; border-radius: 4px; cursor: pointer;">Copy</button>
              </div>
            </div>
            <div id="copyToast" style="display: none; font-size: 0.8125rem; color: #166534; font-weight: 700; text-align: right; margin-bottom: 0.5rem;">✓ Copied to clipboard</div>
            <div style="font-size: 0.9375rem; color: #2C464F; line-height: 1.6;">
              <div><strong>Category:</strong> <span id="successCategory">—</span></div>
              <div style="margin-top: 0.25rem;"><strong>Nominee:</strong> <span id="successNominee">—</span></div>
            </div>
          </div>

          <p id="successReceiptMessage" style="color: #2C464F; max-width: 500px; margin: 0 auto 1.5rem; line-height: 1.72; font-size: 1rem;">
            Thank you for submitting your nomination for the INTECARE Excellence Award 2026. Your dossier has been securely recorded and queued for review by the Evaluation Committee.
          </p>
          <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap;">
            <button type="button" class="btn btn-outline-dark open-tracking-btn" id="successTrackStatusBtn">
              <span>Track Nomination Status →</span>
            </button>
            <button type="button" class="btn btn-lime close-modal-btn" id="restartNominationBtn">Return to Portal</button>
          </div>
        </div>
      </div>
    </div>
  </dialog>

  <?php require_once __DIR__ . '/tracking-modal.php'; ?>

  <!-- JavaScript Interactions -->
  <script src="<?= $basePath ?>/assets/js/main.js?v=<?= filemtime(__DIR__ . '/../assets/js/main.js') ?>"></script>
  <script src="<?= $basePath ?>/assets/js/assistant-knowledge.js?v=<?= filemtime(__DIR__ . '/../assets/js/assistant-knowledge.js') ?>"></script>
  <script src="<?= $basePath ?>/assets/js/assistant-ui.js?v=<?= filemtime(__DIR__ . '/../assets/js/assistant-ui.js') ?>"></script>
</body>
</html>
