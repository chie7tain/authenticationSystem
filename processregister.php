<?php session_start();


// collecting error count during registration
$errorCount = 0;


// verifying the data that is collected

$first_name = $_POST["first_name"] != "" ? $_POST["first_name"] : $errorCount++ ;

$last_name = $_POST["last_name"] !== ""? $_POST["last_name"]:$errorCount++;

$email = $_POST["email"] !=="" ? $_POST["email"]:$errorCount++;
if($email = $_POST['email'] ===)
$gender = $_POST["gender"] !== "" ? $_POST["gender"]:$errorCount++;

$designation = $_POST["designation"] !== "" ? $_POST["designation"]:$errorCount++;

$department = $_POST["department"] !== "" ? $_POST["department"]:$errorCount++;

$password = $_POST["password"] !== "" ? $_POST["password"]:$errorCount ++;


$_SESSION["first_name"] = $first_name;
$_SESSION["last_name"] = $last_name;
$_SESSION["email"] = $email;
$_SESSION["gender"] = $gender;
$_SESSION["designation"] = $designation;
$_SESSION["department"] = $department;
// $_SESSION['password'] = $password;

if($errorCount > 0){
	$_SESSION["error"] = 'you have ' . $errorCount . ' errors please check your inputs and try again';
	if($errorCount < 2){
			$_SESSION["error"] = 'you have ' . $errorCount . ' error please check your inputs and try again';
	}
	header("Location: register.php");
}else{
	$allUsers = scandir("db/users/");
	$countAllUsers = count($allUsers);
	$newUserId = $countAllUsers -1;
	$userObject = [
		"id" => $newUserId,
		'first_name'=> $first_name,
		'last_name' => $last_name,
		'email' => $email,
		'password' => password_hash($password, PASSWORD_DEFAULT),//password encryption
		'gender' => $gender,
		"designation" => $designation,
		"department"=> $department
	];
	// check if user exists first before saving to database and redirect as appropriate
	for($counter = 0; $counter <= $countAllUsers; $counter++ ){
		$currentUser = $allUsers[$counter];
		if($currentUser == $email . ".json"){
			$_SESSION['error'] = "Registration failed, " .$email . " already exists";
			header("Location: register.php");
			die();
		}
	}
	// save data to the database
	file_put_contents("db/users/" .$email. ".json",json_encode($userObject));
	$_SESSION['message'] = "Registration Successfull, Login " . $first_name;
	header("Location: login.php");
}
?>