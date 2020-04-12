<?php

include_once('lib/header.php');
if(isset($_SESSION["LoggedIn"]) && !empty($_SESSION["LoggedIn"])){
	header("Location:dashboard.php");
}

?>
<header class="header-container">
	<h1>Welcome, Please Register</h1>
	<p>All fields are required</p>
</header>


<div class="form-container">
	<form method="POST" action="processregister.php">
		<!-- <div> -->
			<?php
				if(isset($_SESSION["error"]) && !empty($_SESSION["error"])){

					echo "<span style='color:red'>" .$_SESSION["error"]."</span>";
					// removes session variables
					// session_unset();
					// destroys session
					session_destroy();
				}
			?>
		<!-- </div> -->
		<div>
			<label class="field-label">First Name:</label><br>
			<input class="input-field"
			<?php
			// echo "value='their father'"
				if(isset($_SESSION["first_name"])){
					echo "value=" . $_SESSION["first_name"];
				}
			?>
			type="text" name="first_name" placeholder="First Name">
		</div>
		<div>
			<label class="field-label">Last Name:</label><br>
			<input class="input-field"
			<?php
				if(isset($_SESSION["last_name"])){
					echo "value=".$_SESSION["last_name"];
				}
			?>
			 type="text" name="last_name" placeholder="Last Name">
		</div>
		<div>
			<label class="field-label">Email:</label><br>
			<input class="input-field"
			<?php
				if(isset($_SESSION['email'])){
					echo"value=".$_SESSION["email"];
				}
			?>
			type="text" name="email" placeholder="example@email.com">
		</div>
		<div>
			<label class="field-label">Gender:</label><br>
			<select name="gender" class="input-field">
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
		</div>

		<div>
			<label class="field-label">Password:</label>
			<input class="input-field"
			<?php
				if(isset($_SESSION['password'])){
					echo"value=".$_SESSION["password"];
				}
			?> 
			type="password" name="password" placeholder="Password" >
		</div>


		<div>
<label class="field-label">Designation:</label>
	<select name="designation" class="input-field">
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
		</div>

		<div>
			<label class="field-label">Department:</label>
			<input class="input-field"
			<?php
				if(isset($_SESSION['department'])){
					echo"value=".$_SESSION["department"];
				}
			?>
			type="text" name="department" placeholder="Department to visit">
		</div>
		<div>
			<input class="btn" type="Submit" value="Register">
		</div>
	</form>
</div>
<?php include_once('lib/footer.php')?>