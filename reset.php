<?php include_once('lib/header.php');
// this line of code checks if the token is set either by GET or by Session and if not it means the user has not the proper authorization to view the reset password page i.e he/she has not gone to a registered email to get he reset link which contains a token
	if(!isset($_SESSION['LoggedIn']) && !isset($_GET['token']) && !isset($_SESSION['token'])){
		$_SESSION['error'] = "you are not authorised to password reset page ";
		header("Location: login.php");
	}
?>
	<h3>Reset Password</h3>
	<p>Reset Password associated with your account: ['email']</p>

	<div>
		<form method="POST" action="processReset.php">
			<?php
			if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){
				echo "<span style='color:red'>" .$_SESSION["error"]."</span>";
					// this line of code removes session variables after refresh
					session_destroy();
				}
			?>
			<?php
			// TODO dont forget to add sessin logged in
			if(!isset($_SESSION['LoggedIn'])){
				?>
			<input
			<?php
				if(isset($_SESSION['token'])){
					echo "value='" . $_SESSION['token'] ."'";
					}else{
					echo "value='" .$_GET['token']. "'";
					}
				?>
				type="hidden" name="token">
			<?php
		 }
		 ?>
			<div>
				<label>Email:</label><br>
				<input
				<?php
					if(isset($_SESSION['email'])){
						echo "value='".$_SESSION['email']."'";
					}
				?>
				type="email" name="email" placeholder="email@example.com">
			</div>
			<div>
				<label>Enter New Password</label><br>
				<input type="Password" name="password" placeholder="Password">
			</div>
			<input type="submit" name="" value="Reset Password">
		</form>
	</div>
<?php include_once('lib/footer.php')?>