<?php
    require_once("../model/trajet.php");
	
    if(isset($_POST["codition"])&&isset($_POST["depart"])&&isset($_POST["destination"])){
        $codition = $_POST["codition"];
		$depart = $_POST["depart"];
        $destination = $_POST["destination"];
		$carte =  "../Cartes/Carte_2.xml";
		$trajet = new Trajet($carte , $depart, $destination);
		
       //chercher tous les trajet 
	   $trajets = $trajet->chercher();
	   
	   //ordre par condition 
	   $trajets = $trajet->trier_par_condition( $codition , $trajets);
	   
	   //envouyer le resultat a la page v_recherche
	   header("location:../view/v_rechercher.php?trajets=$trajets");
      
		
	}
  
  

?>