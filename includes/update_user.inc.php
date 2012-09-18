<?php
$errors = array();
if (!empty($email)) {
  $validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  if (!$validemail) {
    $errors['email'] = "Your email appears invalid. Please try again.";
  }
}

if (!$errors) {
  $things = array("fname", "lname", "email", "role", "showday", "showtime", "showpm", "showduration", "phone", "showname", "showchoice");
  foreach ($things as $item) {
    $$item = $_POST[$item];
  }
  if ($role == "admin") {
    die("You dunderfuck");
  }
  if($_SESSION['role'] == "admin") {
  $vsql = 'UPDATE users SET showchoice=? WHERE user_id = ?';
  $stmt = $connw->stmt_init();
  $stmt = $connw->prepare($vsql);
  $stmt->bind_param('ii', $showchoice, $user);
  $stmt->execute();
  }
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
    if (!$stmt->error) {
      $fqdn = 'Location: ' . $redirect . "?message=" . $fname;
      header($fqdn);
    } else {
      $errors[] = 'Something has died. You\'ll probably have to call nick.';
    }
  } else echo("Statement failed: " . "<br>");
}
