<?php
session_start();
ob_start();
// set a time limit in seconds
$timelimit = 10000;
// get the current time
$now = time();
// where to redirect if rejected
$redirect = 'login.php';
$next = $_SERVER['PHP_SELF'];
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
  header("Location: {$redirect}?expired=yes&next={$next}");
  exit;
} else {
  // if it's got this far, it's OK, so update start time
  $_SESSION['start'] = time();
}
