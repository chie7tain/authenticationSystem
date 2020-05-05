<?php include_once('lib/header.php');
	require_once('functions/alert.php');
?>

	<h3>Forgot password</h3>
	<p>Provide the email address associated with your accout</p>

	<div>
		<form method="POST" action="processForgot.php">
			<?php
				print_error();
				?>
			<div>
				<label>Email:</label><br>
				<input
				<?php
					if(isset($_SESSION['email'])){
						echo "value=" . $_SESSION['email'];
					}
				?>
				 type="email" name="email" placeholder="email@example.com">
			</div>
			<input type="submit" name="" value="send reset code">
		</form>
	</div>
<?php include_once('lib/footer.php')?>