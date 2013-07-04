<?php

header('Access-Control-Allow-Origin: *');

/*****************************************************************
 *	index.php
 *	------------------------
 *  Created			: April 11, 2013
 *  Created by:		: Jason Torgrimson, Thor Lund, Bruno Grubisic, Issac Laris, Tristan Neria, Joey Higgins
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
	'authenticated' => false
);

if (array_key_exists('username', $_POST) &&
	array_key_exists('password', $_POST)) {
	
	$sql['username'] = $data_validation->escape_sql($_POST['username']);
	$sql['password'] = $data_validation->escape_sql($_POST['password']);
	
	$db->query("SELECT COUNT(*) AS numAccounts FROM `user` WHERE `username`='" . $sql['username'] . "' AND `password`='" . $sql['password'] . "'", 'accounts');
	$result = $db->fetch_array('accounts');
	if ($result['numAccounts'] > 0) {
		$response['authenticated'] = true;	
	}
}

echo json_encode($response);

?>