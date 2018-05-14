
<?php
//include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: ../login.php'); }



?>




<html>
	 <head>
		<title>Add Records</title>
		<link rel="stylesheet" href="style/style.css">
	</head>
<body style="margin:auto 0px; padding-top:20px; font-family:arial; ">
<center>

<br>
<div style="font-size:40px; font-family:Arial;">
<b><center>FCSS USERS</center></b>
</div>
<br>
<center><a style="text-decoration:none; color:red; padding-right:550px" href="index.php">index</a></center>
<hr style ="width:590px; margin-bottom:0px;"></hr>
<br>

<form action="" method="post">
<table border="1">

	<tr>
		<th colspan="2"><b><font color='red'> Add Records </font></b></th>
	</tr>
	
	<tr>
		<td width="179"><b><font color="#663300">username<em>*</em></font></b></td>
		<td><label>
		<input type="text" name="username" size="50">
		</label></td>
	</tr>
	

	
	<tr>
		<td width="179"><b><font color="#663300">email<em>*</em></font></b></td>
		<td><label>
		<input type="text" name="email" size="50">
		</label></td>
	</tr>	
	
	<tr>
		<td width="179"><b><font color="#663300">fullname<em>*</em></font></b></td>
		<td><label>
		<input type="text" name="fullname" size="50">
		</label></td>
	</tr>	
	
	
		<tr>
		<td width="179"><b><font color="#663300">contactnumber<em>*</em></font></b></td>
		<td><label>
		<input type="text" name="contactnumber" size="50">
		</label></td>
	</tr>	
	
	
	<tr>
	<td width="179"><b><font color='#663300'>course<em>*</em</font></b></td>
	<td><label>
	
	<select style="height:30px; width:240px; font-size:17px;" name="course" required>
		<option value="">None</option>
		<option value="volvo">Volvo</option>
		<option value="saab">Saab</option>
		<option value="mercedes">Mercedes</option>
		<option value="audi">Audi</option>
	</select>
	
	</label></td>
	</tr>
	
	
	<tr>
		<td width="179"><b><font color="#663300">password<em>*</em></font></b></td>
		<td><label>
		<input type="text" name="password" size="50">
		</label></td>
	</tr>	
	
	
	
	
	<tr align="right">
		<td colspan="2"><label>
			<input type="submit" name="submit" value="Insert Records">
		</label></td>
	</tr>
	
</table>
</form>
</center>
</body>
</html>

<?php

include('config.php');

		$username=$_POST['username'];
		$password = md5($_POST['password']);
		$email=$_POST['email'];
		
				$fullname=$_POST['fullname'];
				$contactnumber=$_POST['contactnumber'];
		
				$course=$_POST['course'];
	
	if (isset($_POST['submit']))
	{
		 if($_POST['username']!="" && $_POST['email']!="" && $_POST['fullname']!="" && $_POST['contactnumber']!="" && $_POST['password']!=""){
			mysql_query("INSERT INTO users(username, email,fullname,contactnumber,course, password)
                       VALUES ('$username', '$email','$fullname','$contactnumber','$course','$password'  )
                      ");
					  echo "successfull";
		 }
		   else{
			echo"All fields must be filled out";
		}
	}
	else
	{
		echo "try again";
	}
?>