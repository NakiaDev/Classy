<?php
if (isset($_POST['email'])) {
	// CHANGE THE TWO LINES BELOW
	$email_to = "email@email.com"
	$email_subject = "http://www.classysound.com";

	function died($error) {
		// your error code can go here
		echo "We're sorry, but there's errors found with the form you submitted.\n\n";
		echo $error."\n\n";
		echo "Please go back and fix these errors.\n\n";
		die();
	}

	// validation expected data exists
	if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['message'])) {
		died('We are sorry, but there appears to be a problem with the form you submitted.');
	}

	$name = $_POST['name']; // required
	$email_from = $_POST['email']; // required
	$company = $_POST['company']; // not required
	$message = $_POST['message']; // required

	$error_message = "";
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if (!preg_match($email_exp,$email_from)) {
  	$error_message .= 'The Email Address you entered does not appear to be valid.';
  }

	$string_exp = "/^[A-Za-z .'-]+$/";

  if (!preg_match($string_exp,$name)) {
  	$error_message .= 'The Name you entered does not appear to be valid.';
  }

  if (strlen($message) < 2) {
  	$error_message .= 'The Message you entered do not appear to be valid.';
  }

  if (strlen($error_message) > 0) {
  	died($error_message);
  }

	$email_message = "Form details below.\n\n";

	function clean_string($string) {
	  $bad = array("content-type","bcc:","to:","cc:","href");
	  return str_replace($bad,"",$string);
	}

	$email_message .= "Name: ".clean_string($name)."\n";
	$email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Company: ".clean_string($company)."\n";
	$email_message .= "Message: ".clean_string($message)."\n";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>

Thank you for contacting us. We will be in touch with you very soon.

<?php
}
die();
?>
