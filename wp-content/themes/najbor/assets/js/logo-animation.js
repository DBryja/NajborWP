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

    function enterAnim() {
        sizes = {width: window.innerWidth, height: window.innerHeight};
        gsap.from("#autobus", {
            duration: duration,
            x: -sizes.width,
            ease: ease
        });
        gsap.from("#samolot", {
            duration: duration,
            x: sizes.width,
            y: sizes.height / 2,
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
        setTimeout(() => {
            document.getElementById("anim-wrapper").remove();
        }, duration*1005);
    }
    setTimeout(enterAnim, 100);
    setTimeout(exitAnim, duration*1200);
}