<?php

//This is just for development testing, and can be removed from production because it's probably some horrible security hole. 
header('Access-Control-Allow-Origin: *');

/*****************************************************************
 *	account_registration.php
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
	'dbError' => false,
	'usernameOpen' => false,
	'emailOpen' => false,
	'userID' => 0
);

if (array_key_exists('username', $_POST) 	&&
	array_key_exists('password', $_POST) 	&&
	array_key_exists('email', $_POST) 		&& 
	array_key_exists('firstName', $_POST) 	&& 
	array_key_exists('lastName', $_POST)) {
	
	foreach($_POST as $key => $value) { 
		$sql[$key] = $data_validation->escape_sql($value); 
	} 
	
	$result = $db->query("SELECT `id` FROM `user` WHERE `username` = '" . $sql['username'] . "'");
	if($result) {
		if ($result->rowCount() == 0) {
			$response['usernameOpen'] = true;
			$result = $db->query("SELECT `id` FROM `user` WHERE `email`='" . $sql['email'] . "'");
			if ($result) {
				if ($result->rowCount() == 0) {
					$response['emailOpen'] = true;
					$result = $db->query("INSERT INTO `user` (`firstName`, `lastName`, `username`, `password`, `email`) VALUES ('" . 
								$sql['firstName'] . "', '" . $sql['lastName'] . "', '" . $sql['username'] . "', '" . $sql['password'] . 
								"', '" . $sql['email'] . "')");
					
					if ($result) {
						$response['userID'] = $db->lastInsertId();
					} else {
						$response['dbError'] = true;	
					}
				}
			} else {
				$response['dbError'] = true;
			}
		}
	} else {
		$response['dbError'] = true;		
	}

}

echo json_encode($response);

?>