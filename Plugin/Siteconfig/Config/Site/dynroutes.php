<?php
$config = array (
  'Siteroutes' => 
  array (
    0 => 
    array (
      'route' => '/',
      'url' => 
      array (
        'controller' => 'pages',
        'action' => 'view',
        0 => 'index',
      ),
    ),
    1 => 
    array (
      'route' => '/impressum',
      'url' => 
      array (
        'controller' => 'pages',
        'action' => 'imprint',
      ),
    ),
    2 => 
    array (
      'route' => '/',
      'url' => 
      array (
        'controller' => 'contact',
        'action' => 'form',
      ),
    ),
  ),
);