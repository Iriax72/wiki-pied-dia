<?php
$css_activated = $_SERVER['REQUEST_METHOD'] === 'POST'
    ? isset($_POST['active-css'])
    : true;
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
    <link rel="shortcut icon" href="./assets/pied.png" type="image/png">
    <script src="./script.js" defer></script>
</head>
<body>
    <button id="settings-btn">⚙️</button>
    <div id="settings-div" class="hidden container">
        <form method="POST">
            <div>
                <input type="checkbox" id="active-css" name="active-css" <?php if ($css_activated) {echo 'checked';}?>>
                <label for="active-css">Activer le CSS</label>
            </div>
            <div>
                <input type="checkbox" name="test" id="test">
                <label for="test">Cette checkbox ne sert à rien</label>
            </div>
            <button type="submit" class="submit-btn">enregistrer</button>
        </form>
    </div>
    <div id="research" class="container">
        <div class="page-title">
            <h1>Wiki-pied-dia</h1>
            <img src="./assets/pied.png" alt="logo (pied)">
        </div>
        <form method="POST" class="container">
            <?php if ($css_activated): ?>
                <input type="hidden" name="active-css" value="1">
            <?php endif ?>
            <input type="text" name="research" id="research-input" value="<?= $research ?? '' ?>">
            <button type="submit" class="submit-btn" id="research-btn">rechercher</button>
        </form>
    </div>
    <?php if (isset($results)): ?>
        <div id="results" class="container">
        <?php foreach ($results as $result): ?>
            <?php $title = $result['title']; ?>
            <a href="https://<?= $lang ?>.wikipedia.org/wiki/<?= urldecode($title) ?>">
                <h2><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= strip_tags($result['snippet'], '<b>') ?></p>
            </a>
        <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>