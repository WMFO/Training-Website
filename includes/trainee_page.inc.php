<h1>Trainee Area</h1>
<p>
Welcome, 
<?php echo $_SESSION['fname']; ?>
!
</p>
<?php if(1) {
  $sql = "SELECT * FROM cmstext WHERE name = 'traineeAnn'";
  $announce = $conn->query($sql);
  $row = $announce->fetch_assoc();
  echo $row['body'];
?>
<?php } ?>
<?php if (!$registration_done && !$register) {?><p>Your registration and login is successful. Please log back in at the appropriate time to select your show.</p>
<?php } else { ?>
<p>The WMFO training portal.</p>
<?php } 
include('./includes/quiz_include.inc.php');
if (!@$complete) {
  include("./includes/show_selection.inc.php");
}
