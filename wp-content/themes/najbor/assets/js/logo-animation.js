document.addEventListener("DOMContentLoaded", runGSAP);
function runGSAP(){
    const logoSize = getComputedStyle(document.documentElement).getPropertyValue("--exit-width");
    const headerStyle = getComputedStyle(document.querySelector("header.header"));
    const paddings = [headerStyle.paddingTop, headerStyle.paddingRight, headerStyle.paddingBottom, headerStyle.paddingLeft];

    gsap.registerPlugin(gsap.plugins.motionPath);
    const duration = 1.6;
    const ease = "elastic.inOut(1, 0.75)";

    gsap.set(".header", {
        display: "none"
    })
    gsap.set(["body", "html"], {
        "overflow-y": "hidden"
    })
    gsap.set([".home__hero__title span", ".home__hero__desc span", ".home__hero__image"], {
        opacity: 0,
    })

    function enterAnim() {
        sizes = {width: window.innerWidth, height: window.innerHeight};
        gsap.to("#autobus", {
            duration: duration,
            x: -300,
            ease: ease
        });
        gsap.to("#samolot", {
            duration: duration,
            x: -150,
            y: -250,
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
        sizes = {width: window.innerWidth, height: window.innerHeight};
        gsap.to("#autobus", {
            duration: duration,
            x: sizes.width * 1.3,
            ease: ease
        });
        gsap.to("#samolot", {
            duration: duration,
            x: -sizes.width * 1.3,
            y: -sizes.height,
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
        gsap.set(["body", "html"], {
            "overflow-y": "auto",
            delay: duration
        })

        gsap.fromTo(".home__hero__title span", {
            yPercent: 105,
            skewX: -15,
            opacity: 1,
        }, {
            delay: duration,
            yPercent: 0,
            skewX: 0,
            opacity: 1,
            stagger: 0.02,
        });
        gsap.fromTo(".home__hero__desc span", {
            yPercent: 10,
            opacity: 0,
        }, {
            delay: duration + 0.3,
            yPercent: 0,
            opacity: 1,
            stagger: 0.2,
        });
        gsap.fromTo(".home__hero__image", {
            "--insetBottom": "100%",
            opacity: 1,
        }, {
            delay: duration + 0.8,
            duration: 1,
            "--insetBottom": "-20%",
            ease: "power4.in",
            opacity: 1,
        });
        gsap.fromTo(".home__hero__image", {
            "--brightness": 2.5,
        }, {
            delay: duration + 0.8,
            duration: 1,
            "--brightness": 1,
            ease: "linear",
        });
        // gsap.fromTo(".home__hero__image", {
        //     "--insetBottom": "100%",
        //     "--brightness": 2,
        //     opacity: 1,
        // }, {
        //     delay: duration + 0.8,
        //     duration: 1,
        //     "--insetBottom": "-20%",
        //     "--brightness": 1,
        //     ease: "power4.in",
        //     opacity: 1,
        // })



        setTimeout(() => {
            document.getElementById("anim-wrapper").remove();
        }, duration*1005);
    }
    setTimeout(enterAnim, 100);
    setTimeout(exitAnim, duration*1200);
}