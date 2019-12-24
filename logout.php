?php
	require "db.php";


	unset($_SESSION['logged_user']);

    session_destroy($_SESSION['logged_user']);

	header('Location: homepage.php');
?>
