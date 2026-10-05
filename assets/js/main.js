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

  // 4. Award Explorer Tabs (Individual vs Corporate) — Delegated
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.tab-btn');
    if (!btn) return;
    const target = btn.dataset.tab;
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    const activePane = document.getElementById(target);
    if (activePane) {
      activePane.classList.add('active');
    }
  });

  // 4B. About Section Organization Switcher (HWED vs MIHA) — Delegated
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.about-org-tab-btn');
    if (!btn) return;
    const target = btn.dataset.orgTab;
    document.querySelectorAll('.about-org-tab-btn').forEach(b => {
      b.classList.remove('active');
      b.setAttribute('aria-selected', 'false');
    });
    document.querySelectorAll('.about-org-pane').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    btn.setAttribute('aria-selected', 'true');
    const activePane = document.getElementById(target);
    if (activePane) {
      activePane.classList.add('active');
    }
  });

  // 5. Accessible Dialog Modals with Delegated Triggers & Light Dismiss
  const setupModal = (modalId, openTriggers, closeTriggers, onOpen) => {
    openTriggers.forEach(selector => {
      document.addEventListener('click', (e) => {
        const btn = e.target.closest(selector);
        if (!btn) return;
        e.preventDefault();
        const dialog = document.getElementById(modalId);
        if (dialog && typeof dialog.showModal === 'function') {
          dialog.showModal();
          if (typeof onOpen === 'function') onOpen(btn);
        }
      });
    });

    closeTriggers.forEach(selector => {
      document.addEventListener('click', (e) => {
        const btn = e.target.closest(selector);
        if (!btn) return;
        const dialog = document.getElementById(modalId);
        if (dialog && typeof dialog.close === 'function' && dialog.open) {
          dialog.close();
        }
      });
    });

    // Fallback light-dismiss for dialogs
    document.addEventListener('click', (event) => {
      const dialog = document.getElementById(modalId);
      if (!dialog || event.target !== dialog || !dialog.open) return;
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
  };

  setupModal('guidelinesModal', ['.open-guidelines-btn'], ['.dialog-close-btn', '.close-modal-btn']);
  setupModal('trackingModal', ['.open-tracking-btn'], ['.dialog-close-btn', '.close-modal-btn']);

  // 6. Nomination Form Dynamic Field Switching & Auto-Save Draft
  const form = document.getElementById('nominationForm');
  const individualRadio = document.getElementById('typeIndividual');
  const corporateRadio = document.getElementById('typeCorporate');
  const individualFields = document.getElementById('individualFields');
  const corporateFields = document.getElementById('corporateFields');
  const categorySelect = document.getElementById('nominationCategory');
  const rationaleTextarea = document.getElementById('nominationRationale');
  const wordCountBadge = document.getElementById('rationaleWordCount');
  const formAlert = document.getElementById('nominationFormAlert');
  const csrfInput = document.getElementById('nominationCsrfToken');
  const draftBanner = document.getElementById('nominationDraftBanner');
  const clearDraftBtn = document.getElementById('btnClearNominationDraft');

  const DRAFT_STORAGE_KEY = 'intecare_nomination_draft';

  const individualCategories = [
    {
      group: "STAY WELL", items: [
        "INTECARE Preventive Health Leadership Award 2026",
        "INTECARE Community Health Leadership Award 2026",
        "INTECARE Wellness & Lifestyle Medicine Leadership Award 2026",
        "INTECARE Mental Wellbeing Advocacy Award 2026",
        "INTECARE Health Promotion Innovation Award 2026"
      ]
    },
    {
      group: "GET WELL", items: [
        "INTECARE Integrative Healthcare Professional Leadership Award 2026",
        "INTECARE Patient-Centred Care Leadership Award 2026",
        "INTECARE Evidence-Based Medicine Leadership Award 2026",
        "INTECARE Healthcare Innovation in Care Delivery Award 2026",
        "INTECARE Clinical Excellence Leadership Award 2026"
      ]
    },
    {
      group: "RECOVER WELL", items: [
        "INTECARE Rehabilitation Leadership Award 2026",
        "INTECARE Recovery & Functional Healthcare Leadership Award 2026",
        "INTECARE Integrated Recovery Care Leadership Award 2026",
        "INTECARE Mental Health Recovery Leadership Award 2026",
        "INTECARE Independent Living & Social Care Leadership Award 2026"
      ]
    },
    {
      group: "AGE WELL", items: [
        "INTECARE Healthy Ageing Advocacy Award 2026",
        "INTECARE Active Ageing Leadership Award 2026",
        "INTECARE Longevity & Lifestyle Innovation Award 2026",
        "INTECARE Age-Friendly Healthcare Leadership Award 2026",
        "INTECARE Excellence in Ageing & Quality of Life Leadership Award 2026"
      ]
    }
  ];

  const corporateCategories = [
    {
      group: "ORGANISATIONAL EXCELLENCE", items: [
        "INTECARE Healthcare Organisation Excellence Award 2026",
        "INTECARE Wellness Organisation Excellence Award 2026",
        "INTECARE Healthcare Brand Excellence Award 2026",
        "INTECARE Emerging Healthcare Enterprise Excellence Award 2026",
        "INTECARE Excellence in Healthcare Impact Award 2026"
      ]
    },
    {
      group: "INNOVATION & TRANSFORMATION", items: [
        "INTECARE Healthcare Innovation Excellence Award 2026",
        "INTECARE Digital Health Transformation Excellence Award 2026",
        "INTECARE Health Technology Excellence Award 2026",
        "INTECARE Integrative Healthcare Innovation Excellence Award 2026",
        "INTECARE Future of Healthcare Excellence Award 2026"
      ]
    },
    {
      group: "PEOPLE, WORKPLACE & COMMUNITY", items: [
        "INTECARE Employer of Choice – Healthcare & Wellness Excellence Award 2026",
        "INTECARE Healthcare Workforce Development Excellence Award 2026",
        "INTECARE Excellence in Employee Wellbeing Award 2026",
        "INTECARE Community Partnership Excellence Award 2026",
        "INTECARE Social Impact & Community Development Excellence Award 2026"
      ]
    },
    {
      group: "INDUSTRY, SUSTAINABILITY & ECOSYSTEM", items: [
        "INTECARE Sustainable Healthcare Excellence Award 2026",
        "INTECARE Healthcare Ecosystem Partnership Excellence Award 2026",
        "INTECARE Excellence in Healthcare Enterprise Development Award 2026",
        "INTECARE Healthcare Investment & Growth Excellence Award 2026",
        "INTECARE Outstanding Contribution to the Healthcare & Wellness Economy Award 2026"
      ]
    }
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
  }

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

  // Auto-Save Draft Functions
  const saveNominationDraft = () => {
    if (!form) return;
    const stream = form.querySelector('input[name="nomineeType"]:checked')?.value || 'individual';
    const draft = {
      stream: stream,
      category: categorySelect ? categorySelect.value : '',
      nomineeName: document.getElementById('nomineeName')?.value || '',
      nomineeDesignation: document.getElementById('nomineeDesignation')?.value || '',
      companyName: document.getElementById('companyName')?.value || '',
      companyReg: document.getElementById('companyReg')?.value || '',
      nominatorEmail: document.getElementById('nominatorEmail')?.value || '',
      nominatorPhone: document.getElementById('nominatorPhone')?.value || '',
      rationale: rationaleTextarea?.value || '',
      savedAt: Date.now()
    };

    const hasContent = Boolean(draft.nomineeName || draft.companyName || draft.nominatorEmail || draft.rationale);
    if (hasContent) {
      try {
        localStorage.setItem(DRAFT_STORAGE_KEY, JSON.stringify(draft));
      } catch (e) {}
    }
  };

  const loadNominationDraft = (triggerBtn = null) => {
    if (!form) return;

    // First check if trigger button requested a specific stream/category
    let triggerStream = null;
    let triggerAward = null;
    if (triggerBtn) {
      triggerStream = triggerBtn.getAttribute('data-stream');
      triggerAward = triggerBtn.getAttribute('data-award-title');
    }

    try {
      const raw = localStorage.getItem(DRAFT_STORAGE_KEY);
      if (raw) {
        const draft = JSON.parse(raw);
        if (draft && (draft.nomineeName || draft.companyName || draft.nominatorEmail || draft.rationale)) {
          // Restore stream (unless explicit override from button)
          const streamToUse = triggerStream || draft.stream;
          if (streamToUse === 'corporate' && corporateRadio) {
            corporateRadio.checked = true;
            updateNomineeType();
          } else if (individualRadio) {
            individualRadio.checked = true;
            updateNomineeType();
          }

          // Restore category
          const catToUse = triggerAward || draft.category;
          if (catToUse && categorySelect) {
            const needle = catToUse.toLowerCase().trim();
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

          // Restore fields
          if (draft.nomineeName && document.getElementById('nomineeName')) document.getElementById('nomineeName').value = draft.nomineeName;
          if (draft.nomineeDesignation && document.getElementById('nomineeDesignation')) document.getElementById('nomineeDesignation').value = draft.nomineeDesignation;
          if (draft.companyName && document.getElementById('companyName')) document.getElementById('companyName').value = draft.companyName;
          if (draft.companyReg && document.getElementById('companyReg')) document.getElementById('companyReg').value = draft.companyReg;
          if (draft.nominatorEmail && document.getElementById('nominatorEmail')) document.getElementById('nominatorEmail').value = draft.nominatorEmail;
          if (draft.nominatorPhone && document.getElementById('nominatorPhone')) document.getElementById('nominatorPhone').value = draft.nominatorPhone;
          if (draft.rationale && rationaleTextarea) {
            rationaleTextarea.value = draft.rationale;
            updateWordCount();
          }

          if (draftBanner) draftBanner.style.display = 'flex';
          return;
        }
      }
    } catch (e) {}

    // Fallback: Handle card button pre-selection without prior draft
    if (triggerStream === 'corporate' && corporateRadio) {
      corporateRadio.checked = true;
      updateNomineeType();
    } else if (triggerStream === 'individual' && individualRadio) {
      individualRadio.checked = true;
      updateNomineeType();
    }

    if (triggerAward && categorySelect) {
      const needle = triggerAward.toLowerCase().trim();
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
  };

  const clearNominationDraft = () => {
    try {
      localStorage.removeItem(DRAFT_STORAGE_KEY);
    } catch (e) {}
    if (form) form.reset();
    if (individualRadio) {
      individualRadio.checked = true;
      updateNomineeType();
    }
    if (draftBanner) draftBanner.style.display = 'none';
    clearFormErrors();
    updateWordCount();
  };

  if (clearDraftBtn) {
    clearDraftBtn.addEventListener('click', clearNominationDraft);
  }

  // Auto-save on input with debouncing
  if (form) {
    let draftDebounceTimer;
    form.addEventListener('input', () => {
      clearTimeout(draftDebounceTimer);
      draftDebounceTimer = setTimeout(saveNominationDraft, 350);
    });
    form.addEventListener('change', saveNominationDraft);
  }

  setupModal('nominationModal', ['.open-nomination-btn'], ['.dialog-close-btn', '.close-modal-btn'], (btn) => {
    loadNominationDraft(btn);
  });

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
  document.addEventListener('click', (e) => {
    if (e.target.closest('.open-nomination-btn')) {
      fetchCsrfToken();
    }
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
            try {
              localStorage.removeItem(DRAFT_STORAGE_KEY);
            } catch (e) {}
            if (draftBanner) draftBanner.style.display = 'none';
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
  const GALA_TARGET_TIMESTAMP = new Date('2026-11-27T19:30:00+08:00').getTime();

  const updateCountdown = () => {
    const cdDays = document.getElementById('cdDays');
    const cdHours = document.getElementById('cdHours');
    const cdMins = document.getElementById('cdMins');
    const cdSecs = document.getElementById('cdSecs');
    if (!cdDays && !cdHours && !cdMins && !cdSecs) return;

    const now = new Date().getTime();
    const distance = GALA_TARGET_TIMESTAMP - now;

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

  window.intecareUpdateCountdown = updateCountdown;
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
      } catch (e) { }
    }

    const startDrag = (e) => {
      // Ignore drags originating from calendar button or dropdown
      if (e.target.closest('.cd-calendar-wrap')) return;

      // Only drag on primary pointer button (left click) or touch
      if (e.button !== undefined && e.button !== 0) return;
      if (window.innerWidth <= 1024) return; // Allow natural document stacking on mobile

      isDragging = true;
      countdownEl.classList.add('is-dragging');

      try {
        countdownEl.setPointerCapture(e.pointerId);
      } catch (err) { }

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
      } catch (err) { }

      // Save position to session
      const parentRect = heroContainer.getBoundingClientRect();
      const elRect = countdownEl.getBoundingClientRect();
      const currentLeft = Math.round(elRect.left - parentRect.left);
      const currentTop = Math.round(elRect.top - parentRect.top);

      try {
        sessionStorage.setItem('intecare_hero_cd_pos', JSON.stringify({ left: currentLeft, top: currentTop }));
      } catch (err) { }
    };

    countdownEl.addEventListener('pointerdown', startDrag);
    countdownEl.addEventListener('pointermove', onDrag);
    countdownEl.addEventListener('pointerup', stopDrag);
    countdownEl.addEventListener('pointercancel', stopDrag);

    // Double-click resets to default floating location
    countdownEl.addEventListener('dblclick', (e) => {
      if (e.target.closest('.cd-calendar-wrap')) return;
      countdownEl.style.left = '';
      countdownEl.style.top = '';
      countdownEl.style.right = '';
      countdownEl.style.bottom = '';
      try {
        sessionStorage.removeItem('intecare_hero_cd_pos');
      } catch (e) { }
    });
  }

  // ==========================================================================
  // 8C. ADD TO CALENDAR INTEGRATION (Global Delegated Handler)
  // ==========================================================================
  const triggerIcsDownload = () => {
    const icsContent = [
      'BEGIN:VCALENDAR',
      'VERSION:2.0',
      'PRODID:-//INTECARE 2026//Excellence Awards//EN',
      'CALSCALE:GREGORIAN',
      'METHOD:PUBLISH',
      'BEGIN:VEVENT',
      'UID:intecare-2026-gala-dinner@intecare.org',
      'DTSTAMP:20261005T000000Z',
      'DTSTART:20261127T113000Z',
      'DTEND:20261127T150000Z',
      'SUMMARY:INTECARE Excellence Award 2026 — Gala Presentation & Dinner',
      'DESCRIPTION:Official Gala Presentation & Awards Ceremony celebrating 40 visionary individuals and organisations across Healthcare, Wellness, Education, and Disability (HWED).\\n\\nVenue: Grand Ballroom, Hotel Royale Chulan Damansara.\\nTime: 7:30 PM - 11:00 PM (GMT+8).\\nWebsite: https://intecare.org',
      'LOCATION:Grand Ballroom, Hotel Royale Chulan Damansara, 2 Jalan PJU 7/3, Mutiara Damansara, 47810 Petaling Jaya, Selangor, Malaysia',
      'STATUS:CONFIRMED',
      'END:VEVENT',
      'END:VCALENDAR'
    ].join('\r\n');

    const blob = new Blob([icsContent], { type: 'text/calendar;charset=utf-8' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'intecare-2026-gala-presentation.ics';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
  };

  // Delegated click handler for + Calendar toggle and options
  document.addEventListener('click', (e) => {
    // 1. Toggle button click
    const btn = e.target.closest('#btnAddToCal, .btn-cal-add');
    if (btn) {
      e.preventDefault();
      e.stopPropagation();
      const wrap = btn.closest('.cd-calendar-wrap, .hero-event-cal-wrap');
      const menu = wrap ? wrap.querySelector('.cd-cal-menu') : document.getElementById('calMenu');
      if (menu) {
        const isVisible = menu.classList.toggle('is-visible');
        btn.setAttribute('aria-expanded', String(isVisible));
      }
      return;
    }

    // 2. ICS download button click
    const icsBtn = e.target.closest('#btnDownloadIcs, .btn-download-ics');
    if (icsBtn) {
      e.preventDefault();
      e.stopPropagation();
      triggerIcsDownload();
      document.querySelectorAll('.cd-cal-menu').forEach(m => m.classList.remove('is-visible'));
      document.querySelectorAll('#btnAddToCal, .btn-cal-add').forEach(b => b.setAttribute('aria-expanded', 'false'));
      return;
    }

    // 3. Click outside -> close all calendar menus
    if (!e.target.closest('.cd-calendar-wrap, .hero-event-cal-wrap, .cd-cal-menu')) {
      document.querySelectorAll('.cd-cal-menu').forEach(m => m.classList.remove('is-visible'));
      document.querySelectorAll('#btnAddToCal, .btn-cal-add').forEach(b => b.setAttribute('aria-expanded', 'false'));
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      document.querySelectorAll('.cd-cal-menu.is-visible').forEach(m => m.classList.remove('is-visible'));
      document.querySelectorAll('#btnAddToCal, .btn-cal-add').forEach(b => b.setAttribute('aria-expanded', 'false'));
    }
  });

  // Reset when resizing across mobile / desktop breakpoints
  window.addEventListener('resize', () => {
    if (countdownEl && window.innerWidth <= 1024) {
      countdownEl.style.left = '';
      countdownEl.style.top = '';
      countdownEl.style.right = '';
      countdownEl.style.bottom = '';
    }
  }, { passive: true });

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

  const activateOrbitDomain = (domainKey) => {
    const data = domainData[domainKey] || domainData.core;
    const orbitDomainBadge = document.getElementById('orbitDomainBadge');
    const orbitDomainTitle = document.getElementById('orbitDomainTitle');
    const orbitDomainDesc = document.getElementById('orbitDomainDesc');
    const orbitTagsLabel = document.getElementById('orbitTagsLabel');
    const orbitDomainTags = document.getElementById('orbitDomainTags');
    const orbitCenterHub = document.getElementById('orbitCenterHub');

    if (orbitDomainBadge) orbitDomainBadge.textContent = data.badge;
    if (orbitDomainTitle) orbitDomainTitle.textContent = data.title;
    if (orbitDomainDesc) orbitDomainDesc.textContent = data.desc;
    if (orbitTagsLabel) orbitTagsLabel.textContent = data.label;

    if (orbitDomainTags) {
      orbitDomainTags.innerHTML = data.tags.map(t => `<span class="hwed-tag-pill">${t}</span>`).join('');
    }

    document.querySelectorAll('.hwed-orbit-node').forEach(node => {
      const isMatch = node.dataset.domain === domainKey;
      node.classList.toggle('active', isMatch);
      node.setAttribute('aria-selected', isMatch ? 'true' : 'false');
    });

    document.querySelectorAll('.hwed-m-pill').forEach(pill => {
      const isMatch = pill.dataset.domain === domainKey;
      pill.classList.toggle('active', isMatch);
      pill.setAttribute('aria-selected', isMatch ? 'true' : 'false');
    });

    if (orbitCenterHub) {
      orbitCenterHub.classList.toggle('active', domainKey === 'core');
    }
  };

  document.addEventListener('click', (e) => {
    const node = e.target.closest('.hwed-orbit-node');
    if (node && node.dataset.domain) {
      activateOrbitDomain(node.dataset.domain);
      return;
    }
    const pill = e.target.closest('.hwed-m-pill');
    if (pill && pill.dataset.domain) {
      activateOrbitDomain(pill.dataset.domain);
      return;
    }
    if (e.target.closest('#orbitCenterHub') || e.target.closest('#orbitResetBtn')) {
      activateOrbitDomain('core');
      return;
    }
  });

  // --- B. HWED 5 Strategic Pillars Interactive Cards ---
  document.addEventListener('click', (e) => {
    const card = e.target.closest('.hwed-pillar-photo-card');
    if (!card) return;
    document.querySelectorAll('.hwed-pillar-photo-card').forEach(c => c.classList.remove('active'));
    card.classList.add('active');
  });

  // --- C. HWED Measurable Impact: Outcomes & Stakeholders Selectors ---
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

  document.addEventListener('click', (e) => {
    const outcomeTab = e.target.closest('.impact-pill-tab[data-outcome]');
    if (outcomeTab) {
      const data = outcomesData[outcomeTab.dataset.outcome];
      if (data) {
        document.querySelectorAll('.impact-pill-tab[data-outcome]').forEach(t => {
          t.classList.remove('active');
          t.setAttribute('aria-selected', 'false');
        });
        outcomeTab.classList.add('active');
        outcomeTab.setAttribute('aria-selected', 'true');

        const outcomeTitle = document.getElementById('outcomeTitle');
        const outcomeDesc = document.getElementById('outcomeDesc');
        if (outcomeTitle) outcomeTitle.textContent = data.title;
        if (outcomeDesc) outcomeDesc.textContent = data.desc;
      }
      return;
    }

    const stakeholderTab = e.target.closest('.impact-pill-tab[data-stakeholder]');
    if (stakeholderTab) {
      const data = stakeholdersData[stakeholderTab.dataset.stakeholder];
      if (data) {
        document.querySelectorAll('.impact-pill-tab[data-stakeholder]').forEach(t => {
          t.classList.remove('active');
          t.setAttribute('aria-selected', 'false');
        });
        stakeholderTab.classList.add('active');
        stakeholderTab.setAttribute('aria-selected', 'true');

        const stakeholderTitle = document.getElementById('stakeholderTitle');
        const stakeholderDesc = document.getElementById('stakeholderDesc');
        if (stakeholderTitle) stakeholderTitle.textContent = data.title;
        if (stakeholderDesc) stakeholderDesc.textContent = data.desc;
      }
      return;
    }
  });

  // ==========================================================================
  // 12. FOUR CHAPTER AWARDS JOURNEY & INTERACTIVE DRAWER (#the-awards)
  // ==========================================================================
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
    const stageAwardsDrawer = document.getElementById('stageAwardsDrawer');
    if (!stageAwardsDrawer || !journeyData[journeyKey]) return;

    document.querySelectorAll('.award-chapter-card').forEach(card => {
      const isTarget = card.getAttribute('data-journey') === journeyKey;
      card.classList.toggle('is-active', isTarget);
      card.setAttribute('aria-expanded', isTarget ? 'true' : 'false');
    });

    const meta = journeyData[journeyKey];
    const drawerJourneyTitle = document.getElementById('drawerJourneyTitle');
    const drawerJourneySub = document.getElementById('drawerJourneySub');
    const drawerStageEyebrow = document.getElementById('drawerStageEyebrow');
    if (drawerJourneyTitle) drawerJourneyTitle.textContent = meta.title;
    if (drawerJourneySub) drawerJourneySub.textContent = meta.sub;
    if (drawerStageEyebrow) drawerStageEyebrow.textContent = meta.eyebrow;

    document.querySelectorAll('.drawer-stage-content').forEach(panel => {
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
    const stageAwardsDrawer = document.getElementById('stageAwardsDrawer');
    if (!stageAwardsDrawer) return;
    stageAwardsDrawer.style.display = 'none';
    document.querySelectorAll('.award-chapter-card').forEach(card => {
      card.classList.remove('is-active');
      card.setAttribute('aria-expanded', 'false');
    });
  };

  document.addEventListener('click', (e) => {
    const closeBtn = e.target.closest('#closeDrawerBtn');
    if (closeBtn) {
      closeJourneyDrawer();
      return;
    }
    const card = e.target.closest('.award-chapter-card');
    if (card) {
      if (e.target.closest('.open-nomination-btn')) return;
      const journey = card.getAttribute('data-journey');
      if (journey) openJourneyDrawer(journey);
    }
  });

  document.addEventListener('keydown', (e) => {
    const card = e.target.closest('.award-chapter-card');
    if (card && (e.key === 'Enter' || e.key === ' ')) {
      e.preventDefault();
      const journey = card.getAttribute('data-journey');
      if (journey) openJourneyDrawer(journey);
    }
  });

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
  window.intecareCheckUrlJourney = checkUrlJourney;

  // ==========================================================================
  // CORPORATE STREAM TABS SWITCHER (#corporate-awards)
  // ==========================================================================
  document.addEventListener('click', (e) => {
    const tab = e.target.closest('.corp-stream-tab');
    if (!tab) return;
    const streamKey = tab.getAttribute('data-corp-stream');
    if (!streamKey) return;

    document.querySelectorAll('.corp-stream-tab').forEach(t => {
      t.classList.remove('active');
      t.setAttribute('aria-selected', 'false');
    });
    document.querySelectorAll('.corp-panel, .corp-stream-panel').forEach(p => {
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

  // ==========================================================================
  // AWARD DETAIL MODAL (#awardDetailModal) & CARD INSPECTION
  // ==========================================================================
  const closeAwardDetail = () => {
    const awardDetailModal = document.getElementById('awardDetailModal');
    if (awardDetailModal && typeof awardDetailModal.close === 'function' && awardDetailModal.open) {
      awardDetailModal.close();
    }
  };

  document.addEventListener('click', (e) => {
    if (e.target.closest('#closeAwardDetailBtn') || e.target.closest('#cancelAwardDetailBtn')) {
      closeAwardDetail();
      return;
    }

    const awardDetailModal = document.getElementById('awardDetailModal');
    if (awardDetailModal && e.target === awardDetailModal) {
      closeAwardDetail();
      return;
    }

    const inspectBtn = e.target.closest('.btn-inspect-award, .btn-drawer-details');
    if (inspectBtn) {
      e.preventDefault();
      e.stopPropagation();
      const num = inspectBtn.getAttribute('data-award-num') || '';
      const title = inspectBtn.getAttribute('data-award-title') || '';
      const stream = inspectBtn.getAttribute('data-stream') || 'individual';
      const subLabel = inspectBtn.getAttribute('data-subgroup-label') || '';
      const stageLabel = inspectBtn.getAttribute('data-stage-label') || '';
      const nomTitle = inspectBtn.getAttribute('data-nom-title') || title;
      const desc = inspectBtn.getAttribute('data-award-desc') || '';

      const awardDetailNum = document.getElementById('awardDetailNum');
      const awardDetailBadge = document.getElementById('awardDetailBadge');
      const awardDetailSubgroup = document.getElementById('awardDetailSubgroup');
      const awardDetailTitle = document.getElementById('awardDetailTitle');
      const awardDetailDesc = document.getElementById('awardDetailDesc');
      const detailNominateBtn = document.getElementById('detailNominateBtn');

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
      return;
    }

    if (e.target.closest('#detailNominateBtn')) {
      closeAwardDetail();
    }
  });

  // ==========================================================================
  // TROPHY SHOWCASE: INTERACTIVE 5-ITEM SYMBOLISM SELECTOR
  // ==========================================================================
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

  document.addEventListener('click', (e) => {
    const tab = e.target.closest('.trophy-sym-tab');
    if (!tab) return;
    const val = tab.getAttribute('data-value');
    if (!val || !trophyData[val]) return;

    document.querySelectorAll('.trophy-sym-tab').forEach(t => {
      t.classList.remove('active');
      t.setAttribute('aria-selected', 'false');
    });
    tab.classList.add('active');
    tab.setAttribute('aria-selected', 'true');

    const symCardTitle = document.getElementById('symCardTitle');
    const symCardDesc = document.getElementById('symCardDesc');
    if (symCardTitle && symCardDesc) {
      symCardTitle.style.opacity = '0';
      symCardDesc.style.opacity = '0';
      setTimeout(() => {
        symCardTitle.textContent = trophyData[val].title;
        symCardDesc.textContent = trophyData[val].desc;
        symCardTitle.style.opacity = '1';
        symCardDesc.style.opacity = '1';
      }, 120);
    }
  });

  // ==========================================================================
  // GUIDELINES: ACCESSIBLE COMPACT ACCORDION
  // ==========================================================================
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.guideline-acc-btn');
    if (!btn) return;
    const item = btn.closest('.guideline-accordion-item');
    if (!item) return;

    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.guideline-accordion-item').forEach(other => {
      other.classList.remove('open');
      const otherBtn = other.querySelector('.guideline-acc-btn');
      if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
    });

    if (!isOpen) {
      item.classList.add('open');
      btn.setAttribute('aria-expanded', 'true');
    }
  });

  // ==========================================================================
  // TIMELINE: INTERACTIVE MILESTONE SWITCHER
  // ==========================================================================
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

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.timeline-ms-btn');
    if (!btn) return;
    const ms = btn.getAttribute('data-milestone');
    if (!ms || !milestoneData[ms]) return;

    document.querySelectorAll('.timeline-ms-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const timelineMsTitle = document.getElementById('timelineMsTitle');
    const timelineMsDesc = document.getElementById('timelineMsDesc');
    if (timelineMsTitle && timelineMsDesc) {
      timelineMsTitle.style.opacity = '0';
      timelineMsDesc.style.opacity = '0';
      setTimeout(() => {
        timelineMsTitle.textContent = milestoneData[ms].title;
        timelineMsDesc.textContent = milestoneData[ms].desc;
        timelineMsTitle.style.opacity = '1';
        timelineMsDesc.style.opacity = '1';
      }, 100);
    }
  });

  // ==========================================================================
  // 13. ABOUT PAGE: 10 STRATEGIC OBJECTIVES INTERACTIVE SWITCHER
  // Provides two-column interactive showcase on desktop + accordion on mobile
  // Keyboard accessible with Enter, Space, Up and Down arrow navigation
  // ==========================================================================
  const activateObjective = (btn, shouldFocus = false) => {
    if (!btn) return;
    const num = btn.getAttribute('data-num') || '01';
    const title = btn.getAttribute('data-title') || '';
    const desc = btn.getAttribute('data-desc') || '';
    const wrap = btn.closest('.objective-nav-item-wrap');

    document.querySelectorAll('.objective-nav-btn').forEach(b => {
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
    const watermarkEl = document.getElementById('activeObjectiveWatermark');
    const titleEl = document.getElementById('activeObjectiveTitle');
    const descEl = document.getElementById('activeObjectiveDesc');
    const badgeEl = document.getElementById('activeObjectiveBadge');

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

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.objective-nav-btn');
    if (!btn) return;
    activateObjective(btn, false);
  });

  document.addEventListener('keydown', (e) => {
    const btn = e.target.closest('.objective-nav-btn');
    if (!btn) return;
    const allBtns = Array.from(document.querySelectorAll('.objective-nav-btn'));
    const index = allBtns.indexOf(btn);
    if (index === -1) return;

    if (e.key === 'ArrowDown') {
      e.preventDefault();
      const nextIndex = (index + 1) % allBtns.length;
      activateObjective(allBtns[nextIndex], true);
    } else if (e.key === 'ArrowUp') {
      e.preventDefault();
      const prevIndex = (index - 1 + allBtns.length) % allBtns.length;
      activateObjective(allBtns[prevIndex], true);
    }
  });

  // ==========================================================================
  // 14. ORGANISERS ALLIANCE: PARTNER PROFILE EXPAND/COLLAPSE CONTROLLER
  // ==========================================================================
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.partner-toggle-btn');
    if (!btn) return;
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

  // ==========================================================================
  // 15. GOVERNANCE & EVALUATION INTEGRITY: 3-STAGE INTERACTIVE EXPLORER
  // ==========================================================================
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

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.governance-step-btn');
    if (!btn) return;
    const stageKey = btn.getAttribute('data-gov-stage');
    const data = govStages[stageKey];
    if (!data) return;

    document.querySelectorAll('.governance-step-btn').forEach(b => {
      b.classList.remove('active');
      b.setAttribute('aria-selected', 'false');
    });
    btn.classList.add('active');
    btn.setAttribute('aria-selected', 'true');

    const govWatermark = document.getElementById('govWatermark');
    const govBadge = document.getElementById('govBadge');
    const govTitle = document.getElementById('govTitle');
    const govDesc = document.getElementById('govDesc');

    if (govWatermark) govWatermark.textContent = data.num;
    if (govBadge) govBadge.textContent = data.badge;
    if (govTitle) govTitle.textContent = data.title;
    if (govDesc) govDesc.textContent = data.desc;
  });

  // ==========================================================================
  // 16. EVENT DETAILS: PROGRAMME TIMELINE INTERACTIVE CONTROLLER
  // ==========================================================================
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
    if (!btn) return;
    const milestoneId = btn.getAttribute('data-programme-id');
    const data = programmeMilestones[milestoneId];
    if (!data) return;

    document.querySelectorAll('.programme-timeline-btn').forEach(b => {
      b.classList.remove('active');
      b.setAttribute('aria-selected', 'false');
    });

    btn.classList.add('active');
    btn.setAttribute('aria-selected', 'true');

    const progWatermark = document.getElementById('progWatermark');
    const progTimeTag = document.getElementById('progTimeTag');
    const progStatusTag = document.getElementById('progStatusTag');
    const progTitle = document.getElementById('progTitle');
    const progDesc = document.getElementById('progDesc');
    const progFootnote = document.getElementById('progFootnote');

    if (progWatermark) progWatermark.textContent = data.num;
    if (progTimeTag) progTimeTag.textContent = data.time;
    if (progStatusTag) progStatusTag.textContent = data.status;
    if (progTitle) progTitle.textContent = data.title;
    if (progDesc) progDesc.textContent = data.desc;
    if (progFootnote) progFootnote.textContent = data.foot;
  };

  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.programme-timeline-btn');
    if (!btn) return;
    activateMilestone(btn);
  });

  document.addEventListener('keydown', (e) => {
    const btn = e.target.closest('.programme-timeline-btn');
    if (!btn) return;
    const allBtns = Array.from(document.querySelectorAll('.programme-timeline-btn'));
    const index = allBtns.indexOf(btn);
    if (index === -1) return;

    let targetIndex = -1;
    if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
      e.preventDefault();
      targetIndex = (index + 1) % allBtns.length;
    } else if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
      e.preventDefault();
      targetIndex = (index - 1 + allBtns.length) % allBtns.length;
    } else if (e.key === 'Home') {
      e.preventDefault();
      targetIndex = 0;
    } else if (e.key === 'End') {
      e.preventDefault();
      targetIndex = allBtns.length - 1;
    }

    if (targetIndex >= 0 && allBtns[targetIndex]) {
      allBtns[targetIndex].focus();
      activateMilestone(allBtns[targetIndex]);
    }
  });
});

