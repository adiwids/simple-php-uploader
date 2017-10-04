<form action="sample.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="attachment">
  <button type="submit">Upload</button>
</form>
<?php
if(isset($_FILES)) {
  require_once('./lib/simple_uploader.php');
  $uploader = new SimpleUploader();
  $uploader->setUploadDir('./uploads/test/nested/directory/');
  $uploader->store('attachment', $_FILES);
  echo $uploader->getStoredFilePath();
}
?>
