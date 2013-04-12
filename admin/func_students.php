<?php

	function displayStudents(){
		global $db, $data_validation;
		
		$db->query('SELECT * FROM student', 'students');
		
		$output = '	<a href="?action=addStudentForm">Add User</a>
					
					<table>
					<tr>
						<th>Options</th>
						<th>First Name</th>
						<th>Last Name</th>
					</tr>';
					
		while($row = $db->fetch_array('students')){
		$html['id'] 		= $data_validation->escape_html($row['id']);
		$html['firstName'] 	= $data_validation->escape_html($row['firstName']);
		$html['lastName']	= $data_validation->escape_html($row['lastName']);
		
		$output .= '<tr>
						<td><a href="?action=editStudentDo&id='.$html['id'].'">Edit</a> | <a href="?action=deleteStudentDo&id='.$html['id'].'">Delete</a></td>
						<td>'.$html['firstName'].'</td>
						<td>'.$html['lastName'].'</td>
					</tr>';
		}
		
		$output .= '</table>';
		
		return $output;
	}

	function addStudentForm(){
		?>
        	<form name="addStudent" method="post" action="?action=addStudentDo">
            	<label for="firstName">First Name:
                	<input type="text" name="firstName" id="firstName" />
                </label>
                <label for="lastName">Last Name:
                	<input type="text" name="firstName" id="firstName" />
                </label>
                	<input type="submit" id="submit" value="Save" />
            </form>
        <?php	
	}
	
	function addStudentDo($firstName, $lastName){
		global $db, $data_validation;
		
		$sql['firstName'] 	= $data_validation->escape_sql($firstName);
		$sql['lastName'] 	= $data_validation->escape_sql($lastName);
		
		$db->query('INSERT INTO student (firstName, lastName)
					VALUES (\'' . $sql['firstName'] . '\', \'' . $sql['lastName'] . '\')');
	}