<?php
require_once('connection.inc.php');
$conn = dbConnect('read');
// get the username's details from the database
$sql = 'SELECT salt, pwd, enabled, user_id, role, showchoice, fname, quizscore FROM users WHERE email = ?';
// initialize and prepare statement
$stmt = $conn->stmt_init();
$stmt->prepare($sql);
// bind the input parameter
$stmt->bind_param('s', $email);
// bind the result, using a new variable for the password
$stmt->bind_result($salt, $storedPwd, $enabled, $user_id, $role, $showchoice, $fname, $quizscore);
$stmt->execute();
$stmt->fetch();
// encrypt the submitted password with the salt and compare with stored password
$passok = sha1($password . $salt) == $storedPwd;
require('./includes/PasswordHash.php');
$megahasher = new PasswordHash(8,FALSE);
$passok = $megahasher->CheckPassword($password, $storedPwd);
if ($passok && ($enabled || $role == "admin")){
  $_SESSION['authenticated'] = 'Jesse Weeks';
  $_SESSION['user_id'] = $user_id;
  $_SESSION['role'] = $role;
  $_SESSION['showchoice'] = $showchoice;
  $_SESSION['enabled'] = $enabled;
  $_SESSION['fname'] = $fname;
  $_SESSION['quizscore'] = $quizscore;
  // get the time the session started
  $_SESSION['start'] = time();
  session_regenerate_id();
  header("Location: $redirect");
  exit;
} elseif ($passok && $user_id != 0 && $enabled == "0"){
  $error = 'Your account is disabled. If you have questions, contact the training coordinator.';
} else {
  // if no match, prepare error message
  $error = 'Invalid username or password';
}
