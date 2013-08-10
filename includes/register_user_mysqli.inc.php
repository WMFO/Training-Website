<?php
//mysqli_report(MYSQLI_REPORT_ALL);
require_once('./classes/Ps2/CheckPassword.php');
require_once('./includes/PasswordHash.php');
$errors = array();
$checkPwd = new Ps2_CheckPassword($pwd, 8);
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
if ($email != $conf_email) {
  $errors[] = "Your email addresses do not match. Please ensure accuracy or else you won't receive proper updates.";
}
// validate the user's email
if (!empty($email)) {
  $validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  if (!$validemail) {
    $errors['email'] = "Your email appears invalid. Please try again.";
  }
}
if(strstr($fname, ';') || strstr($lname, ';')) {
  $errors[] = "Silly Tyler, Trix are for kids!";
}
if (!$errors) {
  // include the connection file
  require_once('connection.inc.php');
  $conn = dbConnect('write');
  //echo "<pre>";
  //var_dump($conn);
  //echo "</pre>";
  // create a salt using the current timestamp
  $salt = time();
  // encrypt the password and salt with SHA1
  //$hash = sha1($pwd . $salt);
  // prepare SQL statement
  $megahasher = new PasswordHash(8,FALSE);
  $hash = $megahasher->HashPassword($pwd);
  $sql = 'INSERT INTO users (fname, lname, email, salt, pwd, role, showday, showtime, showpm, showduration, phone, showname, showgenre, student_id)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
  $stmt = $conn->stmt_init();
  $stmt = $conn->prepare($sql);
  if($stmt != false)
  {
    // bind parameters and insert the details into the database
    $stmt->bind_param('sssisssissssss', $fname, $lname, $email, $salt, $hash, $role, $showday, $showtime, $showpm,
      $showduration, $phone, $showname, $showgenre, $student_id);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
      if ($role = "trainee"){
        $sql = "SELECT user_id FROM users WHERE email = \"" . $email . '"';
        $connw = dbConnect('write');
        $result = $connw->query($sql);
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $result->close();
        $sql = "INSERT INTO attendance (user_id) VALUES (" . $user_id . ")";
        $result = $connw->query($sql);
      }
      $fqdn = 'Location: ' . $redirect . "?message=" . $fname;
      $success = "$fname, you have been successfully registered. You may now log in.";
      header($fqdn);
    } elseif ($stmt->errno == 1062) {
      $errors[] = "$email already in system. If you have forgotten your password, please use the password reset page.";
    } else {
      $errors[] = 'Sorry, please call Max Goldstein. Error code 3.14159' . $stmt->errno;
    }
  } else echo("Statement failed: " . "<br>");
}
