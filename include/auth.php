<?php


/**
 * Log in a particular user
 */
function login($email) {
	$_SESSION['email'] = $email;
}

/**
 * Log out the current user
 */
function logout() {
	unset($_SESSION['email']);
}

/**
 * Return whether there a user is logged in
 */
function is_logged_in() {
	return isset($_SESSION['email']);
}

/**
 * Return whether the logged-in user is an admin
 */
function is_admin() {
	return is_logged_in() and (logged_in_user() === 'admin');
}

/**
 * Get the current logged-in username
 */
function logged_in_user() {
	return $_SESSION['email'];
}


/**
 * Redirect if not logged in as admin
 */
function require_admin_login() {
	if(!is_admin()) {
		header('Location: index.php');
	}
}

/**
 * Redirect if not logged in
 */
function require_login() {
	if(!is_logged_in()) {
		header('Location: index.php');
	}
}