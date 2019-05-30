<!-- Angélique ETIENNE - Juexiao ZHANG (3B2) -->
<!-- PAGE D'ACCUEIL -->
	<?php
		session_start();
		if (!isset($_SESSION["pseudo"]))
			header('Location:../formulaire_connexion.php');
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Gestion stages S4 - IUT Orsay</title>
		<link rel="stylesheet" href="../../styles/StylePrincipal.css" />
	</head>

	<body>

		<!-- Barre d'onglets -->
		<div class = "barre_onglets">
			<ul id="barre_nav">
				<li><a href="#">Accueil</a></li>
				<li><a href="#"> <?php echo $_SESSION["pseudo"] ?> </a></li>
				<li><a href="../../controleurs/controleur_deconnexion.php">Déconnexion</a></li>
				<li><a href="#">Aide</a></li>
			</ul>
		</div>

		<div class = "bloc_page">

			<h1>Bienvenue</h1>

			<div class = "texte">
				<p><center>Vous êtes sur le site de gestion de stages de S4 du département informatique de l'IUT d'Orsay.</center></p>
			</div>

			<!-- Boutons de navigation -->
			<div class = "menu_page">
				<a class="nav" href="remplir_fiche.php">Remplir une fiche</a>
				<a class="nav" href="donner_avis.php">Donner son avis</a>
				<a class="nav" href="dispo_soutenances.php">Saisir disponibilités soutenances</a>
			</div>

		</div>

	</body>

</html>
