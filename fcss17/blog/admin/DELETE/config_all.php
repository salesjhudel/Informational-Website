<?php

$con=mysql_connect("localhost","root","");
if(!$con)
	{
	die('Could not connect:' . mysql_error());
	}
$query='CREATE DATABASE work';
$result=mysql_query($query);

mysql_select_db('database') or die ('Cannot select database');
$query= 'CREATE TABLE users2(
	id int NOT NULL AUTO_INCREMENT,
	firstname VARCHAR(50) NOT NULL,
	middlename VARCHAR(50) NOT NULL,
	lastname VARCHAR(50) NOT NULL,
	mail VARCHAR(50) NOT NULL,
	pass VARCHAR(50) NOT NULL,
	PRIMARY KEY(id))';
	
$result = mysql_query($query);

mysql_close($con);
echo "<center><font color='blue' size='16'><br><br>";
echo "Your Database Table Has been Created!";
echo "</font></center>";
?>