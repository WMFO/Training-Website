<?php
mysqli_report(MYSQLI_REPORT_OFF);
if($_SERVER["HTTPS"] != "on") {
     header("HTTP/1.1 301 Moved Permanently");
        header("Location: https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
        exit();
}
session_start();
ob_start();
// set a time limit in seconds
$timelimit = 10000;
// get the current time
$now = time();
// where to redirect if rejected
$next = $_SERVER['PHP_SELF'];
$redirect = "login.php?next={$next}";
// if session variable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) {
  header("Location: $redirect");
  exit;
} elseif ($now > $_SESSION['start'] + $timelimit) {
  // if timelimit has expired, destroy session and redirect
  $_SESSION = array();
  // invalidate the session cookie
  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-86400, '/');
  }
  // end session and redirect with query string
  session_destroy();
  header("Location: {$redirect}&expired=yes");
  exit;
} else {
  // if it's got this far, it's OK, so update start time
  $_SESSION['start'] = time();
}
