
<?php
//include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: ../login.php'); }



?>




<html>
<head>
<title>View Records</title>
<link rel="stylesheet" href="style/style.css">
</head>
<br>
<div style="font-size:40px; font-family:Arial;">
<b><center>FCSS USERS</center></b>
</div>
<br>

</div>
<body style="margin:auto 0px; padding-top:20px; font-family:arial; "><center>
<a style="text-decoration:none; color:red; padding-right:600px" href="../index.php">go back</a>
<hr style="width:660px;"></hr>


<?php

include('config.php');
$result=mysql_query("select * from users")
or die(mysql_error());

echo "<table border='1' cellpadding='10' >";
echo "<tr>
<th><div style ='font-family:helvetica; font-size:15px; color:#ff1a1a'>id</div></th>
<th><div style ='font-family:helvetica; font-size:15px; color:#ff1a1a'>username</font></th>
<th><div style ='font-family:helvetica; font-size:15px; color:#ff1a1a'>password</font></th>
<th><div style ='font-family:helvetica; font-size:15px; color:#ff1a1a'>email</font></th>

<th><div style ='font-family:helvetica; font-size:15px; color:#ff1a1a'>fullname</font></th>
<th><div style ='font-family:helvetica; font-size:15px; color:#ff1a1a'>contact number</font></th>


<th><div style ='font-family:helvetica; font-size:15px; color:#ff1a1a'>course</font></th>



<th><div style ='font-family:helvetica; font-size:15px; color:#ff1a1a'>action</font></th>

</tr>";

while($row=mysql_fetch_array($result))
{

echo"<tr>";
echo"<td><div style='font-size:15px;float:right; font-family:arial;'>".$row['id']."</div></td>";
echo"<td><div style='font-size:15px;float:right; font-family:arial;'>".$row['username']."</td>";
echo"<td><div style='font-size:15px;float:right; font-family:arial;'>".$row['password']."</td>";
echo"<td><div style='font-size:15px;float:right; font-family:arial;'>".$row['email']."</td>";

echo"<td><div style='font-size:15px;float:right; font-family:arial;'>".$row['fullname']."</td>";
echo"<td><div style='font-size:15px;float:right; font-family:arial;'>".$row['contactnumber']."</td>";


echo"<td><div style='font-size:15px;float:right; font-family:arial;'>".$row['course']."</td>";

echo'<td><b><font color="white" name="arial"><a style="text-decoration:none; color:#ff1a1a;" href="edit.php?id='.$row['id'].'">Edit </div></a></font></b>';
echo'<font color="black" size="4px"> | </font>';
echo'<b><font color="#663300" name="arial"><a style="text-decoration:none; color:#ff1a1a;" href="delete.php?id='.$row['id'].'">Delete</a></font></b></td>';
echo"</tr>";


}

echo"</table>";
?>

<div style="font-family:arial; font-size:19px; margin:auto 0px; padding-right:510px; " >
<h4><a style="text-decoration:none; color:red;"  href="insert.php" title="Click here to add new record in the database">Add New Record</a></h4>
</div>
</center>

</body>

</html>
















