<?php
// include parent class ApplicationController
require_once 'application_controller.php';

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
    $this->redirect('/images');
  }

  function delete()
  {
    $this->redirect('/images');
  }
}
