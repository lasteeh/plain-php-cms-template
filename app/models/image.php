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
    $original_image_name = $this->attributes['name'];

    if ($image_error === UPLOAD_ERR_OK) {
      // successfully uploaded:

      // next, move the uploaded file to the desired directory
      $image_temp_name = $this->attributes['tmp_name'];
      $image_path = $this::UPLOAD_DIRECTORY . $original_image_name;

      // Check if the file already exists in the directory
      $counter = 1;
      $new_filename = $original_image_name; // Initialize new_filename here

      while (file_exists($image_path)) {
        // If the file already exists, append an increment in parentheses
        $info = pathinfo($original_image_name);
        $new_filename = $info['filename'] . " ($counter)." . $info['extension'];
        $image_path = $this::UPLOAD_DIRECTORY . $new_filename;
        $counter++;
      }

      // Update the name attribute with the new filename
      $this->attributes['name'] = $new_filename;

      $this->ensure_directory_exist($this::UPLOAD_DIRECTORY);

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
        return [$this, ['failed to move "' . $original_image_name . '"']];
      }
    } else {
      // error uploading image file:
      return [$this, ['error uploading "' . $original_image_name . '"']];
    }
  }

  public function find_by_name($name)
  {
    $record = $this->find_by('name', $name);

    return $record;
  }

  private function ensure_directory_exist($directory_path)
  {
    if (is_dir($directory_path)) {
      return;
    } else {
      if (mkdir($directory_path, 0777, true)) {
        return;
      } else {
        $this->errors[] = ['Failed to create image uploads directory'];
      }
    }
  }
}
