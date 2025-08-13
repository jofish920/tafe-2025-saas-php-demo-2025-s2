<?php
/**
 * Experiment 6 - including files.
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
</head>
<body>
    <?php
    require_once $template_path . "/header.php";
    ?>
    <main>
        <header>
            <h2>PAGE HEADER</h2>
        </header>
        <?php
        if (! empty($output))
        {
        echo "<article>";
            echo "<h3>Errors</h3>";
            echo $output;
            echo "</article>";
        }
        ?>
        <?php
            $sql = "SELECT * FROM categories";
            $stmt = $pdo->query($sql);
            $resultCode = $stmt->execute();
            // $count = $stmt->rowCount();
            $categories = $stmt->fetchAll(PDO::FETCH_OBJ);
        ?>
        <article>
            <h3>Main Body</h3>
            <p>
                Open up a new bash terminal (or split the current one using
                <kbd>ALT</kbd>+<kbd>SHIFT</kbd>+<kbd>-</kbd>), then:
            <pre><code>
cd php-demo-2025-s2/
mkdir -p resources/templates
touch {resources,resources/templates}/.gitignore
touch resources/templates/{header,footer}.php
</code></pre>
                <div class="table-ish">
                    <label for="base-path">base_path</label>
                    <span class="value" id="base-path"><?= htmlspecialchars($base_path) ?></span>
                </div>
            </p>
        </article>
        <article>
            <h3>Database 1</h3>
            <?php // table>(thead>tr>th*3)+(tbody>tr>td*3)+(tfoot>tr>td) ?>
            <table class="border-collapse">
                <thead>
                <tr>
                    <th scope="col" class="border-blue-100">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category) { ?>
                <tr>
                    <td><?= htmlspecialchars($category->id) ?></td>
                    <td><?= htmlspecialchars($category->title) ?></td>
                    <td><?= htmlspecialchars($category->description) ?></td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">
                        Total rows: <?= count($categories) ?>
                    </td>
                </tr>
                </tfoot>
            </table>
        </article>
    </main>
<?php require_once $template_path . "/footer.php"; ?>
</body>
</html>
