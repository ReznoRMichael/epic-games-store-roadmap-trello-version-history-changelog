<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Epic Games Store Roadmap Trello PHP Parser (Version History / Changelog)</title>
</head>
<body>
    <h1>Epic Games Store Roadmap — Version History / Changelog</h1>
    <p class="smalltext">Trello .json file parser written by ReznoR for fun and learning ( <a href="https://github.com/ReznoRMichael" target="_blank">github.com/ReznoRMichael</a> )<br>
    You can support me directly through <a href="https://www.paypal.me/ReznoRMichael" target="_blank">PayPal</a> if you think it's worth it.</p>
    <div style="margin-bottom: 20px;"></div>
    <div id="generate">
        <?php require_once("generateVersionHistory.php") ?>
    </div>
</body>
</html>