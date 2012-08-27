<?php if (isset($_POST['attendance'])){
  require('attendance.inc.php');
}
if (isset($_POST['reset'])){
  $_SESSION['att'] = null;
}
?>
<?php
#require_once('connection.inc.php');
#$conn = dbConnect('read');
// get the username's details from the database
$sql = "SELECT fname, lname, email, phone, user_id FROM users WHERE showchoice = " . $_SESSION['user_id'];
$result = $conn->query($sql) or die($conn->error);
$numRows = $result->num_rows;
?>
<table border="2">
  <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
  </tr>
      <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
      <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['phone']; ?></td>
    </tr>
    <?php } ?>
</table>
<?php
if ($showweek > 0) {
  $sql = "SELECT * FROM users JOIN attendance
    on users.user_id=attendance.user_id WHERE showchoice = "
    . $_SESSION['user_id']; 
  $attendance = $conn->query($sql);

  if (isset($_SESSION['att'])){?>
<p><i>You have successfully submitted attendance for this login session. To revise, click below.</i></p>
<form method="post" id="aresetform" action="">
<input type="submit" name="reset" id="reset" value="Revise Attendance">
</form>
<?php } else {?>
<h2>Attendance Matrix</h2>
<p>Please check off all present trainees during each show.</p>
<form id="attendanceform" method="post" action="">
  <table border="2">
    <tr>
       <th>Name</th>
       <th>Present (Week 1)</th>
       <th>Week 2</th>
       <th>Week 3</th>
    </tr>
<?php
    while ($row = $attendance->fetch_assoc()){ ?>
   <tr>
      <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
<?php 
      for ($i = 1; $i<4; $i++){
        echo '<td><input type="checkbox"';
        if ($i < $showweek){
          if ($row[$i . '_attend'] == false) {echo 'disabled="disabled"';}
          else { echo 'disabled="disabled" checked="yes"';} 
        } elseif ($i == $showweek){
          if ($row[$i . "_show"] != 0 && 
            $row[$i . "_show"] != $_SESSION['user_id']){
              echo 'disabled="disabled" checked="yes"';
          } else {
            echo ' value="'
              . $row['user_id'] .
              '" name="attends[]"';
            if ($row[$i . '_attend'] == true) { 
              echo 'checked';
            }
          }
        } else {
          echo 'disabled="disabled"';
        }
        echo "></td>";
      }?>

<?php } ?>

</table>
<p><input type="submit" name="attendance" value="Submit Attendance" id="attendance"></p>
</form>
<?php
        $attendance->close();
}
}
$result->close();
?>

