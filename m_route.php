<?php

class route{
	public $nom;
	public $type;
	public $troncons;

	


	public function __construct()
    { 

  
  		 $this->nom='n1' ;
	     $this->type='nationale' ;
	     $this->troncons=[] ;  
       
    } 

     public function getAllRoute($carte){

		 $routes=[];
		 foreach ($carte['reseau']['route'] as $key => $value) {
		 	$route = new route();
		 	$route->nom = $value['nom'];
		 	$route->type = $value['type'];

		 	$route->troncons = $value['troncon'];

		 	$routes[] = $route;

		 }
		 return $routes;

	} //return all the route from carte  ok
//	public function 


}



?> 