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
      'page_title' => 'Images',
    ];
    $this->render($page_info);
  }

  function new()
  {
    $page_info = [
      'page_title' => 'Upload Image',
    ];
    $this->render($page_info);
  }

  function create()
  {
    var_dump($_FILES);
    echo nl2br(PHP_EOL);
    echo nl2br(PHP_EOL);

    $images_params = $this->images_params($_FILES);

    $images_errors = [];

    foreach ($images_params as $image_params) {
      $image = new Image;
      list($image, $error_messages) = $image->upload($image_params);

      if ($error_messages) {
        $images_errors = array_merge($images_errors, $error_messages);
      }
    }

    var_dump($images_errors);
    echo nl2br(PHP_EOL);
    echo nl2br(PHP_EOL);
    if (empty($images_errors)) {
      // $this->redirect('/images');
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
