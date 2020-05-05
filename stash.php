<?php include_once('lib/header.php');
include_once('./functions/validations.php');
include_once('./functions/validations.php');

// collecting error count during registration
// $errorCount = 0;
// verifying the data that is collected

// $first_name ='';
// $last_name = '';
// $email = '';
// $gender = '';
// $department = '';
// $designation = '';
// $password = '';
if($_POST){
		if(empty($_POST["first_name"])){
				$first_name_Err = "first name is required";
		}else{
				$first_name = test_input($_POST["first_name"]);
				// we are setting variables and returning them after the user submits and errors are found so the user does not have to type again
				$_SESSION["first_name"] = $first_name;
				// this line below checks the input for only letters and whitespace
				checkForLetters($first_name);
			}
		if(empty($_POST["last_name"])){
			$_SESSION["error"] = "Last name is required";
		}else{
				$last_name = test_input($_POST['last_name']);
				$_SESSION["last_name"] = $last_name;
				checkForLetters($last_name);
		}
		if(empty($_POST["email"])){
				$_SESSION["error"] = "email is required";
		}else{
				$email = test_input($_POST['email']);
				$_SESSION["email"] = $email;
				checkEmail($email);
		}
		if(empty($_POST["gender"])){
				$_SESSION["error"] = "gender is required";
		}else{
				$gender = test_input($_POST['gender']);
				$_SESSION["gender"] = $gender;
				// checkForLetters($gender);
		}
		if(empty($_POST["department"])){
				$_SESSION["error"] = "The department field is required";
		}else{
				$department = test_input($_POST['department']);
				$_SESSION["department"] = $department;
				checkForLetters($department);
		}
		if(empty($_POST["designation"])){
				$_SESSION["error"] = "The designation field is required";
		}else{
				$designation = test_input($_POST['designation']);
				$_SESSION["designation"] = $designation;
				// checkForLetters($designation);
		}
		if(empty($_POST["password"])){
				$_SESSION["error"] = "The password field is required";
		}else{
				$password = test_input($_POST['password']);
				if(strlen($password) < 5){
					$_SESSION['error'] = "Password Not strong enough";
					header("Location:register.php");
				}
		}
		// echo "got here";
		// die();
}else{
			echo "got here";
		die();
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
