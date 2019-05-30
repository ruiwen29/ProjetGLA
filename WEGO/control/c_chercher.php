<?php
    require_once("../model/m_trajet.php");
	//include ("../model/m_trajet.php");
	require_once("../model/m_carte.php");
    if(isset($_POST["codition"])&&isset($_POST["depart"])&&isset($_POST["destination"])){
        
		$codition = $_POST["codition"];
		$depart = $_POST["depart"];
        $destination = $_POST["destination"];
		$carte_adr =  "../Cartes/Carte_2.xml";
		/*
		$carte = new Carte($carte_adr);
		$t = new Trajet($carte , $depart, $destination);
		
		//$troncons = $carte->getAllTroncon();
		$fichier =  "../Cartes/Carte.xml";
		$xml = file_get_contents($fichier);
		$objectxml = simplexml_load_string($xml);//将文件转换成 对象
		$xmljson= json_encode($objectxml );//将对象转换个JSON
		$xmlarray=json_decode($xmljson,true);//将json转换成数组
		$troncons =  [];
		foreach ($xmlarray['route'] as $route){
			array_push($troncons,$route['troncon']);	
		}
		
		$trajets = array("depart" => "$depart","destination" => "$destination");
		$villes= array('$depart');
		$trajets= $t->chercherUnTrajet($depart,$destination,$trajets, $troncons,$villes);
   
		
      

	  //chercher tous les trajet 
	   //$trajets = $trajet->chercherTrajets();
	   //print_r($trajets);
	   //ordre par condition 
	   //$trajets = $trajet->trier_par_condition( $codition , $trajets);
	   
	   //envouyer le resultat a la page v_recherche
	   //header("location:../view/v_rechercher.php?trajets=$trajets");
      
		*/
	}
  
  

?>