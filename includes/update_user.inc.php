<?php
$errors = array();
if (!empty($email)) {
  $validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  if (!$validemail) {
    $errors['email'] = "Your email appears invalid. Please try again.";
  }
}

if (!$errors) {
  $things = array("fname", "lname", "email", "role", "showday", "showtime", "showpm", "showduration", "phone", "showname");
  foreach ($things as $item) {
    $$item = $_POST[$item];
  }
  // include the connection file
  $sql = 'UPDATE users SET fname=?, lname=?, email=?, role=?, showday=?, showtime=?, showpm=?, showduration=?, phone=?, showname=? WHERE user_id = ?';
  $stmt = $connw->stmt_init();
  $stmt = $connw->prepare($sql);
  if($stmt != false)
  {
    // bind parameters and insert the details into the database
    $stmt->bind_param('sssssissssi', $fname, $lname, $email, $role, 
      $showday, $showtime, $showpm,
      $showduration, $phone, $showname, $user);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
      $fqdn = 'Location: ' . $redirect . "?message=" . $fname;
      header($fqdn);
    } else {
      $errors[] = 'Sorry, somebody has done fucked up. Error code 3.14159' . $stmt->errno;
    }
  } else echo("Statement failed: " . "<br>");
}
