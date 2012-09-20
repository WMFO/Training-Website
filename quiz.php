<?php
include('./includes/logout.inc.php');
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$conn=dbConnect('write');
$role = $_SESSION['role'];
$sql = "SELECT * FROM quiz_questions ORDER BY qnum ASC";
$result = $conn->query($sql);
include('./head.inc.php');
?>
<h1>Quiz</h1>
<p>Before you can register for a show, you must complete this quiz. It is designed to assess your knowledge of basic operating practices here at the station. If you do poorly on the quiz, we'll ask for you to attend a final session where we'll go over additional details.</p>
<form method="post" action="" name="quizform">
<?php
while($row = $result->fetch_assoc()) { ?>
<p>Question <?php echo $row['qnum'] ?>:</p>
<?php echo $row['content'];
echo $row['input'];?>
<?php } ?>
<input type="submit" name="submitquiz" value="Submit Answers">
</form>
<?php include('./tail.inc.php');?>
