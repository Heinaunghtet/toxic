<div class="maincontent">
	
	This is my note
	<br>
	<form method="post"action="<?php echo URL ?>note/create">
		<label>Title</label><br>
		<input type="title" name="title"><br>
		
		<label>Content</label><br>
		<textarea name="content"></textarea><br>
		
	    
		<input type="submit" value="CREATE">
	</form>
</div>

<div class="huuu">
	

	<table>
		<caption>Note List</caption>
		
		<tbody>
			
			<?php
			if(isset($this->data) && !empty($this->data)){

				$count=1;
			    foreach ($this->data as $key => $value) {
				echo '<tr>';
				echo '<td>'.$count.'</td>';
				echo '<td>'.$value['title'].'</td>';
				echo '<td>'.$value['content'].'</td>';
				echo '<td>'.$value['date'].'</td>';
				
					echo '<td><a id="" href="note/delete/'.$value['note_id'].'">[delete]</a></td>';
				   echo '<td><a id="" href="note/edit/'.$value['note_id'].'">[edit]</a></td>';

				
				
				echo '</tr>';
				$count++;
			}

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