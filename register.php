<?php
if($_SERVER["HTTPS"] != "on") {
     header("HTTP/1.1 301 Moved Permanently");
        header("Location: https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
        exit();
}
$expected = array('fname', 'lname', 'email', 'pwd', 'conf_pwd', 'role', 'showday', 'showtime', 'showpm', 'showduration',
  'phone', 'showname', 'showgenre', 'conf_email');
// set required fields
$required = array('fname', 'lname', 'email', 'pwd', 'conf_pwd', 'role', 'conf_email');
$errors = array();
$missing = array(); 
$redirect = "login.php";
if (isset($_POST['register'])) {
  require('./includes/processmail.inc.php');
  require_once('./includes/register_user_mysqli.inc.php');
}
$settingQuery = array();
require_once('./includes/connection.inc.php');
$conn = dbConnect('read');
$sql="SELECT * FROM settings";
$settingQuery = $conn->query($sql);
while ($row = $settingQuery->fetch_assoc()) {
  if ($row['type'] == 'int') {
    $setting[$row['name']] = intval($row['nvalue']);
  }
  elseif ($row['type'] == 'date'){
    $setting[$row['name']] = strtotime($row['dvalue']);
  }
}
include('./head.inc.php');
if(@$_GET['key'] != $setting['regkey']) {  
  echo "<h1>Your Registration Link Has Expired</h1>";
  echo "<br />This probably means that you're late to the registration process. Contact the training coordinator if you believe there's been an error.";
} else {
if (!isset($_GET['reg'])){
?>
<?php
  //echo $_GET['key'];
  //echo $setting['regkey'];
  $sql = "SELECT * FROM cmstext WHERE name = 'DJRegPg'";
  $text = $conn->query($sql);
  $row = $text->fetch_assoc();
  echo $row['body'];
  $text->free();
?>
<p>When you are ready to continue, please click <a href="https://<?php echo $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>&reg=yes">here</a>.</p>


<?php
} else {
?>
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
<style>
label {
        display:inline-block;
        width:115px;
        text-align:right;
        padding-right:2px;
}
input[type="submit"] {
        margin-left:122px;
}
</style>
<h1>Register user</h1>
<br />
<?php
if (isset($success)) {
  echo "<p>$success</p>";
  echo '<p><a href="login.php">Login</a></p>';
} elseif (isset($errors) && !empty($errors)) {
  echo '<ul><font color="red">';
  foreach ($errors as $error) {
    echo "<li>$error</li>";
  }
  echo '</ul></font>';
  echo '<br />';
}
?>
<form id="form1" method="post" action="">
  <p>
    <label for="fname">First Name:</label>
    <input type="text" name="fname" id="fname" maxlength="44" <?php if ($errors || $missing){
      echo 'value="' . $fname . '" ';}?>required>
  </p>
  <p>
    <label for="lname">Last Name:</label>
    <input type="text" name="lname" id="lname" maxlength="44" <?php if ($errors || $missing){
      echo 'value="' . $lname . '" ';}?>required>
  </p>
  <p>
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" maxlength="50" <?php if ($errors || $missing){
      echo 'value="' . $email . '" ';}?>required>
  </p>
  <p>
    <label for="conf_email">Confirm Email:</label>
    <input type="text" name="conf_email" id="conf_email" maxlength="50" <?php if ($errors || $missing){
      echo 'value="' . $conf_email . '" ';}?>required><i> Please Ensure Accuracy</i>
  </p>
  <p>
    <label for="pwd">Password:</label>
    <input type="password" name="pwd" id="pwd" required>
  </p>
  <p>
    <label for="conf_pwd">Confirm password:</label>
    <input type="password" name="conf_pwd" id="conf_pwd" required>
  </p>
    <p>
        <label for="trainee">Trainee</label>
        <input type="radio" onchange="hideA(this)" name="role" id="trainee" value="trainee"
<?php $trainchecked = (($errors || $missing) && $role == 'trainer') && isset($_POST);
if(!$trainchecked){ echo "checked";} ?>>
        <br />
        <label for="trainer">Trainer</label>
        <input type="radio" onchange="showA(this)" name="role" id="trainer" value="trainer" <?php if($trainchecked){ echo 'checked'; }?>>
    </p>

    <div id="B" <?php if(!$trainchecked){ ?>
        style="display: block;"> <?php } else { ?>
        style="display: none;"><?php } ?>
  <p>
    <label for="phone">Phone Number:</label>
    <input type="text" name="phone" id="phone" maxlength="14" <?php if ($errors || $missing){
      echo 'value="' . $phone . '" ';}?>> Optional. In case you forget to come to training.
  </p>
</div>

    <div id="A" <?php if($trainchecked){ ?>
        style="display: block;"> <?php } else { ?>
        style="display: none;"><?php } ?>
 <p>
  <p>
    <label for="showname">Show Name:</label>
    <input type="text" name="showname" id="showname" maxlength="50" <?php if ($errors || $missing){
      echo 'value="' . $showname . '" ';}?>> 
  </p>
  <p>
    <label for="showgenre">Show Genre:</label>
    <input type="text" name="showgenre" id="showgenre" maxlength="50" <?php if ($errors || $missing){
      echo 'value="' . $showgenre . '" ';}?>> 
  </p>
                                <label for="showday">Show day?
                <?php if (isset($missing) && in_array('showday', $missing)) { ?>
                 <span class="warning">Please make a selection</span>
                <?php } ?>
                </label>
                                <select name="showday" id="showday">
                                        <option value=""
<?php
        if (!$_POST || $_POST['showday'] == '') {
          echo 'selected';
        } ?>>Select one</option>
                                        <option value="Monday"
<?php
          if ($_POST && $_POST['showday'] == 'Monday') {
            echo 'selected';
          } ?>>Monday</option>
                                        <option value="Tuesday"
<?php
            if ($_POST && $_POST['showday'] == 'Tuesday') {
              echo 'selected';
            } ?>>Tuesday</option>
                                        <option value="Wednesday"
<?php
              if ($_POST && $_POST['showday'] == 'Wednesday') {
                echo 'selected';
              } ?>>Wednesday</option>
                                        <option value="Thursday"
<?php
                if ($_POST && $_POST['showday'] == 'Thursday') {
                  echo 'selected';
                } ?>>Thursday</option>
                                        <option value="Friday"
<?php
                  if ($_POST && $_POST['showday'] == 'Friday') {
                    echo 'selected';
                  } ?>>Friday</option>
                                        <option value="Saturday"
<?php
                    if ($_POST && $_POST['showday'] == 'Saturday') {
                      echo 'selected';
                    } ?>>Saturday</option>
                                        <option value="Sunday"
<?php
                      if ($_POST && $_POST['showday'] == 'Sunday') {
                        echo 'selected';
                      } ?>>Sunday</option>
                                </select>

        </p>
        <p>
            <label for="showtime">Show Start Time:</label>
            <input name="showtime" type="text" id="text" size="2" maxlength="2" 
<?php if(isset($_POST['showtime'])){
  echo 'value="' . $_POST['showtime'] . '"'; } 
?>
                        > 
            <select name="showpm" id="showpm">
                        <option value="AM"
<?php
    if (!$_POST || $_POST['showpm'] == 'AM' || $_POST['showpm'] == '') {
      echo 'selected';
    } ?>>AM</option>
                        <option value="PM"
<?php
      if ($_POST && $_POST['showpm'] == 'PM') {
        echo 'selected';
      } ?>>PM</option>

            </select> 
        </p>
        <p>
            <label for="showduration">Show Duration:</label>
            <select name="showduration" id="showduration">
                        <option value="1"
<?php
        if (!$_POST || $_POST['showduration'] == '1' || $_POST['showduration'] == '') {
          echo 'selected';
        } ?>>1</option>
                        <option value="2"
<?php
          if ($_POST && $_POST['showduration'] == '2') {
            echo 'selected';
          } ?>>2</option>

            </select>
            hour(s)
        </p>
    </div>

  <p>
    <input name="register" type="submit" id="register" value="Register">
  </p>
</form>
<?php }}
include('./tail.inc.php');?>
