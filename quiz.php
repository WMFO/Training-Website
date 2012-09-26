<?php
include('./includes/logout.inc.php');
require_once("./includes/session_timeout.inc.php");
require("./includes/session_var_setup.inc.php");
require_once("./includes/connection.inc.php");
$conn=dbConnect('write');
$sql = "SELECT * FROM quiz_questions ORDER BY qnum ASC";
$result = $conn->query($sql);
$sql = "SELECT * FROM quiz_views WHERE id_fk =" . $_SESSION['user_id'];
$view = $conn->query($sql);
if(isset($_POST['submitquiz'])) {
  require('./includes/grade_quiz.inc.php');
  header("Location: index.php");
}
if ($view->num_rows) {
  header("Location: index.php?quizr=meow");
} else {
  $sql = "INSERT INTO quiz_views (id_fk) VALUES (" . $_SESSION['user_id'] . ")";
  $conn->query($sql);
}
if($_SESSION['quizscore'] >= 0) {
  $complete = true;
  $percentage = $_SESSION['quizscore'];
}
include('./head.inc.php');
?>
<pre>
<?php //var_dump($conn); ?>
</pre>


<h1>Quiz</h1>
<p>Before you can register for a show, you must complete this quiz. It is designed to assess your knowledge of basic operating practices here at the station. If you do poorly on the quiz, we'll ask for you to attend a final session where we'll go over additional details.</p>
<form method="post" action="" name="quizform">
<?php
while($row = $result->fetch_assoc()) { ?>
<p>Question <?php echo $row['qnum'] ?>:</p>
<?php echo $row['content'];
echo "<p>\n" . $row['input'] . "\n</p>";?>
<?php } ?>
<input type="submit" name="submitquiz" value="Submit Answers">
</form>
<?php  
include('./tail.inc.php');?>
