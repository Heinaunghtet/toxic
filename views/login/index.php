

<div class="maincontent">
	This is Login Form Page
	<br>
	<form action="<?php echo URL ?>login/check" method="post" accept-charset="utf-8">
		<label>USER NAME</label><br>
		<input type="text" name="username"><br>
		
		<label>PASSWORD</label><br>
		<input type="password" name="password"><br>
		<label for="role">Role</label><br>
		<select name="role" >
			<option value="student">Student</option>
			<option value="teacher">Teacher</option>
			<option value="admin">Admin</option>
		</select>
	    
		<input type="submit" value="SUBMIT">
	</form>
	<?php if(isset($this->msg)){
		echo $this->msg;
	}; ?>
	
</div>

