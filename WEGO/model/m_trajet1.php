<?php
require_once("../model/m_carte.php");
Class Trajet
{
    private $carte;//type Carte
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
        $this->carte= $carte ;
		$this->depart=$depart ;
		$this->destination=$destination;  
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
		$xml    = '<trajet></trajet>';
		//以字符串为基础创建xml对
		$xmlObj = simplexml_load_string($xml);
		$k = 1;
		foreach($this->trajet_arr as $rows){
			if (is_string($rows)){
				if ($k==1){
					$xmlObj->addChild('ville-depart',$rows);
					$k ++;
				}
				else {
					$xmlObj->addChild('ville-depart',$rows);
				}
				
			}
			else{
				$item    = $xmlObj->addChild('etape');
				$itemSon = $item->addChild('numero',$rows[0]);
				$itemSon = $item->addChild('route',$rows[1]);
				$itemSon = $item->addChild('destination',$rows[2]);
			}
			
		}
		//保存XML文件
		$a = date('Y-m-d');
		$b = time();
		$xmlObj->asXML('../trajets/trajet_'.$a.'_'.$b.'.xml');
		
		return '../trajets/trajet_'.$a.'_'.$b.'.xml';
 
	}
}
?>