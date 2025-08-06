<?php
/**
 * Experiment 05 - Settings reading file
 *
 * Author:          Adrian Gould <https://github.com/AdyGCode>
 * Date created:    2025-08-06
 *
 */

/*
 * Set the base path to be one folder above this folder
 *
 * realpath computes the path
 *  - c:\users\USERNAME\source\repos\APP_NAME\app\..
 * becomes
 *  - c:\users\USERNAME\source\repos\APP_NAME
 */
$base_path = realpath(__DIR__."/../");
echo "<p>" .  $base_path ."</p>";

/*
 * include the autoload file that will add the
 * vlucas/phpdotenv composer package's classes to the
 * running application
 */
require_once $base_path."/vendor/autoload.php";

/*
 * make the Dotenv classes available
 */
use Dotenv\Dotenv;

/*
 * Create an immutable (unable to be altered) Dotenv object
 * and load the contents of the .env file contained at the base path
 */
$dotenv = Dotenv::createImmutable($base_path);
$dotenv->load();

echo "<p>Settings file has been included</p>";


$x = $_ENV["APP_NAME"];
echo "App name: ".$x;
