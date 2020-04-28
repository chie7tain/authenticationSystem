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

	// this loop goes through out database and finds the relevant user and thens is terminated by the die function
	for($counter = 0; $counter <= $countAllUsers; $counter++ ){
		$currentUser = $allUsers[$counter];
// this if statement checks the currentuser against the one stored in our database
		if($currentUser == $email . ".json"){
			//the following leads to a more random token using alphabets numbers and special characters
			$token = "";
			$alphabets = ['a','A','b','B','c','C','d','D','e','E','f','F','g','G','h','H','i','I','j','J','l','L','m','M','n','N','o','O','p','P','q','Q','r','R','s','S','t','T','u','U','v','V','w','W','x','X','y','Y','z','Z',1,2,3,4,5,6,7,8,9,0,'$','%','/','@'];
// this loop creates a random token for the reset password
			for($i = 0;$i < 20; $i++){
				//this mt_rand function aka rand sets the min and max number within which it would set the index we would use in our token generation 20 times
				$index = mt_rand(0,count($alphabets));
				// $secIndex = mt_rand(0,26);
				$token .= $alphabets[$index];
		}
			// end of loop that creates the random token
			// these are parameters to the mail function
			$subject = "Password Reset Link";
			$message = "A password reset has been initiated from your account, if you did not initiate this reset, please disregard this message, otherwise, visit: localhost/smh/reset.php?token=$token";
			$headers = "From: no-reply@snh.org" . "\r\n" .
			"CC: fredrick@snh.org";
// this code here ataches a token to the email address of the individual who is trying to change his/her password and saves the token in to the tokens part of the db
			file_put_contents("db/tokens/" .$email. ".json",json_encode(["token" => $token]));
// the mail function in the code bellow is used to test out our reset mail and sends a mail to the account holder
			$try = mail($email,$subject,$message,$headers);
			if($try){
				$_SESSION['message'] = "Password reset has been sent to your email: " . $email;
				header("Location: login.php");
			}else{
				$_SESSION['error'] = " we could not send password reset to: " . $email;
				header("Location: forgot_password.php");
			}
			die();
		}
	}
	$_SESSION['error'] = "This Email: " . $email. " is not registered ERR: ";
	header("Location: forgot_password.php");
}