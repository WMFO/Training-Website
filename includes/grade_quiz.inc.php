<?php
$numtotal = $result->num_rows;
$numcorrect = 0;
$sql = "DELETE FROM quiz_answers WHERE user_id_fk = ?";
$stmt = $conn->stmt_init();
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
while ($row = $result->fetch_assoc()) {
  $$row['post_name'] = $_POST[$row['post_name']];
  $sql = "INSERT INTO quiz_answers (user_id_fk, qnum_fk, answer) VALUES (?,?,?)";
  $stmt = $conn->stmt_init();
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('iis', $_SESSION['user_id'], $row['qnum'], $$row['post_name']);
  $stmt->execute();
  $correct = strtoupper($row['answer']);
  $theirs = strtoupper($$row['post_name']);
  if ($correct == $theirs) {
    $numcorrect++;
  }
}
$_SESSION['quizscore'] = $numcorrect/$numtotal*100;
$sql = "UPDATE users SET quizscore = " . $_SESSION['quizscore'] . " WHERE user_id = " . $_SESSION['user_id'];
$conn->query($sql);
