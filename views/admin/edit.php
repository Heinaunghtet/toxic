<div class="maincontent">
	
	This is acc update
	<br>
	<form method="post"action="<?php echo URL ?>admin/editsave/<?php echo $this->data1[0]['user_id']?>">

		<label>USER NAME</label><br>
		<input type="text" name="username" value="<?php echo $this->data1[0]['name']?>"><br>
		
		<label>PASSWORD</label><br>
		<input type="text" name="password"><br>
		<label for="role">Role</label><br>
		<select name="role" >
			<option value="student" <?php if($this->data1[0]['role']=='student'){echo 'selected';}?>>Student</option>
			<option value="teacher"<?php if($this->data1[0]['role']=='teacher'){echo 'selected';}?>>Teacher</option>
			<option value="admin" <?php if($this->data1[0]['role']=='admin'){echo 'selected';}?>>Admin</option>
		</select>
	    
		<input type="submit" value="UPDATE">
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
				echo '</tr>';
				$count++;
			}
			// $acc=$this->data;
			// print_r($acc);
			
			?>
		</tbody>
	</table>
	
	
	
	
</div>