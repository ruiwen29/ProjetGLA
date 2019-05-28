<?php
Class Trajet
{
    private $carte_arr;//repertoire de la carte
    private $depart;
	private $destination;
	private $trajet; //array
	
	function __construct() 
    { 
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    } 
	
	function  __construct1($trajet){
		$trajet->trajet=$trajet ;       
	}
	
	function __construct3($carte,$depart,$destination)
    {	
		$fichier =  $carte;
		$xml = file_get_contents($fichier);
		$objectxml = simplexml_load_string($xml);//将文件转换成 对象
		$xmljson= json_encode($objectxml );//将对象转换个JSON
		$carte_arr=json_decode($xmljson,true);//将json转换成数组
		
        $this->carte_arr=$carte_arr ;
		$this->depart=$depart ;
		$this->destination=$destination ;       
    }
	
	public function chercher(){
		$trajets = 0;
		
		return $trajets;
	}
	
	public function trier_par_condition($cond ,$trajets){
		$trajets = 0;
		return $trajets;
	}
	
	public function filtrer_nb_radio($nbRadio , $trajets){
		$trajets = 0;
		return $trajets;
	}
	
	public function trier_par_es_ville ($es, $ville ,$trajets){
		$trajets = 0;
		return $trajets;
	}
	
	public function stock_trajet (){
		
	}
}
?>