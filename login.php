<?php 
$error = '';
if (isset($_POST['login'])) {
  session_start();
  $email = $_POST['email'];
  $password = $_POST['pwd'];
  // location to redirect on success
  if (isset($_GET['next'])){
    $redirect = $_GET['next'];
  } else {
    $redirect = '/';
  }
  require_once('./includes/authenticate_mysqli.inc.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<style>
label {
        display:inline-block;
        width:65px;
        text-align:right;
        padding-right:2px;
}
input[type="submit"] {
          margin-left:75px;
}
</style>
</head>

<body>
<h1>Login Page</h1>
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
<?php } ?>
<form id="form1" method="post" action="">
    <p>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
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
  echo '<a href="register.php?key=3311656">Click here to Register</a>'; 
} ?>
<pre>
  __  ____        ____  __ _____ ___    ____   ___  _ ____  
 / /__\ \ \      / /  \/  |  ___/ _ \  |___ \ / _ \/ |___ \ 
| |/ __| \ \ /\ / /| |\/| | |_ | | | |   __) | | | | | __) |
| | (__| |\ V  V / | |  | |  _|| |_| |  / __/| |_| | |/ __/ 
| |\___| | \_/\_/  |_|  |_|_|   \___/  |_____|\___/|_|_____|
 \_\  /_/                                                   
</pre>
</body>
</html>
