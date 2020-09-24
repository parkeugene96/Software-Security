<?php include('server.php') ?>
<!DOCTYPE html>

<html>
    <head>
        <title>Registration system PHP and MySQL</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    
        <div class="header">
            <h2>Reset Password</h2>
        </div>
    
        <form method="post" action="resetPassword.php">
            <?php include('errors.php'); ?>
            
            <div class="input-group">
  		        <label>Username</label>
  		        <input type="text" name="username1" >
            </div>
            
            <div class="input-group">
  		        <label>Current Password</label>
  		        <input type="password" name="password1" >
            </div>
        
            <div class="input-group">
                <label>New Password</label>
                <input type="password" name="password2">
            </div>
            
            <div class="input-group">
                <label>Verification Code</label>
                <input type="text" name="verifyCode">
            </div>
        
            <div class="input-group">
                <button type="submit" class="btn" name="submit_password">Submit</button>
            </div>
        </form>
    </body>
</html>