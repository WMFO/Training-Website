<h1>Trainee Area</h1>
<p>
Welcome, 
<?php echo $_SESSION['fname']; ?>
!
</p>
<?php if(0) {?>
<table border="2" width="550px">
<tr><td style="background-color: #FFCACA"><b>A Note:</b> We have a VERY heavy load of trainees this semester. You stand a much better chance of getting a good show (or any show at all if we have 70+ people request a show) if you get a show with 1 or 2 or 3 friends. Start thinking about this now so that when it's time to fill out show request forms you don't have to worry. Also, coming to volunteer days is highly recommended to get a higher ranking.</td></tr>
</table><br />
<?php } ?>
<?php if (!$registration_done && !$register) {?><p>Your registration and login is successful. Please log back in at the appropriate time to select your show.</p>
<?php } else { ?>
<p>The WMFO training portal.</p>
<?php } 
include('./includes/quiz_include.inc.php');
if (!@$complete) {
  include("./includes/show_selection.inc.php");
}
