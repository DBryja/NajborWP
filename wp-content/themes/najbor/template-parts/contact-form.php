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

<div class="contact">
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
                <a href="https://www.facebook.com/profile.php?id=100063761825254" aria-label="Facebook">
                    <i class="fa-brands fa-facebook" aria-hidden="true"></i>
                </a>
                <a href="mailto: wiktornajbor@gmail.com" aria-label="e-mail">
                    <i class="fa-solid fa-envelope"></i>
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
                const formResponse = document.getElementById('formResponse');
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
