<?php
$update2 = dbConnect('write');
$uupd = "UPDATE users SET enabled = 
CASE `user_id`";
foreach ($_POST as $key=>$item) {
  if (is_numeric($key)) {
    $uupd .= "WHEN '" . $key . "' THEN '" . $item . "'
      ";
  }
}
$uupd .="END";
$test3 = $update2->query($uupd);
