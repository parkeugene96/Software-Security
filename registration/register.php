<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration System</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
    
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
      <?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>First Name</label>
  	  <input type="firstname" name="firstname" value="<?php echo $firstname; ?>">
  	</div>
      
    <div class="input-group">
  	  <label>Last Name</label>
  	  <input type="lastname" name="lastname" value="<?php echo $lastname; ?>">
  	</div>
      
    <div class="input-group">
  	  <label>Sex</label>
  	  <input type="Sex"  name="Sex" value="<?php echo $Sex; ?>">
  	</div>
      
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="username" name="username" value="<?php echo $username; ?>">
  	</div>
      
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
      
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
      
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>