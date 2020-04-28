<?php

session_start();

// error counter
$errorCount = 0;

// verifying input data from user
$email = $_POST["email"] !=="" ? $_POST["email"]:$errorCount++;
$password = $_POST["password"] !== "" ? $_POST["password"]:$errorCount ++;

$_SESSION["email"] = $email;

// error checker
if($errorCount > 0){
	$_SESSION["error"] = "you have ". $errorCount.
	" errors in your submission please check";
		if($errorCount == 1){
		$_SESSION["error"] = "you have ". $errorCount.
		" error in your submission please check";
	 }
 header("Location: login.php");
}else{
	// check if user is alreadly registered
	$allUsers = scandir("db/users/");
	$countAllUsers = count($allUsers);

	for($counter = 0; $counter <= $countAllUsers; $counter++ ){
		$currentUser = $allUsers[$counter];
			if($currentUser == $email . ".json"){
			$userString = file_get_contents('db/users/'.$currentUser);
			$userObject = json_decode($userString);
			$passwordFromDb = $userObject->password;
			$passwordFromUser = password_verify($password, $passwordFromDb);
				if($passwordFromDb == $passwordFromUser){
					$_SESSION["LoggedIn"] = $userObject ->id;
				  $_SESSION["email"] = $userObject->email;
					$_SESSION['fullname'] = $userObject->first_name . " " . $userObject->last_name;
					$_SESSION["role"] = $userObject->designation;
					header("Location:dashboard.php");
					// redirect to user dashboard
					die();
				}
				// die();
			}
		}
	}
	$_SESSION["error"] = "Invalid login details please check your input";
	header("Location:login.php");
	die();
// }
?>