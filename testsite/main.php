<?php
session_start();
?>
<html>
 <head>
  <title>Logged In</title>
 </head>
 <body>
  <h1>Welcome to MoYo - A personalized music site!</h1>
<?php
if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
?>
  <p>Thank you for logging into our system, <b><?php 
echo $_SESSION['username'];?>.</b></p> 
  <p>You may now <a href="form.php">click here</a> to search music information.</p>
  <p>Or just <a href="showplaylist.php">click here</a> to edit your musiclist.</p>
  <p><a href="logout.php">Change Account</a></p>
<?php
    if ($_SESSION['admin_level'] > 0) {
        echo '<p><a href="admin_area.php">Click here</a> to access your ' .
            'administrator tools.</p>';
    }
} else {
?>
  <p>You are currently not logged in to our system. Once you log in,
you can search music info and edit your playlist.</p>
  <p>If you have already registered, <a href="login.php">click
here</a> to log in. Or if you would like to create an account, 
<a href="register.php">click here</a> to register.</p>
<?php
}
?>