<?php

//This is just for development testing, and can be removed from production because it's probably some horrible security hole. 
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
	'deviceID' => 0
);

if (array_key_exists('deviceType', $_POST)) {
	$sql['deviceType'] = $data_validation->escape_sql($_POST['deviceType']);
	
	$result = mysql_query("INSERT INTO `device` (`device_type`) VALUES ('" . $sql['deviceType'] . "')");
	$response['deviceID'] = mysql_insert_id();
}

echo json_encode($response);

?>