/**
 * INTECARE EXCELLENCE AWARD 2026 — JAVASCRIPT INTERACTIONS
 */

// ==========================================================================
// CENTRAL HERO COLLAGE ASSET CONFIGURATION
// Each collage layer points to an independent image file in assets/images/hero/
// (also accessible via public/images/hero/ or public/images/intecare/hero/).
// Supports transparent PNGs, WebP with transparency, and regular JPGs.
// Replacing any of these local image files immediately updates the collage layer.
// ==========================================================================
const heroImages = {
  portrait: "assets/images/hero/hero-main-portrait.jpg",
  medicalTechnology: "assets/images/hero/hero-medical-technology.png",
  healthcareInnovation: "assets/images/hero/hero-healthcare-innovation.jpg",
  architecture: "assets/images/hero/hero-architecture.jpg",
  wellness: "assets/images/hero/hero-wellness.jpg",
  abstractTechnology: "assets/images/hero/hero-abstract-technology.png",
  supportingVisual: "assets/images/hero/hero-supporting-visual.png"
};
window.heroImages = heroImages;

document.addEventListener('DOMContentLoaded', () => {
  // 1. Sticky Navigation & Scroll Effects
  const header = document.querySelector('.site-header');
  const handleScroll = () => {
    if (window.scrollY > 40) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  };
  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll();

  // 2. Mobile Navigation Toggle
  const mobileToggle = document.querySelector('.mobile-toggle');
  const navMenu = document.querySelector('.nav-menu');
  const navLinks = document.querySelectorAll('.nav-link');

  if (mobileToggle && navMenu) {
    mobileToggle.addEventListener('click', () => {
      const isOpen = navMenu.classList.toggle('open');
      mobileToggle.setAttribute('aria-expanded', isOpen);
    });

    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        navMenu.classList.remove('open');
        mobileToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  // 3. Active Nav Link on Scroll
  const sections = document.querySelectorAll('section[id]');
  const highlightNavLink = () => {
    const scrollY = window.pageYOffset;
    sections.forEach(section => {
      const sectionHeight = section.offsetHeight;
      const sectionTop = section.offsetTop - 120;
      const sectionId = section.getAttribute('id');
      const targetLink = document.querySelector(`.nav-link[href*="${sectionId}"]`);
      if (targetLink) {
        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
          targetLink.classList.add('active');
        } else {
          targetLink.classList.remove('active');
        }
      }
    });
  };
  window.addEventListener('scroll', highlightNavLink, { passive: true });

  // 4. Award Explorer Tabs (Individual vs Corporate)
  const tabButtons = document.querySelectorAll('.tab-btn');
  const tabPanes = document.querySelectorAll('.tab-pane');

  tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const target = btn.dataset.tab;
      
      tabButtons.forEach(b => b.classList.remove('active'));
      tabPanes.forEach(p => p.classList.remove('active'));

      btn.classList.add('active');
      const activePane = document.getElementById(target);
      if (activePane) {
        activePane.classList.add('active');
      }
    });
  });

  // 4B. About Section Organization Switcher (HWED vs MIHA)
  const orgTabButtons = document.querySelectorAll('.about-org-tab-btn');
  const orgPanes = document.querySelectorAll('.about-org-pane');

  orgTabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const target = btn.dataset.orgTab;
      orgTabButtons.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-selected', 'false');
      });
      orgPanes.forEach(p => p.classList.remove('active'));

      btn.classList.add('active');
      btn.setAttribute('aria-selected', 'true');
      const activePane = document.getElementById(target);
      if (activePane) {
        activePane.classList.add('active');
      }
    });
  });

  // 5. Accessible Dialog Modals with Light Dismiss
  const setupModal = (modalId, openTriggers, closeTriggers) => {
    const dialog = document.getElementById(modalId);
    if (!dialog) return;

    openTriggers.forEach(selector => {
      document.querySelectorAll(selector).forEach(btn => {
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          dialog.showModal();
        });
      });
    });

    closeTriggers.forEach(selector => {
      dialog.querySelectorAll(selector).forEach(btn => {
        btn.addEventListener('click', () => {
          dialog.close();
        });
      });
    });

    // Fallback light-dismiss for browsers without closedby support (e.g. Safari)
    if (!('closedBy' in HTMLDialogElement.prototype)) {
      dialog.addEventListener('click', (event) => {
        if (event.target !== dialog) return;
        const rect = dialog.getBoundingClientRect();
        const isDialogContent = (
          rect.top <= event.clientY &&
          event.clientY <= rect.top + rect.height &&
          rect.left <= event.clientX &&
          event.clientX <= rect.left + rect.width
        );
        if (!isDialogContent) {
          dialog.close();
        }
      });
    }
  };

  setupModal('guidelinesModal', ['.open-guidelines-btn'], ['.dialog-close-btn', '.close-modal-btn']);
  setupModal('nominationModal', ['.open-nomination-btn'], ['.dialog-close-btn', '.close-modal-btn']);
  setupModal('trackingModal', ['.open-tracking-btn'], ['.dialog-close-btn', '.close-modal-btn']);

  // 6. Nomination Form Dynamic Field Switching
  const form = document.getElementById('nominationForm');
  const individualRadio = document.getElementById('typeIndividual');
  const corporateRadio = document.getElementById('typeCorporate');
  const individualFields = document.getElementById('individualFields');
  const corporateFields = document.getElementById('corporateFields');
  const categorySelect = document.getElementById('nominationCategory');

  const individualCategories = [
    { group: "STAY WELL", items: [
      "INTECARE Preventive Health Leadership Award 2026",
      "INTECARE Community Health Leadership Award 2026",
      "INTECARE Wellness & Lifestyle Medicine Leadership Award 2026",
      "INTECARE Mental Wellbeing Advocacy Award 2026",
      "INTECARE Health Promotion Innovation Award 2026"
    ]},
    { group: "GET WELL", items: [
      "INTECARE Integrative Healthcare Professional Leadership Award 2026",
      "INTECARE Patient-Centred Care Leadership Award 2026",
      "INTECARE Evidence-Based Medicine Leadership Award 2026",
      "INTECARE Healthcare Innovation in Care Delivery Award 2026",
      "INTECARE Clinical Excellence Leadership Award 2026"
    ]},
    { group: "RECOVER WELL", items: [
      "INTECARE Rehabilitation Leadership Award 2026",
      "INTECARE Recovery & Functional Healthcare Leadership Award 2026",
      "INTECARE Integrated Recovery Care Leadership Award 2026",
      "INTECARE Mental Health Recovery Leadership Award 2026",
      "INTECARE Independent Living & Social Care Leadership Award 2026"
    ]},
    { group: "AGE WELL", items: [
      "INTECARE Healthy Ageing Advocacy Award 2026",
      "INTECARE Active Ageing Leadership Award 2026",
      "INTECARE Longevity & Lifestyle Innovation Award 2026",
      "INTECARE Age-Friendly Healthcare Leadership Award 2026",
      "INTECARE Excellence in Ageing & Quality of Life Leadership Award 2026"
    ]}
  ];

  const corporateCategories = [
    { group: "ORGANISATIONAL EXCELLENCE", items: [
      "INTECARE Healthcare Organisation Excellence Award 2026",
      "INTECARE Wellness Organisation Excellence Award 2026",
      "INTECARE Healthcare Brand Excellence Award 2026",
      "INTECARE Emerging Healthcare Enterprise Excellence Award 2026",
      "INTECARE Excellence in Healthcare Impact Award 2026"
    ]},
    { group: "INNOVATION & TRANSFORMATION", items: [
      "INTECARE Healthcare Innovation Excellence Award 2026",
      "INTECARE Digital Health Transformation Excellence Award 2026",
      "INTECARE Health Technology Excellence Award 2026",
      "INTECARE Integrative Healthcare Innovation Excellence Award 2026",
      "INTECARE Future of Healthcare Excellence Award 2026"
    ]},
    { group: "PEOPLE, WORKPLACE & COMMUNITY", items: [
      "INTECARE Employer of Choice – Healthcare & Wellness Excellence Award 2026",
      "INTECARE Healthcare Workforce Development Excellence Award 2026",
      "INTECARE Excellence in Employee Wellbeing Award 2026",
      "INTECARE Community Partnership Excellence Award 2026",
      "INTECARE Social Impact & Community Development Excellence Award 2026"
    ]},
    { group: "INDUSTRY, SUSTAINABILITY & ECOSYSTEM", items: [
      "INTECARE Sustainable Healthcare Excellence Award 2026",
      "INTECARE Healthcare Ecosystem Partnership Excellence Award 2026",
      "INTECARE Excellence in Healthcare Enterprise Development Award 2026",
      "INTECARE Healthcare Investment & Growth Excellence Award 2026",
      "INTECARE Outstanding Contribution to the Healthcare & Wellness Economy Award 2026"
    ]}
  ];

  const populateCategories = (type) => {
    if (!categorySelect) return;
    categorySelect.innerHTML = '<option value="">-- Please Select an Official Category --</option>';
    const dataset = type === 'corporate' ? corporateCategories : individualCategories;

    dataset.forEach(grp => {
      const optgroup = document.createElement('optgroup');
      optgroup.label = grp.group;
      grp.items.forEach(award => {
        const opt = document.createElement('option');
        opt.value = award;
        opt.textContent = award;
        optgroup.appendChild(opt);
      });
      categorySelect.appendChild(optgroup);
    });
  };

  const updateNomineeType = () => {
    if (corporateRadio && corporateRadio.checked) {
      if (individualFields) individualFields.style.display = 'none';
      if (corporateFields) corporateFields.style.display = 'block';
      populateCategories('corporate');
    } else {
      if (individualFields) individualFields.style.display = 'block';
      if (corporateFields) corporateFields.style.display = 'none';
      populateCategories('individual');
    }
  };

  if (individualRadio && corporateRadio) {
    individualRadio.addEventListener('change', updateNomineeType);
    corporateRadio.addEventListener('change', updateNomineeType);
    updateNomineeType();

    // Auto-select stream and category when card nomination button is clicked
    document.querySelectorAll('.open-nomination-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const stream = btn.getAttribute('data-stream');
        const awardTitle = btn.getAttribute('data-award-title');

        if (stream === 'corporate' && corporateRadio) {
          corporateRadio.checked = true;
          updateNomineeType();
        } else if (stream === 'individual' && individualRadio) {
          individualRadio.checked = true;
          updateNomineeType();
        }

        if (awardTitle && categorySelect) {
          const needle = awardTitle.toLowerCase().trim();
          for (let i = 0; i < categorySelect.options.length; i++) {
            const opt = categorySelect.options[i];
            const optVal = (opt.value || '').toLowerCase();
            const optTxt = (opt.text || '').toLowerCase();
            if (optVal && (optVal.includes(needle) || needle.includes(optVal) || optTxt.includes(needle) || needle.includes(optTxt))) {
              categorySelect.selectedIndex = i;
              break;
            }
          }
        }
      });
    });
  }

  // 7. Nomination Form Submission & Real Asynchronous Feedback
  const rationaleTextarea = document.getElementById('nominationRationale');
  const wordCountBadge = document.getElementById('rationaleWordCount');
  const formAlert = document.getElementById('nominationFormAlert');
  const csrfInput = document.getElementById('nominationCsrfToken');

  // Word Counter & 300-word constraint checker
  const updateWordCount = () => {
    if (!rationaleTextarea || !wordCountBadge) return 0;
    const text = rationaleTextarea.value.trim();
    const words = text ? text.split(/\s+/).length : 0;
    wordCountBadge.textContent = `${words} / 300 words`;
    
    if (words > 300) {
      wordCountBadge.classList.add('limit-exceeded');
      wordCountBadge.classList.remove('limit-warning');
    } else if (words > 270) {
      wordCountBadge.classList.add('limit-warning');
      wordCountBadge.classList.remove('limit-exceeded');
    } else {
      wordCountBadge.classList.remove('limit-warning', 'limit-exceeded');
    }
    return words;
  };

  if (rationaleTextarea) {
    rationaleTextarea.addEventListener('input', updateWordCount);
    rationaleTextarea.addEventListener('change', updateWordCount);
    updateWordCount();
  }

  // Clear previous validation errors
  const clearFormErrors = () => {
    if (formAlert) {
      formAlert.style.display = 'none';
      formAlert.textContent = '';
      formAlert.className = 'nomination-alert alert-danger';
    }
    if (form) {
      form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
      form.querySelectorAll('.field-error-text').forEach(el => el.remove());
    }
  };

  // Display specific field error
  const setFieldError = (fieldId, message) => {
    const field = document.getElementById(fieldId);
    if (!field) return;
    field.classList.add('is-invalid');
    const parent = field.parentElement;
    const existingMsg = parent.querySelector('.field-error-text');
    if (!existingMsg) {
      const err = document.createElement('span');
      err.className = 'field-error-text';
      err.textContent = message;
      parent.appendChild(err);
    } else {
      existingMsg.textContent = message;
    }
  };

  // Helper: resolve API URL dynamically based on current path
  const getNominationApiUrl = () => {
    const path = window.location.pathname.toLowerCase();
    if (path.startsWith('/intecare')) {
      return '/INTECARE/nomination.php';
    }
    return 'nomination.php';
  };

  // Fetch or retrieve session CSRF token
  const fetchCsrfToken = async (forceRefresh = false) => {
    if (!forceRefresh && csrfInput && csrfInput.value && csrfInput.value.length === 64) {
      return csrfInput.value;
    }
    const apiUrl = getNominationApiUrl();
    try {
      const res = await fetch(`${apiUrl}?action=csrf`, {
        credentials: 'same-origin',
        headers: { 'Accept': 'application/json' }
      });
      const data = await res.json();
      if (data && data.csrf_token) {
        if (csrfInput) csrfInput.value = data.csrf_token;
        return data.csrf_token;
      }
    } catch (e) {
      console.warn('Could not retrieve CSRF token:', e);
    }
    return csrfInput?.value || '';
  };

  // Initial CSRF prefetch on page load and modal open
  fetchCsrfToken();
  document.querySelectorAll('.open-nomination-btn').forEach(btn => {
    btn.addEventListener('click', () => { fetchCsrfToken(); });
  });

  if (form) {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
      clearFormErrors();

      const submitBtn = form.querySelector('button[type="submit"]');
      const originalBtnHtml = submitBtn.innerHTML;

      // 1. Client-Side Pre-validation
      const isCorporate = corporateRadio && corporateRadio.checked;
      const categoryVal = categorySelect ? categorySelect.value.trim() : '';
      const emailVal = document.getElementById('nominatorEmail')?.value.trim() || '';
      const phoneVal = document.getElementById('nominatorPhone')?.value.trim() || '';
      const rationaleVal = rationaleTextarea ? rationaleTextarea.value.trim() : '';

      let clientValid = true;

      if (!categoryVal) {
        setFieldError('nominationCategory', 'Please select an official award category.');
        clientValid = false;
      }

      if (isCorporate) {
        const companyName = document.getElementById('companyName')?.value.trim() || '';
        const companyReg = document.getElementById('companyReg')?.value.trim() || '';
        if (!companyName) {
          setFieldError('companyName', 'Company or organisation name is required.');
          clientValid = false;
        }
        if (!companyReg) {
          setFieldError('companyReg', 'Company registration number or industry is required.');
          clientValid = false;
        }
      } else {
        const nomineeName = document.getElementById('nomineeName')?.value.trim() || '';
        const nomineeDesignation = document.getElementById('nomineeDesignation')?.value.trim() || '';
        if (!nomineeName) {
          setFieldError('nomineeName', 'Nominee full name with title is required.');
          clientValid = false;
        }
        if (!nomineeDesignation) {
          setFieldError('nomineeDesignation', 'Nominee designation or speciality is required.');
          clientValid = false;
        }
      }

      if (!emailVal || !emailVal.includes('@')) {
        setFieldError('nominatorEmail', 'Please enter a valid official work email.');
        clientValid = false;
      }

      if (!phoneVal) {
        setFieldError('nominatorPhone', 'Contact telephone number is required.');
        clientValid = false;
      }

      const words = updateWordCount();
      if (!rationaleVal) {
        setFieldError('nominationRationale', 'Executive summary of achievements is required.');
        clientValid = false;
      } else if (words > 300) {
        setFieldError('nominationRationale', `Executive summary exceeds the 300-word limit (${words} words). Please condense your text.`);
        clientValid = false;
      } else if (rationaleVal.length < 20) {
        setFieldError('nominationRationale', 'Please provide a meaningful summary of achievements (minimum 20 characters).');
        clientValid = false;
      }

      if (!clientValid) {
        if (formAlert) {
          formAlert.textContent = 'Please review and resolve the highlighted errors below before submitting.';
          formAlert.style.display = 'block';
        }
        return;
      }

      // 2. Prepare Form Data & CSRF Token
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span>Processing Submission...</span>';

      try {
        let token = csrfInput?.value || '';
        if (!token || token.length !== 64) {
          token = await fetchCsrfToken(true);
        }

        const formData = new FormData(form);
        if (token) {
          formData.set('csrf_token', token);
        }

        const apiUrl = getNominationApiUrl();
        let response = await fetch(apiUrl, {
          method: 'POST',
          body: formData,
          credentials: 'same-origin',
          headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          }
        });

        let json;
        try {
          json = await response.json();
        } catch (jsonErr) {
          throw new Error('Server returned an unexpected response format. Please try again.');
        }

        // Automatic retry once if session expired or token mismatch occurred
        if (response.status === 403 && json && json.message && json.message.toLowerCase().includes('token')) {
          const freshToken = await fetchCsrfToken(true);
          if (freshToken) {
            formData.set('csrf_token', freshToken);
            response = await fetch(apiUrl, {
              method: 'POST',
              body: formData,
              credentials: 'same-origin',
              headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
              }
            });
            try {
              json = await response.json();
            } catch (retryJsonErr) {
              throw new Error('Server returned an unexpected response format.');
            }
          }
        }

        // Update token if returned
        if (json.csrf_token && csrfInput) {
          csrfInput.value = json.csrf_token;
        }

        if (response.ok && json.success) {
          // Success: populate success view
          const formView = document.getElementById('nominationFormView');
          const successView = document.getElementById('nominationSuccessView');
          const refCodeEl = document.getElementById('successTrackingRef');
          const catEl = document.getElementById('successCategory');
          const nomEl = document.getElementById('successNominee');
          const msgEl = document.getElementById('successReceiptMessage');

          if (refCodeEl) refCodeEl.textContent = json.data.tracking_reference;
          if (catEl) catEl.textContent = json.data.category;
          if (nomEl) {
            nomEl.textContent = json.data.nominee_type === 'individual'
              ? (json.data.nominee_name || 'Individual Nominee')
              : (json.data.company_name || 'Corporate Nominee');
          }
          if (msgEl) {
            if (json.data.email_sent) {
              msgEl.textContent = 'Thank you for submitting your nomination. An official confirmation email and dossier tracking reference have been transmitted to ' + json.data.nominator_email + '. Your submission is currently pending review.';
            } else {
              msgEl.textContent = 'Thank you for submitting your nomination for the INTECARE Excellence Award 2026. Your dossier has been securely recorded and queued for review by the Evaluation Committee.';
            }
          }

          if (formView && successView) {
            formView.style.display = 'none';
            successView.style.display = 'block';
          }
        } else {
          // Validation error or business logic failure
          if (formAlert) {
            formAlert.textContent = json.message || 'Validation failed. Please review your submission.';
            formAlert.style.display = 'block';
          }

          if (json.errors && typeof json.errors === 'object') {
            for (const [key, msg] of Object.entries(json.errors)) {
              setFieldError(key, msg);
            }
          }
        }
      } catch (networkError) {
        console.error('Nomination submission error:', networkError);
        if (formAlert) {
          formAlert.textContent = networkError.message || 'A network error occurred while communicating with the server. Please check your connection and try again.';
          formAlert.style.display = 'block';
        }
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHtml;
      }
    });
  }

  // Copy tracking reference to clipboard
  const copyBtn = document.getElementById('copyRefBtn');
  if (copyBtn) {
    copyBtn.addEventListener('click', async () => {
      const refText = document.getElementById('successTrackingRef')?.textContent?.trim();
      const toast = document.getElementById('copyToast');
      if (refText) {
        try {
          await navigator.clipboard.writeText(refText);
          if (toast) {
            toast.style.display = 'block';
            setTimeout(() => { toast.style.display = 'none'; }, 2500);
          }
        } catch (e) {
          const ta = document.createElement('textarea');
          ta.value = refText;
          document.body.appendChild(ta);
          ta.select();
          document.execCommand('copy');
          document.body.removeChild(ta);
          if (toast) {
            toast.style.display = 'block';
            setTimeout(() => { toast.style.display = 'none'; }, 2500);
          }
        }
      }
    });
  }

  // Reset form when dialog closes or user clicks restart
  const restartBtn = document.getElementById('restartNominationBtn');
  if (restartBtn) {
    restartBtn.addEventListener('click', () => {
      const formView = document.getElementById('nominationFormView');
      const successView = document.getElementById('nominationSuccessView');
      if (formView && successView) {
        formView.style.display = 'block';
        successView.style.display = 'none';
        if (form) form.reset();
        clearFormErrors();
        if (individualRadio) individualRadio.checked = true;
        updateNomineeType();
        updateWordCount();
      }
    });
  }

  // ==========================================================================
  // 7B. SECURE TRACKING PORTAL & PROGRESS STEPPER (Option A)
  // ==========================================================================
  const trackingModal = document.getElementById('trackingModal');
  const trackingForm = document.getElementById('trackingForm');
  const trackingFormAlert = document.getElementById('trackingFormAlert');
  const trackingLookupView = document.getElementById('trackingLookupView');
  const trackingResultView = document.getElementById('trackingResultView');
  const trackRefInput = document.getElementById('trackRefInput');
  const trackEmailInput = document.getElementById('trackEmailInput');
  const trackingCsrfInput = document.getElementById('trackingCsrfToken');

  const standaloneTrackingForm = document.getElementById('standaloneTrackingForm');
  const standaloneTrackingAlert = document.getElementById('standaloneTrackingAlert');
  const standaloneLookupView = document.getElementById('standaloneLookupFormView');
  const standaloneResultView = document.getElementById('standaloneTrackingResultView');
  const standaloneTrackRef = document.getElementById('standaloneTrackRef');
  const standaloneTrackEmail = document.getElementById('standaloneTrackEmail');

  const getTrackingApiUrl = () => {
    const path = window.location.pathname.toLowerCase();
    if (path.startsWith('/intecare')) {
      return '/INTECARE/track-status.php';
    }
    return 'track-status.php';
  };

  // Build the complete visual status result HTML (stepper, status pill, details card, next steps)
  const renderTrackingResultHtml = (data, isModal = true) => {
    const statusKey = (data.status_key || 'pending').toLowerCase().replace(/\s+/g, '_');
    
    // Status Badge Text Mapping
    const statusBadgeLabels = {
      shortlisted: 'OFFICIALLY SHORTLISTED',
      under_review: 'EVALUATION IN PROGRESS',
      pending: 'AWAITING COMMITTEE CONVENING',
      approved: 'CONFIRMED GALA FINALIST',
      rejected: 'EVALUATION CONCLUDED'
    };
    const statusBadgeText = statusBadgeLabels[statusKey] || 'OFFICIAL STATUS';

    // Step icon generator (Strictly no emojis! SVG line icons only)
    const checkIcon = `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"></polyline></svg>`;
    const crossIcon = `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>`;

    let stepperHtml = '<div class="tracking-stepper">';
    (data.steps || []).forEach(step => {
      const stateClass = step.state || 'upcoming';
      const stepNumStr = step.step < 10 ? `0${step.step}` : `${step.step}`;
      let icon = stepNumStr;
      if (stateClass === 'completed') icon = checkIcon;
      if (stateClass === 'rejected') icon = crossIcon;

      stepperHtml += `
        <div class="step-item ${stateClass}">
          <div class="step-node-wrap">
            <div class="step-node" aria-hidden="true">${icon}</div>
            <div class="step-line" aria-hidden="true"></div>
          </div>
          <div class="step-content">
            <div class="step-title">${step.name}</div>
            <div class="step-desc">${step.description}</div>
          </div>
        </div>
      `;
    });
    stepperHtml += '</div>';

    const nomineeTypeLabel = data.nominee_type === 'individual' ? 'Individual Excellence Award' : 'Corporate Excellence Award';
    const closeActionHtml = isModal
      ? `<button type="button" class="btn btn-secondary close-modal-btn">Close</button>`
      : '';

    const statusTitle = data.status_title || (data.status === 'Approved' ? 'GALA FINALIST' : data.status.toUpperCase());
    const statusSummary = data.status_summary || data.next_steps;

    return `
      <div class="tracking-result-inner">
        <!-- Top Verification Header Row -->
        <div class="tracking-ref-banner">
          <div class="tracking-ref-group">
            <span class="tracking-ref-eyebrow">OFFICIAL TRACKING REFERENCE</span>
            <span class="tracking-ref-code">${data.tracking_reference}</span>
          </div>
          <div class="tracking-verified-tag">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
              <polyline points="9 12 11 14 15 10"></polyline>
            </svg>
            <span>VERIFIED REGISTRY DOSSIER</span>
          </div>
        </div>

        <!-- 1. HERO STATUS CARD (PRIMARY VISUAL FOCUS) -->
        <div class="hero-status-card status-${statusKey}" role="region" aria-label="Current nomination status">
          <div class="hero-status-header">
            <span class="hero-status-eyebrow">CURRENT NOMINATION STATUS</span>
            <span class="hero-status-badge">
              <span class="status-indicator-dot" aria-hidden="true"></span>
              <span class="status-badge-text">${statusBadgeText}</span>
            </span>
          </div>
          <h2 class="hero-status-title">${statusTitle}</h2>
          <div class="hero-status-divider" aria-hidden="true"></div>
          <p class="hero-status-desc">${statusSummary}</p>
        </div>

        <!-- 2. PROGRESS STEPPER (Structured Editorial Timeline) -->
        <div class="tracking-stepper-wrap">
          <div class="tracking-stepper-label">OFFICIAL EVALUATION PROGRESSION</div>
          ${stepperHtml}
        </div>

        <!-- 3. NOMINATION DETAILS (Clean Editorial Information Grid) -->
        <div class="dossier-meta-card">
          <div class="dossier-meta-header">
            <div class="dossier-stream-pill ${data.nominee_type}">
              <span class="stream-dot" aria-hidden="true"></span>
              <span class="stream-name">${nomineeTypeLabel}</span>
            </div>
            <span class="dossier-meta-ref">Reference: <code>${data.tracking_reference}</code></span>
          </div>

          <div class="dossier-details-grid">
            <div class="dossier-field-block">
              <span class="dossier-field-label">NOMINEE / ORGANISATION</span>
              <div class="dossier-nominee-val">${data.nominee_display}</div>
            </div>

            <div class="dossier-field-block">
              <span class="dossier-field-label">AWARD CATEGORY</span>
              <div class="dossier-category-box">
                <svg class="category-icon-svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#075B68" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <circle cx="12" cy="8" r="7"></circle>
                  <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                </svg>
                <span class="category-name">${data.category}</span>
              </div>
            </div>
          </div>

          <div class="dossier-dates-grid">
            <div class="dossier-date-item">
              <span class="dossier-field-label">DATE DOSSIER RECEIVED</span>
              <div class="dossier-date-val">${data.submitted_date}</div>
            </div>
            <div class="dossier-date-item">
              <span class="dossier-field-label">LAST STATUS UPDATE</span>
              <div class="dossier-date-val">${data.last_updated}</div>
            </div>
          </div>
        </div>

        <!-- 4. OFFICIAL STATUS NOTICE & SECRETARIAT BRIEFING -->
        <div class="tracking-callout-box">
          <div class="callout-header-bar">
            <span class="callout-eyebrow">OFFICIAL STATUS NOTICE • SECRETARIAT BRIEFING</span>
          </div>
          <p class="callout-body-text">${data.next_steps}</p>
          
          <div class="callout-milestone-deck">
            <div class="milestone-entry">
              <div class="milestone-icon-box">
                <svg class="milestone-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                  <line x1="16" y1="2" x2="16" y2="6"></line>
                  <line x1="8" y1="2" x2="8" y2="6"></line>
                  <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
              </div>
              <div class="milestone-info">
                <span class="milestone-tag">GALA PRESENTATION</span>
                <span class="milestone-text">${data.gala_date}</span>
              </div>
            </div>
            <div class="milestone-entry">
              <div class="milestone-icon-box">
                <svg class="milestone-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
              </div>
              <div class="milestone-info">
                <span class="milestone-tag">OFFICIAL VENUE</span>
                <span class="milestone-text">${data.gala_venue}</span>
              </div>
            </div>
          </div>
        </div>

        <!-- 5. Actions Bar -->
        <div class="tracking-actions-bar">
          <button type="button" class="btn btn-outline-cyan" id="${isModal ? 'btnCheckAnotherModal' : 'btnCheckAnotherStandalone'}">
            <span>← Check Another Dossier</span>
          </button>
          ${closeActionHtml}
        </div>
      </div>
    `;
  };

  // Perform secure tracking verification via Fetch API (Reference Only)
  const executeStatusLookup = async (reference, alertEl, submitBtn, resultContainer, formContainer, isModal = true) => {
    if (alertEl) {
      alertEl.style.display = 'none';
      alertEl.innerHTML = '';
    }

    const cleanRef = (reference || '')
      .replace(/[\u2010\u2011\u2012\u2013\u2014\u2015\u2212\uFE58\uFE63\uFF0D]/g, '-')
      .trim()
      .toUpperCase();

    if (trackRefInput && trackRefInput.value !== cleanRef) trackRefInput.value = cleanRef;
    if (standaloneTrackRef && standaloneTrackRef.value !== cleanRef) standaloneTrackRef.value = cleanRef;

    // Client pre-validation on reference only
    if (!cleanRef || !/^INT26-[A-F0-9]{8}$/i.test(cleanRef)) {
      if (alertEl) {
        alertEl.innerHTML = '<strong>INVALID REFERENCE FORMAT</strong><div style="margin-top: 0.25rem;">Please enter a valid tracking reference in the format INT26-XXXXXXXX.</div>';
        alertEl.style.display = 'block';
      }
      return false;
    }

    const originalBtnText = submitBtn ? submitBtn.innerHTML : '';
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span>Checking Status...</span>';
    }

    try {
      let token = trackingCsrfInput?.value || csrfInput?.value || '';
      if (!token || token.length !== 64) {
        token = await fetchCsrfToken(true);
      }

      const formData = new FormData();
      formData.append('action', 'track');
      formData.append('csrf_token', token);
      formData.append('tracking_reference', cleanRef);

      const apiUrl = getTrackingApiUrl();
      const response = await fetch(apiUrl, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      });

      const json = await response.json();

      if (json.csrf_token) {
        if (trackingCsrfInput) trackingCsrfInput.value = json.csrf_token;
        if (csrfInput) csrfInput.value = json.csrf_token;
      }

      if (response.ok && json.success && json.data) {
        // Render verified tracking result
        if (resultContainer && formContainer) {
          resultContainer.innerHTML = renderTrackingResultHtml(json.data, isModal);
          formContainer.style.display = 'none';
          resultContainer.style.display = 'block';

          // Wire "Check Another Dossier" button
          const checkAnotherBtn = resultContainer.querySelector(isModal ? '#btnCheckAnotherModal' : '#btnCheckAnotherStandalone');
          if (checkAnotherBtn) {
            checkAnotherBtn.addEventListener('click', () => {
              resultContainer.style.display = 'none';
              formContainer.style.display = 'block';
              if (alertEl) alertEl.style.display = 'none';
            });
          }

          // Wire close button inside modal results
          if (isModal) {
            resultContainer.querySelectorAll('.close-modal-btn').forEach(btn => {
              btn.addEventListener('click', () => {
                if (trackingModal) trackingModal.close();
              });
            });
          }
        }
        return true;
      } else {
        if (alertEl) {
          const errTitle = json.title || 'TRACKING REFERENCE NOT FOUND';
          const errMsg = json.message || 'Please check your official tracking reference and try again.';
          alertEl.innerHTML = `<strong>${errTitle}</strong><div style="margin-top: 0.25rem;">${errMsg}</div>`;
          alertEl.style.display = 'block';
        }
        return false;
      }
    } catch (networkErr) {
      console.error('Tracking request error:', networkErr);
      if (alertEl) {
        alertEl.innerHTML = '<strong>NETWORK ERROR</strong><div style="margin-top: 0.25rem;">A connection error occurred. Please check your network and try again.</div>';
        alertEl.style.display = 'block';
      }
      return false;
    } finally {
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
      }
    }
  };

  // Automatically normalize unicode dashes and lowercase input on paste/typing
  const normalizeRefInput = (inputEl) => {
    if (!inputEl) return;
    inputEl.addEventListener('input', () => {
      const val = inputEl.value.replace(/[\u2010\u2011\u2012\u2013\u2014\u2015\u2212\uFE58\uFE63\uFF0D]/g, '-').toUpperCase();
      if (inputEl.value !== val) {
        inputEl.value = val;
      }
    });
  };
  normalizeRefInput(trackRefInput);
  normalizeRefInput(standaloneTrackRef);

  // Wire Modal Form Submission
  if (trackingForm) {
    trackingForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const ref = trackRefInput?.value || '';
      const submitBtn = trackingForm.querySelector('button[type="submit"]');
      executeStatusLookup(ref, trackingFormAlert, submitBtn, trackingResultView, trackingLookupView, true);
    });
  }

  // Wire Standalone Page Form Submission (if on track-status.php)
  if (standaloneTrackingForm) {
    standaloneTrackingForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const ref = standaloneTrackRef?.value || '';
      const submitBtn = standaloneTrackingForm.querySelector('button[type="submit"]');
      executeStatusLookup(ref, standaloneTrackingAlert, submitBtn, standaloneResultView, standaloneLookupView, false);
    });
  }

  // Connect Nomination Success Screen Button directly to Tracking Modal
  const successTrackStatusBtn = document.getElementById('successTrackStatusBtn');
  if (successTrackStatusBtn) {
    successTrackStatusBtn.addEventListener('click', (e) => {
      e.preventDefault();
      const nominationModal = document.getElementById('nominationModal');
      const refText = document.getElementById('successTrackingRef')?.textContent?.trim() || '';

      if (nominationModal) nominationModal.close();
      if (trackingModal) {
        trackingModal.showModal();
        if (trackRefInput) trackRefInput.value = refText;

        // Auto-run lookup immediately if ref is present
        if (refText) {
          const submitBtn = trackingForm ? trackingForm.querySelector('button[type="submit"]') : null;
          executeStatusLookup(refText, trackingFormAlert, submitBtn, trackingResultView, trackingLookupView, true);
        }
      }
    });
  }

  // Auto-detect URL parameter ?track=INT26-XXXXXXXX or ?ref=INT26-XXXXXXXX on page load
  const urlParams = new URLSearchParams(window.location.search);
  const trackParam = urlParams.get('track') || urlParams.get('ref');
  if (trackParam && /^INT26-[A-F0-9]{8}$/i.test(trackParam.trim())) {
    const cleanParam = trackParam.trim().toUpperCase();
    if (trackRefInput) trackRefInput.value = cleanParam;
    if (standaloneTrackRef) standaloneTrackRef.value = cleanParam;

    if (standaloneTrackingForm) {
      const submitBtn = standaloneTrackingForm.querySelector('button[type="submit"]');
      executeStatusLookup(cleanParam, standaloneTrackingAlert, submitBtn, standaloneResultView, standaloneLookupView, false);
    } else if (trackingModal) {
      trackingModal.showModal();
      const submitBtn = trackingForm ? trackingForm.querySelector('button[type="submit"]') : null;
      executeStatusLookup(cleanParam, trackingFormAlert, submitBtn, trackingResultView, trackingLookupView, true);
    }
  }

  // ==========================================================================
  // 8. HERO LIVE EVENT COUNTDOWN (Target: 27 November 2026, 19:30:00 GMT+8)
  // ==========================================================================
  const galaDate = new Date('2026-11-27T19:30:00+08:00').getTime();
  const cdDays = document.getElementById('cdDays');
  const cdHours = document.getElementById('cdHours');
  const cdMins = document.getElementById('cdMins');
  const cdSecs = document.getElementById('cdSecs');

  const updateCountdown = () => {
    const now = new Date().getTime();
    const distance = galaDate - now;

    if (distance > 0) {
      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      if (cdDays) cdDays.textContent = String(days).padStart(2, '0');
      if (cdHours) cdHours.textContent = String(hours).padStart(2, '0');
      if (cdMins) cdMins.textContent = String(minutes).padStart(2, '0');
      if (cdSecs) cdSecs.textContent = String(seconds).padStart(2, '0');
    } else {
      if (cdDays) cdDays.textContent = '00';
      if (cdHours) cdHours.textContent = '00';
      if (cdMins) cdMins.textContent = '00';
      if (cdSecs) cdSecs.textContent = '00';
    }
  };

  updateCountdown();
  setInterval(updateCountdown, 1000);

  // ==========================================================================
  // 8B. INTERACTIVE DRAGGABLE FLOATING COUNTDOWN
  // Allows the user to freely click and drag the countdown anywhere across the hero
  // ==========================================================================
  const countdownEl = document.getElementById('eventCountdown');
  const heroContainer = document.querySelector('.hero-container');

  if (countdownEl && heroContainer) {
    let isDragging = false;
    let startPointerX = 0;
    let startPointerY = 0;
    let startElementLeft = 0;
    let startElementTop = 0;

    // Restore previously dragged position if saved in current session (desktop only)
    if (window.innerWidth > 1024) {
      try {
        const saved = sessionStorage.getItem('intecare_hero_cd_pos');
        if (saved) {
          const { left, top } = JSON.parse(saved);
          countdownEl.style.left = `${left}px`;
          countdownEl.style.top = `${top}px`;
          countdownEl.style.right = 'auto';
          countdownEl.style.bottom = 'auto';
        }
      } catch (e) {}
    }

    const startDrag = (e) => {
      // Only drag on primary pointer button (left click) or touch
      if (e.button !== undefined && e.button !== 0) return;
      if (window.innerWidth <= 1024) return; // Allow natural document stacking on mobile

      isDragging = true;
      countdownEl.classList.add('is-dragging');

      try {
        countdownEl.setPointerCapture(e.pointerId);
      } catch (err) {}

      const parentRect = heroContainer.getBoundingClientRect();
      const elRect = countdownEl.getBoundingClientRect();

      // Convert from right/clamp to explicit pixel offset within heroContainer
      startElementLeft = elRect.left - parentRect.left;
      startElementTop = elRect.top - parentRect.top;

      countdownEl.style.left = `${startElementLeft}px`;
      countdownEl.style.top = `${startElementTop}px`;
      countdownEl.style.right = 'auto';
      countdownEl.style.bottom = 'auto';

      startPointerX = e.clientX;
      startPointerY = e.clientY;

      document.body.style.userSelect = 'none';
      document.body.style.webkitUserSelect = 'none';

      e.preventDefault();
    };

    const onDrag = (e) => {
      if (!isDragging) return;

      const parentRect = heroContainer.getBoundingClientRect();
      const elRect = countdownEl.getBoundingClientRect();

      const deltaX = e.clientX - startPointerX;
      const deltaY = e.clientY - startPointerY;

      let newLeft = startElementLeft + deltaX;
      let newTop = startElementTop + deltaY;

      // Keep within boundaries of the hero container with comfortable padding
      const maxLeft = parentRect.width - elRect.width - 8;
      const maxTop = parentRect.height - elRect.height - 8;

      newLeft = Math.max(8, Math.min(newLeft, maxLeft));
      newTop = Math.max(8, Math.min(newTop, maxTop));

      countdownEl.style.left = `${newLeft}px`;
      countdownEl.style.top = `${newTop}px`;
    };

    const stopDrag = (e) => {
      if (!isDragging) return;
      isDragging = false;
      countdownEl.classList.remove('is-dragging');

      document.body.style.userSelect = '';
      document.body.style.webkitUserSelect = '';

      try {
        countdownEl.releasePointerCapture(e.pointerId);
      } catch (err) {}

      // Save position to session
      const parentRect = heroContainer.getBoundingClientRect();
      const elRect = countdownEl.getBoundingClientRect();
      const currentLeft = Math.round(elRect.left - parentRect.left);
      const currentTop = Math.round(elRect.top - parentRect.top);

      try {
        sessionStorage.setItem('intecare_hero_cd_pos', JSON.stringify({ left: currentLeft, top: currentTop }));
      } catch (err) {}
    };

    countdownEl.addEventListener('pointerdown', startDrag);
    countdownEl.addEventListener('pointermove', onDrag);
    countdownEl.addEventListener('pointerup', stopDrag);
    countdownEl.addEventListener('pointercancel', stopDrag);

    // Double-click resets to default floating location
    countdownEl.addEventListener('dblclick', () => {
      countdownEl.style.left = '';
      countdownEl.style.top = '';
      countdownEl.style.right = '';
      countdownEl.style.bottom = '';
      try {
        sessionStorage.removeItem('intecare_hero_cd_pos');
      } catch (e) {}
    });

    // Reset when resizing across mobile / desktop breakpoints
    window.addEventListener('resize', () => {
      if (window.innerWidth <= 1024) {
        countdownEl.style.left = '';
        countdownEl.style.top = '';
        countdownEl.style.right = '';
        countdownEl.style.bottom = '';
      }
    }, { passive: true });
  }

  // ==========================================================================
  // 9. SUBTLE POINTER-RESPONSIVE ARTWORK PARALLAX & TILT
  // ==========================================================================
  const heroVisual = document.getElementById('heroVisualCollage') || document.querySelector('.hero-visual-collage');
  const heroArtwork = document.querySelector('.hero-collage-container') || document.querySelector('.hero-master-collage-wrap') || document.getElementById('heroArtworkCanvas');
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

  if (heroVisual && heroArtwork && !prefersReducedMotion.matches) {
    let ticking = false;

    const handlePointerMove = (e) => {
      if (ticking || window.innerWidth < 1024) return;
      ticking = true;

      requestAnimationFrame(() => {
        const rect = heroVisual.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        const relX = (e.clientX - centerX) / (rect.width / 2);
        const relY = (e.clientY - centerY) / (rect.height / 2);

        const clampX = Math.max(-1, Math.min(1, relX));
        const clampY = Math.max(-1, Math.min(1, relY));

        heroArtwork.style.transform = `perspective(1000px) rotateY(${clampX * 3.5}deg) rotateX(${-clampY * 2.5}deg) translate3d(${clampX * 6}px, ${clampY * 4}px, 0)`;

        ticking = false;
      });
    };

    const handlePointerLeave = () => {
      heroArtwork.style.transform = 'perspective(1000px) rotateY(0deg) rotateX(0deg) translate3d(0, 0, 0)';
    };

    heroVisual.addEventListener('pointermove', handlePointerMove, { passive: true });
    heroVisual.addEventListener('pointerleave', handlePointerLeave);
  }

  // ==========================================================================
  // 11. HWED ECOSYSTEM INTERACTIVE ARCHITECTURE SUITE
  // Complete interactive experience for Orbit, 5 Pillars, and Impact Explorer
  // ==========================================================================

  // --- A. HWED Orbit Interactive Controller ---
  const orbitNodes = document.querySelectorAll('.hwed-orbit-node');
  const orbitMobilePills = document.querySelectorAll('.hwed-m-pill');
  const orbitCenterHub = document.getElementById('orbitCenterHub');
  const orbitResetBtn = document.getElementById('orbitResetBtn');
  const orbitDomainBadge = document.getElementById('orbitDomainBadge');
  const orbitDomainTitle = document.getElementById('orbitDomainTitle');
  const orbitDomainDesc = document.getElementById('orbitDomainDesc');
  const orbitTagsLabel = document.getElementById('orbitTagsLabel');
  const orbitDomainTags = document.getElementById('orbitDomainTags');

  if (orbitDomainTitle) {
    const domainData = {
      core: {
        badge: 'CENTRAL ARCHITECTURE • INTEGRATED CORE',
        title: 'ONE ECOSYSTEM',
        desc: 'Healthcare & Wellness Economy Development (HWED) serves as the unifying national platform connecting science, technology, clinical practice, enterprise, and investment into an integrated economic engine for the health lifecycle.',
        label: 'Core Ecosystem Facets:',
        tags: ['6 Connected Domains', '5 Strategic Pillars', 'Lifelong Value Creation']
      },
      science: {
        badge: 'DOMAIN 01 • DISCOVERY & TRANSLATION',
        title: '01. SCIENCE & RESEARCH',
        desc: 'Pioneering clinical research, evidence generation, translational science, and biomedical breakthroughs that form the scientific foundation of progressive health solutions.',
        label: 'Key Domain Focus Areas:',
        tags: ['Translational Science', 'Biomedical Studies', 'Clinical Evidence', 'R&D Pipelines']
      },
      practice: {
        badge: 'DOMAIN 02 • CARE DELIVERY & EXCELLENCE',
        title: '02. CLINICAL PRACTICE',
        desc: 'Frontline medical practice, clinical protocols, multidisciplinary care teams, and patient-centred service standards advancing healthcare delivery.',
        label: 'Key Domain Focus Areas:',
        tags: ['Care Protocols', 'Clinical Standards', 'Multidisciplinary Teams', 'Patient Outcomes']
      },
      technology: {
        badge: 'DOMAIN 03 • INTELLIGENCE & INFRASTRUCTURE',
        title: '03. TECHNOLOGY & AI',
        desc: 'Next-generation MedTech, digital health systems, clinical AI analytics, diagnostic IoT, and smart care infrastructure accelerating transformation.',
        label: 'Key Domain Focus Areas:',
        tags: ['MedTech Innovation', 'Digital Health', 'AI & Analytics', 'IoT Diagnostics']
      },
      enterprise: {
        badge: 'DOMAIN 04 • COMMERCIALISATION & SCALING',
        title: '04. ENTERPRISE & SMES',
        desc: 'Health entrepreneurship, SME capacity development, commercialisation assistance, and intellectual property management scaling viable health solutions.',
        label: 'Key Domain Focus Areas:',
        tags: ['SME Acceleration', 'Incubation', 'IP Protection', 'Market Access']
      },
      investment: {
        badge: 'DOMAIN 05 • STRATEGIC FINANCING',
        title: '05. CAPITAL & INVESTMENT',
        desc: 'Venture funding, private equity, angel syndicates, and institutional capital backing promising healthcare ventures and high-impact infrastructure.',
        label: 'Key Domain Focus Areas:',
        tags: ['Venture Capital', 'Growth Financing', 'Angel Syndicates', 'Capital Facilities']
      },
      industry: {
        badge: 'DOMAIN 06 • GOVERNANCE & ALLIANCES',
        title: '06. INDUSTRY & PUBLIC POLICY',
        desc: 'Multi-sector coalitions, public-private partnerships (PPP), standardisation bodies, international trade connectivity, and ESG healthcare alignment.',
        label: 'Key Domain Focus Areas:',
        tags: ['PPP Coalitions', 'Policy Standards', 'International Trade', 'ESG Alignment']
      }
    };

    const activateDomain = (domainKey) => {
      const data = domainData[domainKey] || domainData.core;

      // Update text and tags
      if (orbitDomainBadge) orbitDomainBadge.textContent = data.badge;
      if (orbitDomainTitle) orbitDomainTitle.textContent = data.title;
      if (orbitDomainDesc) orbitDomainDesc.textContent = data.desc;
      if (orbitTagsLabel) orbitTagsLabel.textContent = data.label;

      if (orbitDomainTags) {
        orbitDomainTags.innerHTML = data.tags.map(t => `<span class="hwed-tag-pill">${t}</span>`).join('');
      }

      // Update desktop nodes
      orbitNodes.forEach(node => {
        const isMatch = node.dataset.domain === domainKey;
        node.classList.toggle('active', isMatch);
        node.setAttribute('aria-selected', isMatch ? 'true' : 'false');
      });

      // Update mobile pills
      orbitMobilePills.forEach(pill => {
        const isMatch = pill.dataset.domain === domainKey;
        pill.classList.toggle('active', isMatch);
        pill.setAttribute('aria-selected', isMatch ? 'true' : 'false');
      });

      // Update central hub active state
      if (orbitCenterHub) {
        orbitCenterHub.classList.toggle('active', domainKey === 'core');
      }
    };

    orbitNodes.forEach(node => {
      node.addEventListener('click', () => {
        activateDomain(node.dataset.domain);
      });
    });

    orbitMobilePills.forEach(pill => {
      pill.addEventListener('click', () => {
        activateDomain(pill.dataset.domain);
      });
    });

    if (orbitCenterHub) {
      orbitCenterHub.addEventListener('click', () => {
        activateDomain('core');
      });
    }

    if (orbitResetBtn) {
      orbitResetBtn.addEventListener('click', () => {
        activateDomain('core');
      });
    }
  }

  // --- B. HWED 5 Strategic Pillars Interactive Cards ---
  const pillarPhotoCards = document.querySelectorAll('.hwed-pillar-photo-card');
  if (pillarPhotoCards.length) {
    pillarPhotoCards.forEach(card => {
      card.addEventListener('click', () => {
        pillarPhotoCards.forEach(c => c.classList.remove('active'));
        card.classList.add('active');
      });
    });
  }

  // --- C. HWED Measurable Impact: Outcomes & Stakeholders Selectors ---
  const outcomeTabs = document.querySelectorAll('.impact-pill-tab[data-outcome]');
  const outcomeTitle = document.getElementById('outcomeTitle');
  const outcomeDesc = document.getElementById('outcomeDesc');

  if (outcomeTabs.length && outcomeTitle) {
    const outcomesData = {
      '1': {
        title: 'HEALTHIER PEOPLE',
        desc: 'Improved health, prevention, lifestyle resilience, and lifelong wellbeing across communities.'
      },
      '2': {
        title: 'STRONGER ECONOMY',
        desc: 'New market opportunities, investment inflows, health entrepreneurship, and sustainable GDP contribution.'
      },
      '3': {
        title: 'GREATER OPPORTUNITIES',
        desc: 'Cross-sector innovation, commercialisation pipelines, and ASEAN regional market expansion.'
      },
      '4': {
        title: 'SUSTAINABLE TOMORROW',
        desc: 'A resilient, ethical, and inclusive healthcare and wellness economy prepared for future challenges.'
      }
    };

    outcomeTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const data = outcomesData[tab.dataset.outcome];
        if (!data) return;

        outcomeTabs.forEach(t => {
          t.classList.remove('active');
          t.setAttribute('aria-selected', 'false');
        });
        tab.classList.add('active');
        tab.setAttribute('aria-selected', 'true');

        outcomeTitle.textContent = data.title;
        outcomeDesc.textContent = data.desc;
      });
    });
  }

  const stakeholderTabs = document.querySelectorAll('.impact-pill-tab[data-stakeholder]');
  const stakeholderTitle = document.getElementById('stakeholderTitle');
  const stakeholderDesc = document.getElementById('stakeholderDesc');

  if (stakeholderTabs.length && stakeholderTitle) {
    const stakeholdersData = {
      '1': {
        title: 'HEALTHCARE PROVIDERS',
        desc: 'Hospitals, clinics, and medical centres advancing integrated care.'
      },
      '2': {
        title: 'WELLNESS ORGANISATIONS',
        desc: 'Preventive centres, lifestyle medicine brands, and wellbeing practitioners.'
      },
      '3': {
        title: 'HEALTH ENTERPRISES & SMES',
        desc: 'Innovators scaling diagnostic, therapeutic, and nutritional products.'
      },
      '4': {
        title: 'TECH INNOVATORS',
        desc: 'MedTech, digital health, and AI pioneers creating smart solutions.'
      },
      '5': {
        title: 'UNIVERSITIES & ACADEMIA',
        desc: 'Medical faculties and institutions developing future clinical talent.'
      },
      '6': {
        title: 'INVESTORS & CAPITAL PARTNERS',
        desc: 'Venture capital funds and angel syndicates backing healthcare breakthroughs.'
      }
    };

    stakeholderTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const data = stakeholdersData[tab.dataset.stakeholder];
        if (!data) return;

        stakeholderTabs.forEach(t => {
          t.classList.remove('active');
          t.setAttribute('aria-selected', 'false');
        });
        tab.classList.add('active');
        tab.setAttribute('aria-selected', 'true');

        stakeholderTitle.textContent = data.title;
        stakeholderDesc.textContent = data.desc;
      });
    });
  }

  // ==========================================================================
  // 12. FOUR CHAPTER AWARDS JOURNEY & INTERACTIVE DRAWER (#the-awards)
  const chapterCards = document.querySelectorAll('.award-chapter-card');
  const stageAwardsDrawer = document.getElementById('stageAwardsDrawer');
  const closeDrawerBtn = document.getElementById('closeDrawerBtn');
  const drawerJourneyTitle = document.getElementById('drawerJourneyTitle');
  const drawerJourneySub = document.getElementById('drawerJourneySub');
  const drawerStageEyebrow = document.getElementById('drawerStageEyebrow');
  const drawerPanels = document.querySelectorAll('.drawer-stage-content');

  const journeyData = {
    'stay-well': {
      title: 'STAY WELL',
      sub: 'PREVENTION, WELLNESS & HEALTH PROMOTION',
      eyebrow: '5 EXCELLENCE AWARDS (01–05)'
    },
    'get-well': {
      title: 'GET WELL',
      sub: 'HEALTHCARE, CARE & PATIENT OUTCOMES',
      eyebrow: '5 EXCELLENCE AWARDS (06–10)'
    },
    'recover-well': {
      title: 'RECOVER WELL',
      sub: 'REHABILITATION, RECOVERY & INDEPENDENCE',
      eyebrow: '5 EXCELLENCE AWARDS (11–15)'
    },
    'age-well': {
      title: 'AGE WELL',
      sub: 'HEALTHY AGEING, LONGEVITY & ACTIVE LIVING',
      eyebrow: '5 EXCELLENCE AWARDS (16–20)'
    }
  };

  const openJourneyDrawer = (journeyKey) => {
    if (!stageAwardsDrawer || !journeyData[journeyKey]) return;

    chapterCards.forEach(card => {
      const isTarget = card.getAttribute('data-journey') === journeyKey;
      card.classList.toggle('is-active', isTarget);
      card.setAttribute('aria-expanded', isTarget ? 'true' : 'false');
    });

    const meta = journeyData[journeyKey];
    if (drawerJourneyTitle) drawerJourneyTitle.textContent = meta.title;
    if (drawerJourneySub) drawerJourneySub.textContent = meta.sub;
    if (drawerStageEyebrow) drawerStageEyebrow.textContent = meta.eyebrow;

    drawerPanels.forEach(panel => {
      panel.classList.remove('active');
    });
    const activePanel = document.getElementById(`panel-${journeyKey}`);
    if (activePanel) {
      activePanel.classList.add('active');
    }

    stageAwardsDrawer.style.display = 'block';

    setTimeout(() => {
      stageAwardsDrawer.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 50);
  };

  const closeJourneyDrawer = () => {
    if (!stageAwardsDrawer) return;
    stageAwardsDrawer.style.display = 'none';
    chapterCards.forEach(card => {
      card.classList.remove('is-active');
      card.setAttribute('aria-expanded', 'false');
    });
  };

  chapterCards.forEach(card => {
    const journey = card.getAttribute('data-journey');
    card.addEventListener('click', (e) => {
      if (e.target.closest('.open-nomination-btn')) return;
      openJourneyDrawer(journey);
    });

    card.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        openJourneyDrawer(journey);
      }
    });
  });

  if (closeDrawerBtn) {
    closeDrawerBtn.addEventListener('click', closeJourneyDrawer);
  }

  // URL Hash or Query Parameter Deep-link support
  const checkUrlJourney = () => {
    const urlParams = new URLSearchParams(window.location.search);
    const journeyParam = urlParams.get('journey');
    const hash = (window.location.hash || '').replace('#', '').toLowerCase();
    
    if (journeyParam && journeyData[journeyParam]) {
      openJourneyDrawer(journeyParam);
    } else if (hash && journeyData[hash]) {
      openJourneyDrawer(hash);
    }
  };
  checkUrlJourney();

  // ==========================================================================
  // CORPORATE STREAM TABS SWITCHER (#corporate-awards)
  // ==========================================================================
  const corpStreamTabs = document.querySelectorAll('.corp-stream-tab');
  const corpStreamPanels = document.querySelectorAll('.corp-panel, .corp-stream-panel');

  corpStreamTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const streamKey = tab.getAttribute('data-corp-stream');
      
      corpStreamTabs.forEach(t => {
        t.classList.remove('active');
        t.setAttribute('aria-selected', 'false');
      });
      corpStreamPanels.forEach(p => {
        p.classList.remove('active');
        p.style.display = 'none';
      });

      tab.classList.add('active');
      tab.setAttribute('aria-selected', 'true');

      const targetPanel = document.getElementById(`corp-panel-${streamKey}`);
      if (targetPanel) {
        targetPanel.classList.add('active');
        targetPanel.style.display = 'block';
      }
    });
  });

  // ==========================================================================
  // AWARD DETAIL MODAL (#awardDetailModal) & CARD INSPECTION
  // ==========================================================================
  const awardDetailModal = document.getElementById('awardDetailModal');
  const closeAwardDetailBtn = document.getElementById('closeAwardDetailBtn');
  const cancelAwardDetailBtn = document.getElementById('cancelAwardDetailBtn');
  const detailNominateBtn = document.getElementById('detailNominateBtn');
  const awardDetailNum = document.getElementById('awardDetailNum');
  const awardDetailBadge = document.getElementById('awardDetailBadge');
  const awardDetailSubgroup = document.getElementById('awardDetailSubgroup');
  const awardDetailTitle = document.getElementById('awardDetailTitle');
  const awardDetailDesc = document.getElementById('awardDetailDesc');

  const closeAwardDetail = () => {
    if (awardDetailModal && typeof awardDetailModal.close === 'function' && awardDetailModal.open) {
      awardDetailModal.close();
    }
  };

  if (closeAwardDetailBtn) closeAwardDetailBtn.addEventListener('click', closeAwardDetail);
  if (cancelAwardDetailBtn) cancelAwardDetailBtn.addEventListener('click', closeAwardDetail);
  if (awardDetailModal) {
    awardDetailModal.addEventListener('click', (e) => {
      if (e.target === awardDetailModal) closeAwardDetail();
    });
  }

  document.querySelectorAll('.btn-inspect-award, .btn-drawer-details').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      const num = btn.getAttribute('data-award-num') || '';
      const title = btn.getAttribute('data-award-title') || '';
      const stream = btn.getAttribute('data-stream') || 'individual';
      const subLabel = btn.getAttribute('data-subgroup-label') || '';
      const stageLabel = btn.getAttribute('data-stage-label') || '';
      const nomTitle = btn.getAttribute('data-nom-title') || title;
      const desc = btn.getAttribute('data-award-desc') || '';

      if (awardDetailNum) awardDetailNum.textContent = num;
      if (awardDetailBadge) awardDetailBadge.textContent = stream.toUpperCase();
      if (awardDetailSubgroup) awardDetailSubgroup.textContent = subLabel ? `${subLabel} • ${stageLabel}` : stageLabel;
      if (awardDetailTitle) awardDetailTitle.textContent = title;
      if (awardDetailDesc) awardDetailDesc.textContent = desc;

      if (detailNominateBtn) {
        detailNominateBtn.setAttribute('data-stream', stream);
        detailNominateBtn.setAttribute('data-award-title', nomTitle);
      }

      if (awardDetailModal && typeof awardDetailModal.showModal === 'function') {
        awardDetailModal.showModal();
      }
    });
  });

  if (detailNominateBtn) {
    detailNominateBtn.addEventListener('click', () => {
      closeAwardDetail();
    });
  }


  // ==========================================================================
  // TROPHY SHOWCASE: INTERACTIVE 5-ITEM SYMBOLISM SELECTOR
  // ==========================================================================
  const trophyTabs = document.querySelectorAll('.trophy-sym-tab');
  const symCardTitle = document.getElementById('symCardTitle');
  const symCardDesc = document.getElementById('symCardDesc');
  const trophyData = {
    people: {
      title: 'PEOPLE',
      desc: 'Human health and lifelong wellbeing.'
    },
    health: {
      title: 'HEALTH',
      desc: 'Continuous healthcare and wellness across the entire human lifecycle.'
    },
    partnership: {
      title: 'PARTNERSHIP',
      desc: 'Strategic collaboration between HWED, MIHA, and the wider industry ecosystem.'
    },
    sustainability: {
      title: 'SUSTAINABILITY',
      desc: 'Long-term, responsible healthcare, ESG stewardship, and economic resilience.'
    },
    excellence: {
      title: 'EXCELLENCE',
      desc: 'Uncompromising recognition of meaningful professional and organisational contribution.'
    }
  };

  if (trophyTabs.length && symCardTitle && symCardDesc) {
    trophyTabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const val = tab.getAttribute('data-value');
        if (!val || !trophyData[val]) return;

        trophyTabs.forEach(t => {
          t.classList.remove('active');
          t.setAttribute('aria-selected', 'false');
        });
        tab.classList.add('active');
        tab.setAttribute('aria-selected', 'true');

        symCardTitle.style.opacity = '0';
        symCardDesc.style.opacity = '0';
        setTimeout(() => {
          symCardTitle.textContent = trophyData[val].title;
          symCardDesc.textContent = trophyData[val].desc;
          symCardTitle.style.opacity = '1';
          symCardDesc.style.opacity = '1';
        }, 120);
      });
    });
  }

  // ==========================================================================
  // GUIDELINES: ACCESSIBLE COMPACT ACCORDION
  // ==========================================================================
  const accItems = document.querySelectorAll('.guideline-accordion-item');
  if (accItems.length) {
    accItems.forEach(item => {
      const btn = item.querySelector('.guideline-acc-btn');
      if (!btn) return;

      btn.addEventListener('click', () => {
        const isOpen = item.classList.contains('open');
        accItems.forEach(other => {
          other.classList.remove('open');
          const otherBtn = other.querySelector('.guideline-acc-btn');
          if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
        });

        if (!isOpen) {
          item.classList.add('open');
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    });
  }

  // ==========================================================================
  // TIMELINE: INTERACTIVE MILESTONE SWITCHER
  // ==========================================================================
  const milestoneBtns = document.querySelectorAll('.timeline-ms-btn');
  const timelineMsTitle = document.getElementById('timelineMsTitle');
  const timelineMsDesc = document.getElementById('timelineMsDesc');
  const milestoneData = {
    opening: {
      title: 'NOMINATION OPENING — 28 SEPTEMBER 2026',
      desc: 'Official call for nominations opens across all 40 categories (20 Individual and 20 Corporate). Dossier portal opens for online submissions.'
    },
    gala: {
      title: 'GALA PRESENTATION — 27 NOVEMBER 2026 (FRIDAY)',
      desc: 'Venue: Hotel Royale Chulan Damansara | Time: 7:30 PM – 11:00 PM. High-level gala banquet, ministerial address, and trophy presentation.'
    }
  };

  if (milestoneBtns.length && timelineMsTitle && timelineMsDesc) {
    milestoneBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const ms = btn.getAttribute('data-milestone');
        if (!ms || !milestoneData[ms]) return;

        milestoneBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        timelineMsTitle.style.opacity = '0';
        timelineMsDesc.style.opacity = '0';
        setTimeout(() => {
          timelineMsTitle.textContent = milestoneData[ms].title;
          timelineMsDesc.textContent = milestoneData[ms].desc;
          timelineMsTitle.style.opacity = '1';
          timelineMsDesc.style.opacity = '1';
        }, 100);
      });
    });
  }

  // ==========================================================================
  // 13. ABOUT PAGE: 10 STRATEGIC OBJECTIVES INTERACTIVE SWITCHER
  // Provides two-column interactive showcase on desktop + accordion on mobile
  // Keyboard accessible with Enter, Space, Up and Down arrow navigation
  // ==========================================================================
  const objectiveBtns = document.querySelectorAll('.objective-nav-btn');
  const watermarkEl = document.getElementById('activeObjectiveWatermark');
  const titleEl = document.getElementById('activeObjectiveTitle');
  const descEl = document.getElementById('activeObjectiveDesc');
  const badgeEl = document.getElementById('activeObjectiveBadge');

  if (objectiveBtns.length) {
    const activateObjective = (btn, shouldFocus = false) => {
      const num = btn.getAttribute('data-num') || '01';
      const title = btn.getAttribute('data-title') || '';
      const desc = btn.getAttribute('data-desc') || '';
      const wrap = btn.closest('.objective-nav-item-wrap');

      // Update button states
      objectiveBtns.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-selected', 'false');
      });
      btn.classList.add('active');
      btn.setAttribute('aria-selected', 'true');

      if (shouldFocus) {
        btn.focus();
      }

      // Mobile Accordion toggle
      document.querySelectorAll('.objective-nav-item-wrap').forEach(w => {
        if (w !== wrap) {
          w.classList.remove('open');
        }
      });
      if (wrap) {
        wrap.classList.toggle('open');
      }

      // Desktop Featured Panel update with smooth transition
      if (titleEl && descEl) {
        titleEl.style.opacity = '0';
        descEl.style.opacity = '0';
        titleEl.style.transform = 'translateY(6px)';
        descEl.style.transform = 'translateY(6px)';

        setTimeout(() => {
          if (watermarkEl) watermarkEl.textContent = num;
          if (badgeEl) badgeEl.textContent = `OBJECTIVE ${num} OF 10 • STRATEGIC MANDATE`;
          titleEl.textContent = title;
          descEl.textContent = desc;

          titleEl.style.opacity = '1';
          descEl.style.opacity = '1';
          titleEl.style.transform = 'translateY(0)';
          descEl.style.transform = 'translateY(0)';
        }, 150);
      }
    };

    objectiveBtns.forEach((btn, index) => {
      btn.addEventListener('click', () => {
        activateObjective(btn, false);
      });

      // Keyboard navigation: Up/Down arrow keys
      btn.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowDown') {
          e.preventDefault();
          const nextIndex = (index + 1) % objectiveBtns.length;
          activateObjective(objectiveBtns[nextIndex], true);
        } else if (e.key === 'ArrowUp') {
          e.preventDefault();
          const prevIndex = (index - 1 + objectiveBtns.length) % objectiveBtns.length;
          activateObjective(objectiveBtns[prevIndex], true);
        }
      });
    });
  }

  // ==========================================================================
  // 14. ORGANISERS ALLIANCE: PARTNER PROFILE EXPAND/COLLAPSE CONTROLLER
  // ==========================================================================
  const partnerToggleBtns = document.querySelectorAll('.partner-toggle-btn');
  partnerToggleBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const targetId = btn.getAttribute('data-target');
      const drawer = document.getElementById(targetId);
      if (!drawer) return;

      const isExpanded = btn.getAttribute('aria-expanded') === 'true';
      if (isExpanded) {
        drawer.classList.add('collapsed');
        btn.setAttribute('aria-expanded', 'false');
        const textSpan = btn.querySelector('.btn-text');
        const iconSpan = btn.querySelector('.btn-icon');
        if (textSpan) textSpan.textContent = 'View Detailed Profile';
        if (iconSpan) iconSpan.textContent = '▼';
      } else {
        drawer.classList.remove('collapsed');
        btn.setAttribute('aria-expanded', 'true');
        const textSpan = btn.querySelector('.btn-text');
        const iconSpan = btn.querySelector('.btn-icon');
        if (textSpan) textSpan.textContent = 'Hide Detailed Profile';
        if (iconSpan) iconSpan.textContent = '▲';
      }
    });
  });

  // ==========================================================================
  // 15. GOVERNANCE & EVALUATION INTEGRITY: 3-STAGE INTERACTIVE EXPLORER
  // ==========================================================================
  const govStepBtns = document.querySelectorAll('.governance-step-btn');
  const govWatermark = document.getElementById('govWatermark');
  const govBadge = document.getElementById('govBadge');
  const govTitle = document.getElementById('govTitle');
  const govDesc = document.getElementById('govDesc');

  if (govStepBtns.length && govTitle) {
    const govStages = {
      '1': {
        num: '01',
        badge: 'RIGOROUS OVERSIGHT • STAGE 01',
        title: '01. INDEPENDENT PANEL',
        desc: 'Dossiers are scored independently by senior healthcare professionals, medical educators, and enterprise leaders without conflict of interest.'
      },
      '2': {
        num: '02',
        badge: 'RIGOROUS OVERSIGHT • STAGE 02',
        title: '02. EVIDENCE AUDITING',
        desc: 'All claims of clinical innovation, patient impact, and enterprise scalability are validated against verifiable documentation and testimonials.'
      },
      '3': {
        num: '03',
        badge: 'RIGOROUS OVERSIGHT • STAGE 03',
        title: '03. NO COMMERCIAL BIAS',
        desc: 'Sponsorship or commercial partnership does not influence judging outcomes; selection is strictly predicated on genuine merit and ecosystem impact.'
      }
    };

    govStepBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const stageKey = btn.getAttribute('data-gov-stage');
        const data = govStages[stageKey];
        if (!data) return;

        govStepBtns.forEach(b => {
          b.classList.remove('active');
          b.setAttribute('aria-selected', 'false');
        });
        btn.classList.add('active');
        btn.setAttribute('aria-selected', 'true');

        if (govWatermark) govWatermark.textContent = data.num;
        if (govBadge) govBadge.textContent = data.badge;
        if (govTitle) govTitle.textContent = data.title;
        if (govDesc) govDesc.textContent = data.desc;
      });
    });
  }

  // ==========================================================================
  // 16. EVENT DETAILS: PROGRAMME TIMELINE INTERACTIVE CONTROLLER
  // ==========================================================================
  const progTimelineBtns = document.querySelectorAll('.programme-timeline-btn');
  const progWatermark = document.getElementById('progWatermark');
  const progTimeTag = document.getElementById('progTimeTag');
  const progStatusTag = document.getElementById('progStatusTag');
  const progTitle = document.getElementById('progTitle');
  const progDesc = document.getElementById('progDesc');
  const progFootnote = document.getElementById('progFootnote');

  if (progTimelineBtns.length && progTitle) {
    const programmeMilestones = {
      '1': {
        num: '01',
        time: '6:30 PM',
        status: 'GALA RECEPTION • MILESTONE 01',
        title: 'RED CARPET & VVIP ARRIVAL',
        desc: 'Arrival reception, photo opportunities, media wall interviews, and registration for guests, nominees, and delegates.',
        foot: 'Official Event Schedule — Grand Ballroom Foyer'
      },
      '2': {
        num: '02',
        time: '7:30 PM',
        status: 'FORMAL COMMENCEMENT • MILESTONE 02',
        title: 'OPENING ADDRESS & GALA COMMENCEMENT',
        desc: 'Welcome addresses by the Organising Committee and leadership of HWED & MIHA, setting the strategic vision for the evening.',
        foot: 'Official Event Schedule — Grand Ballroom'
      },
      '3': {
        num: '03',
        time: '8:00 PM',
        status: 'KEYNOTE ECOSYSTEM LAUNCH • MILESTONE 03',
        title: 'OFFICIAL HWED ECOSYSTEM LAUNCH',
        desc: 'Formal national introduction of the Healthcare & Wellness Economy Development (HWED) multi-sector initiative and strategic framework.',
        foot: 'Featured Milestone ✦ Grand Ballroom Main Stage'
      },
      '4': {
        num: '04',
        time: '8:30 PM',
        status: 'ACADEMIC CONVOCATION • MILESTONE 04',
        title: 'OLYMPIA EDUCATION CONVOCATION CEREMONY',
        desc: 'Conferment ceremony honouring 45 graduating healthcare & wellness professionals receiving their professional credentials and diplomas.',
        foot: 'Official Event Schedule — Grand Ballroom Main Stage'
      },
      '5': {
        num: '05',
        time: '9:00 PM',
        status: 'ENTERPRISE SHOWCASE • MILESTONE 05',
        title: 'PRODUCT INNOVATION SHOWCASE: NANOTECH SANITIZER',
        desc: 'Official unveiling of the advanced Nanotech Sanitizer enterprise innovation, highlighting breakthrough antimicrobial standards and commercial deployment.',
        foot: 'Official Event Schedule — Grand Ballroom Main Stage'
      },
      '6': {
        num: '06',
        time: '9:30 PM',
        status: 'SIGNATURE AWARDS CEREMONY • MILESTONE 06',
        title: 'PRESENTATION OF 40 EXCELLENCE AWARDS',
        desc: 'Signature ceremony presenting 20 Individual and 20 Corporate Excellence Awards honouring transformative clinical leaders and pioneering healthcare organisations.',
        foot: 'Featured Milestone ✦ Grand Ballroom Main Stage'
      },
      '7': {
        num: '07',
        time: '10:30 PM',
        status: 'EXECUTIVE CELEBRATION • MILESTONE 07',
        title: 'FORMAL DINNER, NETWORKING SOIRÉE & CELEBRATION',
        desc: 'Executive networking dinner, commemorative photography, and celebratory fellowship among healthcare leaders, corporate partners, and dignitaries.',
        foot: 'Official Event Schedule — Grand Ballroom & Banquet Tables'
      }
    };

    const activateMilestone = (btn) => {
      const milestoneId = btn.getAttribute('data-programme-id');
      const data = programmeMilestones[milestoneId];
      if (!data) return;

      progTimelineBtns.forEach(b => {
        b.classList.remove('active');
        b.setAttribute('aria-selected', 'false');
      });

      btn.classList.add('active');
      btn.setAttribute('aria-selected', 'true');

      if (progWatermark) progWatermark.textContent = data.num;
      if (progTimeTag) progTimeTag.textContent = data.time;
      if (progStatusTag) progStatusTag.textContent = data.status;
      if (progTitle) progTitle.textContent = data.title;
      if (progDesc) progDesc.textContent = data.desc;
      if (progFootnote) progFootnote.textContent = data.foot;
    };

    progTimelineBtns.forEach((btn, index) => {
      btn.addEventListener('click', () => activateMilestone(btn));

      // Keyboard accessibility for tablist
      btn.addEventListener('keydown', (e) => {
        let targetIndex = -1;
        if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
          e.preventDefault();
          targetIndex = (index + 1) % progTimelineBtns.length;
        } else if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
          e.preventDefault();
          targetIndex = (index - 1 + progTimelineBtns.length) % progTimelineBtns.length;
        } else if (e.key === 'Home') {
          e.preventDefault();
          targetIndex = 0;
        } else if (e.key === 'End') {
          e.preventDefault();
          targetIndex = progTimelineBtns.length - 1;
        }

        if (targetIndex >= 0) {
          progTimelineBtns[targetIndex].focus();
          activateMilestone(progTimelineBtns[targetIndex]);
        }
      });
    });
  }
});

