
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
		}elseif (isset($_SESSION['error'])) {
			echo "<span style='color:red'>".$_SESSION['error']."</span>";
			session_destroy();
		}

	?>
		<header class="header-container">
			<h1>Login to your Dashboard</h1>
		</header>
<div class="form-container">
<form method="POST" action="processLogin.php">

			<?php
				if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){

					echo "<span style='color:red'>" .$_SESSION["error"]."</span>";
					// removes session variables
					// session_unset();
					// destroys session
					// session_destroy();
				}
			?>

		<div>
			<div>
			<label class="field-label">Email:</label>
			</div>
			<input class="input-field"
			<?php
				if(isset($_SESSION['email'])){
					echo"value=".$_SESSION["email"];
				}
			?>
			type="text" name="email" placeholder="example@email.com">
		</div>

		<div>
			<div>
			<label class="field-label">Password:</label>
			</div>
			<input class="input-field" type="password" name="password" placeholder="Password" >
		</div>

		<div>
			<input class="btn" type="Submit" value="Login">
		</div>
	</form>
</div>
<?php include_once('lib/footer.php')?>