<?php
/*****************************************************************
 *	DOCUMENT_TEMPLATE.php
 *	------------------------
 *  Created			: April 6, 2013
 *  Created by:		: Jason Torgrimson, Thor Lund, Bruno Grubisic, Issac Laris, Tristan Neria, Joey Higgins, and Nathan Eliason
 *  Copyright		: (c) 2013 
 *	Description		: (overview of file purpose here)
****************************************************************/
   
/************************************************
 *	PAGE VARIABLES AND CONSTANTS
************************************************/

	//Defines the path from this file to the root of the site
		//Define to path to the root of our site in the quotes.
		define('ROOT_PATH', '../');
		
	//Defines page title in the title bar and in the header.
		//Place the title of your project in the quotes.
		define('TITLE', 'Admin Login Page');

/************************************************
 *	SERCURITY AND INCLUDES
************************************************/

	//Includes all classes and variables common to all pages in the site.
		require_once(ROOT_PATH . 'common.php');

	//Validate authorized user access to this page
		$auth->validate_user_access('PUBLIC');

/************************************************
 *	DATA HANDLING
 *	description: Section used for filtering
 				 incoming data and escaping
				 outgoing data passed to this
				 page.
 ************************************************/
 
 
 
/************************************************
 *	PAGE SPECIFIC FUNCTIONS
 *	description: Section used for creating functions
 				 used ONLY on this page.  All other
				 functions must be included in the
				 appropriate file in the INC folder.
 ************************************************/

if(	array_key_exists('username', $_POST) &&
	array_key_exists('password', $_POST)){
	$auth->process_login($_POST['username'], $_POST['password'], 'admin/courses.php');
}

 
/************************************************
 *	HEADER
 *	description: Section calls the header
 				 container for this page.
************************************************/
	
	//Establishes the structure for the header container
		$template->admin_page_header(TITLE);
		

/************************************************
 *	PAGE OUTPUT
 *	description: Section used for all page output
************************************************/

if (array_key_exists('retry', $_GET)) {
	?>
	<div style="display: block; text-align: center;">Your credentials could not be verified. Please try again.</div>
	<?php	
}
?>

	<form method="post" name="loginForm" id="loginForm">
    	<label for="username">Username :</label>
        <input type="text" name="username" id="username" />
        <label for="password">Password :</label>
        <input type="password" name="password" id="password" />
        <input type="submit" id="submit" value="Submit">
	</form>

<?php

/************************************************
 *	FOOTER
 *	description: Section calls the advertisement
 				 structure for this page.
************************************************/

	//Establishes the structure for the banner container
		$template->admin_page_footer();


/************************************************
 *	END OF DOCUMENT
************************************************/

?>