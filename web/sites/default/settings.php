<?php

// @codingStandardsIgnoreFile

$settings['hash_salt'] = '53cr3t!';

$settings["config_sync_directory"] = '../config/default';

if ($_SERVER['SYMFONY_DOCKER_ENV'] && file_exists(__DIR__ . '/settings.symfony.php')) {
  require_once __DIR__ . '/settings.symfony.php';
}

if (file_exists(__DIR__ . '/settings.local.php')) {
  require_once __DIR__ . '/settings.local.php';
}
