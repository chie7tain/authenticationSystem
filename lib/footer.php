
 <nav class="nav-container">
 	<a class="nav-links" href="index.php">Home</a> ||
 	<?php
 	if(!isset($_SESSION["LoggedIn"])){ ?>

	<a class="nav-links" href="login.php">Login</a> ||
 	<a class="nav-links" href="register.php">Register</a> ||
 	<a class="nav-links" href="forgot_password.php">Forgot Password</a>
<?php }else{?>
<a class="nav-links" href="logout.php">Logout</a> ||
<a class="nav-links" href="reset.php">Reset Password</a>
<?php } ?>
</nav>
</body>

</html>