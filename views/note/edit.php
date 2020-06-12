<div class="maincontent">
	<?php
	//print_r($this->data);
	?>
	
	This is my note edit
	<br>
	<form method="post"action="<?php echo URL ?>note/EditSave/<?php echo $this->data[0]['note_id']?>">
		<label>Title</label><br>
		<input type="title" name="title" value="<?php echo $this->data[0]['title']?>"><br>
		
		<label>Content</label><br>
		<textarea name="content" value=><?php echo $this->data[0]['content']?></textarea><br>
		
	    
		<input type="submit" value="UPDATE">
	</form>
</div>

<div class="huuu">
	

	<table>
		<caption>Note List</caption>
		
		<tbody>
			
			<?php
			if(isset($this->data1) && !empty($this->data1)){

				$count=1;
			    foreach ($this->data1 as $key => $value) {
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