<?php
ob_start();

    require_once("../model/bd.php");
    require_once("../model/user.php");
	session_start();
	//echo $_SERVER["QUERY_STRING"]."<br>";//adr=../trajets/trajet_2019-05-30_1559247108.xml
	$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	echo $query['adr'];
  
	if( !empty($query['adr'])){
        $adr = $query['adr'];
		print_r($adr);
		if (isset($_SESSION['id']))
		{	
			$id = $_SESSION['id'];
			echo $id;
			$coBd = new Bd("wego");
            $co = $coBd -> connexion();
            $user = new User($id);
            $user ->supprimer_favori($co,$adr);			
			mysqli_close($co);
			header('location:../view/v_accuille.php');	
		}
		else{
			//echo 'pas connecter!';
			echo "<script>alert('pas connecter!');parent.location.href='../index.php';</script>";
		}
		 
	}
	else{
		//print_r( $_POST["adr"]);
		//echo "<script>alert('pas de data recue!');parent.location.href='../view/v_accuille.php';</script>";
	}
 
?>