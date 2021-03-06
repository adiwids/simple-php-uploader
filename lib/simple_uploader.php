<?php
class SimpleUploader {
  const PERMISSION_MODE = 0775;
  const UPLOAD_ROOT_DIR = 'uploads';

  public static function getRootPath() {
    return realpath('./');
  }

  private $attributes = [
    'uploadDir' => NULL,
    'filename' => NULL
  ];

  public function __construct() {
    $this->setUploadDir( implode(DIRECTORY_SEPARATOR, [static::getRootPath(), self::UPLOAD_ROOT_DIR]) );
  }

  public function setUploadDir($path) {
    if(substr($path, -1) == '/') {
      $path = substr($path, 0, (strlen($path) - 1));
    }
    $this->setAttribute('uploadDir', $path);
    if( !file_exists($this->getAttribute('uploadDir')) ) {
      return mkdir($this->getAttribute('uploadDir'), self::PERMISSION_MODE, true);
    }
    return file_exists($this->getAttribute('uploadDir'));
  }

  public function setAttribute($attr_name, $value) {
    $this->attributes[$attr_name] = $value;
  }

  public function getAttribute($attr_name) {
    return $this->attributes[$attr_name];
  }

  public function store($field, $multipart_data) {
    if(!array_key_exists($field, $multipart_data)) {
      throw new Exception("Undefined index '".$field."' on multipart/data parameter.");
    }
    $this->setAttribute('filename', $multipart_data[$field]['name']);
    @move_uploaded_file($multipart_data[$field]['tmp_name'], $this->getStoredFilePath());
  }

  public function getStoredFilePath() {
    return implode(DIRECTORY_SEPARATOR, [$this->getAttribute('uploadDir'), $this->getAttribute('filename')]);
  }
}
?>

