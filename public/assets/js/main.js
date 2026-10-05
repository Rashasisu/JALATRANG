// Preloader fast hide
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

// AOS init
AOS.init({ duration: 700, once: true });

// Navbar scroll effect
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
document.addEventListener('DOMContentLoaded', handleNavScroll);
handleNavScroll();

// Scroll to top
const btn = document.getElementById('scrollTop');
window.addEventListener('scroll', () => btn.classList.toggle('visible', window.scrollY > 300));
btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

// CSRF untuk AJAX
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': 'roZaytq4Pxg4Repeg9eRXxcmMijDVuuhOVZAm5Hh' }
});

// Init Bootstrap Tooltip
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
    new bootstrap.Tooltip(el);
});
