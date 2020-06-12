<?php //Session::Init();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo isset($this->title) ? $this->title :'MVC';?></title>
	<link rel="stylesheet" href="<?php echo URL ?>public/css/default.css">
	<script type="text/javascript" src="<?php echo URL ?>public/script/jquery.js"></script>
	<script type="text/javascript" src="<?php echo URL ?>public/script/custom.js"></script>
	<?php 
	if(isset($this->js)){
		$this->script($this->js);
	}
	if(isset($this->css)){
		$this->style($this->css);
	}  
	   
	?>

</head>
<body>

	<nav>
		This is Header
		<ul>
			<?php
			if(Session::Get('loginvalue')==false):
			?>
				<li><a href="<?php echo URL ?>index" title="">Home</a></li>
				<li><a href="<?php echo URL ?>about" title="">About</a></li>
				<li><a href="<?php echo URL ?>help" title="">Help</a></li>
				<li><a href="<?php echo URL ?>login" title="">Login</a></li>
			<?php
			elseif(Session::Get('loginvalue')==true):
			?>

			<li class="logout"><a href="<?php echo URL ?>dashboard/logout" title="">Logout</a></li>
			<li><a href="<?php echo URL ?>dashboard" title="">Dashboard</a></li>
			<li><a href="<?php echo URL ?>note" title="">Note</a></li>
				<?php
				if(Session::Get('role')=='student'):
				?>
					<li><a href="<?php echo URL ?>student" title="">Student</a></li>
				<?php
				elseif(Session::Get('role')=='teacher'):
				?>
					<li><a href="<?php echo URL ?>teacher" title="">Teacher</a></li>
				<?php
				elseif(Session::Get('role')=='admin'):
				?>
					<li><a href="<?php echo URL ?>admin" title="">Admin</a></li>
				<?php endif;?>
			
						
			<?php else:?>

			<li><a href="<?php echo URL ?>login" title="">Account</a></li>
			

			<?php endif;?>
		</ul>
	</nav>
	
