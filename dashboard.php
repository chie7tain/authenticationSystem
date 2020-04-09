<?php 
include_once('lib/header.php');
if(!isset($_SESSION["LoggedIn"]) && empty($_SESSION["LoggedIn"])){
	header("Location:dashboard.php");
}

?>
<h1>Dashboard</h1>

	 loggedIn User ID:<?php 
	 echo $_SESSION["LoggedIn"];
	 ?>
	 Welcome, <?php echo $_SESSION['fullname'] ?> , You are logged in as (<?php echo $_SESSION['role']?>), and your ID is <?php 
	 echo $_SESSION["LoggedIn"];
	 ?>.

<?php include_once('lib/footer.php')?>