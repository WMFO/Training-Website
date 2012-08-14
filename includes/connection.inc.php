<?php
function dbConnect($usertype, $connectionType = 'mysqli') {
  $host = 'localhost';
  $db = 'training';
  //if ($usertype == 'read') {
  if ($usertype == 'read'){
    $user = 'trainingread';
    $pwd = 'ch00ch00training!';
  } elseif ($usertype == 'write') {
    $user = 'trainingwrite';
    $pwd = 'hAUrft9x7TaYxqXe';
  } else {
    exit('Unrecognized connection type');
  }
  if ($connectionType == 'mysqli') {
	return new mysqli($host, $user, $pwd, $db);
  } elseif ($mysqli->connect_error) {
	die('Connect Error: ' . $mysqli->connect_error);
    
  } else {
    try {
      return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
    } catch (PDOException $e) {
      echo 'Cannot connect to database';
      exit;
    }
  }
}
