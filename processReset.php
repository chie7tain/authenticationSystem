<?php include_once('lib/header.php');


// collecting error count during registration
$errorCount = 0;


// verifying the data that is collected
$email = $_POST["email"] !== "" ? $_POST["email"] : $errorCount++;
$password = $_POST["password"] !== "" ? $_POST["password"] : $errorCount++;

if(!isset($_SESSION['LoggedIn'])){
	$token = $_POST["token"] !== "" ? $_POST["token"] : $errorCount++;
	$_SESSION["token"] = $token;
}
// session storage variables
$_SESSION["email"] = $email;


if ($errorCount > 0) {
	$_SESSION["error"] = 'you have ' . $errorCount . ' errors please check your inputs and try again';
	if ($errorCount < 2) {
		$_SESSION["error"] = 'you have ' . $errorCount . ' error please check your inputs and try again';
	}
	header("Location: reset.php");
}else{
	// this line of code uses the scandir function to check the db/tokens folder for the token that match the user
	$allUsersToken = scandir("db/tokens/");
	$countAllUsersToken = count($allUsersToken);
	// check if user exists first before saving to database and redirect as appropriate
	for ($counter = 0; $counter <= $countAllUsersToken
	; $counter++) {
		$currentTokenFile = $allUsersToken[$counter];
		if ($currentTokenFile == $email . ".json") {
			$tokenContent = file_get_contents('db/tokens/' . $currentTokenFile);
			$tokenObject = json_decode($tokenContent);
			$tokenFromDb = $tokenObject->token;
			if($_SESSION['LoggedIn']){
				$checkToken = true;
			}else{
				$checkToken = $tokenFromDb === $token;
			}
			if($checkToken){
				// check if user is alreadly registered
				$allUsers = scandir("db/users/");
				$countAllUsers = count($allUsers);
				for ($counter = 0; $counter <= $countAllUsers; $counter++) {
					$currentUser = $allUsers[$counter];
					if ($currentUser == $email . ".json") {
						$userString = file_get_contents('db/users/' . $currentUser);
						$userObject = json_decode($userString);
						$userObject->password = password_hash($password, PASSWORD_DEFAULT);
						unlink('db/users/',$currentUser); //using the unlink function we delete details of the user so we can update it
						file_put_contents("db/users/" . $email . ".json", json_encode($userObject));
						$_SESSION['message'] = "Password reset Successfull, you can now Login " . $first_name;
// this code block sends a message to user after the password reset has been completed so as to inform him/her for reference purposes
						$subject = "Password reset successful";
						$message = "Your account password has recently been updated if you did not initiate this process please visit https://www.snh.org to reset your password immeadeately";
						$headers = "From: no-reply@snh.org" . "\r\n" .
							"CC: fredrick@snh.org";
						// the mail function in the code bellow is used to test out our reset mail and sends a mail to the account holder
						$try = mail($email, $subject, $message, $headers);

						header("Location: login.php");
						die();
					}
				}
			}
		}
	}
	$_SESSION['error'] = "Password reset failed token expired or invalid";
	header("Location: login.php");
}