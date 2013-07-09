<?php

	function displayTasks(){
		global $db, $data_validation;
		
		$db->query('SELECT * FROM task', 'tasks');
		
		$output = '<div class="content">
					<table>
					<tr>
						<th>Options</th>
						<th>Task</th>
						<th>Description</th>
					</tr>';
					
		while($row = $db->fetch_array('tasks')){
            $html['id'] 		    = $data_validation->escape_html($row['id']);
            $html['name'] 	        = $data_validation->escape_html($row['name']);
            $html['description']	= $data_validation->escape_html($row['description']);
            $html['value']          = $data_validation->escape_html($row['value']);
            $html['operator']       = $data_validation->escape_html($row['operator']);
        
            $output .= 
                '<tr>
                    <td><a href="?action=editTaskDo&id='.$html['id'].'">Edit</a> | <a href="?action=deleteTaskDo&id='.$html['id'].'">Delete</a></td>
                    <td>'.$html['name'].'</td>
                    <td>'.$html['operator'] . ' ' . $html['value'] . ' ' . $html['description'].'</td>
                </tr>';
		}
		
		$output .= '</table>
					</div>';
		
		return $output;
	}

	function addTaskForm(){
	?>
        <div>	
            <a href="#repetition" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-icon="check" data-transition="flip">Repetition</a>
            <a href="#timed" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-icon="check" data-transition="flip">Timed</a>

            <div data-role="popup" id="repetition" data-theme="a" class="ui-corner-all">
                <form name="addTask" method="post" action="?action=addTaskDo">
                    <div style="padding:10px 20px;">
                      <h3>New Repetition Event</h3>
                    	<label for="operator">
                        <select name="operator">
                            <option value="greater than">Greater than</option>
                            <option value="Less than">Less than</option>
                            <option value="Exactly">Exactly</option>
                        </select>
                    </label>
                    <label for="value">
                        <input type="number" name="value" />
                    </label>
                    <?php
                        /*} else {
                        ?>
                    <fieldset class="ui-grid-a">
                        <div class="ui-block-a" style="width: 29%;"></div>
                        <div class="ui-block-b" style="text-align: right; width: 20%;">
                            <label for="minutes">
                                <input type="number" maxlength="2" name="minutes" style="display: inline; width: 50px"/>
                            </label>
                        </div>
                        <div class="ui-block-c" style="text-align: center; width: 2%; padding-top: 15px;">
                            :
                        </div>
                        <div class="ui-block-d" style="text-align: right; width: 20%;">
                            <label for="seconds">
                                <input type="number" maxlength="2" name="seconds" style="display: inline; width: 50px;" />
                            </label>
                        </div>
                    </fieldset>
                    <?php
                        }
						*/
                        ?>
                    <label for="description">
                        <input type="text" name="description" />
                    </label>
                    <input type="submit" id="submit" value="Save" />
                </form>
            </div>
            <div data-role="popup" id="timed" data-theme="a" class="ui-corner-all">
                <form>
                    <div style="padding:10px 20px;">
                      <h3>Please sign in</h3>
                      <label for="un" class="ui-hidden-accessible">Username:</label>
                      <input type="text" name="user" id="un" value="" placeholder="username" data-theme="a" />

                      <label for="pw" class="ui-hidden-accessible">Password:</label>
                      <input type="password" name="pass" id="pw" value="" placeholder="password" data-theme="a" />

                      <button type="submit" data-theme="b" data-icon="check">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
        <?php	
	}
	
	function addGoalDo($name, $description){
		global $db, $data_validation;
		
		$sql['name'] 	    = $data_validation->escape_sql($name);
		$sql['description'] = $data_validation->escape_sql($description);
		
		$db->query('INSERT INTO goal (name, description) VALUES (\''.$sql['name'].'\',\''.$sql['description'].'\');');
	}


	
	function deleteGoalDo($goalId){
		global $db, $data_validation;
		
		$sql['goalId'] = $data_validation->escape_sql($goalId);
		
		$db->query('DELETE FROM goal WHERE id = '.$sql['goalId']);
		
		return;
	}