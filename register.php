<?php

include_once('lib/header.php');
if(isset($_SESSION["LoggedIn"]) && !empty($_SESSION["LoggedIn"])){
	header("Location:dashboard.php");
}

?>
	<h1>Welcome, Please Register</h1>
	<p>All fields are required</p>


	<form method="POST" action="processregister.php">
		<!-- <p> -->
			<?php
				if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){

					echo "<span style='color:red'>" .$_SESSION["error"]."</span>";
					// removes session variables
					// session_unset();
					// destroys session
					session_destroy();
				}
			?>
		<!-- </p> -->
		<p>
			<label>First Name:</label><br>
			<input
			<?php
			// echo "value='their father'"
				if(isset($_SESSION["first_name"])){
					echo "value=" . $_SESSION["first_name"];
				}
			?>
			type="text" name="first_name" placeholder="First Name" >
		</p>
		<p>
			<label>Last Name:</label><br>
			<input
			<?php
				if(isset($_SESSION["last_name"])){
					echo "value=".$_SESSION["last_name"];
				}
			?>
			 type="text" name="last_name" placeholder="Last Name">
		</p>
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
			<label>Gender:</label><br>
			<select name="gender">
				<option selected="" disabled="">select gender</option>
		<option
			<?php 
				if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female'){
					echo 'selected';
				}
			?>

		>Female</option>

		<option
			<?php 
				if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male'){
					echo 'selected';
				}
			?>
		>Male</option>
			</select>
		</p>

		<p>
			<label>Password:</label>
			<input
			<?php
				if(isset($_SESSION['password'])){
					echo"value=".$_SESSION["password"];
				}
			?> 
			type="password" name="password" placeholder="Password" >
		</p>


		<p>
<label>Designation:</label>
	<select name="designation">
	<option selected="" disabled="">select designation</option>
	<option
		<?php 
			if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team(MT)'){
				echo 'selected';
			}
		?>
	>Medical Team(MT)</option>

	<option
	<?php 
		if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient'){
			echo 'selected';
		}
		?>
	>Patient</option>
	</select>
		</p>

		<p>
			<label>Department:</label>
			<input
			<?php
				if(isset($_SESSION['department'])){
					echo"value=".$_SESSION["department"];
				}
			?>
			type="text" name="department" placeholder="Department to visit">
		</p>
		<p>
			<input type="Submit" value="Register">
		</p>
	</form>

<?php include_once('lib/footer.php')?>