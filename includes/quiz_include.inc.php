<?php 
$sql = "SELECT * FROM attendance WHERE user_id = " . $_SESSION['user_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$numattends = 0;
for ($i = 1; $i<4; $i++) {
  if ($row[$i . '_attend'] == true) {
    $numattends++;
  }
}
if($_SESSION['quizscore'] >= 0) {
  $complete = true;
  $percentage = $_SESSION['quizscore'];
}
if(@$complete) {
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
<?php } 
} elseif($numattends > 1) {?>
<h3>Congratulations</h3>
  <p>Our records indicate that you have successfully completed our studio training process!<p>
<p>Before you can proceed, you'll have to take a quiz. There are a few important guidelines to read before you take the quiz. Observe:</p>
<ul>
<li>You may only view/take this quiz once. Please do not reload or leave the page once you view the questions as you will not be allowed back into the system.</li>
<li>The quiz is a fairly straight forward multiple choice/short answer format. You may use any resources to fill out the quiz, but please do it alone and don't cheat. This is to make sure you know the information or know where to find the necessary information.</li>
<li>If you fail or fail to complete the quiz, you'll be required to come to a remedial training session. You will be contacted with details.</li>
<li>Please take this quiz within 24 hours after your last training session. If you fail to fill this out within this reasonable window, you'll jeopardize your ability to get a show.</li>
</ul>
<p>Thanks! If you pass, please follow the instructions on the presented page. </p>
<p><a href="quiz.php">I've read the information above and I'm ready to proceed.</a></p>
<?php } ?>

