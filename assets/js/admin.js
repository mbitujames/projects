document.addEventListener('DOMContentLoaded', function() {
    const navOpenBtn = document.querySelector('[data-nav-open-btn]');
    const navCloseBtn = document.querySelector('[data-nav-close-btn]');
    const navbar = document.querySelector('[data-navbar]');
    const overlay = document.querySelector('[data-overlay]');

    navOpenBtn.addEventListener('click', function() {
        navbar.setAttribute('data-nav-open', 'true');
        overlay.style.display = 'block';
    });

    navCloseBtn.addEventListener('click', function() {
        navbar.removeAttribute('data-nav-open');
        overlay.style.display = 'none';
    });

    overlay.addEventListener('click', function() {
        navbar.removeAttribute('data-nav-open');
        overlay.style.display = 'none';
    });
});