/* ==========================================================================
   EDITORIAL BOOK PAGE-TURN TRANSITION CONTROLLER
   Luxury Editorial Magazine / Awards Publication Page Turn:
   - Intercepts internal navigation links
   - Initiates physical right-to-left 3D page bending & light sheen
   - Dynamic cast shadow sweeps underneath
   - Navigates at ~520ms when page curls past screen
   - Smoothly reveals destination page without flash
   ========================================================================== */
(function initBookPageTurnTransition() {
  const setupTransition = () => {
    const turnStage = document.getElementById('page-turn-stage');
    if (!turnStage) return;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let isNavigating = false;

    // 1. Check for incoming page settlement
    const hasPendingTurn = sessionStorage.getItem('intecare_page_turn') === 'active';
    if (hasPendingTurn && !prefersReducedMotion) {
      sessionStorage.removeItem('intecare_page_turn');
      document.body.classList.add('is-page-settling');
      turnStage.classList.remove('is-turning');

      setTimeout(() => {
        document.body.classList.remove('is-page-settling');
      }, 400);
    } else {
      sessionStorage.removeItem('intecare_page_turn');
      turnStage.classList.remove('is-turning');
    }

    // 2. Browser Back/Forward & BFCache restoration
    window.addEventListener('pageshow', (event) => {
      isNavigating = false;
      sessionStorage.removeItem('intecare_page_turn');
      turnStage.classList.remove('is-turning');
      document.body.classList.remove('is-page-settling');
    });

    // 3. Intercept internal navigation clicks
    document.addEventListener('click', (event) => {
      const link = event.target.closest('a');
      if (!link) return;

      // Skip modifier keys or non-primary clicks
      if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button !== 0) {
        return;
      }

      // Skip explicit download or new tab links
      if (link.hasAttribute('download') || (link.target && link.target !== '_self')) {
        return;
      }

      // Skip modal buttons & AI assistant widgets
      if (link.classList.contains('open-nomination-btn') || 
          link.classList.contains('open-tracking-btn') || 
          link.classList.contains('no-transition') ||
          link.closest('.assistant-concierge-panel') ||
          link.closest('.assistant-widget')) {
        return;
      }

      const hrefAttr = link.getAttribute('href');
      if (!hrefAttr) return;

      // Skip anchors, javascript, mailto, tel
      if (hrefAttr.startsWith('#') || 
          hrefAttr.startsWith('javascript:') || 
          hrefAttr.startsWith('mailto:') || 
          hrefAttr.startsWith('tel:')) {
        return;
      }

      // Parse destination URL
      let targetUrl;
      try {
        targetUrl = new URL(link.href, window.location.href);
      } catch (e) {
        return;
      }

      // Must be same origin (internal page)
      if (targetUrl.origin !== window.location.origin) {
        return;
      }

      // If destination is on same path and only hash differs, allow smooth scroll
      const isSamePath = (targetUrl.pathname.replace(/\/$/, '') === window.location.pathname.replace(/\/$/, '')) &&
                         (targetUrl.search === window.location.search);
      if (isSamePath && targetUrl.hash) {
        return;
      }

      // If exact same URL, do nothing
      if (targetUrl.href === window.location.href) {
        return;
      }

      // If reduced motion is preferred, let browser handle navigation instantly
      if (prefersReducedMotion) {
        return;
      }

      // Prevent default jump and initiate book page-turn
      event.preventDefault();
      if (isNavigating) return;
      isNavigating = true;

      // Set transition flag for destination page
      sessionStorage.setItem('intecare_page_turn', 'active');

      // Trigger 3D Page Turn Animation
      turnStage.classList.add('is-turning');

      // Navigate once page has curled past the screen (~520ms)
      setTimeout(() => {
        window.location.href = targetUrl.href;
      }, 520);

      // Safety fallback: Reset if navigation is cancelled
      setTimeout(() => {
        if (isNavigating) {
          isNavigating = false;
          turnStage.classList.remove('is-turning');
        }
      }, 2500);
    });
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupTransition);
  } else {
    setupTransition();
  }
})();


