<?php

function viewCourses($userId){
	global $db, $data_validation, $auth;
	
	//Capture arguements
	$sql['userId'] = $data_validation->escape_sql($userId);
	
	//Query courses
	$db->query('SELECT * FROM course WHERE user_id = '.$sql['userId'].' AND active = 1', 'courseList');
	
	$output = '<div class="content">
				<table>
					<tr>
						<th>Options</th>
						<th>Name</th>
					</tr>';
	while($row = $db->fetch_array('courseList')){
		$html['courseId'] 	= $data_validation->escape_html($row['id']);
		$html['courseName']	= $data_validation->escape_html($row['name']);
	
		$output .= '<tr>
						<td><a data-role="button" data-inline="true" data-mini="true" href="?action=updateCourse&courseId='.$html['courseId'].'">Edit</a><a data-role="button" data-inline="true" data-mini="true" href="?action=deleteCourseDo&courseId='.$html['courseId'].'">Delete</a></td>
						<td>'.$html['courseName'].'</td>
					</tr>';
	}
	$output .= '</table></div>';
	
	return $output;
}

function createCourse($userId){
	global $db, $data_validation, $auth;
	
	$html['userId'] = $data_validation->escape_html($userId);
	$output = '	<div class="content">
				<div class="title">Create A New Course</div>
				<form method="post" action="?action=createCourseDo">
					<label for="courseName">Name</label>
					<input type="text" name="courseName" id="courseName" />
					<input type="submit" value="Submit" name="Submit" id="createCourse" />
					<input type="hidden" name="userId" value="'.$html['userId'].'" />
				</form>
				</div>';
	
	return $output;

}

function createCourseDo($userId, $courseName){
	global $db, $data_validation, $auth;

	$sql['userId'] 		= $data_validation->escape_sql($userId);
	$sql['courseName'] 	= $data_validation->escape_sql($courseName);
	
	$db->query('INSERT INTO course (user_id, name) VALUES (\''.$sql['userId'].'\',\''.$sql['courseName'].'\');');
	
}

function updateCourse($courseId){
	global $db, $data_validation, $auth;
	
}

function updateCourseDo($courseId, $courseName){
	global $db, $data_validation, $auth;
	
}

function deleteCourseDo($courseId){
	global $db, $data_validation, $auth;
	
	$sql['courseId'] = $data_validation->escape_sql($courseId);
	
	$db->query('DELETE FROM course WHERE id = '.$sql['courseId'].' LIMIT 1;');
}