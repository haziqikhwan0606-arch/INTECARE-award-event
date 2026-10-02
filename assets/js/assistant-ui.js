/**
 * INTECARE EXCELLENCE AWARD 2026 — ASSISTANT UI CONTROLLER
 * 
 * Manages floating launcher, chat interface, message rendering,
 * realistic typing animation, quick action pills, contextual action handlers,
 * and accessibility compliance.
 * STRICT POLICY: ZERO EMOJIS.
 */

(function () {
  'use strict';

  // SVG Icons (Strictly Vector - No Emojis)
  const ICONS = {
    spark: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/></svg>`,
    chat: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>`,
    send: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>`,
    close: `<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>`,
    refresh: `<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path><path d="M21 3v5h-5"></path><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path><path d="M8 16H3v5"></path></svg>`,
    arrowRight: `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>`
  };

  class IntecareAssistant {
    constructor() {
      this.isOpen = false;
      this.isTyping = false;
      this.knowledge = window.intecareAssistantKnowledge;
      this.history = [];
      this.init();
    }

    init() {
      if (!this.knowledge) {
        console.warn("INTECARE Assistant: Knowledge base not loaded.");
        return;
      }

      this.createDOM();
      this.bindEvents();
      this.renderInitialGreeting();
    }

    createDOM() {
      // 1. Floating Launcher
      const launcher = document.createElement('button');
      launcher.id = 'intecareAssistantLauncher';
      launcher.setAttribute('type', 'button');
      launcher.setAttribute('aria-label', 'Open INTECARE Official Assistant');
      launcher.setAttribute('aria-expanded', 'false');
      launcher.innerHTML = `
        <div class="ia-launcher-icon-wrap" aria-hidden="true">
          ${ICONS.chat}
          <span class="ia-launcher-pulse"></span>
        </div>
        <div class="ia-launcher-label">
          <span class="ia-launcher-title">INTECARE Assistant</span>
          <span class="ia-launcher-sub">Official Awards Concierge</span>
        </div>
      `;
      document.body.appendChild(launcher);
      this.launcherEl = launcher;

      // 2. Chat Window Container
      const windowEl = document.createElement('div');
      windowEl.id = 'intecareAssistantWindow';
      windowEl.setAttribute('role', 'dialog');
      windowEl.setAttribute('aria-label', 'INTECARE Assistant Dialog');
      windowEl.setAttribute('aria-modal', 'true');
      windowEl.innerHTML = `
        <!-- Header -->
        <header class="ia-header">
          <div class="ia-header-brand">
            <div class="ia-avatar" aria-hidden="true">
              ${ICONS.spark}
            </div>
            <div class="ia-header-info">
              <span class="ia-header-title">INTECARE Assistant</span>
              <span class="ia-header-status">
                <span class="ia-status-dot" aria-hidden="true"></span>
                Official Award Information
              </span>
            </div>
          </div>
          <div class="ia-header-actions">
            <button type="button" class="ia-icon-btn ia-reset-btn" aria-label="Reset Conversation" title="Reset Conversation">
              ${ICONS.refresh}
            </button>
            <button type="button" class="ia-icon-btn ia-close-btn" aria-label="Close Assistant" title="Close Assistant">
              ${ICONS.close}
            </button>
          </div>
        </header>

        <!-- Message Body -->
        <div class="ia-body" id="iaMessageBody" role="log" aria-live="polite">
          <!-- Populated dynamically -->
        </div>

        <!-- Footer Input Bar -->
        <footer class="ia-footer">
          <form class="ia-input-wrap" id="iaInputForm" novalidate>
            <input 
              type="text" 
              class="ia-input" 
              id="iaTextInput" 
              placeholder="Ask about INTECARE..." 
              autocomplete="off"
              aria-label="Ask about INTECARE"
            >
            <button type="submit" class="ia-send-btn" id="iaSendBtn" aria-label="Send message" disabled>
              ${ICONS.send}
            </button>
          </form>
          <div class="ia-disclaimer">
            Official Knowledge Base — Intecare 2026 Web Content Draft
          </div>
        </footer>
      `;
      document.body.appendChild(windowEl);
      this.windowEl = windowEl;
      this.bodyEl = windowEl.querySelector('#iaMessageBody');
      this.formEl = windowEl.querySelector('#iaInputForm');
      this.inputEl = windowEl.querySelector('#iaTextInput');
      this.sendBtn = windowEl.querySelector('#iaSendBtn');
      this.closeBtn = windowEl.querySelector('.ia-close-btn');
      this.resetBtn = windowEl.querySelector('.ia-reset-btn');
    }

    bindEvents() {
      // Toggle Assistant
      this.launcherEl.addEventListener('click', () => this.toggle());
      this.closeBtn.addEventListener('click', () => this.close());
      this.resetBtn.addEventListener('click', () => this.reset());

      // Form Submission
      this.formEl.addEventListener('submit', (e) => {
        e.preventDefault();
        this.handleUserSubmit();
      });

      // Enable/Disable Send Button based on input
      this.inputEl.addEventListener('input', () => {
        const hasText = this.inputEl.value.trim().length > 0;
        this.sendBtn.disabled = !hasText;
      });

      // Keyboard Accessibility
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && this.isOpen) {
          this.close();
        }
      });
    }

    toggle() {
      if (this.isOpen) {
        this.close();
      } else {
        this.open();
      }
    }

    open() {
      this.isOpen = true;
      this.windowEl.classList.add('ia-open');
      this.launcherEl.setAttribute('aria-expanded', 'true');
      this.launcherEl.style.display = 'none';
      setTimeout(() => {
        this.inputEl.focus();
        this.scrollToBottom();
      }, 200);
    }

    close() {
      this.isOpen = false;
      this.windowEl.classList.remove('ia-open');
      this.launcherEl.setAttribute('aria-expanded', 'false');
      this.launcherEl.style.display = 'flex';
      this.launcherEl.focus();
    }

    reset() {
      this.bodyEl.innerHTML = '';
      this.history = [];
      this.renderInitialGreeting();
    }

    renderInitialGreeting() {
      // 1. Initial Intro Message
      const introText = this.knowledge.meta.introMessage.replace(/\n\n/g, '</p><p>');
      this.appendAssistantMessage(`<p>${introText}</p>`);

      // 2. Quick Action Questions Container
      const quickContainer = document.createElement('div');
      quickContainer.className = 'ia-quick-container';
      quickContainer.innerHTML = `
        <div class="ia-quick-title">Suggested Inquiries</div>
        <div class="ia-quick-grid">
          ${this.knowledge.quickQuestions.map(q => `
            <button type="button" class="ia-quick-btn" data-qid="${q.id}">
              <span>${q.text}</span>
              <span class="ia-quick-arrow" aria-hidden="true">${ICONS.arrowRight}</span>
            </button>
          `).join('')}
        </div>
      `;

      quickContainer.querySelectorAll('.ia-quick-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          const qid = btn.dataset.qid;
          const questionText = btn.querySelector('span').textContent;
          this.handleQuery(questionText, qid);
        });
      });

      this.bodyEl.appendChild(quickContainer);
      this.scrollToBottom();
    }

    appendUserMessage(text) {
      const row = document.createElement('div');
      row.className = 'ia-message-row ia-user';
      row.innerHTML = `
        <div class="ia-bubble">
          ${this.escapeHtml(text)}
        </div>
      `;
      this.bodyEl.appendChild(row);
      this.scrollToBottom();
    }

    appendAssistantMessage(htmlContent, actions = []) {
      const row = document.createElement('div');
      row.className = 'ia-message-row ia-assistant';

      let actionsHtml = '';
      if (actions && actions.length > 0) {
        actionsHtml = `
          <div class="ia-msg-actions">
            ${actions.map(act => `
              <button type="button" class="ia-action-btn ${act.primary ? 'ia-primary' : 'ia-outline'}" data-action="${act.action}">
                <span>${act.label}</span>
                <span aria-hidden="true">${ICONS.arrowRight}</span>
              </button>
            `).join('')}
          </div>
        `;
      }

      row.innerHTML = `
        <div class="ia-msg-avatar" aria-hidden="true">
          ${ICONS.spark}
        </div>
        <div class="ia-bubble">
          ${htmlContent}
          ${actionsHtml}
        </div>
      `;

      // Bind Action Clicks
      row.querySelectorAll('.ia-action-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
          const action = btn.dataset.action;
          this.handleContextAction(action);
        });
      });

      this.bodyEl.appendChild(row);
      this.scrollToBottom();
    }

    showTypingIndicator() {
      const typingEl = document.createElement('div');
      typingEl.className = 'ia-message-row ia-assistant ia-typing-row';
      typingEl.innerHTML = `
        <div class="ia-msg-avatar" aria-hidden="true">
          ${ICONS.spark}
        </div>
        <div class="ia-typing-indicator" aria-label="INTECARE Assistant is typing">
          <span class="ia-typing-dot"></span>
          <span class="ia-typing-dot"></span>
          <span class="ia-typing-dot"></span>
        </div>
      `;
      this.bodyEl.appendChild(typingEl);
      this.scrollToBottom();
      return typingEl;
    }

    handleUserSubmit() {
      const text = this.inputEl.value.trim();
      if (!text || this.isTyping) return;

      this.inputEl.value = '';
      this.sendBtn.disabled = true;
      this.handleQuery(text);
    }

    handleQuery(userText, explicitId = null) {
      this.appendUserMessage(userText);
      this.isTyping = true;

      const indicator = this.showTypingIndicator();

      // Simulated natural latency (450ms – 650ms)
      const latency = Math.floor(Math.random() * 200) + 450;

      setTimeout(() => {
        indicator.remove();
        this.isTyping = false;

        const response = explicitId 
          ? this.knowledge.matchQuery(explicitId) 
          : this.knowledge.matchQuery(userText);

        this.appendAssistantMessage(response.content, response.actions);
      }, latency);
    }

    handleContextAction(action) {
      switch (action) {
        case 'submit_nomination':
          // Re-use official existing modal trigger
          const modal = document.getElementById('nominationModal');
          if (modal && typeof modal.showModal === 'function') {
            this.close();
            modal.showModal();
          } else {
            const openBtn = document.querySelector('.open-nomination-btn');
            if (openBtn) {
              this.close();
              openBtn.click();
            } else {
              window.location.href = './awards#nominate';
            }
          }
          break;

        case 'track_status':
          const trackingModal = document.getElementById('trackingModal');
          if (trackingModal && typeof trackingModal.showModal === 'function') {
            this.close();
            trackingModal.showModal();
          } else {
            window.location.href = 'track-status.php';
          }
          break;

        case 'explore_awards':
          window.location.href = './awards';
          break;

        case 'view_guidelines':
          window.location.href = './awards#guidelines';
          break;

        case 'event_details':
          window.location.href = './event-details';
          break;

        default:
          console.log("Unhandled assistant action:", action);
      }
    }

    scrollToBottom() {
      requestAnimationFrame(() => {
        this.bodyEl.scrollTop = this.bodyEl.scrollHeight;
      });
    }

    escapeHtml(string) {
      const div = document.createElement('div');
      div.textContent = string;
      return div.innerHTML;
    }
  }

  // Initialize on DOMContentLoaded
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      window.intecareAssistant = new IntecareAssistant();
    });
  } else {
    window.intecareAssistant = new IntecareAssistant();
  }

})();
