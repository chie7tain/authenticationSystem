<!-- this function would screen the form data returned from the user -->

<?php
// session_start();
function test_input($data)
{
  $data = trim($data); //this function call trims all white space
  $data = stripslashes($data); //this function call removes all slashesh
  $data = htmlspecialchars($data); // this function call converts all html code the may have been inputed by the user
  return $data;
}
function useTestIput($value)
{
  for ($i = 0; $i < count($_POST); $i++) {
    if (checkIfEmpty($_POST[$value])) {
      return;
    } else {
      test_input($value);
    }
  }
}

// this function checks the values if they are empty and if so returns an error
function checkIfEmpty($value)
{
  if ($_POST) {
    for ($i = 0; $i < count($_POST); $i++) {
      if (empty($_POST[$value]) == $_POST[$value]) {
        $_SESSION['error'] = $value . ' ' . 'is required';
        // print_r($_SESSION['error']);
        header("Location:register.php");
      }
    }
  }
}
// this function checks the name fields for only letters and whitespace
function checkForLetters($value)
{
  if (!preg_match("/^[a-zA-Z ]*$/", $value)) {
    $_SESSION['error'] = "only letters and white space allowed";
    header("Location:register.php");
  } elseif ($value == $_SESSION['first_name'] && strlen($value) < 3) {
    $_SESSION['error'] = "first name must be greater than 2 letters";
    header("Location:register.php");
  }
  // if($value == $_SESSION['last_name'] && strlen($value) < 3) {
  //   // print_r($_SESSION[])
  //   $_SESSION['error'] = "last name must be greater than 2 letters";
  //   header("Location:register.php");
  // }
}
function checkEmail($value)
{
  if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "invalid email format: only stevejobs@apple.com something like that";
    header("Location:register.php");
  } elseif ($value == $_SESSION['email'] && strlen($value) < 5) {
    $_SESSION['error'] = "email must not be less than 5 letters";
    header("Location:register.php");
  }
}
