<?php 
$error = '';
if($_SERVER["HTTPS"] != "on") {
     header("HTTP/1.1 301 Moved Permanently");
        header("Location: https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
        exit();
}
if (isset($_POST['login'])) {
  session_start();
  $email = $_POST['email'];
  $password = $_POST['pwd'];
  // location to redirect on success
  if (isset($_GET['next'])){
    $redirect = $_GET['next'];
  } else {
    $redirect = 'index.php';
  }
  require_once('./includes/authenticate_mysqli.inc.php');
}
include('./head.inc.php');
?>
<style>
label {
        display:inline-block;
        width:85px;
        text-align:right;
        padding-right:2px;
}
input[type="submit"] {
          margin-left:95px;
}
</style>

<h1>Login Page</h1>
<br />
<?php
if ($error) {
  echo "<p>$error</p>";
} elseif (isset($_GET['expired'])) {
?>
<p>Your session has expired. Please log in again.</p>
<?php } elseif(isset($_GET['message'])){
  echo $_GET['message'] . ', you have successfully registered. You may now login.';
} elseif(isset($_GET['logout'])){?>
<p>Logout Successful</p>
<?php } elseif(isset($_GET['reset'])) {?>
<p>Password Successfully Reset. You may now log in.</p>
<?php } ?>
<form id="form1" method="post" action="">
    <p>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" autofocus />
    </p>
    <p>
        <label for="pwd">Password:</label>
        <input type="password" name="pwd" id="pwd">
    </p>
    <p>
        <input name="login" type="submit" id="login" value="Log in">
    </p>
</form>

<?php if( $_SERVER['SERVER_NAME'] == "php.axfp.org") {
  echo '<p><a href="register.php?key=3311646">Click here to Register</a></p>'; 
} ?>
<p><a href="passwdreset.php">Forgot Password?</a></p>
<pre>
__        ____  __ _____ ___    ____   ___  _ _____
\ \      / /  \/  |  ___/ _ \  |___ \ / _ \/ |___ /
 \ \ /\ / /| |\/| | |_ | | | |   __) | | | | | |_ \
  \ V  V / | |  | |  _|| |_| |  / __/| |_| | |___) |
   \_/\_/  |_|  |_|_|   \___/  |_____|\___/|_|____/
</pre>
<?php include('./tail.inc.php');?>
