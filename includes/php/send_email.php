<?php
	
	session_start();
	
	include_once('class.phpmail.php');
	
	if( isset($_POST['quick_contact_submitted']) ) {
		
		$full_name = $_POST['full_name'];
		$email_address = $_POST['email_address'];
		$message = $_POST['message'];
		$email_address_contact = $_POST['email_address_contact'];
		
		if ( empty($full_name) ){
			
			print 'Please fill in your name'; 
			exit;
			
		} elseif( validate_email($email_address) == false ){
			
			print 'Please provide a valid email address';
			exit;
			
		} elseif( empty($message) ){
			
			print 'Please provide a message'; 
			exit;
			
		} else {
		
			//Send the report
			$mailer = PhpMail::getInstance();
			
			$message_santizied = $mailer->sanitize_message($message);
			
			$subject = 'Quick contact form inquiry';
			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers .= 'From: webmaster@hopecharitytheme.com <webmaster@hopecharitytheme.com>' . "\r\n";
			
			$body = ' 
					<html>
					<head>
					  <title>Quick contact form inquiry</title>
					</head>
					<body>
					  
					  <p>Full Name: '.$full_name.'</p>
					  <p>Email Address: '.$email_address.'</p>
					  <p>Message: '.$message_santizied.'</p>
					  
					</body>
					</html>
					';
			
			$result = $mailer->sendMail($email_address_contact, $subject, $body, $headers);
			
			if( $result !== false ){
				echo 'Your inquiry has been received, thank you.';
			} else {
				echo 'A system error occurred. Please try again later.';	
			}
			
		}//end of if
		
		
	}//end of POST check
	
	function validate_email($value){
			
		if( !empty($value) ) {
			
			if( !preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $value)) {
				
				return false;
				
			} else {
				
				return true;
				
			}
			
		} else {
			
			return false;
			
		}
		
	}//end of validate_email()
		
		

?>