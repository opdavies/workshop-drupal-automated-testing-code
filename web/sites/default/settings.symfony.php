<?php

$databases['default']['default'] = [
  'driver' => $_SERVER['DATABASE_DRIVER'],
  'host' => $_SERVER['DATABASE_HOST'],
  'database' => $_SERVER['DATABASE_NAME'],
  'username' => $_SERVER['DATABASE_USER'],
  'password' => $_SERVER['DATABASE_PASSWORD'],
  'port' => $_SERVER['DATABASE_PORT'],
  'prefix' => '',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'collation' => 'utf8mb4_general_ci',
];
