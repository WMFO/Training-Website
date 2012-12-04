<?php
if(@$_GET['tomod'] && $_SESSION['role'] == "admin") {
  $connw = dbConnect('write');
  $sql = "SELECT * FROM users WHERE showchoice = " . $connw->real_escape_string($_GET['tomod']);
  $update = $connw->query($sql);
  while ($student = $update->fetch_assoc()) {
    for ($i = 1; $i < 4; $i++) {
      if (isset($_POST['S' . $student['user_id']]) && in_array($i,$_POST['S' . $student['user_id']])){
        $bool = true;
      } else {
        $bool = false;
      }
      $sql2 = "UPDATE attendance SET " . $i . "_attend = " . ($bool ? 'true' : 'false') . ","  . $i . "_show = -1 WHERE user_id = " . $student['user_id'];
      $result = $connw->query($sql2);
    }
  }
  $success = $result;
}

