<?php

define('ROUTES', [
  // format:
  // 'url' => [
  // 'HTTP_METHOD' => ['controller' => 'controller@action']
  // ], 

  // pages 
  '/' => [
    'GET' => ['controller' => 'pages@index']  // homepage
  ],
  '/settings' => [
    'GET' => ['controller' => 'pages@settings']
  ],

  // sessions 
  '/login' => [
    'GET' => ['controller' => 'sessions@new'],
    'POST' => ['controller' => 'sessions@create'],
  ],
  '/logout' => [
    'DELETE' => ['controller' => 'sessions@delete'],
  ],

  // images
  '/images' => [
    'GET' => ['controller' => 'images@index'],
    'POST' => ['controller' => 'images@create']
  ],
  '/images/new' => [
    'GET' => ['controller' => 'images@new']
  ],
  '/images/:id' => [
    'GET' => ['controller' => 'images@show']
  ],
  '/images/:id/edit' => [
    'GET' => ['controller' => 'images@edit']
  ],
  '/images/:id' => [
    'PATCH' => ['controller' => 'images@update']
  ],
  '/images/:id/delete' => [
    'DELETE' => ['controller' => 'images@delete']
  ],
]);
