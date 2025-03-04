</main>
<div class="transition-box">
    <div class="loader"></div>
</div>

<script>
    const transitionBox = document.querySelector('.transition-box');
    let isTransitioning = false;
    function animHeader(){
        gsap.from(".header__right .anim", {
            duration: 0.3,
            y: "15%",
            opacity: 0,
            stagger: 0.2,
            delay: 0.2
        });
    }
    function runTransitionAnimation() {
        gsap.to(transitionBox, {
            y: "-100%",
            duration: 0.6,
            ease: 'power4.inOut',
            onComplete: () => {
                transitionBox.classList.add('ranAnim');
                animHeader();
            }
        });
    }

    document.querySelectorAll(`a:not([target="_blank"]):not([href^="#"])`).forEach(link => {
        link.addEventListener('click', (event) => {
            if(isTransitioning) return;
            isTransitioning = true;

            event.preventDefault();
            gsap.fromTo(transitionBox, {
                y: "100%",
                duration: 0.6,
                ease: 'power4.inOut',
            },{
                y: "0%",
                onComplete: () => {
                    isTransitioning = false;
                    window.location.href = link.href;
                }
            });
        });
    });

    function onPageLoad() {
        const menuActive = document.querySelector(".menu.active");
        if(menuActive){
            menuActive.classList.remove("active");
            menuActive.classList.add("inactive");
        }
        runTransitionAnimation();
    }
    window.addEventListener('DOMContentLoaded', onPageLoad);
    window.addEventListener('pageshow', (event) => {
        if (event.persisted) { // Check if the page is loaded from cache
            onPageLoad();
        }
    });
</script>

<footer class="footer">
	<?php
    if(!is_page("kontakt")){
	    get_template_part("template-parts/contact", "form");
    }
	wp_footer();
	?>
</footer>
</body>
</html>
