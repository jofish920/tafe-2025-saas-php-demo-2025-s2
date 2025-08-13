<?php

$base_path = realpath(__DIR__."/../");
$app_path = $base_path . "/app";
$resource_path = $base_path . "/resources";
$template_path = $resource_path . "/templates";

require_once $base_path."/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($base_path);
$dotenv->load();

$app_name = $_ENV['APP_NAME'];


