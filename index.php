<?php
if (isset($_POST['research'])) {
    require_once __DIR__ . 'API.php';

    $research = $_POST['research'];

    $lang = 'fr';

    $api = new API();
    $results = $api->request($research, $lang);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki-pied-dia</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div id="research">
        <h1>Wiki-pied-dia</h1>
        <form action="POST">
            <input type="text" name="research">
            <button type="submit">rechercher</button>
        </form>
    </div>
    <?php if (isset($results)): ?>
        <div id="results">
        <?foreach ($results as $result): ?>
            <article>
                <?= $result ?>
            </article>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>