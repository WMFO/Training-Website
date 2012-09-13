<?php
$connw= dbConnect('write');
$OK = false;
$numOK = false;
$done = false;
$success = false;
$error = array();
$query = "UPDATE users SET showchoice = 0 WHERE user_id = ?";
$stmt = $connw->stmt_init();
$stmt = $connw->prepare($query);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->close();
$query = "SELECT * FROM users WHERE showchoice = " . $_SESSION['showchoice'];
$result = $connw->query($query);
$numRows = $result->num_rows;
$result->free_result();
$success = true;
$error[] = "Successfully Dropped. Make another selection.";

if ($success) {
  $_SESSION['showchoice'] = 0;
} 
