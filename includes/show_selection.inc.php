<?php
#require_once('connection.inc.php');
#$conn = dbConnect('read');
// get the username's details from the database
if (isset($_POST['register']) && isset($_POST['showchoice']) && $register){
  require('select_show.inc.php');
} elseif (isset($_POST['register']) && !isset($_POST['showchoise'])){
  $error = array();
  $error[] = "Please select a show.";
}
if (isset($_POST['drop']) && $register){
  require('./includes/drop_show.inc.php');
}
//add please select a show condition
if ($_SESSION['showchoice']){
  $sql = "SELECT fname, showname, showgenre, showday, showduration, showtime, showpm, user_id, email FROM users WHERE user_id = " . $_SESSION['showchoice'];
} else {
  $sql = "SELECT fname, showname, showgenre, showday, showduration, showtime, showpm, user_id FROM users WHERE role = 'trainer' AND enabled = '1' ORDER BY showpm ASC, showtime ASC";
}
$result = $conn->query($sql) or die($conn->error);
$numRows = $result->num_rows;
if ($_SESSION['showchoice']) {
?>
<p>Congratulations, you're enrolled to be trained! The details are below:</p>
<table border="2">
  <tr>
    <th>DJ Name</th>
    <th>Name of Show</th>
    <th>Day of Week</th>
    <th>Time</th>
    <th>Show Length</th>
  </tr>
      <?php $row = $result->fetch_assoc() ?>
   <tr>
      <td><?php echo $row['fname']; ?></td>
      <td><?php echo $row['showname']; ?></td>
      <td><?php echo $row['showday']; ?></td>
      <td><?php echo $row['showtime'] . $row['showpm']; ?></td>
      <td><?php echo $row['showduration'] . ' hr(s)'; ?></td>
    </tr>
</table>
<?php if ($register) {?><p>Expect to receive a confirmation email with further details from your training DJ. You have reserved a spot in the above show. If you desire, you may drop your spot in search of another. However, your spot may be taken in you choose to drop your reservation.</p>
 <p> 
<form id="dropform" method="post" action="">
    <input name="drop" type="submit" id="drop" value="Drop Reservation">
</form>
 </p>
<?php } else {
  echo "<p><i>Add/drop is closed. If you need to change shows, contact the training coordinator.</i></p>";
  echo "\n<p>If you do not receive an email from your trainer, please contact them at the address below: ";
}?>
    <p>Your trainer's email is: <?php echo $row['email']; ?></p>
<p>
You may find it helpful to read the 
  <a href="https://www.youtube.com/playlist?list=PLP5F7bT61v2tx_MKfE0UVFV1dXid4YE5M">DJ Handbook</a> and watch the <a href="https://www.youtube.com/playlist?list=PLP5F7bT61v2tx_MKfE0UVFV1dXid4YE5M">Training Videos</a>.
</p>
<p>Attendance:</p>
<?php
$sql = "SELECT * FROM attendance WHERE user_id = " . $_SESSION['user_id'];
$attr = $conn->query($sql);
$attq = $attr->fetch_assoc();
echo "<table border='2'>";
for ($i = 1; $i < $showweek + 1; $i++) {
  echo "<tr><td>Week " . $i . "</td><td>";
  if ($attq[$i . "_attend"]) {
    echo "Yes";
  } else {
    echo "No";
  }
  echo "</td></tr>";
}
echo "</table><br />";

} else {
  if (isset($error)){
    foreach ($error as $problem){
      echo '<p>' . $problem . '</p>';
    }
  }
  if ($register) {
    echo '<p>A total of ' . $numRows . ' shows are hosting new DJs.</p>';
?>
<table border="2">
  <tr>
    <th>DJ Name</th>
    <th>Name of Show</th>
    <th>Day of Week</th>
    <th>Time</th>
    <th>Show Length</th>
    <th>Spots Available</th>
    <th>Choose</th>
  </tr>
  <?php while ($row = $result->fetch_assoc()) { ?>
  <form id="form1" method="post" action="">
    <tr>
      <td><?php echo $row['fname']; ?></td>
      <td><?php echo $row['showname']; ?><i> (<?php echo $row['showgenre'];?>)</i></td>
      <td><?php echo $row['showday']; ?></td>
      <td><?php echo $row['showtime'] . $row['showpm']; ?></td>
      <td><?php echo $row['showduration'] . ' hr(s)'; ?></td>
      <td><?php 
    $sql = "SELECT * FROM users WHERE showchoice = " . $row['user_id'];
    $result2 = $conn->query($sql);
    $enrolled = $result2->num_rows;
    if ($row['showduration'] == 1){
      $avail=$setting['max1hour'] - $enrolled;
    } elseif ($row['showduration'] == 2){
      $avail=$setting['max2hour'] - $enrolled;
    } else {
      $avail= "you done fucked up";
    }
    if($avail < 0) {
      echo "0";
    } else {
      echo $avail;
    }?></td>
      <td><?php
      if ($avail > 0) {
        echo '<input type="radio" name="showchoice" value="' . $row['user_id'] . '">';
      } else {
        echo 'Full';
      }?></td>
    </tr> 
<?php } ?>
</table>
 <p>
    <input name="register" type="submit" id="register" value="Register">
 </p>
 </form>
<?php } else if($registration_done){ ?>
<p>Oops, looks like you missed registration. Try again next semester!</p>
<?php } else {?>
<p>Registration is not open yet. It is available between <?php echo strftime( "%c", $setting['reg_open']);?> until <?php echo strftime("%c", $setting['reg_close']);?>. For help, contact the training coordinator.</p>
<p><i>The current server time is <?php echo strftime("%c" , time()); ?> </i></p>
<?php
}
}
//$result->close();
if ($showweek > 0 && $showweek < 4 && $_SESSION['showchoice']) {
?>
<h2>Weekly Training Goals:</h2>
<ul>
<?php
  $sql = "SELECT * FROM checklist WHERE weeknum = " . $showweek;
  $sql .= " ORDER BY onum ASC";
  $result = $conn->query($sql);

  while ($row = $result->fetch_assoc()){?>
  <li><?php echo $row['item']; ?></li>
<?php } 
echo "</ul>";
}?>
