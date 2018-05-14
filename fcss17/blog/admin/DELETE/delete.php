<?php
//include config
require_once('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: ../login.php'); }

	

?>




<?php

include('config.php');

if(isset($_GET['id']) && is_numeric($_GET['id']))
{
$id=$_GET['id'];

$result=mysql_query("DELETE FROM users WHERE id=$id")
or die(mysql_error());

header("location: index.php");
}
else
{
header("location: index.php");
}
?>