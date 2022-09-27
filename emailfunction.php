<?php session_start();
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
//for filter function
if(isset($_REQUEST['checkemail'])){
	include 'connect.php';
	$email = $_REQUEST['checkemail'];
	$Get_query = "select * FROM client WHERE email ='$email'";		
			
	$result = $conn->query($Get_query);
	if($result->rowCount() > 0){
		echo "unavailable";											
	}else{
		echo "availabless";
	}
}
if(isset($_REQUEST['verifyemail'])){
	
	$email = $_REQUEST['verifyemail'];
	$fullname = $_REQUEST['name'];
	$code = $_REQUEST['vr_code'];
	$Date_now= date("Y/m/d");
	$to_email = $email;


	require $_SERVER['DOCUMENT_ROOT'] . '/crownparkresto/mail/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/crownparkresto/mail/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/crownparkresto/mail/SMTP.php';

	$mail = new PHPMailer;
	$mail->isSMTP(); 
	$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
	$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
	$mail->Port = 587; // TLS only
	$mail->SMTPSecure = 'tls'; // ssl is deprecated
	$mail->SMTPAuth = true;
	$mail->Username = 'blanquerae0295'; // email
	$mail->Password = 'ggufxdspkehvboyf'; // password
	$mail->setFrom('blanquerae0295@gmail.com', 'Elias Blanquera III'); // From email and name
	$mail->addAddress($to_email, $fullname); // to email and name
	$mail->Subject = 'CrownPark Restaurant Account Verification';
	$mail->msgHTML('<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
					  <div style="margin:50px auto;width:70%;padding:20px 0">
						<div style="border-bottom:1px solid #eee">
						  <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">Crown Park Resto Account Registration</a>
						</div>
						<p style="font-size:1.1em">Hi,</p>
						<p>Thank you for choosing CrownPark Restaurant. Use the following Code to complete your Sign Up procedures. Verification Code  is valid for 5 minutes</p>
						<h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">'.$code.'</h2>
						<p style="font-size:0.9em;">Regards,<br />CrownPark Restaurant</p>
						<hr style="border:none;border-top:1px solid #eee" />
						<div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
						  <p>Your Brand Inc</p>
						  <p>1600 Amphitheatre Parkway</p>
						  <p>California</p>
						</div>
					  </div>
					</div>'); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
	$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
	// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
	$mail->SMTPOptions = array(
						'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
						)
					);
	if(!$mail->send()){
		echo "Mailer Error: " . $mail->ErrorInfo;
	}else{
		echo "Message sent!";
	}			  
	
}
?>