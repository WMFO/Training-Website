<?php
$settingQuery = array();
require_once('connection.inc.php');
$conn = dbConnect('read');
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
#    $setting['training_start'] = 2012-12-31; #$row['dvalue'];
/*echo "<pre>";
var_dump($setting);
echo "</pre>";*/
$settingQuery->free_result();

