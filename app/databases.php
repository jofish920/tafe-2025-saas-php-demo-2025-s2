<?php
/**
 * Databases - provides a database interface object
 *
 * MULTI-LINE DESCRIPTION.
 *
 * Project:         php-demo
 * Filename:        databases.php
 * Author:          Josef Meyer <https://github.com/jofish920>
 * Date created:    2025-08-13
 * Version:         0.0
 */

require_once 'settings.php';

$dbType = $_ENV['DB_TYPE'];
$dbName = $_ENV['DB_NAME'];
$dbHost = $_ENV['DB_HOST'];
$dbPort = $_ENV['DB_PORT'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];

$dbDsn = "$dbType:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dbDsn, $dbUser, $dbPass);
}
catch (PDOException $e) {
    echo "<p><strong>Error:</strong> " . (int)$e->getCode() . " | ";
    echo "Failed to connect to database ($dbName)";
    echo "</p>";
}