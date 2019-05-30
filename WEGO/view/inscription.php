<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css" />
	<link rel="icon" href="../style/logo.ico" type="image/x-icon">
	<link rel="shortcut icon" href="../style/logo.ico" type="image/x-icon">
</head>
<body>
    <div class="main">
	<a href = "../view/v_accuille.php"><img class = "smallImage" src = "../style/logoWego.jpg"/></a>
        <h1>Inscription </h1>
        <form  method="post" action="../control/c_inscription.php">
            Nom:<br>
            <input type="text" name="nom" >
            <br>
			 Mail:<br>
            <input type="text" name="mail" >
            <br>
            Mot de passe:<br>
            <input type="password" name="password" >
            <br>
            Verifier:<br>
            <input type="password" name="password2" >
            <br>
            <br>
            <input type="submit" value="s'inscrir" name = "btnCommande">
        </form>
        <p>Deja une compte?</p>
        <a href="../index.php">connection</a>

    </div>
</body>
</html>