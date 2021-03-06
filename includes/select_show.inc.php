<?php
$connw= dbConnect('write');
$OK = false;
$numOK = false;
$done = false;
$success = false;
$message = '';
$error = array();
$query = "UPDATE users SET showchoice = ? WHERE user_id = ?";
$stmt = $connw->stmt_init();
if ($stmt->prepare($query)) {
  $stmt->bind_param('ii', intval($_POST['showchoice']), $_SESSION['user_id']);
  $done = $stmt->execute();
  $stmt->close();
}
if ($done) {
  $query = "SELECT * FROM users WHERE showchoice = " . $_POST['showchoice'];
  $result = $connw->query($query);
  $numRows = $result->num_rows;
  $result->free_result();
  $query2 = "SELECT showduration FROM users WHERE user_id = ?";
  $stmt = $conn->stmt_init();
  $stmt->prepare($query2);
  $stmt->bind_param('i', intval($_POST['showchoice']));
  $stmt->bind_result($showduration);
  $OK = $stmt->execute();
  $stmt->fetch();
  $stmt->close();
  $numOK = false;
  if($OK){
    if($showduration == 1 && $numRows <= $setting['max1hour']){
      $numOK = true;
    } elseif ($showduration == 2 && $numRows <= $setting['max2hour']){
      $numOK = true;
    } else {
      $error[] = "Sorry, the show you requested has been filled. Pick another.";
    }
  } else {
    $error[] = "Sorry, a connwection error has occured.";
  }
  if(!$numOK){ 
    //The oh shit double book moment
    $query = "UPDATE users SET showchoice = 0 WHERE user_id = " . $_SESSION['user_id'];
    $connw->query($query);
  } else {
    $success = true;
  }

} else {
  $error[] = "Error Code 14287";
}
if ($success) {
  $_SESSION['showchoice'] = $_POST['showchoice'];
} 
