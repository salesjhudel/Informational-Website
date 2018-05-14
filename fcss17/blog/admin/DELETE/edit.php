
<?php
//include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: ../login.php'); }



?>




<?php
function valid($id, $username, $email, $fullname, $contactnumber, $password, $course, $error)
{
?>
<html>
<head>
<title>Edit Records</title>
<link rel="stylesheet" href="style/style.css">

</head>


<div style="font-size:40px; font-family:Arial;">
<b><center>FCSS USERS</center></b>
</div>
<center><a style="text-decoration:none; color:red; padding-right:550px" href="index.php">index</a></center>
<hr style ="width:590px; margin-bottom:0px;"></hr>





<body style="margin:auto 0px; padding-top:20px; font-family:arial; ">


<center>

<?php

if($error !='')
{
echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
}
?>





<form action="" method="post">
<input type="hidden" name="id" value="<?php echo $id;?>">


<table border="1" >

	<tr>
	<th colspan="2"><b><font color='Red'> Edit Records </font></b></th>
	</tr>
	

	
	<tr>
	<td width="179"><b><font color='#663300'>username<em>*</em></font></b></td>
	<td><label>
	<input required type="text" name="username" size="50" value="<?php echo $username; ?>"/>
	</label></td>
	</tr>
	
		</br>

	<tr>
	<td width="179"><b><font color='#663300'>email<em>*</em</font></b></td>
	<td><label>
	<input required type="text" name="email" size="50" value="<?php echo $email; ?>"/>
	</label></td>
	</tr>
	
	<tr>
	<td width="179"><b><font color='#663300'>password<em>*</em</font></b></td>
	<td><label>
	<input required type="text" name="password" size="50" value="<?php echo $password; ?>"/>
	</label></td>
	</tr>
	
	<tr>
	<td width="179"><b><font color='#663300'>fullname<em>*</em</font></b></td>
	<td><label>
	<input type="text" name="fullname" size="50" value="<?php echo $fullname; ?>"/>
	</label></td>
	</tr>
	
	
		
	<tr>
	<td width="179"><b><font color='#663300'>contact number<em>*</em</font></b></td>
	<td><label>
	<input required type="text" name="contactnumber" size="50" value="<?php echo $contactnumber; ?>"/>
	</label></td>
	</tr>
	
	
	
	<tr>
	<td width="179"><b><font color='#663300'>course<em>*</em</font></b></td>
	<td><label>
	
	<select style="height:30px; width:240px; font-size:17px;" name="course" required  value="<?php echo $course; ?>"/>
		<option value="">None</option>
		<option value="BSIT">Bachelor Science in Information Technology</option>
		<option value="BSCS">Bachelor Science in Computer Science</option>
		<option value="BSEMC">Bachelor of Science in Entertainment and Multimedia Computing</option>
		<option value="ASCS">ASCS</option>
		<option value="SHS-TECH">SHS-Tech</option>
	</select>
	
	</label></td>
	</tr>
	

	
		</br>
		
	<tr align="right">
	<td colspan="2"><label>
		<input type="submit" name="submit" value="Edit Records" title="Click here to update record.">
	</label></td>
	</tr>

	
</table>
</form>
</center>
</body>


</html>

<?php
}

include('config.php');

if (isset($_POST['submit']))
{


					$id=$_POST['id'];
					$username= mysql_real_escape_string(htmlspecialchars($_POST['username']));
					$password = md5($_POST['password']);

					$email= mysql_real_escape_string(htmlspecialchars($_POST['email']));	
					
					$fullname= mysql_real_escape_string(htmlspecialchars($_POST['fullname']));	
					$contactnumber= mysql_real_escape_string(htmlspecialchars($_POST['contactnumber']));
					
					
					
					$course=$_POST['course'];						

	
			if($username =='' || $email=='' || $fullname=='' || $contactnumber=='' || $password=='' || $course==''){
					

							$error='ER: Please fill in all required fields';

							valid($id, $username, $email , $fullname, $contactnumber, $password ,$course, $error);
					}
					else
					{

								mysql_query("update users set username='$username', email='$email' , fullname='$fullname', contactnumber='$contactnumber', password='$password',course='$course'
								where id='$id'")
								or die(mysql_error());

								header("location: index.php");
								}
								
								
	
}
else

{


if(isset($_GET['id'])&& is_numeric($_GET['id']) && $_GET['id']>0)
{
	
$id=$_GET['id'];
$result= mysql_query("select * from users where id=$id")
or die(mysql_error());
$row= mysql_fetch_array($result);

if($row)
{

$username=$row['username'];	

$email=$row['email'];

$fullname=$row['fullname'];	
$contactnumber=$row['contactnumber'];	
	
$password=$row['password'];


$course=$row['course'];

valid($id, $username,$email , $fullname, $contactnumber, $password, $course,'');
}
else
{
echo "No Results!";
}
}
else

{
echo 'Error';
}
}
?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	