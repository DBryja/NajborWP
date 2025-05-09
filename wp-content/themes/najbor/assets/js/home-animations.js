document.addEventListener("DOMContentLoaded", runGSAP);

function scrollToTop(){
    const originalScrollBehavior = document.documentElement.style.scrollBehavior;
    document.documentElement.style.scrollBehavior = 'auto';
    // Force reflow to ensure the style change is applied immediately
    document.documentElement.offsetHeight;
    window.scrollTo(0, 0);
    document.documentElement.style.scrollBehavior = originalScrollBehavior;
}
function runGSAP(){
    const logoSize = getComputedStyle(document.documentElement).getPropertyValue("--exit-width");
    const headerStyle = getComputedStyle(document.querySelector("header.header"));
    const paddings = [headerStyle.paddingTop, headerStyle.paddingRight, headerStyle.paddingBottom, headerStyle.paddingLeft];
    const isIos = isIosDevice();

    gsap.registerPlugin(gsap.plugins.motionPath);
    const sizes = {width: window.innerWidth, height: window.innerHeight};
    const isMobile = sizes.width < 1024;
    const isTablet = sizes.width < 1024 && sizes.width >= 600;
    const duration = 1.6;
    const ease = "elastic.inOut(1, 0.75)";

    gsap.set(".header", {
        display: "none"
    })
    gsap.set(["body", "html"], {
        "overflow-y": "hidden"
    })
    gsap.set([".home__hero__title span", ".home__hero__desc span", ".home__hero__image", ".home__bio"], {
        opacity: 0,
    })
    function enterAnim() {
        scrollToTop();
        gsap.to("#autobus", {
            duration: duration,
            x: ()=> isMobile ? (isTablet ? -200 : -100) : -0.18 * sizes.width,
            ease: ease
        });
        gsap.to("#samolot", {
            duration: duration,
            x: ()=> isMobile ? (isTablet ? -130 : -70) : -0.125 * sizes.width,
            y: () => isMobile ? (isTablet ? -175 : -100) : -0.25 * sizes.height,
            ease: ease
        });
        gsap.from("#logo", {
            "--rotate": "0deg",
            "--x": "0",
            duration: duration,
            ease: ease
        })
    }
    function exitAnim() {
        gsap.to("#autobus", {
            duration: duration,
            x: ()=> sizes.width * 1.3,
            ease: ease
        });
        gsap.to("#samolot", {
            duration: duration,
            x: ()=> -sizes.width * (isMobile ? 1.6 : 1.3),
            y: ()=> -sizes.height * 0.6,
            ease: ease
        });
        gsap.to("#logo", {
            "--rotate": "2deg",
            "--x": "-20%",
            duration: duration,
            ease: ease
        });
        gsap.to("#anim-wrapper", {
            left: paddings[3],
            top: paddings[0],
            transform: "translate(0, 0)",
            delay: 0.1 * duration,
            duration: duration,
            ease: ease
        });
        gsap.to(":root", {
            "--logo-width": logoSize,
            delay: 0.5 * duration,
        })
        gsap.set("#anim-wrapper", {
            display: "none",
            delay: duration
        })
        gsap.set(".header", {
            display: "flex",
            delay: duration,
            onComplete: ()=>{
                gsap.from(".header__right .anim", {
                    duration: 0.3,
                    y: "15%",
                    opacity: 0,
                    stagger: 0.2,
                    delay: 0.2
                });
            }
        })
        gsap.fromTo(".home__hero__title span", {
            yPercent: 105,
            skewX: -15,
            opacity: 1,
        },
            {
            delay: duration,
            yPercent: 0,
            skewX: 0,
            opacity: 1,
            stagger: 0.02,
        });
        gsap.fromTo(".home__hero__desc span", {
            yPercent: 10,
            opacity: 0,
        },
            {
            delay: duration + 0.3,
            yPercent: 0,
            opacity: 1,
            stagger: 0.2,
        });
        gsap.fromTo(".home__hero__image", {
            "--insetBottom": "100%",
            opacity: 1,
        },
            {
            "--insetBottom": "-50%",
            opacity: 1,
            delay: duration + 0.8,
            duration: isMobile ? 0.6 : 1,
            ease: "power4.in",
        });
        gsap.fromTo(".home__hero__image", {
            "--brightness": 2.5,
        },
            {
            delay: duration + 0.8,
            duration: isMobile ? 0.6 : 1,
            "--brightness": 1,
            ease: "linear",
        });
        if(isMobile) {
            gsap.fromTo(".home__hero__cta", {
                y: -140,
            }, {
                y: -70,
                duration: 0.5,
                delay: duration + 1.45,
                opacity: 1,
                ease: "elastic.out(1.5 , 0.5)",
            })
        }
        gsap.to(".home__bio", {
            opacity: 1,
            delay: duration + (isMobile ? 1.7 : 0),
        });
        gsap.set(["body", "html"], {
            "overflow-y": "auto",
            delay: duration + 0.8
        })

        setTimeout(() => {
            document.getElementById("anim-wrapper").remove();
        }, duration*1005);
    }

    function scrollTriggers(){
        if(isIos) {
            document.querySelector(".home__bio__decor").classList.add("isIos");
            iosScrollAnim();
            return;
        } else {
            document.querySelector(".home__bio__decor").classList.remove("isIos");
        }

        gsap.registerPlugin(ScrollTrigger);
        if(ScrollTrigger.isTouch === 1){
            ScrollTrigger.normalizeScroll(true);
            ScrollTrigger.config({ ignoreMobileResize: true })
        }

        // Categories animation
        gsap.from(".home__categories__item", {
            scrollTrigger: {
                trigger: ".home__categories",
                start: "top 60%",
                end: "+=100"
                // markers: true,
            },
            x: (index) => index % 2 === 0 ? 50 : -50,
            // y: 15,
            opacity: 0,
            stagger: 0.15,
        });

        // Bio decor
        let scrollTimeout;
        gsap.to(".home__bio__decor", {
            scrollTrigger: {
                trigger: ".home__bio",
                start: "top 80%",
                end: "end " + (isMobile ? "100px" : "0%"),
                scrub: 1,
                // markers: true,
                onUpdate: (self) => {
                    const skewValue = self.getVelocity() / 150;
                    gsap.to(".home__bio__decor", { skewX: -skewValue });

                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(() => {
                        gsap.to(".home__bio__decor", { skewX: 0, ease: "elastic.out(1.5 , 1)" });
                    }, 200);
                }
            },
            x: ()=>"+="+window.innerWidth/(isMobile ? 1.6 : 4),
        });
    }

    setTimeout(enterAnim, 100);
    setTimeout(exitAnim, duration*1200);
    setTimeout(scrollTriggers, 100);
}

function iosScrollAnim() {
    const trigger = document.querySelector(".home__categories");
    const startOffset = window.innerHeight - 80;

    window.addEventListener("scroll", scrollListen);

    // Set initial values
    gsap.set(".home__categories__item", {
        x: (index) => index % 2 === 0 ? 50 : -50,
        opacity: 0,
    });
    function scrollListen() {
        const triggerRect = trigger.getBoundingClientRect();
        if (triggerRect.top <= startOffset) {
            window.removeEventListener("scroll", scrollListen);
            window.removeEventListener("scroll", iosScrollAnim);

            gsap.to(".home__categories__item", {
                x: 0,
                opacity: 1,
                stagger: 0.15,
            });
        }
    }
}
function isIosDevice() {
    return /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
}