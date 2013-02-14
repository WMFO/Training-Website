<?php 
if($_SESSION['quizscore'] >= 0) {
  $complete = true;
  $percentage = $_SESSION['quizscore'];
}
if(@$complete) {
  if($percentage >= $setting['min_quiz_grade']) { 
    $sql = "SELECT body FROM cmstext WHERE name = 'RegSuccess'";
    $words = $conn->query($sql);
    $body = $words->fetch_assoc();
echo $body['body'];
echo strftime( "%A %b %e at %l:%M %P", $setting['forms_due']);?>.</p>
<p>If you have any questions about scheduling, please email pd@wmfo.org.</p>

<p>All the best,<br>
Your WMFO Programming Director!</p>
</p>
<ol>
<li><a href="./includes/dj_agreement.pdf">DJ Contract</a></li>
<li><a href="./includes/show_form.pdf">Show Forms</a></li>
</ol>
<br>
<p><i>For Reference:</i></p>
<?php } else { ?>
<h1>Oh no!</h1>
<p>Unfortunately, your score on the test was not good enough to pass! You'll have to attend a remedial training session with the master of training ceremonies. If it's before the deadline on the right, expect an email from the training coordinator shortly.</p>
<?php } 
} elseif($numattends > 1 && isset($_GET['quizr'])) {
 echo "<h3>Well Fiddlesticks</h3><p>Our records indicate that you already viewed the quiz once. To enhance security, only one view of the quiz is allowed per trainee (you're supposed to take it the first time you load the page. Please contact training@wmfo.org and explain that you screwed up and need your quiz view reset.</p>"; 
} elseif($numattends > 1) {?>
<h3>Congratulations</h3>
<table id="myTable" border="2">
<tr><td>
  <p>Our records indicate that you have successfully completed our studio training process!<p>
<p>Before you can proceed, you'll have to take a quiz. There are a few important guidelines to read before you take the quiz. Observe:</p>
<ul>
<li>You may only view/take this quiz once. Please do not reload or leave the page once you view the questions as you will not be allowed back into the system.</li>
<li>The quiz is a fairly straight forward multiple choice/short answer format. You may use any resources to fill out the quiz, but please do it alone and don't cheat. This is to make sure you know the information or know where to find the necessary information.</li>
<li>If you fail the quiz, you'll be required to come to a remedial training session. You will be contacted with details.</li>
<li>Please take this quiz before the required date on the right sidebar. If you fail to do this, you will not receive credit for training.</li>
</ul>
<p>Thanks! If you pass, please follow the instructions on the presented page. </p>
<p><a href="quiz.php">I've read the information above and I'm ready to proceed.</a></p>
</td></tr></table>
<?php } ?>

