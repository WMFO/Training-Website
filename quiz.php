<?php
include('./includes/logout.inc.php');
require_once("./includes/session_timeout.inc.php");
require("./includes/session_var_setup.inc.php");
require_once("./includes/connection.inc.php");
$conn=dbConnect('write');
$sql = "SELECT * FROM quiz_questions";// ORDER BY qnum ASC";
$result = $conn->query($sql);
if(isset($_POST['submitquiz'])) {
  require('./includes/grade_quiz.inc.php');
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
<?php if(@$complete) {
  if($percentage >= $setting['min_quiz_grade']) { ?>
<h1>Congratulations!</h1>
<p>You're all set to schedule your show.<p>
<p>You'll need to fill out show forms and place those under the General Manager's door before the date indicated at the right. These forms include:</p>
<ol>
<li><a href="./includes/dj_contract.pdf">DJ Contract</a></li>
<li><a href="./includes/show_form.pdf">Show Forms</a></li>
</ol>
<p>Please use your legal name on show forms for help with station access.</p>
<?php } else { ?>
<h1>Oh no!</h1>
<p>Unfortunately, your score on the test was not good enough to pass! You'll have to attend a remedial training session. Expect an email from the training coordinator shortly.</p>
<?php } ?>

<?php } else { ?>

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
<?php  }
include('./tail.inc.php');?>
