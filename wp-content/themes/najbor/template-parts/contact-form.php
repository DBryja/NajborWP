<?php
$lang = get_site_language();
$fields = ml_form_fields();
$heading = ml_contact_heading();
$alerts = ml_alerts();
?>

<div class="alert alert--success" style="display: none;" role="alert" aria-live="polite">
    <div class="alert-icon" aria-hidden="true"></div>
    <p class="alert-message"><?php echo $alerts["success"][$lang]?></p>
</div>
<div class="alert alert--error" style="display: flex;" role="alert" aria-live="polite">
    <div class="alert-icon" aria-hidden="true"></div>
    <p class="alert-message"><?php echo $alerts["error"][$lang]?></p>
</div>

<div id="contact" class="contact">
    <div class="contact__decoration" aria-hidden="true"></div>
    <form method="POST" action="" class="form" id="contactForm" aria-labelledby="formHeading">
        <h2 id="formHeading">
            <?php echo $heading[$lang]?>
        </h2>
        <input type="hidden" id="page-title" name="page_title"/>
        <div class="form-field form-field__wrapper">
            <label class="form-field__label" for="name"><?php echo $fields["name"][$lang]?></label><br>
			<input class="form-field__input" type="text" id="name" name="name" required aria-required="true"><br>
		</div>
		<div class="form-field form-field__wrapper">
			<label class="form-field__label" for="email"><?php echo $fields["email"][$lang]?></label><br>
			<input class="form-field__input" type="email" id="email" name="email" required aria-required="true"><br>
		</div>
		<div class="form-field form-field__wrapper">
			<label class="form-field__label" for="subject"><?php echo $fields["subject"][$lang]?></label><br>
			<input class="form-field__input" type="text" id="subject" name="subject" required aria-required="true"><br>
		</div>
		<div class="form-field form-field__wrapper">
			<label class="form-field__label" for="message"><?php echo $fields["message"][$lang]?></label><br>
			<textarea class="form-field__input form-field__input--textarea" id="message" name="message" rows="5" required aria-required="true"></textarea><br>
		</div>
        <div class="form-field form-field__row">
            <div class="links" role="group" aria-label="Social Links">
                <a href="https://www.facebook.com/malarstwonajbor" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/></svg>
                </a>
                <a href="mailto: wiktornajbor@gmail.com" aria-label="e-mail">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                </a>
            </div>
            <button type="submit" class="form-field__submit cursor--click" aria-label="Submit form">
                <span class="arrow" aria-hidden="true"></span>
            </button>
        </div>
	</form>
</div>
<script>
    function showAlert(success) {
        const type = success ? 'success' : 'error';
        const alert = document.querySelector(`.alert--${type}`);
        gsap.to(alert, {
            opacity: 1,
            display: 'flex',
            duration: 0.5,
            y: 200,
            ease: "power2.out"
        })

        setTimeout(() => {
            gsap.to(alert, {
                opacity: 0,
                display: 'none',
                duration: 0.5,
                y: 0,
                ease: "power2.in"
            })
        }, 3000);
    }
    const form = document.getElementById('contactForm');

    document.getElementById("page-title").value = document.title;
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        cursor.classList.add("loading");
        form.querySelector("button").disabled = true;

        const formData = new FormData(this);
        formData.append('action', 'send_email');

        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // const formResponse = document.getElementById('formResponse');
                if(data.success) {
                    form.reset();
                    document.getElementById("page-title").value = document.title;
                }
                showAlert(data.success);
            })
            .catch(error => {
                document.getElementById('formResponse').innerHTML = "<p>Error sending form:" + error +"</p>";
            })
            .finally(() => {
                cursor.classList.remove("loading");
                form.querySelector("button").disabled = false;
            });
    });

    const fields = document.querySelectorAll(".form-field__input");
    fields.forEach((field)=>{
        if (field.value.trim() !== "") {
            field.classList.add("filled");
        } else {
            field.classList.remove("filled");
        }

        field.addEventListener("input", () => {
            if (field.value.trim() !== "") {
                field.classList.add("filled");
            } else {
                field.classList.remove("filled");
            }
        });
    })
</script>
