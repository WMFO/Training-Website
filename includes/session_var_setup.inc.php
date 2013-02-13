<?php
date_default_timezone_set('America/New_York');
$settingQuery = array();
require_once('connection.inc.php');
$conn = dbConnect('read');
$sql = "SELECT role, enabled, showchoice, fname, quizscore FROM users WHERE user_id = " . $_SESSION['user_id'];
$updateQuery = $conn->query($sql);
$info = $updateQuery->fetch_assoc();
$_SESSION['role'] = $info['role'];
$_SESSION['showchoice'] = $info['showchoice'];
$_SESSION['enabled'] = $info['enabled'];
$_SESSION['quizscore'] = $info['quizscore'];
$sql="SELECT * FROM settings";
$settingQuery = $conn->query($sql);
while ($row = $settingQuery->fetch_assoc()) { 
  if ($row['type'] == 'int') {
    $setting[$row['name']] = intval($row['nvalue']);
  }
  elseif ($row['type'] == 'date'){
    $setting[$row['name']] = strtotime($row['dvalue']);
  }
}
$currentTime= mktime();
$training_start = $setting['training_start'];
$showweek_broad = floor(($currentTime - $training_start) / 604800) + 1;
if($showweek_broad > 3) {
  $showweek= 3;
} else {
  $showweek = $showweek_broad;
}
if (($currentTime > $setting['reg_open'] && $currentTime < $setting['reg_close']) || $_SESSION['enabled'] == 2) {
  $register = true;
} else {
  $register = false;
}
if ($currentTime > $setting['reg_close']) {
  $registration_done = true;
} else {
  $registration_done = false;
}
if ($_SESSION['role'] == "trainee") {
  $sql = "SELECT * FROM attendance WHERE user_id = " . $_SESSION['user_id'];
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $numattends = 0;
  for ($i = 1; $i<4; $i++) {
    if ($row[$i . '_attend'] == true) {
      $numattends++;
    }
  }
}
#    $setting['training_start'] = 2012-12-31; #$row['dvalue'];
/*echo "<pre>";
var_dump($setting);
echo "</pre>";*/
$settingQuery->free_result();

