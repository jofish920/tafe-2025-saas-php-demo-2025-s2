<?php
/**
 * Experiment 8 - jokes app (view).
 *
 * Project:         php-demo
 * Filename:        exp-08-view.php
 * Author:          Josef Meyer <https://github.com/jofish920>
 * Date created:    2025-08-27
 * Version:         0.1
 */
global $base_path, $template_path, $app_path, $app_name, $pdo;
global $isNewJoke, $errors, $title, $description, $csrf, $rowsUpdated;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title><?= $app_name ?> » Exp 08</title>
</head>
<body>
    <?php
    require_once $template_path . "/header.php";
    ?>
    <header>
        <h2 class="text-center w-full text-2xl font-bold">Jokes</h2>
    </header>

    <main>
        <?php if ($isNewJoke): ?>
        <section class="m-4 p-4 border border-green-500">
            <h3 class="text-lg font-bold">Submitted Joke</h3>
            <hr class="mt-3">
            <div class="output-grid">
                <div class="output-label">Title</div>
                <div class="output-value"><?= htmlspecialchars($title ?? '') ?></div>
                <div class="output-label">Description</div>
                <div><?= htmlspecialchars($description ?? '') ?></div>
                <div class="output-label">CSRF</div>
                <div><?= htmlspecialchars($csrf ?? '') ?></div>
                <div class="output-label">Rows Updated</div>
                <div><?= $rowsUpdated ?></div>
            </div>
            <?php if (isset($errors['sql'])): ?>
                <p class="error mt-2"><?= htmlspecialchars($errors['sql']) ?></p>
            <?php endif; ?>
        </section>
        <?php endif; ?>

        <section class="border border-green-500 p-4 m-4">
            <h3 class="text-lg font-bold">Create Joke</h3>
            <hr>
            <!--            form[id=NewJoke,method=POST,action=exp-08.php] -->
            <form
                    method="POST"
                    action="#"
                    id="NewJoke"
                    class="flex flex-col"
            >
                <input type="hidden" name="csrf" value="<?= random_int(1000, 9999) ?>">
                <label for="Title" class="mt-4">
                    <span class="text-sm font-medium text-gray-700"> Title </span>

                    <input
                            type="text"
                            id="Title"
                            name="title"
                            placeholder="Joke title<?= rangeText(TITLE_RANGE) ?>"
                            class="mt-0.5 w-full
                                rounded border-gray-300 shadow-sm
                                sm:text-sm"
                            value="<?= htmlspecialchars($title ?? '') ?>"
                    />
                </label>
                <?php if (isset($errors['title'])): ?>
                <p class="error"><?= htmlspecialchars($errors['title']) ?></p>
                <?php endif; ?>
                <label for="Description" class="mt-4">
                    <span class="text-sm font-medium text-gray-700"> Description </span>

                    <textarea
                            id="Description"
                            name="description"
                            class="mt-0.5 w-full resize-none rounded border-gray-300 shadow-sm sm:text-sm"
                            placeholder="Content of joke<?= rangeText(DESCRIPTION_RANGE) ?>"
                            rows="4"
                    ><?= htmlspecialchars($description ?? '') ?></textarea>
                </label>
                <?php if (isset($errors['title'])): ?>
                    <p class="error"><?= htmlspecialchars($errors['title']) ?></p>
                <?php endif; ?>
                <div class="flex justify-between">
                    <?php if (isset($_POST['id'])): ?>
                        <button
                            type="submit"
                            name="operation"
                            class="inline-block rounded-sm border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:ring-3 focus:outline-hidden"
                            value="update"
                        >Update</button>
                    <?php endif; ?>
                    <button
                            type="submit"
                            name="operation"
                            class="inline-block rounded-sm border border-indigo-600 bg-indigo-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-indigo-600 focus:ring-3 focus:outline-hidden"
                            value="create"
                    >Create</button>
                </div>

            </form>
        </section>
    </main>
<?php require_once $template_path . "/footer.php"; ?>
</body>
</html>
