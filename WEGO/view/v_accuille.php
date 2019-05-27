<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accuille</title>
<link rel="stylesheet" type="text/css" href="../style/style.css" />


</head>
<body>
    <div class="map">
        <h1>Connection </h1>
        <canvas> map </canvas>
    </div>
	
	<div class = 'codition'>
		 <h1>cherche un trajet</h1>
        <form  method="post" action="control/c_chercher.php">
			Codition:<select name = 'codition'>
			  <option value="court">Court</option>
			  <option value="rapide">Rapide</option>
			  <option value="eco">Eco</option>
			  <option value="ecologique">Ecologique</option>
			</select>
			<br>
            Depart:
            <input type="text" name="depart" placeholder = 'ville' >
            <br>
            Destination:
            <input type="text" name="destination" placeholder = 'ville'>
            <br>
            <input type="submit" value="Go" name = "btnCherche">
        </form>
        <p>pas de compte?</p>
        <a href="view/inscription.php">inscription</a>
	</div>
	<h1>List de Favori </h1>
	<div class = 'favori'>
	
	</div>

</body>
</html>