<?php
session_start();
require_once "include/config.php";
require_once "include/utils.php";
require_once "include/auth.php";
?>
<?php
	// get_or_default is in utils.php
	// See what it does
	$email = get_or_default($_POST, 'email', '');
	$password = get_or_default($_POST, 'password', '');

	// What does this do?
	if($email and $password) {
		
		// Use the DB to authenticate a user

		// Exercise: Where do these variables come from?
		$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
         $query="SELECT email, password  FROM user where email=?";
	

		$stmt = mysqli_prepare($conn, $query);
		mysqli_stmt_bind_param($stmt, "s", $email);

		// If the execution works properly
		if(mysqli_stmt_execute($stmt))
		{
			// Get the results
			$result = mysqli_stmt_get_result($stmt);

			// Grab the first row
			$row = mysqli_fetch_array($result);
			
			// If it exists
			if($row) {
				// Get the stored password
				$db_password = $row['password'];

				// Re-hash the password using the same parameters that we used to make the DB one
				// See lecture notes on password safety for details
				$hashed_supplied = crypt($password, $db_password);

				// Check whether the DB password is the same as the supplied password
				// In PHP5.6 or newer, use hash_equals instead
				if($db_password === $hashed_supplied)
				{
					login($email);
					header('Location: view.php');
					exit;
				}
			}
		}

		mysqli_stmt_close($stmt);
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>
	<?php include "include/nav.php"; ?>

	<div class="content">

		<h1>Welcome </h1>

		<?php if(is_logged_in()): ?>
			<h2>Currently logged in as <?php echo htmlentities(logged_in_user()); ?></h2>
			<form action="logout.php" method="POST">
				<button>Log out</button>
			</form>
		<?php else: ?>

		<form action="login.php" method="POST">
			<?php if($email) : ?>
				<div class="warning">Login failed, please try again</div>
			<?php endif; ?>
			<ul>
			<li>
				<label for="email">Email</label>
				<input type="text" size="10"
				name="email" id="email"
				value="<?php echo htmlentities($email); ?>">
			</li>

			<li>
				<label for="password">Password</label>
				<input type="password" size="10" name="password" id="password">
			</li>
			</ul>
			<button>Log in to system</button>
		
		</form>
		 <a href ="signup.php"><button> Signup </button> </a> 
		<?php endif; ?>
	</div>

	
	<script src="script/validate_login.js"></script>
</body>
</html>