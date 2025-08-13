<?php
/**
 * Experiment 07
 *
 * This is a duplicated copy of Experiment 06,
 * modified to work with a Database
 *
 * Author:          Adrian Gould <https://github.com/AdyGCode>
 * Date created:    2025-08-13
 *
 */

global $pdo, $base_path; // hmmmmm

require_once __DIR__ . "/../../app/settings.php";

require_once $base_path . "/app/database.php";

$sql = "SELECT * FROM categories;";

$statement = $pdo->query($sql);
$resultCode = $statement->execute();

//var_dump($resultCode);
//var_dump($statement->fetch());
//var_dump($statement->fetchAll(PDO::FETCH_OBJ));

$categories = $statement->fetchAll(PDO::FETCH_OBJ);
$rowCount = $statement->rowCount();
?>
<!doctype html>
<html lang="en_AU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $_ENV["APP_NAME"]; ?> » Exp 07 </title>
</head>
<body>
<?php
// Read the header from the templates
require_once $base_path . "/resources/templates/header.php";
?>
<main>
    <header>
        <h2> PAGE HEADER </h2>
    </header>

    <article>
        <header>
            <h3>Main body</h3>
        </header>
        <section>
            table>(thead>tr>th*3)+(tbody>tr>td*3)+(tfoot>tr>td)
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category->id ?></td>
                        <td><?= $category->title ?></td>
                        <td><?= $category->description ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">
                        Total Rows: <?= $rowCount ?>
                    </td>
                </tr>
                </tfoot>
            </table>
        </section>
    </article>
</main>
<?php
require_once $base_path . "/resources/templates/footer.php";
?>
</body>
</html>
