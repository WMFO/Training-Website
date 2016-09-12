<?php
include('./includes/session_timeout.inc.php');
if($_SESSION['role'] != "admin") {
  header("Location: index.php");
}
include('./includes/logout.inc.php');
include('./head.inc.php');
if (isset($_POST['upload'])) {
  switch (@$_POST['upload']) {
  case "Upload Show Form":
    $filename = getcwd() . '/includes/show_form.pdf';
    break;
  case "Upload DJ Agreement":
    $filename = './includes/dj_agreement.pdf';
    break;
  case "Upload Image":
    $directory = "./images/";
    $filename = $directory . basename($_FILES['userfile']['name']);
    break;
  default:
    $error = true;
    break;
  }
}
if (isset($filename)) {
  if (file_exists($filename) && $_POST['upload'] == "Upload Image") {
    $error = "Sorry, that file already exists. Please rename it and upload again.";
  } else {
    if($errorno = move_uploaded_file($_FILES['userfile']['tmp_name'], $filename)) {
      $success = "File successfully uploaded";
    } else {
      $success = "Error moving file to target directory #" . $errorno . $filename;
    }
  }
}

?>
<h1>File Upload</h1>
<p>Here is a page for uploading files. The first two will replace the show forms (please upload in pdf format). The last will upload an image for your use. There is no deleting capability, just email Max Goldstein if anything goes too terribly wrong. Please only upload one file at a time, sorry. Success will reveal a message of some sort.</p>
<?php if(@$success) { echo "<p>$success</p>"; }?>
<?php if(@$error) { echo "<p>$error</p>"; }?>
<form enctype="multipart/form-data" action="" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="userfile" type="file" /><br />
    <input type="submit" name="upload" value="Upload Show Form" /><br />
    <input type="submit" name="upload" value="Upload DJ Agreement" /><br />
    <input type="submit" name="upload" value="Upload Image" /> <i>Upload to the ./images. For example, if you upload smile.jpg you can view it with src="images/smile.jpg"<br />
</form>
<?php include('./tail.inc.php'); ?>
