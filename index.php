<?php
require_once("./includes/session_timeout.inc.php");
require("./includes/session_var_setup.inc.php");
include('./includes/logout.inc.php');
date_default_timezone_set('America/New_York'); 
include('./head.inc.php');
if($_SESSION['role'] == "admin"){
  ?>
<h1>Admin Area</h1>
<h3><i>How baller is that?</i></h3>
<p>
Welcome, 
<?php echo $_SESSION['fname']; ?>
!
</p>

<?php 
include('./includes/stats.inc.php');} 
if($_SESSION['role'] == "trainee"){
?>
<h1>Trainee Area</h1>
<p>
Welcome, 
<?php echo $_SESSION['fname']; ?>
!
</p>
<?php if(1) {?>
<table border="2" width="550px">
<tr><td style="background-color: #FFCACA"><b>A Note:</b> We have a VERY heavy load of trainees this semester. You stand a much better chance of getting a good show (or any show at all if we have 70+ people request a show) if you get a show with 1 or 2 or 3 friends. Start thinking about this now so that when it's time to fill out show request forms you don't have to worry. Also, coming to volunteer days is highly recommended to get a higher ranking.</td></tr>
</table><br />
<?php } ?>
<?php if (!$registration_done && !$register) {?><p>Your registration and login is successful. Please log back in at the appropriate time to select your show.</p>
<?php } else { ?>
<p>The WMFO training portal.</p>
<?php } 
include('./includes/quiz_include.inc.php');
include("./includes/show_selection.inc.php");
}
?>

<?php 
if($_SESSION['role'] == "trainer"){
?>
<h1>Training Management Portal</h1>
<p>
Welcome, 
<?php echo $_SESSION['fname']; ?>
!
</p>
<p>You can view DJ names and contact info below once they join your show. Please take attendance and fill out the checklist every week during your show!</p>

<?php include('./includes/trainer_startpage.inc.php'); ?>

<?php  include('./includes/checklist.inc.php');
} ?>
<p>Problems? Email training@wmfo.org.</p>
<?php include('./tail.inc.php');
