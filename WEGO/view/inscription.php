
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css" />

</head>
<body>
    <div class="main">
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
        <p>deja une compte?</p>
        <a href="../index.php">connection</a>

    </div>
</body>
</html>
