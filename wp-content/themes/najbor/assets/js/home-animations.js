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
            x: isMobile ? -100 : -350,
            ease: ease
        });
        gsap.to("#samolot", {
            duration: duration,
            x: isMobile ? -70 : -150,
            y: isMobile ? -100 : -250,
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
            x: ()=> -sizes.width * 1.3,
            y: ()=> -sizes.height,
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
        gsap.registerPlugin(ScrollTrigger);
        if(ScrollTrigger.isTouch === 1){
            ScrollTrigger.normalizeScroll(true);
            ScrollTrigger.config({ ignoreMobileResize: true })
        }

        let scrollTimeout;
        const triggerConfig = {
            trigger: ".home__bio",
            start: "top 80%",
            end: "end " + (isMobile ? "100px" : "0%"),
            scrub: 1,
            // markers: true,
        };

        // Only add onUpdate for non-iOS devices
        if (!isIos) {
            triggerConfig.onUpdate = (self) => {
                const skewValue = self.getVelocity() / 150;
                gsap.to(".home__bio__decor", { skewX: -skewValue });

                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    gsap.to(".home__bio__decor", { skewX: 0, ease: "elastic.out(1.5 , 1)" });
                }, 200);
            };
        }

        gsap.to(".home__bio__decor", {
            scrollTrigger: triggerConfig,
            x: ()=>"+="+window.innerWidth/(isMobile ? 1.6 : 4),
        });
    }

    setTimeout(enterAnim, 100);
    setTimeout(exitAnim, duration*1200);
    setTimeout(scrollTriggers, 100);
}

function isIosDevice() {
    return /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
}