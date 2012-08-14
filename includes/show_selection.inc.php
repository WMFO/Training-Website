<?php
require_once('connection.inc.php');
$conn = dbConnect('read');
// get the username's details from the database
$sql = "SELECT fname, showname, showday, showduration, showtime, showpm, user_id FROM users WHERE role = 'trainer'";
$result = $conn->query($sql) or die(mysqli_error());
$numRows = $result->num_rows;
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
  <form>
    <tr>
      <td><?php echo $row['fname']; ?></td>
      <td><?php echo $row['showname']; ?></td>
      <td><?php echo $row['showday']; ?></td>
      <td><?php echo $row['showtime'] . $row['showpm']; ?></td>
      <td><?php echo $row['showduration'] . ' hr(s)'; ?></td>
      <td><?php echo $row['fname']; ?></td>
      <td><input type="radio" name="showchoice" value="<?php echo $row['user_id']; ?>"></td>
    </tr> 
<?php } ?>
</table>
 <p>
    <input name="register" type="submit" id="register" value="Register">
 </p>
</form>
<?php include('./includes/logout.inc.php'); ?>

