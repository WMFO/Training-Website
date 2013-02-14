<?php
include('./includes/session_timeout.inc.php');
include('./includes/session_var_setup.inc.php');
$sql = "SELECT email FROM users WHERE ";
switch(@$_POST['type']):
case 1:
  $sql .= "role = 'trainee'";
  break;
case 2:
  $sql .= "role = 'trainer'";
  break;
case 3:
  $sql .= "role = 'trainee' && showchoice = 0";
  break;
case 4:
  $sql .= "role = 'trainee' && showchoice != 0";
  break;
case 5:
  $sql .= "role = 'trainee' && quizscore >" . $setting['min_quiz_grade'];
  break;
case 6;
  $sql .= "role = 'trainee' && quizscore < 0";
  break;
case 7:
  $sql .= "role = 'trainee' && quizscore <" . $setting['min_quiz_grade']
    . " && quizscore > 0";
  break;
default:
  $sql .= "role != 'admin'";
  break;
endswitch;
$result = $conn->query($sql);
?>
<form name="selectthings" method="post" action="">
<select name="type">
<?php
$things = array("All Emails", "Trainees", "Trainers", "Unregistered Trainees",
  "Registered Trainees", "Trainees who haven't completed the quiz", "Complete Trainees", "Remedial Trainees");
for($i = 0; $i < sizeof($things); $i++) {
  echo '<option value="' . $i . '" '; 
  if (@$_POST['type'] == $i){ echo 'selected="yes"';}
  echo '>' . $things[$i] . '</option' . ">\n";
}?>
</select>
<input type="submit" value="Submit" name="submit">
</form>
<?php
  if (@$result){
    while($row = $result->fetch_assoc()) {
      echo $row['email'] . "\n<br />";
    }
  }
?><p><a href="index.php">Home</a></p>
