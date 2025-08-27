<?php
/**
 * Experiment 8 - jokes app.
 *
 * Project:         php-demo
 * Filename:        exp-08.php
 * Author:          Josef Meyer <https://github.com/jofish920>
 * Date created:    2025-08-27
 * Version:         0.0
 */
ob_start();

require_once __DIR__ . "/../../app/settings.php";

global $base_path, $template_path, $app_path, $app_name;

require_once $app_path . "/databases.php";

global $pdo;

/** The title of the joke. */
$title = '';

/**The joke's content. */
$description = '';

/** Cross-site request forgery check. */
$csrf = '';

if (isset($_POST)) {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $csrf = $_POST['csrf'] ?? '';
}

$isNewJoke = !empty($title) || !empty($description);

$output = ob_get_clean();

$rowsUpdated = 0;

$errors = [];

if ($isNewJoke) {
    checkLength($errors, 'title', $title, TITLE_RANGE);
    checkLength($errors, 'description', $description, DESCRIPTION_RANGE);

    if (empty($errors)) {
        $sqlInsert = "
            INSERT INTO categories (title, description) 
            VALUES (:title, :description)
            ";
        try {
            $stmtInsertJoke = $pdo->prepare($sqlInsert);
            $stmtInsertJoke->bindParam(':title', $title, PDO::PARAM_STR);
            $stmtInsertJoke->bindParam(':description', $description, PDO::PARAM_STR);
            $stmtInsertJoke->execute(); // throws on error
            $rowsUpdated = $stmtInsertJoke->rowCount();
        }
        catch (PDOException $error) {
            $errorCode = $error->getCode();
            $errorMessage = $error->getMessage();
            $errors['sql'] = "SQL Error ($errorCode): $errorMessage";
        }

    }
}

function rangeText($range): string
{
    [$min, $max] = $range;
    if ($min === 0 && $max === INF)
    {
        return '';
    }
    if ($min === 0)
    {
        return "(up to $max characters)";
    }
    if ($max == INF) {
        return "(at least $min characters)";
    }
    return "(between $min and $max characters)";
}

require_once "./exp-08-view.php";
