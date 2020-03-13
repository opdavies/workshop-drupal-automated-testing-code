<?php

// @codingStandardsIgnoreFile

$settings['hash_salt'] = '53cr3t!';

$settings["config_sync_directory"] = '../config';

if (file_exists(__DIR__ . '/settings.local.php')) {
  require_once __DIR__ . '/settings.local.php';
}

// Automatically generated include for settings managed by ddev.
if (file_exists($app_root . '/' . $site_path . '/settings.ddev.php') && getenv('IS_DDEV_PROJECT') == 'true') {
  include $app_root . '/' . $site_path . '/settings.ddev.php';
}
