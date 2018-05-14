<?php

session_start();


$user_id = $_SESSION['user_id'];

?>

			
				<?php
				if($user_id){
				include "connect.php";
				$query = mysql_query("SELECT username, password, followers, following, tweets, fullname
                              FROM users
                              WHERE id='$user_id'
                             ");
		mysql_close($conn);
		$row = mysql_fetch_assoc($query);
		$username = $row['username'];
		$tweets = $row['tweets'];
		$followers = $row['followers'];
		$following = $row['following'];
		$password = $row['password'];
		
		$fullname = $row['fullname'];
	
	

		include('changepassword.php');
    exit;
  }
  ?>
