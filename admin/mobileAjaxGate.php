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
		define('TITLE', '');
	
	//Can be removed in production. Simply allows local files to make ajax request, for testing purposes; 
		header('Access-Control-Allow-Origin: *');

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
 
	foreach($_POST as $dirtyKey => $dirtyValue){
		$cleaned[htmlspecialchars($dirtyKey)] = htmlspecialchars($dirtyValue); 
	}
 
/************************************************
 *	PAGE SPECIFIC FUNCTIONS
 *	description: Section used for creating functions
 				 used ONLY on this page.  All other
				 functions must be included in the
				 appropriate file in the INC folder.
 ************************************************/

	function someoneGoofed(){
		echo json_encode(array('error'=>true, 'message'=>func_get_args())); //the js files check for response.error, but the message is only for debugging and never is viewed by the user
		die();
	}
	
	function blabTable($table, $limit){
		global $db, $record; 
		$db->query("SELECT * FROM `$table` $limit", 0);
		$index = 0;
		while($row = $db->fetch_array('0')){
			foreach($row as $rowIndex => $value){
				if(!is_numeric($rowIndex)){ //assoc arrays only past this line
					$record[$table][$index][$rowIndex] = $value;
				}
			}
			$index++;
		}
	}
	
 
/************************************************
 *	HEADER
 *	description: Section calls the header
 				 container for this page.
************************************************/
	
	//Establishes the structure for the header container
		//$template->page_header(TITLE);
		

/************************************************
 *	PAGE OUTPUT
 *	description: Section used for all page output
************************************************/
	$record = array(); //php is loose but not quite that loose;
	if(@array_key_exists('requested', $cleaned)){
		switch($cleaned['requested']){
			case 'coursename': //in -> nothing, out -> course_name, course_id;
				$db->query("SELECT `name`, `id` FROM `course`", 0);
				$index = 0;
				while($row = $db->fetch_array('0')){
					$record[$index]['name'] = $row[0];
					$record[$index]['id'] = $row[1];
					$index++;
				}
			break;
			
			case 'students': // in -> course_id, out -> student_firstName, student_lastName, student_code, student_id;
				$studentId = array();
				if(array_key_exists('id', $cleaned)){ 
					$db->query("SELECT DISTINCT `student_id` FROM `course_student` WHERE `course_id` = '".$cleaned['id']."'",0);
					while($row = $db->fetch_array('0')){
						$studentId[] = $row[0];
					}
					$index = 0;
					foreach($studentId as $student){
						$db->query("SELECT `firstName`, `lastName`, `code` FROM `student` WHERE `id` = '$student'");
						while($row = $db->fetch_array('0')){
							$record[$index]['firstName'] = $row[0];
							$record[$index]['lastName'] = $row[1];
							$record[$index]['code'] = $row[2];
							$record[$index]['id'] = $student;
							$index++;
						}
					}
				} else someoneGoofed('no id');
			break;
			
			case 'goalinfo': // in -> goal_id, out -> task_operator, task_name, task_description, task_value, task_typeId, task_id;
				$taskId = array();
				if(array_key_exists('id', $cleaned)){ 
					$db->query("SELECT `name` FROM `goal` WHERE `id` = '".$cleaned['id']."' LIMIT 1", 0);
					while($row = $db->fetch_array('0')){
						$record[0]['goalName'] = $row[0];
					}
					$db->query("SELECT `task_id` FROM `goal_task` WHERE `goal_id` = '".$cleaned['id']."'", 0);
					while($row = $db->fetch_array('0')){
						$taskId[] = $row[0];
					}
					foreach($taskId as $task){
						$db->query("SELECT `operator`, `name`, `description`, `value`, `type_id` FROM `task` WHERE `id` = '$task'", 0);
						$index = 0;
						while($row = $db->fetch_array('0')){
							$record[$index]['operator'] = $row[0];
							$record[$index]['name'] = $row[1];
							$record[$index]['description'] = $row[2];
							$record[$index]['value'] = $row[3];
							$record[$index]['typeId'] = $row[4];
							$record[$index]['taskId'] = $task;
							$index++;
						}
					}
				}
			break;
			
			case 'replicateDb':
				blabTable('course', '');
				blabTable('course_student', '');
				blabTable('course_student_task_attempt', '');
				blabTable('course_task', '');
				blabTable('student', '');
				blabTable('course_student', '');
				blabTable('task', '');
				blabTable('task_type', '');
			break; 
			
			default:
				someoneGoofed('no request');
			break; 
		}
	} else if(array_key_exists('sync',$cleaned)){
		if(!file_exists('../sqlCopies/'.date('d_m_Y').'.sql'))
			exec('mysqldump --user=atsolin_tracter --password=results --host=localhost atsolin_resultstracker > ../sqlCopies/'.date('d_m_Y').'.sql');
		return file_get_contents('../sqlCopies/'.date('d_m_Y').'.sql'); 
	}
	
	else someoneGoofed('no request');
	
	echo json_encode(array_merge($record, array('error'=>false))); //js checks for response.error;
	
/************************************************
 *	FOOTER
 *	description: Section calls the advertisement
 				 structure for this page.
************************************************/

	//Establishes the structure for the banner container
		//$template->page_footer();


/************************************************
 *	END OF DOCUMENT
************************************************/

?>