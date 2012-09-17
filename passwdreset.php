<?php
include('./includes/logout.inc.php');
require('./includes/connection.inc.php');
$connw = dbConnect('write');
$tsql = "DELETE FROM pass_reset WHERE CAST('" . date("Y-m_d H:i:s", TIME() - 3600) . "' AS DATETIME) > time";
$connw->query($tsql);
if (isset($_POST['emaillookup'])){
  $error = array();
  $email = $connw->real_escape_string($_POST['email']);
  $sql = "SELECT user_id FROM users WHERE email = '" . $email . "'";
  $result = $connw->query($sql);
  if($result->num_rows) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
    $result->close();
    $now = time();
    $secret = sha1(time() . "herro");
    $sql = "INSERT INTO pass_reset (user_id_fk, secret) VALUES (?,?)";
    $stmt = $connw->stmt_init();
    $stmt = $connw->prepare($sql);
    if ($stmt != false) {
      $stmt->bind_param('is', $user_id, $secret);
      $stmt->execute();
      if ($stmt->affected_rows == 1) {
        $subject = "WMFO TEMS Password Reset";
        $headers = "From: WMFO Training Coordinator <training@wmfo.org>";
        $message = "Hello Freeformer!\n\nYou're receiving this email because someone requested a password change on your WMFO TEMS (Training Education Management System) Account. If that was you, fantastic! Click the link below to load the password reset page:\n\nhttps://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . "?key=" . $secret . "\n\nHowever, if this was not you, simply ignore this email. The reset code will expire on it's own after 60 minutes.";
        if (mail ($email, $subject, $message, $headers)) {
          $error[] = "Check your inbox for a reset code!";
        } else {
          $error[] = "Server error. Email training@wmfo.org";
        }

      } else {
        $error[] = "An email has already been sent to that address";
      }
    }
  } else {
    $error[] = "Sorry, that email is not in the system.";
  }
}
$keyok = false;
if (isset($_GET['key'])){
  $sql = 'SELECT user_id_fk FROM pass_reset WHERE secret = "' . $_GET['key'] . '"';
  $result = $connw->query($sql);
  if($result->num_rows){
    $row = $result->fetch_assoc();
    $user_id = $row['user_id_fk'];
    $keyok = true;
  } else {
    $error[] = "Your link is invalid or has expired. Please try again.";
  }
}
if(isset($_POST['passwd']) && $keyok) {
  $pwd = $_POST['pwd'];
  $conf_pwd = $_POST['conf_pwd'];
  require_once('./classes/Ps2/CheckPassword.php');
  $errors = array();
  $checkPwd = new Ps2_CheckPassword($pwd, 6);
  //$checkPwd->requireMixedCase();
  //$checkPwd->requireNumbers(2);
  //$checkPwd->requireSymbols();
  $passwordOK = $checkPwd->check();
  if (!$passwordOK) {
    $errors = array_merge($errors, $checkPwd->getErrors());
  }
  if ($pwd != $conf_pwd) {
    $errors[] = "Your passwords don't match.";
  }
  if (!$error) {
    //$hash = sha1($pwd . $salt);
    require('./includes/PasswordHash.php');
    $megahasher = new PasswordHash(8,FALSE);
    $hash = $megahasher->HashPassword($pwd);
    $sql = 'UPDATE users SET pwd = ? WHERE user_id = ' . $user_id;
    $stmt = $connw->stmt_init();
    $stmt = $connw->prepare($sql);
    if ($stmt != false) {
      $stmt->bind_param('s', $hash);
      $stmt->execute();
      $stmt->close();
      $sql = "DELETE from pass_reset WHERE user_id_fk = " . $user_id;
      $connw->query($sql);
      Header("Location: login.php?reset=yup");
    } else {
      $error[] = "Something has done fucked up. Call Nick.";
    }
  }
} 
include("./head.inc.php");
?>
<style>
label {
        display:inline-block;
        width:115px;
        text-align:right;
        padding-right:2px;
}
input[type="submit"] {
          margin-left:122px;
}
</style>
<h1>Password Reset</h1>
<br />
<?php
if ($keyok) {
?>
<form name="passwdform" method="post" action="">
<p>Please enter a new password for your account:</p>
<?php
if(isset($error)) {
  echo "<ul>";
  foreach($error as $message) {?>
      <li><?php echo $message;?></li>
<?php }
echo "</ul>";
echo "<br />";
} ?>
<p>
<label for="password">Enter Password:</label>
<input type="password" name="pwd">
</p>
<p>
<label for="passconf">Confirm Password:</label>
<input type="password" name="conf_pwd">
</p>
<p><input type="submit" value="Change Password" name="passwd"></p>
<?php
} else { ?>
<p>Please enter in a valid, registered email below. You will be emailed a reset link that will be valid for sixty (60) minutes. To reset your account password, simply check your email and follow the link to a reset form.<p>
<?php
if(isset($error)) {
  echo "<ul>";
  foreach($error as $message) {?>
      <li><?php echo $message;?></li>
<?php }
echo "</ul>";
echo "<br />";
} ?>
<form name="emailverification" action="passwdreset.php" method="post">
<p>
<label for="email">Email:</label>
<input type="text" name="email">
</p>
<p><input type="submit" value="Password Reset" name="emaillookup"> or 
<a href="index.php">Home</a></p>
</form>
<?php }
include('./tail.inc.php'); ?>
