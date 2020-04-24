<?php include_once('lib/header.php')?>
	
	<h3>Reset Password</h3>
	<p>Reset Password associated with your account: [email]</p>

	<div>
		<form method="POST" action="processReset.php">
			<?php
				if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){

					echo "<span style='color:red'>" .$_SESSION["error"]."</span>";
					// removes session variables
					// session_unset();
					// destroys session
					session_destroy();
				}
			?>
			<input type="hidden" name="token" value="<?php echo $_GET['token']?>">
			<div>
				<label>Email:</label><br>
				<input readonly="" value="[email]" type="email" name="email" placeholder="email@example.com">
			</div>
			<div>
				<label>Enter New Password</label><br>
				<input type="Password" name="password" placeholder="Password">
			</div>
			<input type="submit" name="" value="Reset Password">
		</form>
	</div>
<?php include_once('lib/footer.php')?>