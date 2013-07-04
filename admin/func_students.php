 <?php

	function displayStudents(){
		global $db, $data_validation;
		
		$db->query('SELECT * FROM student', 'students');
		
		$output = '<div class="content">
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
						<td><a href="?action=updateStudent&id='.$html['id'].'">Edit</a> | <a href="?action=deleteStudentDo&id='.$html['id'].'">Delete</a></td>
						<td>'.$html['firstName'].'</td>
						<td>'.$html['lastName'].'</td>
					</tr>';
		}
		
		$output .= '</table>
					</div>';
		
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
	
	function addStudentDo($firstName, $lastName, $code = '0'){
		global $db, $data_validation;
		
		$sql['firstName'] 	= $data_validation->escape_sql($firstName);
		$sql['lastName'] 	= $data_validation->escape_sql($lastName);
		$sql['code'] 		= $data_validation->escape_sql($code);
		
		$db->query('INSERT INTO student (firstName, lastName, code) VALUES (\''.$sql['firstName'].'\',\''.$sql['lastName'].'\''.$sql['code'].'\');');
	}
	
	function updateStudentForm($studentId){
		global $db, $data_validation;

		$sql['studentId'] = $data_validation->escape_sql($studentId);

		//Query all student data
		$db->query('SELECT * FROM student WHERE id = '. $sql['studentId'], 'studentInfo');
		$html['studentId'] 	= $db->result('studentInfo', 0, 'id');
		$html['firstName'] 	= $db->result('studentInfo', 0, 'firstName');
		$html['lastName'] 	= $db->result('studentInfo', 0, 'lastName');
		$html['code'] 		= $db->result('studentInfo', 0, 'code');
		?>
        	<form name="updateStudent" method="post" action="?action=updateStudentDo">
            	<label for="firstName">First Name:</label>
                	<input type="text" name="firstName" id="firstName" value="<?php echo $html['firstName']; ?>" />
                <label for="lastName">Last Name:</label>
                	<input type="text" name="lastName" id="lastName" value="<?php echo $html['lastName']; ?>" />
                <label for="code">Secret Code:</label>
                	<input type="text" name="code" id="code" value="<?php echo $html['code']; ?>" />
                	<input type="submit" id="submit" value="Save" />
                    <input type="hidden" name="studentId" value="<?php echo $html['studentId']; ?>" />
            </form>
        <?php	
	}
	
	function updateStudentDo($studentId, $firstName, $lastName, $code){
		global $db, $data_validation;

		$sql['studentId']	= $data_validation->escape_sql($studentId);
		$sql['firstName'] 	= $data_validation->escape_sql($firstName);
		$sql['lastName'] 	= $data_validation->escape_sql($lastName);
		$sql['code'] 		= $data_validation->escape_sql($code);

		//Update record
		$db->query('UPDATE student SET firstName = \''.$sql['firstName'].'\',
										lastName = \''.$sql['lastName'].'\',
										code = \''.$sql['code'].'\'
								WHERE id = ' . $sql['studentId']);
		
	}
	
	function deleteStudentDo($studentId){
		global $db, $data_validation;
		
		$sql['studentId'] = $data_validation->escape_sql($studentId);
		
		$db->query('DELETE FROM student WHERE id = '.$sql['studentId']);
		
		return true;
	}