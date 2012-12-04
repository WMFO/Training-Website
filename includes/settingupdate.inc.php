<?php
date_default_timezone_set('America/New_York');
$update2 = dbConnect('write');
$text = array("sidebar","DJRegPg");
$uupd = "UPDATE settings SET nvalue = 
CASE `name`";
$dupd = "UPDATE settings SET dvalue = 
CASE `name`";
//mysqli_report(MYSQLI_REPORT_ERROR);
foreach ($_POST as $key=>$item) {
  if (in_array($key,$text)) {
    $sql4 = "UPDATE cmstext SET body = '" . $update2->real_escape_string($item) . "' WHERE name = '" . $key . "'";
    $update2->query($sql4);
  }
  elseif (is_numeric($item)){
    $uupd .= "WHEN '" . $key . "' THEN '" . $item . "'
      ";
  }
  elseif($key != "settingsubmit"){
    $dupd .= "WHEN '" . $key . "' THEN '" . date($item) . "'
      ";
  }

}
$uupd .="END";
$dupd .="END";
$test3 = $update2->query($uupd);
$test4 = $update2->query($dupd);

