<?php
include('./includes/logout.inc.php');
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$conn=dbConnect('write');
if ($_SESSION['role'] != "admin") {
  header("Location: index.php");
}
if (isset($_POST['resetviews']) && isset($_POST['delview']) && $_SESSION['role'] == "admin") {
  foreach($_POST['delview'] as $person) {
    $sql2 = "DELETE FROM quiz_views WHERE id_fk = " . $person;
    $conn->query($sql2);
  }
}
if (isset($_POST['resetviews']) && isset($_POST['markpass']) && $_SESSION['role'] == "admin") {
  foreach($_POST['markpass'] as $person) {
    $sql2 = "UPDATE users SET quizscore = 101 WHERE user_id = " . $person;
    $conn->query($sql2);
  }
}
$sql = "SELECT * FROM users WHERE quizscore >= 0";
$result = $conn->query($sql);
?>
<html>
<head>
<title>User Specific Quiz Functions</title>
</head>
<body>
<?php if (isset($_GET['view'])) {
?>
<h1>View Answers for User</h1>
<p>The correct answer field is only valid as long as the answers have not been changed from the quiz page.</p>
<p>To view accurately, open up the quiz question edit screen in another tab and flip back and fourth to view particular questions</p>
<table border="2">
<tr><th>Question #</th>
<th>Answer</th>
<th>Correct</th>
<th>Color</th>
<?php
  $sql = "SELECT answer FROM quiz_answers WHERE user_id_fk = " . $_GET['view'] . " ORDER BY qnum_fk ASC";
  $person_answers = $conn->query($sql);
  $sql = "SELECT * FROM quiz_questions ORDER BY qnum ASC";
  $questions = $conn->query($sql);
  if ($person_answers->num_rows != $questions->num_rows) {?>
</table>
<p>Answers have not been received. Either the quiz is in progress or was exited early or graded improperly. Reset quiz view to allow second try of quiz.</p>
<?php } else {
  while ($answer = $person_answers->fetch_assoc()) {
    $question = $questions->fetch_assoc();
?>
<tr>
<td><?php echo $question['qnum']; ?></td>
<td><?php echo $answer['answer']; ?></td>
<td><?php echo $question['answer']; ?></td>
<td <?php if (strtoupper($question['answer']) != strtoupper($answer['answer'])) {
  echo 'bgcolor="red"';
} else {
  echo 'bgcolor="green"';
}?>></td>
</tr>
<?php }} ?>
</table>
<a href="quiz_person.php">Back to Quiz Page</a><br />
<?php } else {?>
<h1>User Specific Quiz Functions</h1>
<p>Here is a list of everyone who has viewed the quiz and their score. A score of -1 indicates that the quiz is in progress or the person loaded the page and then never took the quiz. It will tell the person to email you if they screwed up with a sassy and annoyed message on their screen. I recommend waiting until they email you before initiating a "reset" command. If you reset while they're still taking the quiz, their result will not be displayed here because this only displays quiz views.</p>
  <form method="post" action="" name="meh">
<table border="2">
<tr>
<th>Person</th>
<th>Email</th>
<th>Quiz Score</th>
<th>Reset View</th>
<th>Mark Person as Passed</th>
</tr>
<?php 
  $people = array();
  while (1) {
    while($row = $result->fetch_assoc()) {
if (!in_array($row['user_id'], $people)) {
      $people[] = $row['user_id']?>
<tr>
<td><a href="?view=<?php echo $row['user_id']; ?>"><?php echo $row['fname'] . ' ' . $row['lname']; ?></a></td>
<td><?php echo $row['email'];?></td>
<td><?php echo $row['quizscore'];?></td>
<td>R<input type="checkbox" name="delview[]" value="<?php echo $row['user_id']; ?>"></td>
<td>P<input type="checkbox" name="markpass[]" value="<?php echo $row['user_id']; ?>"></td>
</tr>
<?php }} 
if (@$quizviewcheck) {
  break;
}
$sql = "SELECT fname, lname, email, user_id, quizscore FROM quiz_views LEFT JOIN users on user_id = id_fk";
$result = $conn->query($sql);
$quizviewcheck = true;

  }?>
</table>
<input type="submit" name="resetviews" value="Submit">
</form>
<h3>Wrong Answers</h3>
<p>A list of incorrect answers given for this session</p>
<table border="2">
<tr>
<th>Number</th>
<th>Theirs</th>
<th>Correct</th>
<th>Name</th>
</th>
<?php
    $sql = "select qnum, quiz_answers.answer as 'panswer', quiz_questions.answer as 'canswer', user_id_fk, fname, lname from quiz_questions join quiz_answers on qnum = qnum_fk join users on user_id = user_id_fk where quiz_answers.answer != quiz_questions.answer order by qnum asc";
    $qstats = $conn->query($sql);
    while ($wrong = $qstats->fetch_assoc()) {?>
    <tr>
    <td><?php echo $wrong['qnum']; ?></td>
    <td><?php echo $wrong['panswer']; ?></td>
    <td><?php echo $wrong['canswer']; ?></td>
    <td><?php echo $wrong['fname'] . ' ' . $wrong['lname']; ?></td>
</tr>
<?php } ?>
</table>
<?php } ?>
<a href="quizmod.php">Quiz CMS Page</a>
<a href="index.php">Home</a><br />
</body>
</html>
