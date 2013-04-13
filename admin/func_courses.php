<?php

function listCourses($userId){
	global $db, $data_validation, $auth;
	
	//Capture arguements
	$sql['userId'] = $data_validation->escape_sql($userId);
	
	//Query courses
	$db->query('SELECT * FROM course WHERE user_id = '.$sql['userId'].' AND active = 1', 'courseList');
	
	$output = '<div class="content">
				<ul data-role="listview">';
	while($row = $db->fetch_array('courseList')){
		$html['courseId'] 	= $data_validation->escape_html($row['id']);
		$html['courseName']	= $data_validation->escape_html($row['name']);
	
		$output .= '<li><a href="?action=viewCourse&courseId='.$html['courseId'].'">'.$html['courseName'].'</a></li>';
	}
	$output .= '</ul></div>';
	
	return $output;
}

function viewCourse($courseId){
	global $db, $data_validation, $auth;
	//escape args
	$sql['courseId'] 	= $data_validation->escape_sql($courseId);
	$html['courseId'] 	= $data_validation->escape_html($courseId);
	
	$output = '	<script type="text/javascript">
					function searchStudent(value){
						if(value.length > 0){
							$.ajax({url:"?action=searchStudent&value="+value+"&courseId='.$html['courseId'].'",success:function(result){
								$("#listSearchResult").empty()
								$("#listSearchResult").append(result);
								$("#listSearchResult").listview(\'refresh\');
								}
							});
						}else{
							$("#listSearchResult").empty()
						}
					}
					
				</script>';
	
	
	//query course information
	$db->query('SELECT * FROM course WHERE id = '.$sql['courseId'], 'courseInformation');
	$html['courseName'] = $data_validation->escape_html($db->result('courseInformation', 0, 'name'));
	//display course information
	$output .= '<div class="content">
					<h2>'.$html['courseName'].'</h2>
					<a href="#searchStudent" data-rel="popup" data-role="button">Enroll Student</a>
					<div data-role="popup" data-position-to="window" data-role="button" data-inline="true" data-transition="pop" id="searchStudent">
						<div data-role="header" data-theme="a" class="ui-corner-top">
							<h1>Enroll Users</h1>
						</div>
						<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
							<input type="text" id="addStudentEnrollment" onkeyup="searchStudent(this.value)" placeholder="Enroll Student by Name" />
						</div>
							<ul data-role="listview" id="listSearchResult"></ul>
					</div>
					<ul data-role="listview" id="studentEnrollment">';
	
	
	//query students enrolled
	$db->query('SELECT * FROM student LEFT JOIN course_student ON course_student.student_id = student.id LEFT JOIN course ON course.id = course_student.course_id WHERE course.id = '.$sql['courseId'], 'studentInformation');
	
	//display students enrolled
	while($row = $db->fetch_array_by_table('studentInformation')){
		$html['studentId'] 	= $data_validation->escape_html($row['student']['id']);
		$html['firstName'] 	= $data_validation->escape_html($row['student']['firstName']);
		$html['lastName'] 	= $data_validation->escape_html($row['student']['lastName']);
		$html['code'] 		= $data_validation->escape_html($row['student']['code']);
		
		$output .= '<li><a href="#">'.$html['code'].' - '.$html['firstName'].' '.$html['lastName'].'</a></li>';
	}
	
	$output .= '</div>';
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

// Student function

function searchStudent($value, $courseId){
	global $db, $data_validation;
	
	$sql['value'] 		= $data_validation->escape_sql($value);
	$html['courseId'] 	= $data_validation->escape_html($courseId);
	$output = '';
	
	$db->query('SELECT id, firstName, lastName FROM student WHERE firstName LIKE \''.$sql['value'].'%\' OR lastName LIKE \''.$sql['value'].'%\'', 'searchResult');
	while($row = $db->fetch_array('searchResult')){
		$html['studentId'] = $data_validation->escape_html($row['id']);
		$html['studentName'] = $data_validation->escape_html($row['firstName'].' '.$row['lastName']);
		
		$output .= '<li><a href="?action=enrollStudent&studentId='.$html['studentId'].'&courseId='.$html['courseId'].'">'.$html['studentName'].'</a></li>';
		
	}
	
	return $output;
}

function addStudentEnrollment($studentId, $courseId){
	global $db, $data_validation;
	
	$sql['studentId'] 	= $data_validation->escape_sql($studentId);
	$sql['courseId'] 	= $data_validation->escape_sql($courseId);
	$html['courseId'] 	= $data_validation->escape_html($courseId);
	$output = '';

	//Insert enrollment record
	$db->query('INSERT INTO course_student
				(student_id, course_id)
				VALUES
				(\''.$sql['studentId'].'\',\''.$sql['courseId'].'\');', 'insertEnrollment');
	header('Location:?action=viewCourse&courseId='.$html['courseId']);
	exit();
}