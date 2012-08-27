<?php
if (isset($_POST['submitcheck'])){
  require('markitem.inc.php');
}
$sql= "SELECT item, id, onum, 
      IF (checklist_fk IS NULL, FALSE, TRUE) completed
      FROM checklist
      LEFT JOIN checklist_completion on id = checklist_fk
      AND user_fk = "
      . $_SESSION['user_id'] . " WHERE (weeknum <= " . $showweek 
      . " AND checklist_fk IS NULL) OR weeknum = " . $showweek
      . " ORDER BY onum ASC";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
 echo "All items complete for this session!";
} else { ?>
<p>Below you will find a checklist to be used as a guideline during your training. At the end of the day, check off the ones you have completed. Uncompleted items will remain on the list until you complete them, and new ones will be added for each of the three weeks of training.</p>
<form name="checklistform" method="post" action="">
<table border="2">
<tr>
<th>Item</th>
<th>Completion</th>
</tr>
<?php
while ($row = $result->fetch_assoc()){?>
  <tr>
  <td> <?php echo $row['item'];?> </td>
  <td> <input type="checkbox" name="checklist[]" value="<?php 
  echo $row['id']; ?>" <?php
  if ($row['completed'] == true){echo 'checked="yes" disabled="disabled"';}?>> </td> 
  </tr>
<?php } ?>
</table>
<p><input type="submit" name="submitcheck" value="Submit Checklist"></p>
</form>
<?php } ?>
