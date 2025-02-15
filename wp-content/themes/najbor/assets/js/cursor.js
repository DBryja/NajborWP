const cursorBox = document.querySelector('.cursor');
const cursorImage = document.querySelector('.cursor__image');

document.addEventListener("DOMContentLoaded", () => {
    // Hide the cursor initially
    gsap.set(cursorBox, { opacity: 0 });

    // Show the cursor on the first mouse move
    document.addEventListener('mousemove', (e) => {
        const mouseX = e.clientX;
        const mouseY = e.clientY;
        gsap.set(cursorBox, { x: mouseX, y: mouseY }, {once: true})
        gsap.to(cursorBox, {
            duration: 0.3,
            opacity: 1,
        }, {once: true})

        gsap.to(cursorBox, {
            duration: 0.3,
            x: mouseX,
            y: mouseY,
            ease: "power2.out",
        });
    });
});

gsap.set(cursorImage, {
    translateX: "-50%",
    translateY: "-50%",
    skewX: 0.01,
});

const categoryItems = document.querySelectorAll('.categories .menu__item');

let mouseX, lastMouseX = 0;
let speed = 0;
let directionX = 0;
let skewX = 0;
const limit = 12;
function applyTransform(directionX, speed){
    skewX = directionX * speed * 0.8;
    // Using this if/elseif instead of Math.min and Math.max for performance reasons
    if (skewX > limit) {
        skewX = limit;
    } else if (skewX < -1*limit) {
        skewX = -1*limit;
    }
    gsap.to(cursorImage, {
        skewX: skewX,
        onComplete: () => {
            gsap.to(cursorImage, {
                skewX: 0,
            });
        }
    })
}
function updateMouseAttributes(e){
    mouseX = e.clientX;
    const deltaX = mouseX - lastMouseX;
    speed = Math.abs(deltaX);
    directionX = deltaX / speed || 0;
    lastMouseX = mouseX;
    applyTransform(directionX, speed);
}

let hideImageTimeout = null;
categoryItems.forEach((item) => {
    item.addEventListener('mouseover', function() {
        if(hideImageTimeout){
            clearTimeout(hideImageTimeout);
        }
        const thumbnail = this.getAttribute('data-thumbnail');
        gsap.set(cursorImage, {
            backgroundImage: `url(${thumbnail})`
        });
        gsap.fromTo(cursorImage, {
            width: 0,
            opacity: 1,
            filter: "brightness(2)",
        },{
            opacity: 1,
            duration: 0.5,
            width: '10rem',
            ease: 'power3.out',
            filter: "brightness(1)"
        });
    });
    item.addEventListener('mousemove', updateMouseAttributes)
    item.addEventListener('mouseleave', function () {
        gsap.to(cursorImage, {
            duration: 0.5,
            width: 0,
            opacity: 0,
            filter: "brightness(2)",
            ease: 'power3.out',
        });
        hideImageTimeout = setTimeout(() => {
            gsap.set(cursorImage, {
                width: 0,
                opacity: 0,
                backgroundImage: 'none',
            });
        }, 500);
    });
})