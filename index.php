<?php
session_start();
require_once "include/auth.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"
></script>
</head>
<body>



	<?php include "include/nav.php"; ?>

	<div class="content">
		<div class="image"></div>


		<h1 style="color:blue;">Welcome </h1>
	


		<?php
		// Exercise: where are is_logged_in() and logged_in_user() declared?
		if(is_logged_in()){ ?>
			<h2>Currently logged in as <?php echo htmlentities(logged_in_user()); ?></h2>
			<form action="logout.php" method="POST">
				<button>Log out</button>
			</form>
		<?php  } else{ ?>

		<form action="login.php" method="POST">
			<ul>
			<li>
				<label for="email">email</label>
				<input type="text" size="10"  name="email" id="email">
			</li>
			<li>
				<label for="password">Password</label>
				<input type="password" size="10" name="password" id="password">
			</li>
			</ul>
			<button>Log in </button>
		</form>
		<a href ="signup.php"><button> Signup </button> </a> 
		

		<?php } ?>
	</div>



	<script src="script/validate_login.js"></script>

</body>
</html>