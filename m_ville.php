<?php
class ville{
	private $nom;
	private $type;
	private $touristique;
	private $coordonnees;
	


	 public function __construct()
    { 

  
  $this->nom='paris' ;
  $this->type='grande' ;
  $this->touristique=non ;
  $this->coordonnees=[] ;
  
       
    } 
    public function getVilleFromTroncon($troncon){  

		$array = [];
		$array[] = $troncon['ville1'];
		$array[] = $troncon['ville2'];
		return $array;
	}//有问题 待解决


	public function getNextVilleFromTroncon($Troncon,$ville){

		$array = getVilleFromTroncon($Troncon);
		$res = delByValue($array,$ville);
		return $res;
	}	// return array of the next ville

    // public function getVilleFromCarte(){
    	
    // }



}
?>