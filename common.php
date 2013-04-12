<?php
/*****************************************************************
 *	common.php
 *	------------------------
 *  Created			: September 12, 2006
 *  Created by:		: Jason Torgrimson
 *  Copyright		: 2006 Twin Falls High School.
 *	Description		: This file is used to include classes and 
 					  establish database connectiving for all
					  pages in the site.
 ****************************************************************/

/************************************
* 	REQUIRED CONFIGURATION INCLUDE	*
************************************/

	//Require security and configuration files
		require_once(ROOT_PATH . 'inc/config.inc.php');

/************************************
* 	SET ERROR REPORTING				*
************************************/
	
	if(DEBUG){
		error_reporting(E_ALL);
		ini_set('display_errors', '1');
	}

/************************************
* 	REQUIRED SYSTEM INCLUDES		*
************************************/

	//Include database class and establish connection
		require_once(ROOT_PATH 	. 'inc/classes/db.php');
	
	//Include data balidation class
		require_once(ROOT_PATH 	. 'inc/classes/data_validation.php');

	//Include functions class
		require_once(ROOT_PATH 	. 'inc/classes/functions.php');
		
	//Include authentication class
		require_once(ROOT_PATH 	. 'inc/classes/auth.php');
			
	//Include file_upload class
		include(ROOT_PATH 		. 'inc/classes/template.php');


/************************************
* 	QUERY SYSTEM VARIABLES		*
************************************/

				
/************************************
* 	HANDLE LOGOUT REQUEST			*
************************************/

	//Handle logout
		if(isset($_GET['logout'])){
			$auth->logout();
		}

/************************************
* 	TURN SITE OFF OR ON				*
************************************/


	if(!ENABLED){
		die(SITE_TITLE . ' is currently down for maintenance.  Please try again later.');
	}
?>