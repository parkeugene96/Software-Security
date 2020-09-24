<?php
session_start();
global $db;
global $code;
$firstname="";
$lastname = "";
$Sex = "";
$username = "";
$reg_user = "";
$errors = array();

// connect to the database
$db = mysqli_connect("localhost", "root", "", "mydb");
//check connection
if ($db === false){
    die("ERROR: could not connect. " .mysqli_connect_error());
}
echo "Connected Successfully. Host info: " . mysqli_get_host_info($db);

//REGISTER User
if (isset($_POST['reg_user'])) {
    $firstname = mysqli_real_escape_string($db,$_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $Sex = mysqli_real_escape_string($db, $_POST['Sex']);  
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    //form validation
    if (empty($username)){ 
        array_push($errors, "Username is required"); 
    }
    if (empty($password)){ 
        array_push($errors, "Password is required"); 
    }
  
    /* first check the database to make sure 
       a user does not already exist with the same username and/or email */
    $user_check_query = "SELECT * FROM voter WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
      
    // If user exists
    if ($user){ 
        if ($user['username'] === $username){
            array_push($errors, "Username already exists");
        }
    } 
  
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password);//encrypt the password before saving in the database
        $user_query=$db->query( "INSERT INTO voter (image, firstname, lastname, Sex, username, password, course, sponsor) 
  			  VALUES('', '$firstname', '$lastname','$Sex','$username','$password', '', '')");
    
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
    }
}


// LOGIN USER
if (isset($_POST['login_user'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    $response = $_POST["g-recaptcha-response"];
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array('secret' => '6Le9-cUUAAAAAPXJasOdJbvNkaoB_5-CI0Wc5HL9', 'response' => $_POST["g-recaptcha-response"]);
	$options = array('http' => array ('method' => 'POST','content' => http_build_query($data)));
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);
	if ($captcha_success->success==false) {
		echo "<p>You are a bot! Go away!</p>";
        array_push($errors, "CAPTCHA Invalid");
	} 
    else if ($captcha_success->success==true) {
		echo "<p>You are not a bot!</p>";
        if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM voter WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.php');
            }
            else {
                array_push($errors, "Wrong username/password combination");
            }
        }
	}
}


//Reset Password
$code;
if (isset($_POST['send_email'])){
    //Gathers Input
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $username = mysqli_real_escape_string($db,$_POST['username3']);
    //Email Info
    $code=mt_rand(1000, 9999); //Random 4-Digit Number
    $subject="Voting System Email Verification Code";
    $message="Hello,\r\n \r\nThis is the code for your Email Verification Code: \r\n \r\n".$code;
    mail($email,$subject, $message,'From: wpark5voting@gmail.com'); //Sends Email
    //Storing Verification Code
    $user_query=$db->query("UPDATE voter SET course = '$code' WHERE voter.username = '$username'");
    header('location: resetPassword.php');
}

if (isset($_POST['submit_password'])){
    //Gather Inputs
    $username = mysqli_real_escape_string($db,$_POST['username1']);
    $password = mysqli_real_escape_string($db,$_POST['password1']);
    $newPassword = mysqli_real_escape_string($db,$_POST['password2']);
    $verifyCode = mysqli_real_escape_string($db,$_POST['verifyCode']);
    //Errors
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    //Checks Verification Code
    $user_query=("SELECT course FROM voter WHERE username='username'");
    $result = mysqli_query($db, $user_query);
    $code = mysqli_fetch_assoc($result);
    if ($verifyCode != $code['course']){
        array_push($errors, "Wrong Verification");
    }
    //When Verification is successful
    if (count($errors) == 0){
        $password = md5($password);
        $query = "SELECT * FROM voter WHERE username='$username' AND password='$password'";
        $result = mysqli_query($db, $query);
        
        if (mysqli_num_rows(mysqli_query($db, $query)) == 1){
            $_SESSION['username'] = $username;
            $newPassword = md5($newPassword);
            $user_query=$db->query("UPDATE voter SET password = '$newPassword' WHERE voter.username = '$username'");
            header('location: index.php');
        }
        //When current password input is incorrect
        else{
            array_push($errors, "Wrong current password");
        }
    }
    $_SESSION['success'] = "Password has been reset";
}

?>