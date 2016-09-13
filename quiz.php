<?php
include('./includes/logout.inc.php');
require_once("./includes/session_timeout.inc.php");
require("./includes/session_var_setup.inc.php");
require_once("./includes/connection.inc.php");
$conn=dbConnect('write');
$sql = "SELECT * FROM quiz_questions ORDER BY qnum ASC";
$result = $conn->query($sql);
if(isset($_POST['submitquiz'])) {
  require('./includes/grade_quiz.inc.php');
  header("Location: index.php");
}
if($_SESSION['quizscore'] >= 0) {
  $complete = true;
  $percentage = $_SESSION['quizscore'];
}
if($setting['quizlock'] != 2) {
  $sql = "SELECT * FROM quiz_views WHERE id_fk =" . $_SESSION['user_id'];
  $view = $conn->query($sql);
  if ($view->num_rows) {
    header("Location: index.php?quizr=meow");
  } else {
    $sql = "INSERT INTO quiz_views (id_fk) VALUES (" . $_SESSION['user_id'] . ")";
    $conn->query($sql);
  }
}
$giveboot = false;
if($setting['quizlock'] == 0) {
  if ($_SESSION['role'] == "trainer") {
    $giveboot = true;
  }
} else {
  $giveboot = false;
}

include('./head.inc.php');
?>
<?php if (!$giveboot) { ?>
<script type="text/javascript">
var changes = true;        
window.onbeforeunload = function() {
  if(changes) {
    return "If you leave the quiz without finishing you won't be allowed back in.";
  }
  else {
    return null;
  }
}
</script>
<?php } ?>


<h1>Quiz</h1>
<?php if (@$giveboot) {?>
<p>Sorry, the quiz is in production and only trainees may view the quiz during this period. If you have questions regarding the quiz please contact the training coordinator.</p>
<?php } elseif ($_SESSION['role'] == "trainee" && $numattends < 2) { ?>
<p>No cheating the system. Email training@wmfo.org to reset your quiz view and explain the situation.</p>
<?php } else { ?>
<p>Before you can register for a show, you must complete this quiz. It is designed to assess your knowledge of basic operating practices here at the station. If you do poorly on the quiz, we'll ask for you to attend a final session where we'll go over additional details.</p>
<p>Please use the <a target="_blank" href="https://docs.google.com/document/d/1K4ZUeF1CYjk6BDiEqFmx1pf-geqkG0avD8ppCqqe6Ws/edit">DJ Handbook</a> and the <a target="_blank" href="https://www.youtube.com/playlist?list=PLP5F7bT61v2tx_MKfE0UVFV1dXid4YE5M">WMFO Training Videos</a> page!</p>
<form method="post" action="" name="quizform">
<?php
while($row = $result->fetch_assoc()) { ?>
<h2>Question <?php echo $row['qnum'] ?>:</h2>
<?php echo $row['content'];
echo "<p>\n" . $row['input'] . "\n</p>";?>
<?php } ?>
<input type="submit" onclick='changes=false;' name="submitquiz" value="Submit Answers">
</form>
<?php  
}
include('./tail.inc.php');?>
