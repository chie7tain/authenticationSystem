
<?php
include_once('lib/header.php');
require_once('functions/alert.php');

if(isset($_SESSION["LoggedIn"]) && !empty($_SESSION["LoggedIn"])){
	header("Location:dashboard.php");
}

?>

	<?php
	print_message();
	?>
		<header class="header-container">
			<h1>Login to your Dashboard</h1>
		</header>
<div class="form-container">
<form method="POST" action="processLogin.php">
			<?php
			print_error();
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