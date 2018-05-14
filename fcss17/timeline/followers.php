<?php
session_start();
$user_id = $_SESSION['user_id'];
?>
	<?php
	
	
	
			include 'connect.php';
			$followers = mysql_query("SELECT id
								   FROM following
								   WHERE user1_id='$id' AND user2_id='$user_id'
								  ");
			mysql_close($conn);
			if(mysql_num_rows($followers)>=1){
				echo "  ";
				echo "<div style='margin-bottom:20px; font-size:12px; font-family:arial;'> - <i>Follows You</i></div>";
			}
		
		
	?>