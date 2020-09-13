<?php 

include 'header.php';

session_start();

?>

<body>
	<div class='login-form'>
		<h1>Login</h1>
		<form class='loginform' action='login.php' method='post'>
			<p><input type="text" name="username" placeholder="Username"></p>
			<p><input type="password" name="password" placeholder="Password"></p>
			<p><button type="submit" name="submit">Log In</button></p>
		</form>

		<div>
			<p style='font-size: 20px;'>Don't have an account? Click <a href="registration-page.php">here</a> to create one!</p>
		</div>
		<?php

		if(isset($_GET['login'])){
			if($_GET['login']=='invalid'){
				echo "<h3>*Username or password entered is incorrect, please try again* </h3>";
			}
		}

		?>
	</div>
</body>