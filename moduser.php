<?php
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$redirect = "user.php";
if(isset($_GET['user']) && !is_numeric($_GET['user'])){
    die("you dunderfuck. item should be numeric.");
    }
$utype = $_SESSION['role'];
if ($utype == "admin") {
  $user = $_GET['user'];
} else {
    $user = $_SESSION['user_id'];
}
$connw = dbConnect('write');
if(isset($_POST['update'])){
  require('./includes/update_user.inc.php');
}
include('./head.inc.php');
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

<h1>Modify User </h1>
<p>Update info below, then hit update when you're done.</p>

<?php
$sql = "SELECT * FROM users WHERE user_id = " . $user;
$check = $connw->query($sql);
$row = $check->fetch_assoc();

if (isset($errors) && !empty($errors)) {
  echo '<ul>';
  foreach ($errors as $error) {
    echo "<li>$error</li>";
  }
  echo '</ul>';
}
?>
<form id="usermod" method="post" action="">
  <p>
    <label for="fname">First Name:</label>
    <input type="text" name="fname" id="fname" maxlength="44" value="<?php
  echo $row['fname']; ?>" required>
  </p>
  <p>
    <label for="lname">Last Name:</label>
    <input type="text" name="lname" id="lname" maxlength="44" value="<?php 
    echo $row['lname'] ;?>" required>
  </p>
  <p>
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" maxlength="50" value="<?php
    echo $row['email'];?>" required>
  </p>
  <p>
  To change your password, click <a href="passwdreset.php">here</a>.
  </p>
<?php $trainchecked = $row['role'] == 'trainer'; ?>
<?php if($utype == "admin") {?>
    <p>
        <label for="trainee">Trainee</label>
        <input type="radio" onchange="hideA(this)" name="role" value="trainee"
<?php if(!$trainchecked){ echo "checked";} ?>>
        <br />
        <label for="trainer">Trainer</label>
        <input type="radio" onchange="showA(this)" name="role" value="trainer" <?php if($trainchecked){ echo 'checked'; }?>>
    </p>
<?php } else { ?>
  <input type="hidden" name="role" value="<?php echo $utype;?>">
<?php } ?>

    <div id="B" <?php if(!$trainchecked){ ?>
        style="display: block;"> <?php } else { ?>
        style="display: none;"><?php } ?>
  <p>
    <label for="phone">Phone Number:</label>
    <input type="text" name="phone" id="phone" maxlength="14" <?php 
      echo 'value="' . $row['phone'] . '" ';?>> Optional. In case you forget to come to training.
  </p>
</div>

    <div id="A" <?php if($trainchecked){ ?>
        style="display: block;"> <?php } else { ?>
        style="display: none;"><?php } ?>
 <p>
  <p>
    <label for="showname">Show Name:</label>
    <input type="text" name="showname" id="showname" maxlength="50" <?php 
      echo 'value="' . $row['showname'] . '" ';?>> 
  </p>
                                <label for="showday">Show day?
                <?php if (isset($missing) && in_array('showday', $missing)) { ?>
                 <span class="warning">Please make a selection</span>
                <?php } ?>
                </label>
                                <select name="showday" id="showday">
                                        <option value=""
<?php
        if ($row['showday'] == '') {
          echo 'selected';
        } ?>>Select one</option>
                                        <option value="Monday"
<?php
          if ($row['showday'] == 'Monday') {
            echo 'selected';
          } ?>>Monday</option>
                                        <option value="Tuesday"
<?php
            if ($row['showday'] == 'Tuesday') {
              echo 'selected';
            } ?>>Tuesday</option>
                                        <option value="Wednesday"
<?php
              if ($row['showday'] == 'Wednesday') {
                echo 'selected';
              } ?>>Wednesday</option>
                                        <option value="Thursday"
<?php
                if ($row['showday'] == 'Thursday') {
                  echo 'selected';
                } ?>>Thursday</option>
                                        <option value="Friday"
<?php
                  if ($row['showday'] == 'Friday') {
                    echo 'selected';
                  } ?>>Friday</option>
                                        <option value="Saturday"
<?php
                    if ($row['showday'] == 'Saturday') {
                      echo 'selected';
                    } ?>>Saturday</option>
                                        <option value="Sunday"
<?php
                      if ($row['showday'] == 'Sunday') {
                        echo 'selected';
                      } ?>>Sunday</option>
                                </select>

        </p>
        <p>
            <label for="showtime">Show Start Time:</label>
            <input name="showtime" type="text" id="text" size="2" maxlength="2" 
<?php 
  echo 'value="' . $row['showtime'] . '"';  
?>
                        > 
            <select name="showpm" id="showpm">
                        <option value="AM"
<?php
    if ($row['showpm'] == 'AM' || $row['showpm'] == '') {
      echo 'selected';
    } ?>>AM</option>
                        <option value="PM"
<?php
      if ($row['showpm'] == 'PM') {
        echo 'selected';
      } ?>>PM</option>

            </select> 
        </p>
        <p>
            <label for="showduration">Show Duration:</label>
            <select name="showduration" id="showduration">
                        <option value="1"
<?php
        if ($row['showduration'] == '1' || $row['showduration'] == '') {
          echo 'selected';
        } ?>>1</option>
                        <option value="2"
<?php
          if ($row['showduration'] == '2') {
            echo 'selected';
          } ?>>2</option>

            </select>
            hour(s)
        </p>
    </div>

  <p>
    <input name="update" type="submit" id="update" value="Update"> or <a href="index.php">Home</a>
  </p>
</form>
<?php include('./tail.inc.php');?>
