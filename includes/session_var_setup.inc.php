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
$showweek = floor(($currentTime - $training_start) / 604800) + 1;
if ($currentTime > $setting['reg_open']) {
  $register = true;
} else {
  $register = false;
}
#    $setting['training_start'] = 2012-12-31; #$row['dvalue'];
/*echo "<pre>";
var_dump($setting);
echo "</pre>";*/
$settingQuery->free_result();

