<?php
//email.php
//Wes Hicks
//Written for John Dragonetti 3/4/2014
if(isset($_POST['reason']) && isset($_POST['message'])){

	switch ($_POST['reason']) {
		case "general":
			$reason = "General Inquiry";
		break;
		case "design":
			$reason = "Design Request";
		break;
		case "info":
			$reason = "Information Inquiry";
		break;
		case "example":
			$reason = "Work Example Request";
		break;
		case "feedback":
			$reason = "Design Feedback";
		break;
		case "testimonial":
			$reason = "Testimonial";
		break;
		default:
			$reason = "General Inquiry";
		break;
				
	}
	if(isset($_POST['email'])) {
		$email = $_POST['email'];
		$boolean_email = is_email($_POST['email']);
		if(!$boolean_email){	
			$email_notice = "This may not be a valid email address: ";
		} else {
			$email_notice = "";
		}
		$reply_email = $email_notice."".$email;
	} else {
		$reply_email = "Not specified";
	}

	$msg = htmlspecialchars($_POST['message']);
	
	$subject   = "Automated email | JohnDragonetti.me";
	$header    = 'From: noreply@johndragonetti.me';
	$message = 'This message was sent via the contact form on JohnDragonetti.me: 
	Reply email: '.$reply_email.'
	Reason for contact: '.$reason.'
	Message: '.$msg.'


	';

	$text = "You've just been sent an email on johndragonetti.me! Check your email!";

	if(mail("contactjohndragonetti@gmail.com", $subject, $message, $header)){
		if(mail("7045789937@vtext.com", $subject, $text, $header)) {
			header("Location: http://johndragonetti.me");	
		}
	}else {
		echo "There was an error sending your email.";
	}
}
function is_email($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

?>