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
<?php if (!$registration_done && !$register) {?><p>Your registration and login are successful. Please return at the appropriate time to select your show.</p>
<?php } else { ?>
<p>The WMFO training portal.</p>
<?php } 
include('./includes/quiz_include.inc.php');
include("./includes/show_selection.inc.php");
