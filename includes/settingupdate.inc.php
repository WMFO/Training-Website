<?php
$update2 = dbConnect('write');
$uupd = "UPDATE settings SET nvalue = 
CASE `name`";
$dupd = "UPDATE settings SET dvalue = 
CASE `name`";
foreach ($_POST as $key=>$item) {
  if (is_numeric($item)){
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
