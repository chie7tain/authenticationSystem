<?php
include_once('lib/header.php');
if(!isset($_SESSION["LoggedIn"]) && empty($_SESSION["LoggedIn"])){
	header("Location:login.php");
}

?>
	<header class="header-container">
		<h1>Dashboard</h1>
	</header>

<div class="dashboard">
	 <h2>loggedIn User ID:<?php
	 echo $_SESSION["LoggedIn"];

	 ?>
	</h2>

	<div>
		<p>
	 Welcome, <?php echo $_SESSION['fullname'] ?>
	 </p>
	 </div>
	 <div>
	 	<p>
	  You are logged in as (<?php echo $_SESSION['role']?>), and your ID is <?php
	 echo $_SESSION["LoggedIn"];
	 ?>
	</p>
	</div>
</div>
<?php include_once('lib/footer.php')?>