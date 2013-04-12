<?php
/*****************************************************************
 *	config.inc.php
 *	------------------------
 *  Created			: September 6, 2006
 *  Created by:		: Jason Torgrimson
 *  Copyright		: (c) 2006 Twin Falls High School.
 *	Description		: This file holds configuration variables
 					  required by every public and administrative
					  page in the site.
 ****************************************************************/


/*******************************
 * Editable configuration stuff
 *******************************/
	$config['Database_Host']		=	"localhost";
	$config['Database_Name']		=	"local_library";
	$config['Database_User']		=	"library";
	$config['Database_Password']	=	"bru8in2s";

/*******************************
* SYSTEM CONSTANTS
*******************************/



/*******************************
* CONFIGURATION CONSTANTS
*******************************/

	
		
/*******************************
 * Don't touch things below here
 * unless you know what you are 
 * doing!!!
 *******************************/
 
	//Debugging value.  If set to TRUE, all debugging functions will be enabled.
		define('DEBUG', TRUE);
	
	//This constant turns the site on and off.
		//If set to TRUE, the application is turned on.
		//If set to FALSE, the application is turned off and displayes a maintenance message.
		define('ENABLED', TRUE);
?>