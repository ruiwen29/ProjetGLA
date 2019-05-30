<?php
   // require_once("../model/m_trajet.php");
	include ("../model/m_trajet.php");
	//require_once("../model/m_carte.php");
    if(isset($_POST["codition"])&&isset($_POST["depart"])&&isset($_POST["destination"])&&isset($_POST["radar"])){
        if (isset($_POST["sv"])){
			$sv = $_POST["sv"];
		}
		else {
			$sv = '';
		}
		$codition = $_POST["codition"];
		$depart = $_POST["depart"];
        $destination = $_POST["destination"];
		
		$radar = $_POST["radar"];
		
		
		$trajet = trajetSA($depart,$destination,$sv,'',$radar);
		$arr =  array($depart);
		
		foreach ($trajet as $t){
			print_r($t[0]);
			echo '</br>';	
			array_push($arr,$t[0]);			
			echo '</br>----------------------------</br>';
		}
		print_r($arr);
		echo '</br>----------------------------</br>';
		$arr_xml = form_arr_for_xml($arr);
		print_r($arr_xml);
		$adr = stock_trajet($arr_xml);
		print_r($adr);
		
		header("location:../view/v_trajet.php?adr=$adr");
	}
  
  

?>