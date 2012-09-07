<?php
$attq = "INSERT INTO checklist_completion (user_fk, checklist_fk) VALUES ";
$first = true;
foreach ($_POST['checklist'] as $item) {
  if (!$first) {
    $attq .= ", ";
  }
  $first = false;
  $attq .= "(" . $_SESSION['user_id'] . ", " . $item . ") ";
}
$connw = dbConnect('write');
$result2 = $connw->query($attq);
