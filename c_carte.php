
<?php
include 'm_trajet.php';
include 'm_route.php';
include 'm_carte.php';
include 'm_troncon.php';
include 'm_ville.php';


$fichier =  "./carte.xml";

$carte = new carte($fichier);
$a = $carte->getCarte();
//print_r($a);
$route = new route();
$troncon = new troncon();
$route = new route();
$ville = new ville();
echo '</br>';
//print_r($a);
 //$b = $troncon->getAllTronconFromCarte($a);
//print_r($b);

	$troncon = new troncon(); 
 $b = $troncon->getAllTronconFromCarte($a);
// print_r($b);
$trajet = new trajet();
$trajets = $trajet->chercherTrajets($a,'paris','wissous');

 $c = $route->getAllRoute($a);
//	print_r($c);
 //print_r($c[0]['troncon']);
 $d = $troncon->getAllTronconFromRoute($c[2]);
 $e = $ville->getVilleFromTroncon($d[0]);

// print_r($d);
// print_r($e);


print_r($trajets);



?>

	</body>



</html>


