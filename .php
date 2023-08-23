<?php
// Output messages
$response = '';
// Check if the form was submitted
if (isset($_POST['rating'], $_POST['hear_about_us'], $_POST['contact_pref'], $_POST['email'], $_POST['comments'], $_POST['recommend'])) {
	// Process form data 
	// Assign POST variables
	$rating = $_POST['rating'];
	$hear_about_us = $_POST['hear_about_us'];
	$contact_pref = implode(', ', $_POST['contact_pref']);
	$email = $_POST['email'];
	$comments = $_POST['comments'];
	$recommend = $_POST['recommend'];
	// Where to send the mail? It should be your email address
	$to      = 'surveys@yourwebsite.com';
	// Mail from
	$from    = 'noreply@yourwebsite.com';
	// Mail subject
	$subject = 'A user has submitted a survey';
	// Mail headers
	$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'Return-Path: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
	// Capture the email template file as a string
	ob_start();
	include 'email-template.php';
	$email_template = ob_get_clean();
	// Try to send the mail
	if (mail($to, $subject, $email_template, $headers)) {
		// Success
		$response = '<h3>Thank You!</h3><p>With your help, we can improve our services for all our trusted members.</p>';		
	} else {
		// Fail
		$response = '<h3>Error!</h3><p>Message could not be sent! Please check your mail server settings!</a>';
	}
}
<script>
const setStep = step => {
	document.querySelectorAll(".step-content").forEach(element => element.style.display = "none");
	document.querySelector("[data-step='" + step + "']").style.display = "block";
	document.querySelectorAll(".steps .step").forEach((element, index) => {
		index < step-1 ? element.classList.add("complete") : element.classList.remove("complete");
		index == step-1 ? element.classList.add("current") : element.classList.remove("current");
	});
};
document.querySelectorAll("[data-set-step]").forEach(element => {
	element.onclick = event => {
		event.preventDefault();
		setStep(parseInt(element.dataset.setStep));
	};
});
<?php if (!empty($_POST)): ?>
setStep(4);
<?php endif; ?>
</script>