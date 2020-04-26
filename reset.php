<?php 

include_once('lib/header.php');
if(!isset($_GET['token']) && !isset($_SESSION['token'])){
	$_SESSION['error'] = "you are not authorised to view that page";
	header("Location: login.php");
}

?>
	

	<h3>Reset Password</h3>
	<p>Reset Password associated with your account: [email]</p>

	<div>
		<form method="POST" action="processReset.php">
			<?php
				if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){

					echo "<span style='color:red'>" .$_SESSION["error"]."</span>";
					// removes session variables
					session_destroy();
				}
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
			<div>
				<label>Email:</label><br>
				<input 
				<?php
				if(isset($_SESSION['email'])){
					echo "value=''" .$_SESSION['email'];
				}
				?>
				 value="" type="email" name="email" placeholder="email@example.com">
			</div>
			<div>
				<label>Enter New Password</label><br>
				<input type="Password" name="password" placeholder="Password">
			</div>
			<input type="submit" name="" value="Reset Password">
		</form>
	</div>
<?php include_once('lib/footer.php')?>