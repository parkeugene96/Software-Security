<?php include('server.php') ?>
<!DOCTYPE html>

<html>
    <head>
        <title>Email Verification</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    
    <body>
        <div class="header">
            <h2>Email Verification</h2>
        </div>
    
        <form method="post" action="emailVerify.php">
            <?php include('errors.php'); ?>
            <div class="input-group">
  		        <label>Username</label>
  		        <input type="text" name="username3" >
            </div>
            
            <div class="input-group">
  		        <label>Email Address</label>
  		        <input type="text" name="email" >
            </div>
        
            <div class="input-group">
                <button type="submit" class="btn" name="send_email">Send Code</button>
            </div>
        </form>
    </body>
</html>