<form action="test.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="attachment">
  <button type="submit">Upload</button>
</form>
<?php
if(isset($_FILES)) {
  require_once('./lib/simple_uploader.php');
  $uploader = new SimpleUploader();
  $uploader->store('attachment', $_FILES);
  echo $uploader->getStorePath();
}
?>
