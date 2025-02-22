document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('.prace-archive__item');
    if (!items.length) return;
    const isMobile = window.matchMedia('(max-width: 1023px)').matches;

    const totalColumns = 10;
    let previousStartColumn = null;

    items.forEach(item => {
        const shape = item.getAttribute('data-shape');
        let span;

        switch (shape) {
            case 'thin':
                span = 4;
                break;
            case 'square':
                span = 6;
                break;
            case 'wide':
                span = 8;
                break;
            case 'very-wide':
                span = 10;
                break;
            default:
                span = 5;
                break;
        }
        if(isMobile)
            span = Math.min(span+1, 10);

        let startColumn = Math.floor(Math.random() * (totalColumns - span + 1)) + 1;
        // If we land on the same column as 1 item before, then try to move
        if (previousStartColumn !== null && startColumn === previousStartColumn) {
            if (startColumn > 1) {
                startColumn--;
            } else if (startColumn + span <= totalColumns) {
                startColumn++;
            }
        }
        let endColumn = startColumn + span;

        item.style.gridColumnStart = startColumn;
        item.style.gridColumnEnd = endColumn;

        previousStartColumn = startColumn;
    });
});



document.addEventListener('DOMContentLoaded', function() {
    const hideOnScroll = document.querySelectorAll('.hideOnScroll');
    let lastScroll = 0;
    let currentScroll;

    window.addEventListener('scroll', function() {
    currentScroll = window.scrollY;

    if (currentScroll > 5) {
        // Scroll down animation
         gsap.to(hideOnScroll, {duration: 0.1, y: -20, skewX,  opacity: 0, pointerEvents: "none", ease: "none"});
    } else {
        // Scroll up animation
        gsap.to(hideOnScroll, {duration: 0.1, y: 0, opacity: 1, pointerEvents: "all", ease: "none"});
    }

    lastScroll = currentScroll <= 0 ? 0 : currentScroll;
    });
});
