
<?php
include_once('lib/header.php');
if(isset($_SESSION["LoggedIn"]) && !empty($_SESSION["LoggedIn"])){
	header("Location:dashboard.php");
}

?>

	<?php 
		if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
			echo "<span style='color:green'>".$_SESSION['message']."</span>";
			session_destroy(); 
		}
	?>
		<h1>Login to your Dashboard</h1>

<form method="POST" action="processLogin.php">

			<?php
				if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){

					echo "<span style='color:red'>" .$_SESSION["error"]."</span>";
					// removes session variables
					// session_unset();
					// destroys session
					session_destroy();
				}
			?>

		<p>
			<label>Email:</label><br>
			<input
			<?php
				if(isset($_SESSION['email'])){
					echo"value=".$_SESSION["email"];
				}
			?>
			type="text" name="email" placeholder="example@email.com">
		</p>

		<p>
			<label>Password:</label><br>
			<input type="password" name="password" placeholder="Password" >
		</p>

		<p>
			<input type="Submit" value="Login">
		</p>
	</form>
<?php include_once('lib/footer.php')?>