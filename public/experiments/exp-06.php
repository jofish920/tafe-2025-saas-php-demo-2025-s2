<?php
/**
 * Experiment 06
 *
 * Author:          Adrian Gould <https://github.com/AdyGCode>
 * Date created:    2025-08-13
 *
 */

/*
 * include          insert the contents of the named file
 *                  missing files are 'ignored' (warning)
 *                  will insert the file multiple times
 *
 * require          insert the contents of the named file
 *                  missing files give an error
 *                  will insert the file multiple times
 *
 * include_once     as per include, BUT file inserted ONE TIME ONLY
 *
 * require_once     as per require, BUT file inserted ONE TIME ONLY
 */

require_once __DIR__ . "/../../app/settings.php";
?>
<!doctype html>
<html lang="en_AU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $_ENV["APP_NAME"]; ?></title>
</head>
<body>
<?php
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
    <p>
        Create the folders and files needed using Bash...
    </p>

    <p>
        Open a new Bash terminal (or split the current
        one <kbd>ALT</kbd>+<kbd>SHIFT</kbd>+<kbd>-</kbd>)
    </p>

    <pre><code>
    cd php-demo-2025-s2/
    mkdir -p resources/templates
    touch {resources,resources/templates}/.gitignore
    touch resources/templates/{header,footer}.php
    </code></pre>
        </section>
    </article>
</main>
<?php
require_once $base_path . "/resources/templates/footer.php";
?>
</body>
</html>
