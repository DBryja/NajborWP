document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('.prace-archive__item');
    if (!items) return;
    items.forEach(item => {
        const shape = item.getAttribute('data-shape');
        let startColumn, endColumn, span;

        switch (shape) {
            case 'thin':
                span = 3;
                break;
            case 'square':
                span = 5;
                break;
            case 'wide':
                span = 7;
                break;
            case 'very-wide':
                span = 10;
                break;
            default:
                span = 5;
                break;
        }
        startColumn = Math.floor(Math.random() * (10 - span + 1)) + 1;
        endColumn = startColumn + span;

        item.style.gridColumnStart = startColumn;
        item.style.gridColumnEnd = endColumn;
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const hideOnScroll = document.querySelectorAll('.hideOnScroll');
    const header = document.querySelector('.header');
    const headerHeight = header.offsetHeight;
    const headerBottom = header.offsetTop + headerHeight/2;
    let lastScroll = 0;
    let currentScroll;

    window.addEventListener('scroll', function() {
    currentScroll = window.scrollY;

    if (currentScroll > headerBottom) {
        // Scroll down animation
         gsap.to(hideOnScroll, {duration: 0.1, y: -20, opacity: 0, pointerEvents: "none", ease: "none"});
    } else {
        // Scroll up animation
        gsap.to(hideOnScroll, {duration: 0.1, y: 0, opacity: 1, pointerEvents: "all", ease: "none"});
    }

    lastScroll = currentScroll <= 0 ? 0 : currentScroll;
    });
});
