<?php
// include parent class ApplicationRecord
require_once 'application_record.php';

class Image extends ApplicationRecord
{
  const UPLOAD_DIRECTORY = ROOT_PATH . '/public/uploads/images/';

  public function upload($image_params)
  {
    $this->attributes = $image_params;

    // first, check if the image was successfully uploaded
    $image_error = $this->attributes['error'];
    $image_name = $this->attributes['name'];

    if ($image_error === UPLOAD_ERR_OK) {
      // successfully uploaded:

      // next, move the uploaded file to desired directory
      $image_temp_name = $this->attributes['tmp_name'];
      $image_path = $this::UPLOAD_DIRECTORY . $image_name;
      if (move_uploaded_file($image_temp_name, $image_path)) {
        // successfully moved uploaded file to desired directory:

        // then, save image details to db
        $this->attributes['path'] = $image_path;

        // remove 'tmp_name' and 'error' attributes if they exist
        unset($this->attributes['tmp_name']);
        unset($this->attributes['error']);

        if ($this->save()) {
          // details saved to db:
          return [$this, null];
        } else {
          // failed to save to db:
          unlink($image_path);
          $error_messages = $this->errors;
          return [$this, $error_messages];
        }
      } else {
        // failed to move uploaded file:
        return [$this, ['failed to move "' . $image_name . '"']];
      }
    } else {
      // error uploading image file:
      return [$this, ['error uploading "' . $image_name . '"']];
    }
  }
}
