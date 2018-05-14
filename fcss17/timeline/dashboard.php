
<html>

<div style="float:left; width:500px; background-color:white; padding:20px; margin-right:0px; position:fixed;">
<?php


function getTime($t_time){
	$pt = time() - $t_time;
	if ($pt>=86400)
		$p = date("F j, Y",$t_time);
	elseif ($pt>=3600)
		$p = (floor($pt/3600))."h";
	elseif ($pt>=60)
		$p = (floor($pt/60))."m";
	else
		$p = $pt."s";
	return $p;
}
	if($user_id){
		include "connect.php";
		$query = mysql_query("SELECT username, followers, following, tweets, fullname
                              FROM users
                              WHERE id='$user_id'
                             ");
		mysql_close($conn);
		$row = mysql_fetch_assoc($query);
		$username = $row['username'];
		$tweets = $row['tweets'];
		$followers = $row['followers'];
		$following = $row['following'];
		
		$fullname = $row['fullname'];
		
	/*	for the informations of the user */
	
		
		echo "
		
		
		<table>
			<tr>
				<td>
					<img src='./default.jpg' style='width:70px;  border-radius:50% 'alt='display picture'/>
				</td>
				<td valign='top' style='padding-left:8px;'>
					<b><h6 style='font-size:20px; margin-bottom:0px;'><a style='text-decoration:none; color:#4E4D4D' href='./$username'>$fullname</a></h6></b>
					<b><h6 style='font-size:20px; margin-bottom:20px;'><a style='text-decoration:none; color:#4E4D4D; font-size:15px;' href='./$username'>@$username</a></h6></b>
						</td>
						</tr>
		</table>
			
					<div style='margin-top:20px;'>
					<h6 style='margin-top:-10px; font-size:17px; font-family:arial;'>Posts: <a style='text-decoration:none; color:#4E4D4D; font-weight:bold;' href='#'>$tweets</a> | Followers: <a style='text-decoration:none; color:#4E4D4D; font-weight:bold;' href='#'>$followers</a> | Following: <a style='text-decoration:none; color:#4E4D4D; font-weight:bold;' href='#'>$following</a></h6>
					</div>
	
		";
		
		
		
?>

</div>


<div style="float:left; width:500px; height:160px; background-color:white; padding:20px; margin-right:0px; margin-top:190px;  position:fixed; ">

</div>
<div style="float:left; width:500px; height:60px; background-color:#7AC2E3; padding:20px; margin-right:0px; margin-top:150px;  position:fixed; ">


	
	<div style=" margin-right:170px; text-decoration:none; " >
	
	   <a style='text-decoration:none; float:left; font-size:20px; font-weight:bold;  color:white;'>Settings</a>
		<br>
		<br><br><br>
		<a href='cpass.php' style='text-decoration:none; float:right; font-size:17px;  color:#4E4D4D;'>Change Password</a>
		<br><br><br>
		
		<div style =" margin-right:40px;"><a href='logout.php' style='float:right; text-decoration:none;  font-size:17px;  color:#4E4D4D;'>Log out</a></div>
		
		
	</div>

</div>



<div style="float:left; background-color:lightblue; height:120px;"></div>


		<div style=" float:right; width:450px; margin-left:11110px; background-color:#CACACA; padding:20px; margin-top:0px;">
	<?php

	echo "
	
	
	<form action='tweet.php' method='POST'>
		
			<textarea name='post' style='  margin-bottom:5px; border-radius: 15px;
    padding: 10px; 
    width: 410px;
    height: 80px;  ' class='form-control' placeholder='Type anything here..' name='tweet' required='required'></textarea>
			
			<b><button type='submit'  name='button'
			style='float:right; margin-top:3px; font-size:15px; color:white; background-color:#595959; border-radius: 25px;
		width:100px;
		padding: 10px; 
		height: 40px;'>Post</button></b>
		</form>
		<br>
		<br>
		<br>
	";	
	
	
	
	?>
	</div>
	
<div style="float:right; width:450px; margin-left:0px; background-color:white; padding:20px; margin-top:0px;">
<?php		

	
	
	



		include "connect.php";
		$tweets = mysql_query("SELECT username, tweet, timestamp
							   FROM tweets
							   WHERE user_id = $user_id OR (user_id IN (SELECT user2_id FROM following WHERE user1_id='$user_id'))
							   ORDER BY timestamp DESC
							   LIMIT 0, 20
							  ");
		while($tweet = mysql_fetch_array($tweets)){
		
			
			echo "<div class='well well-sm' style='padding-top:4px;padding-bottom:8px; margin-bottom:8px; margin-top:5px; overflow:hidden;'>";
			echo "<div style='font-size:12px;float:right;'>".getTime($tweet['timestamp'])."</div>";
			echo "<table>";
			echo "<tr>";
			echo "<td valign=top style='padding-top:4px;'>";
			echo "<img src='./default.jpg' style='width:55px; border-radius:50px;'alt='display picture'/>";
			echo "</td>";;
			echo "<td style='padding-left:5px;word-wrap: break-word;' valign=top>";
			echo "<b><a style='font-size:18px; text-decoration:none; color:#4E4D4D' href='./".$tweet['username']."'>@".$tweet['username']."</a></b>";
			$new_tweet = preg_replace('/@(\\w+)/','<a style="text-decoration:none; color:#4E4D4D" href=./$1>$0</a>',$tweet['tweet']);
			$new_tweet = preg_replace('/#(\\w+)/','<a href=./hashtag/$1>$0</a>',$new_tweet);
			echo "<div style='font-size:15px; margin-top:-3px;' >".$new_tweet."</div>";
			echo "</td>";
			echo "</tr>";
			echo "</table>";
			echo "</div>";
			
			

		}
		mysql_close($conn);
	}

?>
</div>
</html>

