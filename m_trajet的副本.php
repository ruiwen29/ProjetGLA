<?php
Class trajet{
	private $carte_arr;
    private $depart;
	private $destination;
	private $trajet;
	private $touristique;
	private $radar;
	private $payant;
	private $longueur;

 

 public function __construct($carte,$depart,$destination)
    { 
  $fichier =  $carte;
  $xml = file_get_contents($fichier);
  $objectxml = simplexml_load_string($xml);//将文件转换成 对象
  $xmljson= json_encode($objectxml );//将对象转换个JSON
  $carte_arr=json_decode($xmljson,true);//将json转换成数组
  
  $this->carte_arr=$carte_arr ;
  $this->depart=$depart ;
  $this->destination=$destination ;
  $this->trajet=$[] ;
  

       
    }
 

	
	function delByValue($arr, $value){
	if(!is_array($arr)){
		return $arr;
	}
	foreach($arr as $k=>$v){
		if($v == $value){
			//unset($arr[$k]);
			array_splice($arr,$k,1);   
			}
	}
	return $arr;
}


	function getVilleFromTroncon($Troncon){
		$array = [];
		$array[]= $Troncon['ville1'];
		$array[]= $Troncon['ville2'];
			
		return $array;
	}
	function getNextVilleFromTroncon($Troncon,$ville){

		$array = getVilleFromTroncon($Troncon);
		$res = delByValue($array,$ville);
		return $res;
	}
	// return array of the next ville

	function getAllRoute($carte){
		return $carte['reseau']['route'];
	}

	function getAllTronconFromCarte($carte){
		$arr = getAllRoute($carte);
		$res = [];
		foreach ($arr as $key => $value) {
			$res []=$value['troncon']; 
		}
		return $res;	
	}
	function getAllTronconFromRoute($route){
		return $route['troncon'];
	}

	function estPasseRoute($route,$ville){
		$arr = getAllTronconFromRoute($route);
		foreach ($arr as $key => $value) {
			if($value['ville1'] == $ville or $value['ville2'] == $ville)
			return true; 
		}
		return false;

	}


	function chercherUnTrajet($villeD,$villeF,$tj){
		$no = 1;
		$trajet = [];

		$routes = getAllRoute($carte);
		foreach ($routes as $key => $route) {
			if($villeD == $villeF) {

			}
			$troncons = getAllTronconFromRoute($route);
			foreach ($troncons as $key => $troncon) {
				$villes = getVilleFromTroncon($value);
				if ($villes[0] == $villeDebut or $villes[1] == $villeDebut ) {	
			$etape[] = $no;
			$no = $no + 1 ;
			$etape[] = $route['nom'];
			$nextVille = getNextVilleFromTroncon($troncon,$villeDebut);
			$etape[] = $route['']
			}
				
			}
		}
		}




	function chercherTrajets($carte,$villeDebut,$villeFin){
		$res = [];
		$trajets = [];
		$trajet = [];
		$etape = [];
		$no = 1;
		$routes = getAllRoute($carte);

		function chercherUnTrajet($villeD,$villeF,$t){
		foreach ($routes as $key => $route) {
			if($villeD == $villeF) {

			}
			$troncons = getAllTronconFromRoute($route);
			foreach ($troncons as $key => $troncon) {
				$villes = getVilleFromTroncon($value);
				if ($villes[0] == $villeDebut or $villes[1] == $villeDebut ) {	
			$etape[] = $no;
			$no = $no + 1 ;
			$etape[] = $route['nom'];
			$nextVille = getNextVilleFromTroncon($troncon,$villeDebut);
			$etape[] = $route['']
			}
				
			}
		}
		}


	}
}


	?>
