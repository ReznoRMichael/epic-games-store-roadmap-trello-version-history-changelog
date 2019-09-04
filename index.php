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
    <p>Trello .json file parser written by ReznoR for fun and practice ( <a href="https://github.com/ReznoRMichael" target="_blank">github.com/ReznoRMichael</a> )<br>
    The dates are just last recorded card activity on Trello and can be misleading.<br>
    Program versions (in <b>bold</b>) are direct links to the appropriate card on Trello (opens in a separate tab) — check there for more details.</p>
    <div id="generate">
        <?php require_once("generateVersionHistory.php") ?>
    </div>
</body>
</html>