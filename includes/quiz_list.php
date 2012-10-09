<?php
$sql = "SELECT * FROM (
  SELECT *
  FROM quiz_answers
  JOIN quiz_questions ON qnum_fk = qnum
  WHERE user_id = ?
  ORDER BY id DESC LIMIT ?;
) ORDER BY qnum ASC"
