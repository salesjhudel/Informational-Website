<?php
// error_reporting (E_All^E_Notice);
session_start();
if(isset($_POST['btn'])){
$user_id = $_SESSION['user_id'];
}
?>

<html>
<head>
  <meta name="viewport" content="width=425px, user-scalable=no">

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <title></title>
</head>
<body>
	



	<div id="contents" style="margin-bottom:10px; padding:20px; height:500px; width:400px; font-size:15px; font-family:arial; color:#4E4D4D; background-color:;">


	<form action="register.php" method="POST" role="form" style="width:300px; ">
    <h3></h3>
    <h4 style="font-size:30px; width:550px; color:#4E4D4D; margin-bottom:20px;">Register</h4>
	
	<?php

	$email = $_POST['email'];
	$fullname = $_POST['fullname'];
	$contactnumber = $_POST['contactnumber'];

if(isset($_POST['btn'])){
  if($_POST['username']!="" && $_POST['email']!="" && $_POST['fullname']!="" && $_POST['contactnumber']!="" && $_POST['password']!="" && $_POST['confirm-password']!=""){
    if($_POST['password']==$_POST['confirm-password']){
      include 'connect.php';
      $username = strtolower($_POST['username']);
      $query = mysql_query("SELECT username
                            FROM users
                            WHERE username='$username'
                            ");
      mysql_close($conn);
      if(!(mysql_num_rows($query)>=1)){
          $password = md5($_POST['password']);
          include 'connect.php';
          mysql_query("INSERT INTO users(username,email,fullname,contactnumber,password)
                       VALUES ('$username','$email','$fullname','$contactnumber','$password')
                      ");
          mysql_close($conn);
          echo "<div class='alert alert-success'>Your account has been created!</div>";
          echo "<a href='.' style='width:300px; font-size:15px; font-family:arial ' >Go Home</a>";
          echo "</form>";
          echo "<br>";
     
          echo "</body>";
          echo "</html>";
          exit;

      }
      else{
        $error_msg="<div style='font-weight:bold; '> Username already exists please try again </div>" ;
      }
    }
    else{
      $error_msg="<div style='font-weight:bold;'> Passwords did not match </div>";
    }
  }
  else{
      $error_msg="<div style='font-weight:bold; '>  All fields must be filled out </div>";
  }
}
?>
	<div style ="font-size:10px ">
		<div class="input-group" style="margin-bottom:10px; ">
		<span class="input-group-addon" >@</span>
		<input type="text" class="form-control" style="font-size:17px; width:200px; color:#4E4D4D;" placeholder="Username" name="username" value="<?php $username = ""; echo $username; ?>">

		</div>

		
				<input type="text" class="form-control" style="font-size:17px; width:240px;" placeholder="Fullname" name="fullname" ><br>
				<input type="text" class="form-control" style="font-size:17px; width:240px;" placeholder="Contact number" name="contactnumber" ><br>
	
				<input type="text" class="form-control" style="font-size:17px; width:240px;" placeholder="Email" name="email" ><br>
	

	
	
    <input type="password" style="margin-bottom:10px; font-size:17px; width:240px;" class="form-control" placeholder="Password" name="password" >
    <input type="password" style="margin-bottom:10px; font-size:17px; width:240px;" class="form-control" placeholder="Confirm Password" name="confirm-password" > 
	
	</div>
	
    <?php
	
    if($error_msg){
        echo "<div style ='width:240px;' class='alert alert-danger'>".$error_msg."</div>";
    }
    ?>
	 <div class="btn-group">
		<button type="submit" style="
	background-color: #DFDFDF; 
    border: none;
    color:#4E4D4D;

    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px; width:240px; height:30px; font-size:15px; margin-bottom:5px;" name="btn" value="submit-register-form">Register</button>
		<br>
		
	
		<div style="margin-top:10px;"><a style="color:#5E91A3;  font-size:20px; text-decoration:none;"; href="." style="width:300px; width:200px; " >Go Home</a></div>
		</div>
  </form>
  <br>


  </div>

</body>
</html>
