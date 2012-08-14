<?php
//mysqli_report(MYSQLI_REPORT_ALL);
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
// validate the user's email
if (!empty($email)) {
  $validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  if (!$validemail) {
     $errors['email'] = "Your email appears invalid. Please try again.";
  }
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
  $hash = sha1($pwd . $salt);
  // prepare SQL statement
  $sql = 'INSERT INTO users (fname, lname, email, salt, pwd, role, showday, showtime, showpm, showduration, phone, showname)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
  $stmt = $conn->stmt_init();
  $stmt = $conn->prepare($sql);
  if($stmt != false)
  {
    // bind parameters and insert the details into the database
    $stmt->bind_param('sssisssissss', $fname, $lname, $email, $salt, $hash, $role, $showday, $showtime, $showpm,
                      $showduration, $phone, $showname);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
        $fqdn = 'Location: ' . $redirect . "?message=" . $fname;
  	$success = "$fname, you have been successfully registered. You may now log in.";
        header($fqdn);
    } elseif ($stmt->errno == 1062) {
	$errors[] = "$email already in system. If you have forgotten your password, beg nicholas.andre@tufts.edu to reset it.";
    } else {
	$errors[] = 'Sorry, somebody has done fucked up. Error code 3.14159' . $stmt->errno;
    }
  } else echo("Statement failed: " . "<br>");
}
