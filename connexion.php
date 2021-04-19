<?php
	session_start();
	require './db_inc.php';
	require './account_class.php';

	$account = new Account();
	$login = FALSE;

	try
	{
		$login = $account->login($_POST['myUserName'], $_POST['myPassword']);
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}

	if ($login)
	{
		echo 'Authentication successful.';
		header("Location: index.php");
	}
	else
	{
		echo 'Authentication failed.';
		header("Location: tricatel.php");
	}

?>

