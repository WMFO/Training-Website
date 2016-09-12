<?php 
session_start();
include('./includes/logout.inc.php');
include('./head.inc.php');?>
<h1>About the Training Education Management System</h1>
<p>The WMFO Training Education Management System is a platform constructed by Nicholas Andre in the Summer of 2012 and first used during the Fall 2012 training at WMFO. The goals of the project were to consolidate the infrastructure of training to a central location, consolidate training related functions, and to promote an overall higher quality and better training experience.</p> 
<p>The system is designed to be managed by personel with no knowledge of the underlying codebase. All administrative functions can be performed without access to the underlying architecture, providing a more stable and reusable platform.</p>
<p>The system was also designed with a prudent level of security in mind, storing passwords in a safe way without the original password. The system also requires long passwords to ensure that everyone's account is secure.</p>
<p>The WMFO training site is begrudgingly supported by Nicholas. There is a moderate level of documentation provided to WMFO Executive Board members on the Wiki, and the code is all open source and available for viewing on GitHub.</p>
<p>Unfortunately, the platform (being a custom PHP web application) does not have a tremendous amount of inherent flexibility. The best of luck is wished upon those who will try to modify the code in the future.</p>
<font color="grey"><i>&copy;<?php echo date("Y");?> Nicholas Andre </i></font>
<?php include('./tail.inc.php'); ?>
