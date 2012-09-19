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
<?php if (!$register) {?><p>Your registration and login is successful. Please log back in at the appropriate time to select your show.</p>
<?php } else { ?>
<p>The WMFO training portal.</p>
<?php }
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
<?php if(0) {?>
<table border="2" width="400px">
<tr><td style="background-color: yellow"><b>Notice:</b> WMFO is transitioning to a two (2) week training time frame to enhance overall efficiency of the training process. The Fall 2012 training will be a trial run of the new system. To facilitate the shorter timeframe, we will also be using the TEMS, a training management infrastructure for keeping track of attendance and training goals. If you have any questions, feel free to ask via email.</td></tr>
</table>
<?php } ?>
<p>You can view DJ names and contact info below once they join your show. Please take attendance and fill out the checklist every week during your show!</p>

<?php include('./includes/trainer_startpage.inc.php'); ?>

<?php  include('./includes/checklist.inc.php');
} ?>
<p>Problems? Email training@wmfo.org.</p>
<?php include('./tail.inc.php');
