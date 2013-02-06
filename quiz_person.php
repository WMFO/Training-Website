<?php
include('./includes/logout.inc.php');
require_once("./includes/session_timeout.inc.php");
require("./includes/connection.inc.php");
$conn=dbConnect('write');
if ($_SESSION['role'] != "admin") {
  header("Location: index");
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
$sql = "SELECT fname, lname, email, user_id, quizscore FROM quiz_views LEFT JOIN users on user_id = id_fk";
$result = $conn->query($sql);
?>
<html>
<head>
<title>Quiz Views</title>
</head>
<body>
<?php if (isset($_GET['view'])) {
?>
<h1>View Answers for User</h1>
<p>The correct answer field is only valid as long as the answers have not been changed from the quiz page.</p>
<table border="2">
<tr><th>Question #</th>
<th>Answer</th>
<th>Correct</th>
<?php
  $sql = "SELECT * FROM quiz_answers WHERE user_id_fk = " . $conn->real_escape_string($_GET['view']);
  $persons_answers = $conn->query($sql);
  $sql = "SELECT * FROM quiz_questions";
  $questions = $conn->query($sql);
  while ($answer = $persons_answers->fetch_assoc() && $question = $questions->fetch_assoc()) {
?>
<tr>
<td><?php echo $question['qnum']; ?></td>
<td><?php echo $answer['answer']; ?></td>
<td><?php echo $question['answer']; ?></td>
</tr>
<?php } ?>
</table>
<a href="quiz.php">Back to Quiz Page</a>
<?php } else {?>
<h1>Quiz Management</h1>
  <form method="post" action="" name="meh">
<table border="2">
<tr>
<th>Person</th>
<th>Email</th>
<th>Quiz Score</th>
<th>Reset View</th>
<th>Mark Person as Passed</th>
</tr>
<?php while($row = $result->fetch_assoc()) { ?>
<tr>
<td><a href="?view=<?php echo $row['user_id']; ?>"><?php echo $row['fname'] . ' ' . $row['lname']; ?></a></td>
<td><?php echo $row['email'];?></td>
<td><?php echo $row['quizscore'];?></td>
<td>R<input type="checkbox" name="delview[]" value="<?php echo $row['user_id']; ?>"></td>
<td>P<input type="checkbox" name="markpass[]" value="<?php echo $row['user_id']; ?>"></td>
</tr>
<?php } ?>
</table>
<input type="submit" name="resetviews" value="Submit">
</form>
<?php } ?>
<a href="index.php">Home</a>
</body>
</html>
