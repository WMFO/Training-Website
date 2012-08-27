<?php
#require_once('connection.inc.php');
#$conn = dbConnect('read');
// get the username's details from the database
if (isset($_POST['register']) && isset($_POST['showchoice'])){
  require('select_show.inc.php');
} elseif (isset($_POST['register']) && !isset($_POST['showchoise'])){
  $error = array();
  $error[] = "Please select a show.";
}
if (isset($_POST['drop'])){
  require('/var/www/html/php/includes/drop_show.inc.php');
}
//add please select a show condition
if ($_SESSION['showchoice']){
$sql = "SELECT fname, showname, showday, showduration, showtime, showpm, user_id FROM users WHERE user_id = " . $_SESSION['showchoice'];
} else {
$sql = "SELECT fname, showname, showday, showduration, showtime, showpm, user_id, enrolled FROM users WHERE role = 'trainer' AND enabled = '1'";
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
      <?php while ($row = $result->fetch_assoc()) { ?>
   <tr>
      <td><?php echo $row['fname']; ?></td>
      <td><?php echo $row['showname']; ?></td>
      <td><?php echo $row['showday']; ?></td>
      <td><?php echo $row['showtime'] . $row['showpm']; ?></td>
      <td><?php echo $row['showduration'] . ' hr(s)'; ?></td>
    </tr>
    <?php } ?>
</table>
<p>Expect to receive a confirmation email with further details from your training DJ. You have reserved a spot in the above show. If you desire, you may drop your spot in search of another. However, your spot may be taken in you choose to drop your reservation.</p>
 <p> 
<form id="dropform" method="post" action="">
    <input name="drop" type="submit" id="drop" value="Drop Reservation">
</form>
 </p>
<p>
  <a href="https://wiki.wmfo.org/Training/New_DJ_Training_Checklist">New DJ Training Checklist</a>
</p>
<?php } else {
if (isset($error)){
  foreach ($error as $problem){
    echo '<p>' . $problem . '</p>';
  }
}
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
      <td><?php echo $row['showname']; ?></td>
      <td><?php echo $row['showday']; ?></td>
      <td><?php echo $row['showtime'] . $row['showpm']; ?></td>
      <td><?php echo $row['showduration'] . ' hr(s)'; ?></td>
      <td><?php 
if ($row['showduration'] == 1){
  $avail=$setting['max1hour'] - $row['enrolled'];
} elseif ($row['showduration'] == 2){
  $avail=$setting['max2hour'] - $row['enrolled'];
} else {
  $avail= "you done fucked up";
}
echo $avail; ?></td>
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
<?php }
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
