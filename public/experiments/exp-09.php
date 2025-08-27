<?php
/**
 * Experiment 9 - retrieve a single record from categories.
 *
 * Project:         php-demo
 * Filename:        exp-06.php
 * Author:          Josef Meyer <https://github.com/jofish920>
 * Date created:    2025-08-13
 * Version:         0.0
 */
ob_start();

require_once __DIR__ . "/../../app/settings.php";

global $base_path, $template_path, $app_path, $app_name;

require_once $app_path . "/databases.php";

global $pdo;

$output = ob_get_clean();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $app_name ?> » Exp 07</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="size-1vh">
    <?php
    require_once $template_path . "/header.php";
    ?>
    <main>
        <header>
            <h2>PAGE HEADER</h2>
        </header>
        <?php
        $errors = [];

        if (! isset($_GET['id'])) {
            $url = $_SERVER['PHP_SELF'] . "?id=<number>";
            $errors[] = "Use: $url";
        }

        if (empty($errors)) {
            $stmt = $pdo->prepare("
                            SELECT id, title, description
                            FROM categories
                            WHERE id = :id
                    ");
            $id = (int)$_GET['id'];
            $stmt->bindParam('id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (! $result) {
                [$sqlErrorCode, $drvErrorCode, $errorText] = $stmt->errorInfo();
                $errors[] = "SQL Error ({$sqlErrorCode}): {$errorText}";
            }
        }

        ?>
        <?php if (empty($errors)): ?>
            <article>
                <h3 class="text-center text-lg">Joke</h3>
                <div class="output-grid p-4 border border-gray-800">
                    <div class="output-label">Category ID:</div>
                    <div class="output-value"><?= htmlspecialchars($result['id']) ?></div>
                    <div class="output-label">Title:</div>
                    <div class="output-value"><?= htmlspecialchars($result['title']) ?></div>
                    <div class="output-label">Description:</div>
                    <div class="output-value"><?= htmlspecialchars($result['description']) ?></div>
                </div>
            </article>
        <?php else: ?>
            <article>
                <h2>Errors Retrieving Joke</h2>
                <?php foreach ($errors as $error): ?>
                    <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </article>
        <?php endif; ?>
    </main>
<?php require_once $template_path . "/footer.php"; ?>
</body>
</html>
