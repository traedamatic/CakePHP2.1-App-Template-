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
      'route' => '/contact',
      'url' => 
      array (
        'controller' => 'pages',
        'action' => 'index',
      ),
    ),
    3 => 
    array (
      'route' => '/test/ttest',
      'url' => 
      array (
        'controller' => 'testttt',
        'action' => 'super',
        'plugin' => 'g',
        0 => 'highggg',
      ),
    ),
  ),
);