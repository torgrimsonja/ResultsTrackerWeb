<?php
/*****************************************************************
 *	DOCUMENT_TEMPLATE.php
 *	------------------------
 *  Created			: April 6, 2013
 *  Created by:		: Jason Torgrimson, Thor Lund, Bruno Grubisic, Issac Laris, Tristan Neria, Joey Higgins
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
		define('TITLE', 'Student Management');

/************************************************
 *	SERCURITY AND INCLUDES
************************************************/

	//Includes all classes and variables common to all pages in the site.
		require_once(ROOT_PATH . 'common.php');
		require_once('func_students.php');

	//Validate authorized user access to this page
		$auth->validate_user_access('AUTH');

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

if(	array_key_exists('action', $_GET) &&
	$_GET['action'] == 'addStudentDo' &&
	array_key_exists('firstName', $_POST) &&
	array_key_exists('lastName', $_POST)){
	addStudentDo($_POST['firstName'], $_POST['lastName']);
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
	echo '	<div data-role="header">
				<h1>Student Management</h1>
				<a href="?action=addStudentForm" data-icon="add" class="ui-btn-right">Add</a>
			</div>';
if(	array_key_exists('action', $_GET) &&
	$_GET['action'] == 'addStudentDo' &&
	array_key_exists('firstName', $_POST) &&
	array_key_exists('lastName', $_POST)){
	addStudentDo($_POST['firstName'], $_POST['lastName']);
}

if(	array_key_exists('action', $_GET) &&
			$_GET['action'] == 'addStudentForm'){
	addStudentForm();
}else{
	echo displayStudents();	
}


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