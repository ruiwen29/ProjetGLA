<?php
class troncon{

	public $ville1;
	public $ville2;
	public $vitesse;
	public $touristique;
	public $radar;
	public $payant;
	public $longugeur;


	 public function __construct()
    { 

  
  $this->ville1= 'paris' ;
  $this->ville2= 'paris' ;
  $this->vitesse=0 ;
  $this->radar='non' ;
  $this->payant='non' ;
  $this->longugeur=0 ;

       
    } 


	public function getAllTronconFromCarte($carte){
		$route = new route();
		$arr = $route->getAllRoute($carte);
		$res = [];
		foreach ($arr as $key => $value) {
			if(!is_array($value['troncon'][0]))
			$res []=$value['troncon']; 
			else{
				foreach ($value['troncon'] as $key => $valueT) {
					$res[] = $valueT;
				}
			}
		}
		return $res;	
	}  // return array of all the troncon from carte ok


	public function getAllTronconFromRoute($route){   
		$arr = [];
		if(is_array($route['troncon'][0])){
		
		foreach ($route['troncon'] as $key => $value) {
			$arr[] = $value;
		}}

		else 
		 	{$arr[] =  $route['troncon'];}
		return $arr;

	} //return array of all the troncon from route ok



}
?>