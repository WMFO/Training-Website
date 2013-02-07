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
<h2>New DJ Instructions From the PD</h2>
<p>
Hello New DJs!</p>

<p>Attached you will find the DJ agreement and show scheduling forms.  Every DJ needs to fill out a DJ Agreement form. You only need one show form per show (So a show with 3 DJs needs to submit one show form with 3 DJ agreements attached).</p>

<p>Some important things to keep in mind:</p>

<p>1)      When filling out the forms, please make sure you:<br>
a.      Use the forms available on this website (found below).<br>
b.      Fill out the forms correctly and completely.  That means circling the times you want (and circling the right amount) and writing them down correctly on the form.  For example, don’t circle 4-5 AM and then say you want 4-5 PM.  <br>
c.   Staple all forms together.</p>
<p>
2)      Access List/ID Cards:<br>
a.       For Students:  Immediately after scheduling, you will be added to the access list. Your student ID should get you into the station within a couple of days after that.<br>
b.      For Community Volunteers and Alums:  You will also be added to the access list immediately after scheduling, but you must pick up your IDs from Public Safety on Boston Ave during business hours.  Those are Monday - Friday from 9 AM - 5 PM.  In addition, you must use your ID the day you get it on both the RFID reader on the door to Curtis Hall (even if it’s unlocked) and on the swipe readers.  If you don’t, you will probably lose access in 24 hours.<br>
c.       For Everyone:  If you don’t use your ID on one of the types of readers for a month, your card will deactivate for that reader. So, even if the door to Curtis Hall is always unlocked, tap it every once in a while. You don’t want to go in that one day where the building is locked, there’s no one upstairs, and you have to walk to TUPD to get access to the building.</p>

<p>You'll need to fill out show forms and place those in the manilla envelope on the door next to Brown and Brew before <?php 
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
<p>Unfortunately, your score on the test was not good enough to pass! You'll have to attend a remedial training session. If it's before the deadline on the right, expect an email from the training coordinator shortly.</p>
<?php } 
} elseif($numattends > 1 && isset($_GET['quizr'])) {
 echo "<h3>Oops</h3><p>You appear to have screwed up and not followed instructions. Please contact training@wmfo.org.</p>"; 
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

