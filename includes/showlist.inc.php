<?php if (isset($_POST['attendance'])){
  require('attendance.inc.php');
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
    <th>Attendance</th>
  </tr>
      <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
      <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td><?php echo "&#x25fb;" . "&#9745;" . "&#9746;";?></td>
    </tr>
    <?php } ?>
</table>
<?php
if ($showweek > 0) {
  $sql = "SELECT fname, lname, users.user_id, 1_attend, 2_attend, 3_attend FROM users JOIN attendance
        on users.user_id=attendance.user_id WHERE showchoice = "
    . $_SESSION['user_id']; 
  $attendance = $conn->query($sql);
  
?>
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
  echo "<td>";
  if ($i < $showweek){
  if ($row[$i . '_attend'] == false) {echo "&#9746;";}
  else { echo "&#9745;";} 
  } elseif ($i == $showweek){
    echo '<input type="checkbox" value="'
      . $row['user_id'] .
      '" name="attends"';
    if ($row[$i . '_attend'] == true) { 
      echo 'checked';
    }
    echo '>';
  } else {
    echo '&#x25fb;';
  }
  echo "</td>";
}?></td>

<?php } ?>
    
</table>
<p><input type="submit" name="attendance" value="Submit Attendance" id="attendance"></p>
</form>
<?php
}
?>

