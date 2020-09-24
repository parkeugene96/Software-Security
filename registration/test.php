<?php 
$db = mysqli_connect("localhost", "root", "", "mydb");
//check connection
if ($db === false){
    die("ERROR: could not connect. " .mysqli_connect_error());
}
echo "Connect Successfully. Host info: " . mysqli_get_host_info($db);

$password="password";
$password = md5($password);
//echo $password;
$newPassword="new";


//INSERT
/* $user_check_query=$db->query( "INSERT INTO voter (image, firstname, lastname, Sex, username, password, course, sponsor) 
  			  VALUES('','first', 'last','m','user1','ccb0eea8a706c4c34a16', '', '')"); */


//UPDATE
/* $username="user1";
$query = "SELECT * FROM voter WHERE username='$username' AND password='$password'";
$result = mysqli_query($db, $query);
        
    if (mysqli_num_rows(mysqli_query($db, $query)) == 1){
        $_SESSION['username'] = $username;
        $newPassword = md5($newPassword);
        $user_query =$db->query("UPDATE voter SET password = '$newPassword'WHERE voter.username = '$username'");
        
        if($user_query){
            echo "Success";
        }
        else{
            echo "Unsuccessful";
        }
    } */



//EMAIL
/*$x=1;
if($x==1){
$code=mt_rand(1000, 9999);
$email="parkeugene96@gmail.com";
$subject="Voting System Email Verification Code";
$message="    Hello ".$email.", \r\n \r\nThis is the code for your Email Verification Code: \r\n \r\n".$code;
mail($email,$subject, $message,'From: wpark5voting@gmail.com');
    echo $code;
}*/


//Retrieve and Compare
$user_query=("SELECT course FROM voter WHERE username='username'");
$result = mysqli_query($db, $user_query);
$user = mysqli_fetch_assoc($result);
echo $user['course'];
if($user['course'] == '8477'){
    echo "Works";
}
else{
    echo "Make no sense";
}
    
    
 /*if($user_query){
    echo "Success";
}
else{
    echo "Unsuccessful";
}*/
    
//REGISTER User

?>