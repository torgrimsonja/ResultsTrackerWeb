<?php
/*****************************************************************
 *	courses.php
 *	------------------------
 *  Created			: April 11, 2013
 *  Created by:		: Jason Torgrimson, Thor Lund, Bruno Grubisic, Issac Laris, Tristan Neria, Joey Higgins, Nathan Eliason
 *  Copyright		: (c) 2013 
 *	Description		: Manage course entries in the database
****************************************************************/
   
/************************************************
 *	PAGE VARIABLES AND CONSTANTS
************************************************/

	//Defines the path from this file to the root of the site
		//Define to path to the root of our site in the quotes.
		define('ROOT_PATH', '../');
		
	//Defines page title in the title bar and in the header.
		//Place the title of your project in the quotes.
		define('TITLE', 'Courses Management ');

/************************************************
 *	SERCURITY AND INCLUDES
************************************************/

	//Includes all classes and variables common to all pages in the site.
		require_once(ROOT_PATH . 'common.php');
		require_once('func_courses.php');
		
	//Validate authorized user access to this page
		$auth->validate_user_access('AUTH');

/************************************************
 *	DATA HANDLING
 *	description: Section used for filtering
 				 incoming data and escaping
				 outgoing data passed to this
				 page.
 ************************************************/
 
 if(array_key_exists('action', $_GET) &&
 	$_GET['action'] == 'createCourseDo' &&
	array_key_exists('courseName', $_POST) &&
	array_key_exists('userId', $_POST) &&
	is_numeric($_POST['userId'])){
	 
	 createCourseDo($_POST['userId'], $_POST['courseName']	);
 }else if(	array_key_exists('action', $_GET) &&
 			$_GET['action'] == 'deleteCourseDo' &&
 			array_key_exists('courseId', $_GET) &&
			is_numeric($_GET['courseId'])){
	 deleteCourseDo($_GET['courseId']); 
 }else if(	array_key_exists('action', $_GET) &&
 			$_GET['action'] == 'searchStudent' &&
 			array_key_exists('value', $_GET) &&
 			array_key_exists('courseId', $_GET) &&
			is_numeric($_GET['courseId'])){
	 echo searchStudent($_GET['value'], $_GET['courseId']);
	 exit();
 }else if(array_key_exists('action', $_GET) &&
 			$_GET['action'] == 'enrollStudent' &&
 			array_key_exists('studentId', $_GET)&&
 			is_numeric($_GET['studentId']) &&
 			array_key_exists('courseId', $_GET) &&
			is_numeric($_GET['courseId'])){
	 addStudentEnrollment($_GET['studentId'], $_GET['courseId']);
 }
 
/************************************************
 *	PAGE SPECIFIC FUNCTIONS
 *	description: Section used for creating functions
 				 used ONLY on this page.  All other
				 functions must be included in the
				 appropriate file in the INC folder.
 ************************************************/


 
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
				<h1>Course management</h1>
				<a href="?action=createCourse" data-icon="add" class="ui-btn-right">Add</a>
			</div>';
	if(array_key_exists('action', $_GET) &&
		$_GET['action'] == 'createCourse'){
		
		echo createCourse($_SESSION['USER_ID']);
		
	}else if(array_key_exists('action', $_GET) &&
		$_GET['action'] == 'viewCourse' &&
		array_key_exists('courseId', $_GET) &&
		is_numeric($_GET['courseId'])){
		
		echo viewCourse($_GET['courseId']);
		
	}else{
		echo listCourses($_SESSION['USER_ID']);
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

