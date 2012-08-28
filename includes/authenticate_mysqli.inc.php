<?php
require_once('connection.inc.php');
$conn = dbConnect('read');
// get the username's details from the database
$sql = 'SELECT salt, pwd, enabled, user_id, role, showchoice FROM users WHERE email = ?';
// initialize and prepare statement
$stmt = $conn->stmt_init();
$stmt->prepare($sql);
// bind the input parameter
$stmt->bind_param('s', $email);
// bind the result, using a new variable for the password
$stmt->bind_result($salt, $storedPwd, $enabled, $user_id, $role, $showchoice);
$stmt->execute();
$stmt->fetch();
// encrypt the submitted password with the salt and compare with stored password
if (sha1($password . $salt) == $storedPwd && $enabled){
  $_SESSION['authenticated'] = 'Jesse Weeks';
  $_SESSION['user_id'] = $user_id;
  $_SESSION['role'] = $role;
  $_SESSION['showchoice'] = $showchoice;
  $_SESSION['enabled'] = $enabled;
  // get the time the session started
  $_SESSION['start'] = time();
  session_regenerate_id();
  header("Location: $redirect");
  exit;
} elseif ($user_id != 0 && $enabled == "0"){
  $error = 'Your account setup is successful. Please check back later.';
} else {
  // if no match, prepare error message
  $error = 'Invalid username or password';
}
