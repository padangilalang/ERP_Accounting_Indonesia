<?php	
	$result=tAccount::model()->findAll();
	$_oldvalue=0;
	$_val=0;
	echo '<ul>';
		foreach($result as $row) {
			if ($row->parent_id == $_oldvalue) {
				$_val=$_val+1;
				echo '<li>'.$_val." ".$row->account_name.'</li>';
			} else {
				$_val=$_val-1;
				echo '<li>'.$_val." ".$row->account_name.'</li>';
			}			
			$_oldvalue=$row->id;
		}
	echo '</ul>';	
?>