// resources/js/app.js
// Catatan: jQuery, Bootstrap, dan AOS dimuat lewat <script> vendor di layout
// (public/vendor/js/*), jadi tersedia sebagai global (window.$, window.bootstrap, window.AOS).

import './maintenance';

// ── Preloader ──
const hidePreloader = () => {
    const loader = document.getElementById('preloader');
    if (loader && !loader.classList.contains('hidden')) {
        loader.classList.add('hidden');
        setTimeout(() => loader.remove(), 400);
    }
};
document.addEventListener('DOMContentLoaded', hidePreloader);
window.addEventListener('load', hidePreloader);
setTimeout(hidePreloader, 1200);

// ── AOS ──
window.AOS?.init({ duration: 700, once: true });

// ── Navbar scroll effect ──
const nav = document.getElementById('mainNav');
const topbarEl = document.querySelector('.topbar');
const handleNavScroll = () => {
    if (!nav) return;
    const threshold = topbarEl ? topbarEl.offsetHeight : 35;
    if (window.scrollY >= threshold) {
        nav.classList.add('is-sticky-fixed', 'scrolled');
    } else {
        nav.classList.remove('is-sticky-fixed', 'scrolled');
    }
};
window.addEventListener('scroll', handleNavScroll);
handleNavScroll();

// ── Scroll to top ──
const scrollBtn = document.getElementById('scrollTop');
if (scrollBtn) {
    window.addEventListener('scroll', () => scrollBtn.classList.toggle('visible', window.scrollY > 300));
    scrollBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

// ── CSRF untuk AJAX (dibaca dari <meta name="csrf-token">) ──
const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
if (window.$ && csrf) {
    window.$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': csrf } });
}

// ── Bootstrap Tooltip ──
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
    new window.bootstrap.Tooltip(el);
});
