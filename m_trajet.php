<?php


Class trajet{
	public $carte_arr;
    public $depart;
	public $destination;
	public $trajet;
	public $touristique;
	public $radar;
	public $payant;
	public $longueur;
	public $troncons;

 

 public function __construct()
    { 

  
  $this->trajet = [];
  $this->troncons=[] ;
  

       
    }
 

	
// 	function delByValue($arr, $value){
// 	if(!is_array($arr)){
// 		return $arr;
// 	}
// 	foreach($arr as $k=>$v){
// 		if($v == $value){
// 			//unset($arr[$k]);
// 			array_splice($arr,$k,1);   
// 			}
// 	}
// 	return $arr;
// }


	



// 	function getAllRoute($carte){
// 		return $carte['reseau']['route'];
// 	}

	

// 	function getAllTronconFromRoute($route){
// 		return $route['troncon'];
// 	}


// 	function estPasseRoute($route,$ville){
// 		$arr = getAllTronconFromRoute($route);
// 		foreach ($arr as $key => $value) {
// 			if($value['ville1'] == $ville or $value['ville2'] == $ville)
// 			return true; 
// 		}
// 		return false;

// 	}


     public function chercherUnTrajet($villeD,$villeF,&$tjs,$carte){
     		$ville = new ville();
     		$route = new route();
     		$trajet = new trajet();
     		$routes = $route->getAllRoute($carte);
     		$etape = [];
     		
     		$numero = 1;
     		$destination = "0";
     		if($villeD == $villeF){
     			$tjs[] = $trajet;
     		}
     		else{
     		foreach ($route as $key => $r) {
     			$troncon = new troncon();
     			$troncons = $troncon->getAllTronconFromRoute($r);
     			foreach ($troncons as $key => $t) {
     				if($villeD == $t['ville1'] or $villeF == $t['ville2'])
     					if(!in_array($t, $trajet->troncons)){
     						$trajet->troncons[] = $t;
     						$etape[] = $numero;
     						$etape[] = $r->nom;
     						$etape[] = $ville->getNextVilleFromTroncon($t,$villeD);
     						$trajet->trajet[] = $etape;
     						chercherUnTrajet(getNextVilleFromTroncon($t,$villeD),$villeF,&$tjs,$carte);
     					}
     			}
     		} 
     		}
         }

   	 public function chercherTrajets($carte,$villeDebut,$villeFin){
   	 	$trajets = [];
   	 	$trajets[] = $villeDebut;
   	 	chercherUnTrajet($villeDebut,$villeFin,$trajets,$carte);
   	 	$trajets[] = $villeDefin;
   	 	return $trajets;


   	 }

	// function chercherUnTrajet($villeD,$villeF,$tj){
	// 	$no = 1;
	// 	$trajet = [];

	// 	$routes = getAllRoute($carte);
	// 	foreach ($routes as $key => $route) {
	// 		if($villeD == $villeF) {


	// 		}
	// 		$troncons = getAllTronconFromRoute($route);
	// 		foreach ($troncons as $key => $troncon) {
	// 			$villes = getVilleFromTroncon($value);
	// 			if ($villes[0] == $villeDebut or $villes[1] == $villeDebut ) {	
	// 		$etape[] = $no;
	// 		$no = $no + 1 ;
	// 		$etape[] = $route['nom'];
	// 		$nextVille = getNextVilleFromTroncon($troncon,$villeDebut);
	// 		$etape[] = $route[''];
	// 		}
				
	// 		}
	// 	}
	// 	}




	// function chercherTrajets($carte,$villeDebut,$villeFin){
	// 	$res = [];
	// 	$trajets = [];
	// 	$trajet = [];
	// 	$etape = [];
	// 	$no = 1;
	// 	$routes = getAllRoute($carte);

	// 	function chercherUnTrajet($villeD,$villeF,$t){
	// 	foreach ($routes as $key => $route) {
	// 		if($villeD == $villeF) {

	// 		}
	// 		$troncons = getAllTronconFromRoute($route);
	// 		foreach ($troncons as $key => $troncon) {
	// 			$villes = getVilleFromTroncon($value);
	// 			if ($villes[0] == $villeDebut or $villes[1] == $villeDebut ) {	
	// 		$etape[] = $no;
	// 		$no = $no + 1 ;
	// 		$etape[] = $route['nom'];
	// 		$nextVille = getNextVilleFromTroncon($troncon,$villeDebut);
	// 		$etape[] = $route['']
	// 		}
				
	// 		}
	// 	}
	// 	}


	// }
}


	?>
