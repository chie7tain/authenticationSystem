<?php session_start();

$errorCount = 0;

$email = $_POST["email"] !=="" ? $_POST["email"]:$errorCount++;

$_SESSION["email"] = $email;

if($errorCount >0){
	$session_error = "You have " . $errorCount . "error";
	if($errorCount > 1){
		$session_error .= "s";
	}
	$session_error.= " in your form submission ";
	$_SESSION["error"] = $session_error;
	header("Location: forgot_password.php");
}else{
	$allUsers = scandir("db/users/");
	$countAllUsers = count($allUsers);

	// check if user exists 
	for($counter = 0; $counter <= $countAllUsers; $counter++ ){
		$currentUser = $allUsers[$counter];

		if($currentUser == $email . ".json"){
			// token would help to confirm users
			$token = "iamjohnbull";
			$subject = "Password Reset Link";
			$message = "A password reset has been initiated from your account, if you did not initiate this reset, please disregard this message, otherwise, visit: localhost/smh/reset.php?token=$token";
			$headers = "From: no-reply@snh.org" . "\r\n" . 
			"CC: fredrick@snh.org";
			
			file_put_contents("db/tokens/" .$email. ".json",json_encode(["token"-> $token]));

			$try = mail($email,$subject,$message,$headers);
			// print_r($try);
			// die();
			if($try){
				$_SESSION['error'] = "Password reset has been sent to your email: " . $email;
				header("Location: login.php");
			}else{
				$_SESSION['error'] = "Something went wrong, we could not send password reset to: " . $email;
				header("Location: forgot_password.php");
			}
			die();
		}
	}
	$_SESSION['error'] = "This Email: " . $email. " is not registered ERR: ";
	header("Location: forgot_password.php");
}