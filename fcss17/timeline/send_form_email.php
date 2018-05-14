<?php
$email=$_POST['email'];
$pasword=$_POST['password'];

if(isset($_POST['login-btn'])){
  if($_POST['email']!=""){
   
    include "connect.php";
    $query = mysql_query("SELECT email,password
                          FROM users
                          WHERE email='$email'
                          ");
						  
	$row = mysql_fetch_assoc($query);
	 if($email==$row['email']){	
		$password = $row['password'];
		echo "Your temporary password was already sent to your email. Redirecting back to page..";
		header("Refresh:4; url=index.php");
		  

	 
  
    mysql_close($conn);
	
	
	}
	else{
	  echo"<script>alert('there was no email like that stored on our database'); window.location='fpass.html'</script>";
	 
  }
 
 }
}

?>

<?php


$email=$_POST['email'];


if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "$email";
    $email_subject = "Your email subject line";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
		
	
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email'])){
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required

   
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
 
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
	$email_message .= "Your temporary password is : $password 
				
				
						copy the given password to access your account. When you can open your account, you can now change your password
						if it won't work, contact us and message us on fcss@gmail.com";	

					
    
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 <?php




 ?>
<?php
 
}
?>