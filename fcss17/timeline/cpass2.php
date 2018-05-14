
<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>


 
<body>
	<fieldset>
		<legend>Change Password</legend>
	
	<?php 
		
		include "connect.php";
		$password = $row['password'];
			echo "$password";
		
		if(isset($_POST['re_password']))
		{
		$id=$user_id;	
		echo"$id";
		
		$old_pass=$password;

		$new_pass=md5($_POST['new_pass']);
		$re_pass=md5($_POST['re_pass']);
		
		$chg_pwd=mysql_query("select password from users where id='$user_id'");

		$chg_pwd1=mysql_fetch_array($chg_pwd);
		
		$data_pwd=$chg_pwd1['password'];
		
		
		
		
		if($data_pwd==$old_pass){
		if($new_pass==$re_pass){
			$update_pwd=mysql_query("update users set password='$new_pass' where id='$user_id'");
			echo "<script>alert('Update Sucessfully'); window.location='index.php'</script>";
		}
		else{
			echo "<script>alert('Your new and Retype Password is not match'); window.location='index.php'</script>";
		}
		}
		else
		{
		echo "<script>alert('Your old password is wrong'); window.location='cpass.php'</script>";
		}
		}
	?>
 
	<form method="post">
	
		<dl>
			<dt>
				New Password
			</dt>
				<dd>
					<input type="password" name="new_pass" placeholder="New Password..." value=""  required />
				</dd>
		</dl>
		<dl>
			<dt>
				Retype New Password
			</dt>
				<dd>
					<input type="password" name="re_pass" placeholder="Retype New Password..." value="" required />
				</dd>
		</dl>
 
		<p align="center">
			<input type="submit" class="btn" value="Reset Password" name="re_password" />
		</p>
	</form>
	</fieldset>
</body>
</html>