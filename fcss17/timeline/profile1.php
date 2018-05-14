<?php
session_start();
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=425px, user-scalable=no">

	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<title>Profile</title>
</head>


<h3></h3>



	<div id="contents" style=" padding:20px; width:550px; font-size:10px; background-color:lightblue; margin-bottom:0px;">
		
		<a href='.' style="float:left; font-size:20px; font-family:arial; color:#4E4D4D;">Go Home</a>
	<br>
	<br>
	<br>
	<br>
	
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
	/*iadd mo sa query yung idadagdag mo para kunin nya sa database yung data*/
	if($_GET['username']){
		include 'connect.php';
		$username = strtolower($_GET['username']);
		$query = mysql_query("SELECT id, username, followers, following, tweets, email, fullname
			FROM users
			WHERE username='$username'
			");
		mysql_close($conn);
		if(mysql_num_rows($query)>=1){
			$row = mysql_fetch_assoc($query);
			$id = $row['id'];
		/*nag add ako ng email variable para iistore yung laman ng email sa database*/	
			$email = $row['email'];
			
			$username = $row['username'];
			$tweets = $row['tweets'];
			$followers = $row['followers'];
			$following = $row['following'];
		
			$fullname = $row['fullname'];
			
		
			
			
			/*part where we will add informations to profile*/
			echo "";
			echo "
			<table style='margin-bottom:40px;'>
				<tr>
					<td>
				
						<img src='./default.jpg' style='width:135px; margin-left:185px; border-radius:50%;'alt='display picture'/>
					</td>
					<td valign='top' style='padding-left:8px;'>
					
						<h7></h7>
						
						
					";
			
					/*part where we will add informations to profile*/		
					if($user_id){
				if($user_id!=$id){
					include 'connect.php';
					$query2 = mysql_query("SELECT id
										   FROM following
										   WHERE user1_id='$user_id' AND user2_id='$id'
										  ");
					mysql_close($conn);
					if(mysql_num_rows($query2)>=1){
						echo "<a style='font-size:20px; float:left; margin-left:0px;' href='unfollow.php?userid=$id&username=$username'  style='float:right; '>Unfollow</a>";
					}
					else{
						echo "<a style='font-size:20px; float:left; margin-left:0px; ' href='follow.php?userid=$id&username=$username'  style='float:right;'>Follow</a>";
					}
				}
			}
			else{
				echo "<a href='./register.php' style='float:right;'>Signup</a>";
			}
			echo "<br>";	
			echo "<br>";				

			include 'connect.php';
			$query3 = mysql_query("SELECT id
								   FROM following
								   WHERE user1_id='$id' AND user2_id='$user_id'
								  ");
			mysql_close($conn);
			if(mysql_num_rows($query3)>=1){
				echo "<div style='margin-bottom:20px; font-size:12px; font-family:arial;'> - <i>Follows You</i></div>";
			}
			echo												"</h6> 
			
					</td>
				</tr>
			</table>
				<div style ='text-align:center;'>
					<b><h6 style='font-size:20px; margin-bottom:0px; '><a style='text-decoration:none; color:#4E4D4D; font-size:30px;' href='./$username'>$fullname</a></h6></b>
					<b><h6 style='font-size:20px; margin-bottom:20px; margin-top:0px;'><a style='text-decoration:none; color:#4E4D4D; font-size:17px;' href='./$username'>@$username</a></h6></b>
					<h6 style='margin-top:-10px; font-size:17px; font-family:arial; text-align:center;'>Posts: <a style='text-decoration:none; color:#4E4D4D; font-weight:bold;' href='#'>$tweets</a> | Followers: <a style='text-decoration:none; color:#4E4D4D; font-weight:bold;' href='#'>$followers</a> | Following: <a style='text-decoration:none; color:#4E4D4D; font-weight:bold;' href='#'>$following</a></h6>
				</div>
			";
			
			
				/*parts of following and unfollowing*/
		
			
			
			
			?>
			</div>	


<div style=" width:450px; margin-left:0px; margin-right:0px; background-color:#EFEFEF; padding:20px; margin-top:0px; width:550px;">			
				<?php
			// settings of the tweets
			include "connect.php";
			$tweets = mysql_query("SELECT username, tweet, timestamp
				FROM tweets
				WHERE user_id = $id
				ORDER BY timestamp DESC
				
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
			echo "<b><a style='font-size:18px; text-decoration:none; color:#4E4D4D;' href='./".$tweet['username']."'>@".$tweet['username']."</a></b>";
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
		else{
			echo "<div class='alert alert-danger'>Sorry, this profile doesn't exist.</div>";
			
		}
	}
	?>

	<br>
	</div>

	

	</div>
</html>
