<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accuille</title>
<link rel="stylesheet" type="text/css" href="../style/style.css" />


</head>
<body>
	<div class = 'codition'>
		 <h1>cherche un trajet</h1>
        <form  method="post" action="control/c_rechercher.php">
			</select>
			<br>
			<select name = 'codition'>
			  <option value=1>Eviter</option>
			  <option value=2>Suivre</option>
			</select>
			<input type="text" name="ES" placeholder = 'ville' >
			<br>
            Nombre de radar <=
            <input type="text" name="depart"  >
            <br>
            <input type="submit" value="Rechercher" name = "btnReCherche">
        </form>
	</div>
	<h1>Trajet </h1>
	<div class = 'trajet'>
	<ul>
		<?php 
			//affiche la liste des trajets , selecter un trajet pour navigation 
			if(isset($_POST["trajets"])){
				//for (){}
			}
			else {
				echo "aucun trajet trouver";
			}
		?>
	</ul>
	</div>
	<div class = "return"> 
		chercher un autre trajet 
		<a href = "../view/v_accuille"> return </a>
	</div> 
</body>
</html>