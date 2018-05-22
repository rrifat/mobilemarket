<?php include("app/init.php"); ?>

<?php

if (isset($_POST['submit'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	$check = $Auth->check_admin_login($username, $password);
	if ($check == TRUE) {

		$Template->redirect('app/admin/dashboard.php');
	}
		
}
else
{
	$Template->load('app/views/v_login.php');
}

?>