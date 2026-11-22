<?php
$css_activated = $_POST['active-css'] ?? true;
if (isset($_POST['research'])) {
    require_once __DIR__ . '/API.php';

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
    <?php if ($css_activated): ?>
        <link rel="stylesheet" href="./style.css">
    <?php endif ?>
</head>
<body>
    <button id="settings-btn">⚙️</button>
    <div id="settings-div">
        <form method="POST">
            <div>
                <input type="checkbox" name="active-css" <?php if ($css_activated) {echo 'checked';}?>>
                <label for="active-css">Activer le CSS</label>
            </div>
            <div>
                <input type="checkbox" name="test">
                <label for="test">Cette checkbox ne sert à rien</label>
            </div>
            <button type="submit" class="submit-btn">enregistrer</button>
        </form>
    </div>
    <div id="research">
        <h1>Wiki-pied-dia</h1>
        <form method="POST">
            <input type="text" name="research">
            <button type="submit" class="submit-btn">rechercher</button>
        </form>
    </div>
    <?php if (isset($results)): ?>
        <div id="results">
        <?php foreach ($results as $result): ?>
            <article>
                <h2><?= htmlspecialchars($result['title'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= strip_tags($result['snippet'], '<b>') ?></p>
            </article>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>