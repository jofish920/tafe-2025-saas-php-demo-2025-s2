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

$id = -1;

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
    $operation = $_POST['operation'];
    $id = $_POST['id'];
}

$isNewJoke = !empty($title) || !empty($description);

$output = ob_get_clean();

$rowsUpdated = 0;

$errors = [];

class SQLUpdateResult {
}

class SQLUpdateResultOK extends SQLUpdateResult {
    public string $recordId;

    function __construct($id)
    {
        $this->recordId = $id;
    }
}

class SQLUpdateResultError extends SQLUpdateResult {
    public int $code;
    public string $message;

    public string $sql;

    function __construct(string $sql, PDOException $error)
    {
        $this->sql = $sql;
        $this->code = $error->getCode();
        $this->message = $error->getMessage();
    }
}

function handleSqlError(string $sql, PDOException $error): SQLUpdateResultError {
    global $errors;

    $errorCode = $error->getCode();
    $errorMessage = $error->getMessage();
    $errors['sql'] = "SQL Error ($errorCode): $errorMessage";
    $errors['sql-text'] = $sql;

    return new SQLUpdateResultError($sql, $error);
}

function doInsert($title, $description): SQLUpdateResult {
    global $pdo;

    $sql = "
            INSERT INTO categories (title, description) 
            VALUES (:title, :description)
            ";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->execute(); // throws on error

        if ($stmt->rowCount() == 0) {
            die("Insert succeeded but no rows updated.");
        }

        $sql = "SELECT LAST_INSERT_ID()";
        $stmt = $pdo->query($sql);
        $stmt->execute();

        return new SQLUpdateResultOK($stmt->fetchColumn());
    }
    catch (PDOException $error) {
        return handleSqlError($sql, $error);
    }
}

function doUpdate($id, $title, $description): SQLUpdateResult
{
    global $pdo;

    $sql = "
        UPDATE categories
        SET title = :title, description = :description
        WHERE id = :id
        ";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description
        ]);
        return new SQLUpdateResultOK($id);
    }
    catch (PDOException $error) {
        return handleSqlError($sql, $error);
    }
}

if ($isNewJoke) {
    checkLength($errors, 'title', $title, TITLE_RANGE);
    checkLength($errors, 'description', $description, DESCRIPTION_RANGE);

    if (empty($errors)) {
        switch ($operation) {
            case "insert":
                $result = doInsert($title, $description);
                break;
            case 'update':
                $result = doUpdate($id, $title, $description);
                break;
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
