<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Test</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" />
	<link rel="icon" href="../style/logo.ico" type="image/x-icon">
	<link rel="shortcut icon" href="../style/logo.ico" type="image/x-icon">
</head>
<body>
<?php
	$doc = new DOMDocument();
	$doc->load( '../Cartes/Carte_2.xml' );
	$reseau = $doc->getElementsByTagName( "reseau" );
	$villes = $doc->getElementsByTagName( "ville" );
	//print_r($villes[0] ->getElementsByTagName( "coordonnees"));
	$coordonnees = $villes[0] ->getElementsByTagName( "coordonnees");
	$lat = $coordonnees[0]->getElementsByTagName("latitude")[0]->nodeValue;
	print_r($lat);
	//print_r($reseau);
	$tr = [];
	foreach( $reseau as $route ){
    $troncons = $route->getElementsByTagName( "troncon" );
	$nom_route = $route->getElementsByTagName("nom");
		foreach ($troncons as $troncon){
			$ville1 =  $troncon->getElementsByTagName('ville1')->item(0)->nodeValue;
			$ville2 =  $troncon->getElementsByTagName('ville2')->item(0)->nodeValue;
			$longueur =  $troncon->getElementsByTagName('longueur')->item(0)->nodeValue;			
			echo "$ville1 --$ville2 --$longueur\n";
			$arr = array($ville1, $ville2, $longueur);
			array_push ($tr,$arr);
			echo "<br>";
		}
     
	}
	//print_r($tr);
	//print_r(count($tr));
	
	function A($start , $goal, $villes){
		$closedset  = [];
		$openset  = array(
		array($start,0)
		);
		$came_from  = [];
		$g_start =0;
		$h_start = heuristic_estimate_of_distance($start, $goal,$villes);// (start, goal)
		$f_start = $h_start ;
		//将要被估计的点的集合
		foreach($openset as $p){
			$p[0] 
		}
		
		while (openset != []){
			$x = lowest_f_score();
			$x_ville2 = $x[1];
			if ( $x_ville2== $goal)
			{
				return reconstruct_path($came_from,$goal);
			}
			//remove x from openset 
			$openset = array_diff($openset,array($x));
			//add x to closedset
			$closedset = array_push($closedset,$x);
			
			foreach(neighbor_nodes($x_ville2) as y){
				if ($key = array_search($x, $code)) !== NULL){
					
				}
				else {
					// tentative_g_score := g_score[x] + dist_between(x,y)   
					//從起點到節點y的距離
				}
			}
			
			
		}
		
		
		
		return 0;
	}
	function heuristic_estimate_of_distance($start, $goal, $villes){
		$x1 = 0;
		$x2 = 0;
		$y1 = 0;
		$y2 = 0;
		foreach($villes as $ville){
			$nom_ville = $ville->getElementsByTagName('nom')[0]->nodeValue;
			if ($start == $nom_ville){
				$coo1 = $ville->getElementsByTagName( "coordonnees");
				$x1 =  $coo1[0]->getElementsByTagName("latitude")[0]->nodeValue;
				$y2 = $coo1[0]->getElementsByTagName("longitude")[0]->nodeValue;
			}
			if ($goal == $nom_ville){
				$coo2 = $ville->getElementsByTagName( "coordonnees");
				$x2 =  $coo2[0]->getElementsByTagName("latitude")[0]->nodeValue;
				$y2 = $coo2[0]->getElementsByTagName("longitude")[0]->nodeValue;
			}
			
		}
		return sqrt(pow($x1-$x2,2)+pow($y1-$y2,2))*100;
		
	}
	function neighbor_nodes($ville,$tr){
		$neighbor_nodes =[];
		for ($i = 0; $i <count($tr); $i++){
			if ($tr[$i][0]==$ville){
				array_push ($neighbor_nodes,$tr[$i]);
			}
		}
		return $neighbor_nodes;
	}
	
	
	$neighbor_nodes = neighbor_nodes('V4',$tr);
	print_r($neighbor_nodes);
	
	$depart = 'V4';
	$destination = 'V3';
	
?>
</body>

</html>