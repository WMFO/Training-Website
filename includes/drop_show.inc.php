<?php
  $connw= dbConnect('write');
  $OK = false;
  $numOK = false;
  $done = false;
  $success = false;
  $error = array();
  $query = "UPDATE users SET showchoice = 0 WHERE user_id = ?";
  $stmt = $connw->stmt_init();
  $stmt->prepare($query);
  $stmt->bind_param('i', $_SESSION['user_id']);
  $stmt->execute();
  $stmt->close();
  $query = "SELECT * FROM users WHERE showchoice = " . $_SESSION['showchoice'];
  $result = $connw->query($query);
  $numRows = $result->num_rows;
  $result->free_result();
  $success = true;
  $query3 = "UPDATE users SET enrolled = ? WHERE user_id = ?";
  $stmt = $connw->stmt_init();
  if ($stmt->prepare($query3)) {
     $stmt->bind_param('ii', $numRows, intval($_SESSION['showchoice']));
     $done = $stmt->execute();
     $stmt->close();
     $error[] = "Successfully Dropped. Make another selection.";
  } else {
     $error[] = "Well poop...";
  }
    
  if ($success) {
    $_SESSION['showchoice'] = 0;
  } 
