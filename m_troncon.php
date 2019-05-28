<?php
class troncon{
	private $ville1;
	private $ville2;
	private $vitesse;
	private $touristique;
	private $radar;
	private $payant;
	private $longugeur;


	 public function __construct()
    { 

  
  $this->ville1= new ville() ;
  $this->ville2= new ville() ;
  $this->vitesse=0 ;
  $this->radar=non ;
  $this->payant=non ;
  $this->longugeur=0 ;

       
    } 



}
?>