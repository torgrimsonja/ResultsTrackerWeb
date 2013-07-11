<?php

header('Access-Control-Allow-Origin: *');

/*****************************************************************
 *	index.php
 *	------------------------
 *  Created			: April 11, 2013
 *  Created by:		: Jason Torgrimson, Thor Lund, Bruno Grubisic, Issac Laris, Tristan Neria, Joey Higgins, and Nathan Eliason
 *  Copyright		: (c) 2013 
 *	Description		: Index page.
****************************************************************/
   
/************************************************
 *	PAGE VARIABLES AND CONSTANTS
************************************************/

	//Defines the path from this file to the root of the site
		//Define to path to the root of our site in the quotes.
		define('ROOT_PATH', '../');
		
	//Defines page title in the title bar and in the header.
		//Place the title of your project in the quotes.
		define('TITLE', '');

/************************************************
 *	SERCURITY AND INCLUDES
************************************************/

	//Includes all classes and variables common to all pages in the site.
		require_once(ROOT_PATH . 'common.php');

$response = array(
	'credentialsCorrect' => false
);

if (array_key_exists('changes', $_POST) &&
	array_key_exists('last_sync', $_POST) &&
	array_key_exists('username', $_POST) &&
	array_key_exists('password', $_POST) &&
	array_key_exists('timestamp', $_POST)) {
	
	foreach($_POST as $key => $value) { 
		$sql[$key] = $data_validation->escape_sql($value); 
	} 
	
	$result = mysql_query("SELECT Count(*) FROM `user` WHERE `username`='" . $sql['username'] . "' AND `password`='" . $sql['password'] . "'");
	if ($result && mysql_num_rows($result) > 0) {
		$response['credentialsCorrect'] = true;	
		
	}
}

echo json_encode($response);

?>