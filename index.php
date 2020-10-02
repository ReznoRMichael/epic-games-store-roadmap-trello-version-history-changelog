<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Epic Games Store Version History on a single page</title>
    <meta name="description" content="Epic Games Store Launcher/Web Roadmap Trello JSON PHP parser by ReznoR.">
	<meta name="keywords" content="epic, games, store, web, client, launcher, version, history, changelog, single, page">
	
	<meta property="og:title" content="Epic Games Store Version History on a single page">
	<meta property="og:description" content="Epic Games Store Launcher/Web Roadmap Trello JSON PHP parser by ReznoR.">
	<meta property="og:image" content="http://reznortech.rf.gd/favicon.png">
	<meta property="og:url" content="http://reznortech.rf.gd/epic-games-store-version-history">
	<meta name="twitter:card" content="summary_large_image">
	<meta property="og:site_name" content="rezno[R].tech">
	<meta name="twitter:image:alt" content="Epic Games Store Launcher/Web Roadmap Trello JSON PHP parser by ReznoR.">

	<meta name="author" content="ReznoR Michael">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" href="../favicon.png">
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136831794-2"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-136831794-2');
    </script>
    
</head>
<body>
    
    <h1>Epic Games Store — Version History</h1>

    <p class="smalltext">Changelog for the Epic Games Store Web & Client (Launcher) collected on a Single Page. Updates automatically. If the update will fail, local file will be used instead.<br>
    Source: official <a href="https://trello.com/b/GXLc34hk/epic-games-store-roadmap" target="_blank" rel="noreferrer">Epic Games Trello Roadmap</a>.</p>

    <p class="smalltext">Trello REST API .json file parser written by ReznoR for fun and learning ( <a href="https://github.com/ReznoRMichael/epic-games-store-roadmap-trello-version-history-changelog" target="_blank" rel="noreferrer">GitHub</a> )<br>
    You can support me directly through <a href="https://www.paypal.me/ReznoRMichael" target="_blank" rel="noreferrer">PayPal</a> if you think it's worth it.</p>

    <div style="margin-bottom: 20px;"></div>

    <div id="generate">
        <?php require_once "generateVersionHistory.php"; ?>
    </div>

</body>
</html>