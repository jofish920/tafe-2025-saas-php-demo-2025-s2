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

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Demo Experiment 6</title>
</head>
<body>
    <?php
        require_once __DIR__ . "/../../app/settings.php";
        use \App\Settings;
        global $base_path, $template_path;
        ?>

    <?php require_once $template_path . "/header.php"; ?>
    <main>
        <header>
            <h2>PAGE HEADER</h2>
            <article>
                <h3>Main Body</h3>
                <p>
                    Open up a new bash terminal (or split the current one using
                    <kbd>ALT</kbd>+<kbd>SHIFT</kbd>+<kbd>-</kbd>), then:
                    <code>

                    </code>
                </p>
                <div class="table-ish">
                    <label for="base-path">base_path</label>
                    <span class="value" id="base-path"><?= htmlspecialchars($base_path) ?></span>
                </div>

            </article>
        </header>
    </main>
<?php require_once $template_path . "/footer.php"; ?>
</body>
</html>
