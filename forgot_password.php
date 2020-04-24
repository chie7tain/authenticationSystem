<?php include_once('lib/header.php')?>
	
	<h3>Forgot password</h3>
	<p>Provide the email address associated with your accout</p>

	<div>
		<form method="POST" action="processForgot.php">
			<?php
				if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){

					echo "<span style='color:red'>" .$_SESSION["error"]."</span>";
					// removes session variables
					// session_unset();
					// destroys session
					session_destroy();
				}
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