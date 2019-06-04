<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accuille</title>
<link rel="stylesheet" type="text/css" href="../style/style.css" />
<link rel="icon" href="../style/logo.ico" type="image/x-icon">
<link rel="shortcut icon" href="../style/logo.ico" type="image/x-icon">

</head>
<body>
<div class="main">
	<a href = "../view/v_accuille.php"><img class = "smallImage" src = "../style/logoWego.jpg"/></a>
	<div class = 'filtrer'>
	
		 <h1>Filtrer vos trajets</h1>
        <form  method="post" action="control/c_rechercher.php">
			</select>
			<br/>
			Vous voulez
			<select name = 'codition'>
			  <option value=1>Eviter</option>
			  <option value=2>Suivre</option>
			</select>
			<input type="text" name="ES" placeholder = 'ville' >
			<br/><br/>
            Nombre de radar <=
            <input type="text" name="depart"  >
            <br/><br/>
            <input type="submit" value="Rechercher" name = "btnReCherche">
        </form>
	</div>
	
	<div class = 'trajet'>
	<h1>Votre trajet </h1>
	<ul>
		<?php 
			//affiche la liste des trajets , selecter un trajet pour navigation 
			if(isset($_POST["trajets"])){
				//for (){}
			}
			else {
				echo "Aucun trajet trouve";
			}
		?>
	</ul>
	</div>
	<div class = "return"> 
		>>Si vous voulez chercher un trajet entre les autres villes
		<a href = "../view/v_accuille"> >>Back </a>
	</div> 
</div>	
</body>
</html>