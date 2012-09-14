<?php 
$nohere = false;
$connw = dbConnect('write');
if (isset($_POST['attends'])){
  $checked = $_POST['attends'];
} else {
  $nohere = true;
}
$unchecked = array();
$sql="SELECT user_id FROM users WHERE showchoice = " . $_SESSION['user_id'];
$result = $connw->query($sql);
while ($row = $result->fetch_assoc()) { 
  if (!in_array($row['user_id'],$_POST['attends'])){
    $unchecked[] = $row['user_id'];
  }
}
$sql="UPDATE attendance SET " . $showweek . "_attend = false, "
  . $showweek . "_show = " . $_SESSION['user_id'] . " WHERE "
  . "!(" . $showweek . "_show != " . $_SESSION['user_id']
  . " && " . $showweek . "_attend = true) && (";
$uor = false;
foreach ($unchecked as $user){
  if ($uor){
    $sql .= " ||";
  } 
  $sql .= " user_id = " . $user;
  $uor = true;
}
$sql .= ")";
$done = $connw->query($sql); 
$sql="UPDATE attendance SET " . $showweek . "_attend = true, "
 . $showweek . "_show = " . $_SESSION['user_id'] . " WHERE "
  . "!(" . $showweek . "_show != " . $_SESSION['user_id']
  . " && " . $showweek . "_attend = true) && (";
$uor = false;
foreach ($_POST['attends'] as $user){
  if (!is_numeric($user)){
    die("you dunderfuck");
  }
  if ($uor){
    $sql .= " ||";
  } 
  $sql .= " user_id = " . $user;
  $uor = true;
}
$sql .= ")";
$done = $connw->query($sql); 
  $_SESSION['att'] = "Jim";
if ($done) {
  $success = "Attendance Updated";
}
