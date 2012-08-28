<?php
$expected = array('fname', 'lname', 'email', 'pwd', 'conf_pwd', 'role', 'showday', 'showtime', 'showpm', 'showduration',
  'phone', 'showname');
// set required fields
$required = array('fname', 'lname', 'email', 'pwd', 'conf_pwd', 'role');
$errors = array();
$missing = array(); 
$redirect = "login.php";
if (isset($_POST['register'])) {
  require('./includes/processmail.inc.php');
  require_once('./includes/register_user_mysqli.inc.php');
}
include('./includes/session_var_setup.inc.php');
if(@$_GET['key'] != $setting['regkey']) {
  header("Location: /");
}
// list expected fields
?>
<!DOCTYPE HTML>
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
<meta charset="utf-8">
<title>Register user</title>
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
</head>

<body>
<h1>Register user</h1>
<?php
if (isset($success)) {
  echo "<p>$success</p>";
  echo '<p><a href="login.php">Login</a></p>';
} elseif (isset($errors) && !empty($errors)) {
  echo '<ul>';
  foreach ($errors as $error) {
    echo "<li>$error</li>";
  }
  echo '</ul>';
}
?>
<form id="form1" method="post" action="">
  <p>
    <label for="email">First Name:</label>
    <input type="text" name="fname" id="fname" maxlength="44" <?php if ($errors || $missing){
      echo 'value="' . $fname . '" ';}?>required>
  </p>
  <p>
    <label for="email">Last Name:</label>
    <input type="text" name="lname" id="lname" maxlength="44" <?php if ($errors || $missing){
      echo 'value="' . $lname . '" ';}?>required>
  </p>
  <p>
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" maxlength="50" <?php if ($errors || $missing){
      echo 'value="' . $email . '" ';}?>required>
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
        <input type="radio" onchange="hideA(this)" name="role" value="trainee"
<?php $trainchecked = !(($errors || $missing) && $role == 'trainee') && !isset($_POST);
if(!$trainchecked){ echo "checked";} ?>>
        <br />
        <label for="trainer">Trainer</label>
        <input type="radio" onchange="showA(this)" name="role" value="trainer" <?php if($trainchecked){ echo 'checked'; }?>>
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
                                        <option value="Wednesday"
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
</body>
</html>
