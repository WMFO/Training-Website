<?php
$completed_emails = '';
$sql = "SELECT showduration FROM users WHERE role = 'trainer'";
$result = $conn->query($sql);

?>
<html>
<head>
<script language="Javascript">
function hideA(x)
{
  if (x.checked)
  {
    document.getElementById("A").style.display="none";
    document.getElementById("B").style.display="block";
  }
}

function showA(x)
{
  if (x.checked)
  {
    document.getElementById("A").style.display="block";
    document.getElementById("B").style.display="none";
  }
}
</script>
<h4>Statistics</h4>
<p>This stats page provides basic information, including alerts about incomplete checklists and missing attendance.</p>
<table border="2">
<tr><td>Number 1 hour shows:</td>
<td><?php
$show1hr = 0;
$show2hr = 0;
while($row = $result->fetch_assoc()){
  if($row['showduration'] == 1) {
    $show1hr++;
  } else {
    $show2hr++;
  }
}
echo $show1hr;
?></td></tr>
<tr><td>Number 2 hour shows:</td>
<td><?php echo $show2hr;?></td>
</tr>
<tr>
<td>Max Capacity</td>
<td><?php echo $setting['max1hour'] * $show1hr
+ $setting['max2hour'] * $show2hr;?></td>
</tr>
<tr><td>Enrolled Students</td>
<td><?php
$result->close();
$sql = "SELECT user_id FROM users WHERE role = 'trainee'";
$result = $conn->query($sql);
echo $result->num_rows;

?></td></tr>
</table>
<p>
<label for="simple">Simple Info</label>
<input type="radio" onchange="showA(this)" name="selector" value="simple" checked>
<label for="detailed">Detailed Info</label>
<input type="radio" onchange="hideA(this)" name="selector" value="detailed">
<?php
$result->close();
$sql = "SELECT * FROM users JOIN attendance ON users.user_id = attendance.user_id WHERE role = 'trainee'";
$students = $conn->query($sql);
?>
<div id="A" style="display: block">
  <h2>Breakdown by Trainee</h2>
  <table border="2">
  <tr>
  <th>Name</th>
  <th>Email</th>
  <th>Registered?</th>
  <th>Attendance</th>
  </tr>
<?php
  while($student = $students->fetch_assoc()){?>
<tr>
<td><?php echo $student['fname'] . ' ' . $student['lname']; ?></td>
<td><?php echo $student['email']; ?></td>
<td><?php if($student['showchoice'] == 0) {
  echo "nope";
} else {
  echo "yup: " . $student['showchoice'];
}?></td>
<td><?php 
$numweeks = 0;
  for ($i = $showweek; $i > 0; $i--) {
    if ($student[$i . "_attend"]){
      $numweeks++;
    }
  }
if ($numweeks >= 2) {
  echo "Complete!";
  $completed_emails .= $student['email'] . ', ';
} else {
  echo "incomplete";
}
?></td>
 </tr> 
<?php }
?>
</table>

<?php if($completed_emails){
  echo "<h4>Here are the emails of completed trainees:</h4>";
    echo $completed_emails;
} ?>
</div>
<?php
$students->close();
$sql = "SELECT * FROM users WHERE role = 'trainer'";
$result = $conn->query($sql);
?>
<div id="B" style="Display: none">
<h2>Detailed Show Info</h2>
<?php while ($row = $result->fetch_assoc()) {?>
<h3><?php echo $row['fname'] . ' ' . $row['lname'] . ' (' . $row['showname']
. ')';?></h3>
<table border="2">
<tr>
<th>Attendee</th>
<th>Email</th>
<th>Missing Attendance?</th>
</tr>
<?php 
$sql = "SELECT * FROM users JOIN attendance ON users.user_id = attendance.user_id 
  WHERE showchoice = " . $row['user_id'];
$students = $conn->query($sql);
while ($student = $students->fetch_assoc()) {?>
<tr>
<td><?php echo $student['fname'] . ' ' . $student['lname']; ?></td>
<td><?php echo $student['email']; ?></td>
<td><?php 
$problems = '';
  for ($i = $showweek; $i > 0; $i--) {
    if (!$student[$i . "_attend"]){
      $problems .= 'Missed Show ' . $i . ' ';
    }
  }
if ($problems) {
  echo $problems;
} else {
  echo "OK!";
}
?></td>
 </tr> 
<?php }
?>
</table>
<?php } ?>
</div>
<p><a href="index.php">Home</a></p>
</body>
</html>