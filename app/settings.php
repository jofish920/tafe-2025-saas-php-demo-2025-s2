<?php

namespace App\Settings;

$base_path = realpath(__DIR__."/../");
$resource_path = $base_path . "/resources";
$template_path = $resource_path . "/templates";

require_once $base_path."/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($base_path);
$dotenv->load();
