<?php

	require_once('include/database.php');
	require_once('include/function.php');
	$message=post_check_usrname($_GET['k'],$_GET['id']);
	echo $message;
?>
