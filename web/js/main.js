/**
 * Light Inside the Tunnel — Main JS
 * Minimal vanilla JS: nav scroll, mobile toggle, scroll reveals
 */

(function () {
  'use strict';

  // --- Sticky nav scroll detection ---
  const nav = document.querySelector('.site-nav');
  if (nav) {
    const onScroll = () => {
      nav.classList.toggle('site-nav--scrolled', window.scrollY > 10);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // --- Mobile nav toggle ---
  const toggle = document.querySelector('.nav-toggle');
  const mobileNav = document.querySelector('.mobile-nav');
  const closeBtn = document.querySelector('.mobile-nav__close');

  if (toggle && mobileNav) {
    toggle.addEventListener('click', () => {
      mobileNav.classList.add('mobile-nav--open');
      toggle.setAttribute('aria-expanded', 'true');
      closeBtn?.focus();
    });

    var closeMobileNav = function () {
      mobileNav.classList.remove('mobile-nav--open');
      toggle.setAttribute('aria-expanded', 'false');
      toggle.focus();
    };

    closeBtn?.addEventListener('click', closeMobileNav);

    // Close on Escape + focus trap
    document.addEventListener('keydown', (e) => {
      if (!mobileNav.classList.contains('mobile-nav--open')) return;

      if (e.key === 'Escape') {
        closeMobileNav();
        return;
      }

      // Focus trap: keep Tab within mobile nav
      if (e.key === 'Tab') {
        var focusable = mobileNav.querySelectorAll('a, button, [tabindex]:not([tabindex="-1"])');
        if (focusable.length === 0) return;
        var first = focusable[0];
        var last = focusable[focusable.length - 1];

        if (e.shiftKey && document.activeElement === first) {
          e.preventDefault();
          last.focus();
        } else if (!e.shiftKey && document.activeElement === last) {
          e.preventDefault();
          first.focus();
        }
      }
    });
  }

  // --- Ten Core Beliefs accordion (mobile only) ---
  document.querySelectorAll('.belief__title').forEach(function (title, index) {
    var explanation = title.closest('.belief').querySelector('.belief__explanation');
    var panelId = 'belief-panel-' + (index + 1);

    // Set ARIA attributes linking title to explanation
    if (explanation) {
      explanation.id = panelId;
      explanation.setAttribute('role', 'region');
      explanation.setAttribute('aria-labelledby', 'belief-title-' + (index + 1));
    }
    title.id = 'belief-title-' + (index + 1);
    title.setAttribute('aria-expanded', 'false');
    title.setAttribute('aria-controls', panelId);

    var toggleBelief = function () {
      if (window.innerWidth < 768) {
        var belief = title.closest('.belief');
        var isOpen = belief.classList.toggle('is-open');
        title.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      }
    };

    title.addEventListener('click', toggleBelief);
    title.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleBelief();
      }
    });
  });

  // --- Quote share (copy to clipboard) ---
  document.addEventListener('click', function (e) {
    var btn = e.target.closest('.quote-share');
    if (!btn) return;

    var quoteText = btn.getAttribute('data-quote');
    if (!quoteText) return;

    var text = '"' + quoteText + '" — The Light Inside the Tunnel';

    navigator.clipboard.writeText(text).then(function () {
      var label = btn.querySelector('.quote-share__label');
      btn.classList.add('quote-share--copied');
      if (label) label.textContent = 'Copied to clipboard!';

      setTimeout(function () {
        btn.classList.remove('quote-share--copied');
        if (label) label.textContent = 'Copy quote';
      }, 2000);
    });
  });

  // --- Newsletter form success state ---
  var newsletterForm = document.querySelector('.newsletter__form');
  if (newsletterForm) {
    newsletterForm.addEventListener('submit', function (e) {
      var success = newsletterForm.closest('.newsletter').querySelector('.newsletter__success');
      if (success) {
        // Show success message after short delay (Brevo handles actual submission)
        setTimeout(function () {
          newsletterForm.hidden = true;
          var finePrint = newsletterForm.closest('.newsletter').querySelector('.newsletter__fine-print');
          if (finePrint) finePrint.hidden = true;
          success.hidden = false;
        }, 300);
      }
    });
  }

  // --- Scroll reveal (fade-up on enter) ---
  const reveals = document.querySelectorAll('[data-reveal]');
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    // Show all immediately — no animation
    reveals.forEach((el) => el.classList.add('revealed'));
  } else if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.15 }
    );
    reveals.forEach((el) => observer.observe(el));
  } else {
    // Fallback for browsers without IntersectionObserver
    reveals.forEach((el) => el.classList.add('revealed'));
  }
})();
