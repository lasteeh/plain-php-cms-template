<?php
// include parent class ApplicationController
require_once 'application_controller.php';

// require Image model
require_once './app/models/image.php';

class ImagesController extends ApplicationController
{
  function index()
  {
    $page_info = [
      'page_layout' => 'dashboard',
      'page_title' => 'Images',
    ];
    $this->render($page_info);
  }

  function new()
  {
    $page_info = [
      'page_layout' => 'dashboard',
      'page_title' => 'Upload Image',
    ];
    $this->render($page_info);
  }

  function create()
  {
    $images_params = $this->images_params($_FILES);

    $error_messages = [];

    foreach ($images_params as $image_params) {
      $image = new Image;
      list($image, $image_error_messages) = $image->upload($image_params);

      if ($image_error_messages) {
        $error_messages = array_merge($error_messages, $image_error_messages);
      }
    }

    if ($error_messages) {
      var_dump($error_messages);
    } else {
      $this->redirect('/images');
    }
  }

  function delete()
  {
    $this->redirect('/images');
  }

  private function images_params($user_input)
  {
    $files = $user_input['images'];

    if (is_array($files['name'])) {
      $images_params = [];

      foreach ($files['name'] as $i => $name) {
        if (isset($files['name'][$i])) {
          $images_params[] = [
            'name' => $name,
            'path' => $files['full_path'][$i],
            'type' => $files['type'][$i],
            'size' => $files['size'][$i],
            'tmp_name' => $files['tmp_name'][$i],
            'error' => $files['error'][$i],
          ];
        }
      }
    }

    return $images_params;
  }
}
