<?php
require('./includes/connection.inc.php');
$error = array();
$connw = dbConnect('write');
$sql = "DROP FROM pass_reset WHERE " . TIME() . " > time + 3600";
$connw->query($sql);
$email = $_POST['email'];
$sql = "SELECT user_id FROM users WHERE email = '" . $email . "'";
$result = $connw->query($sql);
if($result->num_rows()) {
  $row = $result->fetch_assoc();
  $user_id = $row['email'];
  $result->close();
  $now = time();
  $secret = sha1(time() . "herro");
  $sql = "INSERT INTO pass_reset (user_id_fk, secret) VALUES (?,?)";
  $stmt = $connw->stmt_init();
  $stmt = $conn->prepare($sql);
  if ($stmt != false) {
    $stmt->bind_param('is', $user_id, $secret);
} else {
  $error[] = "Sorry, that email is not in the system."
}



