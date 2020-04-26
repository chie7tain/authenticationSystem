<?php session_start();


// collecting error count during registration
$errorCount = 0;


// verifying the data that is collected
$email = $_POST["email"] !=="" ? $_POST["email"]:$errorCount++;
$token = $_POST["token"] !=="" ? $_POST["token"]:$errorCount++;

$password = $_POST["password"] !== "" ? $_POST["password"]:$errorCount ++;

$_SESSION["email"] = $email;
$_SESSION["token"] = $token;

if($errorCount > 0){
	$_SESSION["error"] = 'you have ' . $errorCount . ' errors please check your inputs and try again';
	if($errorCount < 2){
			$_SESSION["error"] = 'you have ' . $errorCount . ' error please check your inputs and try again';
	}
	header("Location: reset.php");
}else{
	$allUsersToken = scandir("db/tokens/");

	$countAllUserToken = count($allUsersToken);

	for($counter = 0; $counter < $countAllUserToken; $counter++){
		$currentTokenFile = $allUsersToken[$counter];
		// print_r($currentTokenFIle);
		// die();
		if($currentTokenFile == $email .'.json'){
		$resetToken = file_get_contents('db/tokens/'.$currentTokenFile);
			$tokenObject = json_decode($resetToken);
			// print_r($tokenObject);
			// die();
			$tokenFromDB = $tokenObject->token;

			if($tokenFromDB === $token){
				// check if user is alreadly registered
				$allUsers = scandir("db/users/");
				$countAllUsers = count($allUsers);

				for ($counter = 0; $counter <= $countAllUsers; $counter++) {
					$currentUser = $allUsers[$counter];
					if ($currentUser == $email . ".json") {
						$userString = file_get_contents('db/users/' . $currentUser);
						$userObject = json_decode($userString);
						$userObject->password = password_hash($password, PASSWORD_DEFAULT);
						unlink("db/users/".$currentUser); //file delete, user data deleted
						file_put_contents('db/users/'.$email .'.json',json_encode($userObject));
						$_SESSION['message'] = "Password reset succesfull, you can now Login";
						header("Location: login.php");
						// inform user of password reset
						$subject = "Password Reset Successfull";
						$message = "your password has just been updated, if you did not initiate the password reset process, pleade visit snh.org to reset your password immeadeately.";
						$headers = "From: no-reply@snh.org" . "\r\n" .
							"CC: fredrick@snh.org";
						$try = mail($email, $subject, $message, $headers);
						die();
						}
					}
				}
			}
			// die();
		}
	}
	$_SESSION['error'] = "Password Reset failed, token expired for ". ' ' . $email . " invalid or invalid request for ".' ' . $email;
	header("Location: login.php");
// }