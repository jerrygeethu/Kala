<?php
	//$basepath="http://192.168.1.27/kala/";
	
	define('BASEPATH',"http://localhost/kala/");
	
	define('FILEPATH',"/var/www/kala/");
	
	define('CATEGORY',"/var/www/kala/category/");
	
	define('TESTIMONY',"/var/www/kala/testimony/");
	
	define('MEMBER',"http://localhost/kala/admin/add_member.php");
	
	define('ARTICLE',"http://localhost/kala/admin//manage_publications.php");
	
	define('EVENT',"http://localhost/kala/admin/manage_events.php");
	
	define('ACTIVITY',"http://localhost/kala/admin/manage_activities.php");
	
	define('CURRENT_DATE',date("Y-m-d"));
	
	
		//---------------------------------------- Remove unwanted post values in PHP ------------------------------

		foreach($_POST as $key => $value){

		if(!is_array($_POST[$key]))
		 $_POST[$key]=clean($_POST[$key]);

		}

		foreach($_GET as $key => $value){

		if(!is_array($_GET[$key]))
		$_GET[$key]=clean($_GET[$key]);

		}

		foreach($_REQUEST as $key => $value){

		if(!is_array($_REQUEST[$key]))
		$_REQUEST[$key]=clean($_REQUEST[$key]);

		}

		function clean($string)
		{
			$string = $GLOBALS['db']->real_escape_string($string);
			$string=trim($string);
			return $string;
		} 
		//---------------------------------------- End Remove unwanted post values in PHP -----------------------
?>