/* ==========================================================================
   EDITORIAL BOOK PAGE-TURN TRANSITION CONTROLLER (SPA-ENHANCED / ZERO BLINK)
   Luxury Editorial Magazine / Awards Publication Seamless Page Reveal:
   - Dynamic Background HTML Fetch + In-Place DOM Swapping behind the paper sheet.
   - 100% Zero document unload, zero white flashes, continuous physical book page sweep.
   - Seamless popstate / back-forward browser history support.
   ========================================================================== */
(function initEditorialPaperReveal() {
  const transitionOverlay = document.getElementById('intecarePageTransition');
  if (!transitionOverlay) return;

  const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  let isTransitioning = false;

  const cleanPath = (p) => {
    let path = (p || '').toLowerCase().replace(/\/index\.php$/i, '/').replace(/\.php$/i, '').replace(/\/+$/, '');
    return path === '' ? '/' : path;
  };

  const updateActiveNav = (targetPathname) => {
    const normTarget = cleanPath(targetPathname);
    const navLinks = document.querySelectorAll('.nav-link, .footer-nav-list a');
    navLinks.forEach(link => {
      const href = link.getAttribute('href');
      if (!href || href.startsWith('javascript:') || href.startsWith('#')) return;
      try {
        const linkUrl = new URL(href, window.location.href);
        if (cleanPath(linkUrl.pathname) === normTarget) {
          link.classList.add('active');
        } else {
          link.classList.remove('active');
        }
      } catch(e) {}
    });
  };

  const reinitPageModules = () => {
    // 1. Re-calculate & render Live Countdown immediately
    if (typeof window.intecareUpdateCountdown === 'function') {
      window.intecareUpdateCountdown();
    }
    // 2. Re-trigger Scroll Reveal Engine
    if (typeof window.intecareSetupReveal === 'function') {
      window.intecareSetupReveal();
    }
    // 3. Update sticky header state
    const header = document.querySelector('.site-header');
    if (header) {
      if (window.scrollY > 40) header.classList.add('scrolled');
      else header.classList.remove('scrolled');
    }
    // 4. Autoplay hero video if present
    const heroVideo = document.querySelector('.hero-video');
    if (heroVideo) {
      heroVideo.play().catch(() => {});
    }
    // 5. Deep-link journey drawer check
    if (typeof window.intecareCheckUrlJourney === 'function') {
      window.intecareCheckUrlJourney();
    }
    // 6. Blur active element to remove lingering focus boxes
    if (document.activeElement && document.activeElement.blur) {
      document.activeElement.blur();
    }
  };

  const performSeamlessTransition = async (targetUrl, pushState = true) => {
    if (isTransitioning) return;
    isTransitioning = true;

    // Start Phase 1: Paper sheet sweeps in from right to fully cover the screen (300ms)
    transitionOverlay.classList.remove('is-entering');
    transitionOverlay.classList.add('is-exiting');

    // Concurrently fetch the new page HTML
    const fetchPromise = fetch(targetUrl.href, {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    }).then(res => {
      if (!res.ok) throw new Error('HTTP ' + res.status);
      return res.text();
    });

    // Ensure paper has fully covered viewport before DOM swap
    const delayPromise = new Promise(resolve => setTimeout(resolve, 290));

    try {
      const [htmlText] = await Promise.all([fetchPromise, delayPromise]);
      const parser = new DOMParser();
      const newDoc = parser.parseFromString(htmlText, 'text/html');

      const newMain = newDoc.querySelector('main');
      const currentMain = document.querySelector('main');

      if (newMain && currentMain) {
        currentMain.innerHTML = newMain.innerHTML;
        currentMain.className = newMain.className;
      }

      if (newDoc.title) {
        document.title = newDoc.title;
      }

      // Update active navigation state
      updateActiveNav(targetUrl.pathname);

      // Update URL in browser history
      if (pushState) {
        window.history.pushState({ path: targetUrl.href }, '', targetUrl.href);
      }

      // Scroll to top instantly behind the paper
      window.scrollTo(0, 0);

      // Re-initialize modules on new content
      reinitPageModules();

      // Phase 2: Paper continues smoothly gliding off to the left (420ms)
      transitionOverlay.classList.remove('is-exiting');
      transitionOverlay.classList.add('is-entering');

      setTimeout(() => {
        transitionOverlay.classList.remove('is-entering');
        isTransitioning = false;
      }, 450);

    } catch (err) {
      console.warn('Seamless transition fallback to hard navigation:', err);
      window.location.href = targetUrl.href;
    }
  };

  // Browser Back / Forward button support
  window.addEventListener('popstate', () => {
    try {
      const targetUrl = new URL(window.location.href);
      performSeamlessTransition(targetUrl, false);
    } catch(e) {}
  });

  // Link click listener
  document.addEventListener('click', (event) => {
    const link = event.target.closest('a');
    if (!link) return;

    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button !== 0) {
      return;
    }

    if (link.hasAttribute('download') || (link.target && link.target !== '_self')) {
      return;
    }

    if (link.classList.contains('open-nomination-btn') || 
        link.classList.contains('open-tracking-btn') || 
        link.classList.contains('no-transition') ||
        link.closest('.assistant-concierge-panel') ||
        link.closest('.assistant-widget')) {
      return;
    }

    const hrefAttr = link.getAttribute('href');
    if (!hrefAttr) return;

    if (hrefAttr.startsWith('#') || 
        hrefAttr.startsWith('javascript:') || 
        hrefAttr.startsWith('mailto:') || 
        hrefAttr.startsWith('tel:')) {
      return;
    }

    let targetUrl;
    try {
      targetUrl = new URL(link.href, window.location.href);
    } catch (e) {
      return;
    }

    if (targetUrl.origin !== window.location.origin) {
      return;
    }

    const isSamePage = (cleanPath(targetUrl.pathname) === cleanPath(window.location.pathname)) &&
                       (targetUrl.search === window.location.search);

    if (isSamePage) {
      if (targetUrl.hash) return;
      event.preventDefault();
      return;
    }

    if (prefersReducedMotion) {
      return;
    }

    event.preventDefault();
    if (typeof link.blur === 'function') {
      link.blur();
    }
    performSeamlessTransition(targetUrl, true);
  });
})();

// ==========================================================================
// ART-DIRECTED EDITORIAL SCROLL REVEAL SYSTEM
// High-performance IntersectionObserver scroll reveal engine
// ==========================================================================
(function initScrollReveal() {
  const setupReveal = () => {
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      return;
    }

    if (!('IntersectionObserver' in window)) {
      return;
    }

    const revealSelector = [
      '.reveal-up',
      '.reveal-standard',
      '.reveal-heading',
      '.reveal-editorial-title',
      '.reveal-left',
      '.reveal-right',
      '.reveal-scale',
      '.reveal-stat',
      '.reveal-image',
      '.reveal-mask',
      '.reveal-card-group'
    ].join(', ');

    const revealElements = document.querySelectorAll(revealSelector);
    if (!revealElements.length) return;

    document.documentElement.classList.add('reveal-engine-ready');

    const observerOptions = {
      root: null,
      rootMargin: '0px 0px -40px 0px',
      threshold: 0.15
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-revealed');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    revealElements.forEach(el => {
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom > 0) {
        el.classList.add('is-revealed');
      } else {
        revealObserver.observe(el);
      }
    });
  };

  window.intecareSetupReveal = setupReveal;

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupReveal);
  } else {
    setupReveal();
  }
})();



