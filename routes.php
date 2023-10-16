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

  // sessions 
  '/login' => [
    'GET' => ['controller' => 'sessions@new'],
    'POST' => ['controller' => 'sessions@create'],
  ],
  '/logout' => [
    'GET' => ['controller' => 'sessions@delete'],
  ],

  // users
  '/signup' => [
    'GET' => ['controller' => 'users@new'],
    'POST' => ['controller' => 'users@create'],
  ],

  // images
  '/images' => [
    'GET' => ['controller' => 'images@index'],
    'POST' => ['controller' => 'images@create']
  ],
  '/images/new' => [
    'GET' => ['controller' => 'images@new'],
  ],
  '/images/:id' => [
    'GET' => ['controller' => 'images@show'],
    'PATCH' => ['controller' => 'images@update'],
    'DELETE' => ['controller' => 'images@delete'],
  ],
  '/images/:id/edit' => [
    'GET' => ['controller' => 'images@edit'],
  ],
]);
