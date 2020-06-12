
<div class="maincontent">
	
	This is acc create
	<br>
	<form method="post"action="<?php echo URL ?>admin/create">
		<label>USER NAME</label><br>
		<?php echo Csrf::getInputToken('create') ?>
		<input type="text" name="username"><br>
		
		<label>PASSWORD</label><br>
		<input type="text" name="password"><br>
		<label for="role">Role</label><br>
		<select name="role" >
			<option value="student">Student</option>
			<option value="teacher">Teacher</option>
			<option value="admin">Admin</option>
		</select>
	    
		<input type="submit" value="CREATE">
	</form>
</div>

<div class="huuu">
	

	<table>
		<caption>Acc List</caption>
		
		<tbody>
			
			<?php
			$count=1;
			foreach ($this->data as $key => $value) {
				echo '<tr>';
				echo '<td>'.$count.'</td>';
				echo '<td>'.$value['name'].'</td>';
				echo '<td>'.$value['role'].'</td>';
				if(Session:: Get('role')=='admin'){
					echo '<td>
					        <form action="admin/delete/'.$value['user_id'].'" method="post">'.
					            Csrf::getInputToken('delete') 
                              .'<button type="submit" name="your_name" value="your_value" class="btn-link">Delete</button>
                            </form>
                          </td>';
                    echo '<td>
					        <form action="admin/edit/'.$value['user_id'].'" method="post">'.
					            Csrf::getInputToken('edit') 
                              .'<button type="submit" name="your_name" value="your_value" class="btn-link">Edit</button>
                            </form>
                          </td>';      
				   // echo '<td><a id="" href="admin/edit/'.$value['user_id'].'">[edit]</a></td>';

				}
				
				echo '</tr>';
				$count++;
			}
			// $acc=$this->data;
			// print_r($acc);
		

			?>
		</tbody>
	</table>
	
	
	
	
</div>
<div> 
	<?php
	if(isset($this->error)){
		foreach ($this->error as $key => $value) {
			echo "{$key}:{$value}<br>";
		}
	}
	?>
</div>