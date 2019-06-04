<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Connection</title>
	<link rel="stylesheet" type="text/css" href="style/styleIndex.css" />
	<link rel="icon" href="../style/logo.ico" type="image/x-icon">
	<link rel="shortcut icon" href="../style/logo.ico" type="image/x-icon">
</head>
<body>
    <div class="main">
	<a href = "../view/v_accuille.php"><img class = "smallImage" src = "../style/logoWego.jpg"/></a>
        <h1>Connection </h1>
        <form  method="post" action="control/c_connection.php">
            Login:<br/>
            <input type="text" name="login" placeholder  = 'user nom ou mail' >
            <br/>
            Mot de passe:<br>
            <input type="password" name="password" >
            <br>
            <br>
            <input type="submit" value="connecter" name = "btnConnecter">
        </form>
        <p>Pas de compte?</p>
        <a href="view/inscription.php">Inscription</a>
		
		<p>Ou visiter sans compte</p>
		<a href="view/v_accuille.php">Accueille</a>
    </div>
</body>
</html>