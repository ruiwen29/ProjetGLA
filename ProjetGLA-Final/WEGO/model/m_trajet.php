 <?php

$xml = new DOMDocument();
$xml->load('../Cartes/Carte_2.xml');
$ville1=$xml->getElementsByTagName('ville');
$route1=$xml->getElementsByTagName('route');
function trajetSA($depart,$destination,$villenonpass,$payant,$radar,$touristique){
	global $xml;
	global $ville1;
	global $route1;
	$untrajet=array();
	$trajet=array();
	$maintenant=$depart;
	$nb=0;
	$vite=0;
	
    $g=0;
	$h=0;
	$f=$g+$h;
	$t=0.0;
	$des_x=0.0;
	$des_y=0.0;
	$flagout=true;
	foreach($ville1 as $vi){
		if ($vi->getElementsByTagName("nom")[0]->nodeValue==$destination){
			$des_x=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("latitude")[0]->nodeValue;
			$des_y=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("longitude")[0]->nodeValue;//la position de la destination
			}
		}
	$flage=true;$start=array();	
	while($flage){
	foreach($route1 as $rout){	
	foreach($rout->getElementsByTagName("troncon") as $tron){
		if($tron->getElementsByTagName("ville1")[0]->nodeValue==$maintenant){
																				
			$fl=true;
			foreach($ville1 as $vi){
				$v=$tron->getElementsByTagName("ville2")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				$pay=$tron->getElementsByTagName("payant")[0]->nodeValue;
				$tour=$tron->getElementsByTagName("touristique")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if($payant!='') {if($pay=="oui") $fl=false;}
					if($touristique!='') {if($tour=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$nbensuite=$nb+1;
					$viteensuite=$vite+$tron->getElementsByTagName("vitesse")[0]->nodeValue;
					$gensuite=$g+$tron->getElementsByTagName("longueur")[0]->nodeValue;
					$tensuite=$gensuite/($viteensuite/$nbensuite);
					$main_x=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("latitude")[0]->nodeValue;
					$main_y=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("longitude")[0]->nodeValue;
					$h=sqrt(pow($main_x-$des_x,2)+pow($main_y-$des_y,2))*100;
					$f=$gensuite+$h;
					// if($route!=''){
					// 	if ($rout->getElementsByTagName("type")[0]->nodeValue!=$route) $f+=200;
					// }
					}
				}
			}
			if($fl){
				$start_tron=array($v,$tron,$gensuite,$h,$f,$maintenant,$nbensuite,$viteensuite,$tensuite);
				array_push($start,$start_tron);}
			else continue;
		}
		else if($tron->getElementsByTagName("ville2")[0]->nodeValue==$maintenant){
			$fl=true;
			foreach($ville1 as $vi){
				$v=$tron->getElementsByTagName("ville1")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				$pay=$tron->getElementsByTagName("payant")[0]->nodeValue;
				$tour=$tron->getElementsByTagName("touristique")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if($payant!='') {if($pay=="oui") $fl=false;}
					if($touristique!='') {if($tour=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$nbensuite=$nb+1;
					$viteensuite=$vite+$tron->getElementsByTagName("vitesse")[0]->nodeValue;
					$gensuite=$tron->getElementsByTagName("longueur")[0]->nodeValue+$g;
					$tensuite=$gensuite/($viteensuite/$nbensuite);
					$main_x=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("latitude")[0]->nodeValue;
					$main_y=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("longitude")[0]->nodeValue;
					$h=sqrt(pow($main_x-$des_x,2)+pow($main_y-$des_y,2))*100;
					$f=$gensuite+$h;
					if($route!=''){
						if ($rout->getElementsByTagName("type")[0]->nodeValue!=$route) $f+=200;
					}
					}
				}
			}
			if($fl){
				$start_tron=array($v,$tron,$gensuite,$h,$f,$maintenant,$nbensuite,$viteensuite,$tensuite);
				array_push($start,$start_tron);}
			else continue;
		}
	}
	}
	$j=0;
	foreach($start as $choix){
		
		if($choix[0]==$maintenant) {array_splice($start,$j,1);$j--;}
		$j++;
	}	
	if ($start==[]){echo "desole! il n'y a pas de trajet entre ces deux villes!</br>";$flage=false;$flagout=false;}
	else{
		$index=0;
		$long=50000000;
		$i=0;
		foreach($start as $choix){
			if($choix[4]<$long) {$long=$choix[4];$index=$i;}
			$i++;
		}
		echo "le petit étape".$start[$index][5]."->".$start[$index][0]."</br>";
		array_push($trajet,$start[$index]);
		$nb=$start[$index][6];$vite=$start[$index][7];
		$g=$start[$index][2];
		$maintenant=$start[$index][0];
		if ($maintenant==$destination) {$flage=false;echo "fini!</br>";}
		}
	}
	$t=$trajet;
	if($flagout){
		$n=count($t)-1;
		array_unshift($untrajet,$t[$n]);
		$villeA=$t[$n][5];
		array_splice($t,$n,1);
		$n=count($t)-1;
		while($n>=0){
			if($t[$n][0]==$villeA){
				array_unshift($untrajet,$t[$n]);
				$villeA=$t[$n][5];
				array_splice($t,$n,1);
			}
			if($villeA==$depart) break;
			$n--;
		}
	}
	echo "le nombre des étapes：".count($untrajet)."</br>";
	return $untrajet;// on l'envoie.
}
function trajetRapide($depart,$destination,$villenonpass,$payant,$radar,$touristique){//algo:Aetoile	
	global $xml;
	global $ville1;
	global $route1;
	$untrajet=array();
	$trajet=array();
	$maintenant=$depart;//la ville ou on est.
    $vitesse1=0;
	$nb=0;
	$g=0;
	$t=0.0;
	$flagout=true;
	$flage=true;$start=array();	
	while($flage){
	foreach($route1 as $rout){	
	foreach($rout->getElementsByTagName("troncon") as $tron){
		if($tron->getElementsByTagName("ville1")[0]->nodeValue==$maintenant){
			$fl=true;
			foreach($ville1 as $vi){
				$v=$tron->getElementsByTagName("ville2")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				$pay=$tron->getElementsByTagName("payant")[0]->nodeValue;
				$tour=$tron->getElementsByTagName("touristique")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if($payant!='') {if($pay=="oui") $fl=false;}
					if($touristique!='') {if($tour=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$vensuite=$vitesse1+$tron->getElementsByTagName("vitesse")[0]->nodeValue;
					$nbensuite=$nb+1;
					$gensuite=$g+$tron->getElementsByTagName("longueur")[0]->nodeValue;
					$t=$gensuite/($vensuite/$nbensuite);
					if($route!=''){
						if ($rout->getElementsByTagName("type")[0]->nodeValue!=$route) $t+=200;
					}
					}
				}
			}
			if($fl){
				$start_tron=array($v,$tron,$vensuite,$gensuite,$t,$maintenant,$nbensuite);
				array_push($start,$start_tron);}
			else continue;
		}
		else if($tron->getElementsByTagName("ville2")[0]->nodeValue==$maintenant){
			$fl=true;
			foreach($ville1 as $vi){
				$v=$tron->getElementsByTagName("ville1")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				$pay=$tron->getElementsByTagName("payant")[0]->nodeValue;
				$tour=$tron->getElementsByTagName("touristique")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if($payant!='') {if($pay=="oui") $fl=false;}
					if($touristique!='') {if($tour=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$vensuite=$vitesse1+$tron->getElementsByTagName("vitesse")[0]->nodeValue;
					$nbensuite=$nb+1;
					$gensuite=$g+$tron->getElementsByTagName("longueur")[0]->nodeValue;
					$t=$gensuite/($vensuite/$nbensuite);
					if($route!=''){
						if ($rout->getElementsByTagName("type")[0]->nodeValue!=$route) $t+=200;
					}
					}
				}
			}
			if($fl){
				$start_tron=array($v,$tron,$vensuite,$gensuite,$t,$maintenant,$nbensuite);
				array_push($start,$start_tron);}
			else continue;
		}
	}
	}
	$j=0;
	foreach($start as $choix){                
		
		if($choix[0]==$maintenant) {array_splice($start,$j,1);$j--;}
		$j++;
	}
	
	if ($start==[]){echo "desole! il n'y a pas de trajet entre ces deux villes!</br>";$flage=false;$flagout=false;}
	else{
		$index=0;
		$long=50000000;
		$i=0;
		foreach($start as $choix){
			if($choix[4]<$long) {$long=$choix[4];$index=$i;}
			$i++;
		}
		echo "troncon".$start[$index][5]."->".$start[$index][0]."</br>";
		array_push($trajet,$start[$index]);
		$vitesse1=$start[$index][2]; 
		$g=$start[$index][3];
		$nb=$start[$index][6];
		$maintenant=$start[$index][0];
		if ($maintenant==$destination) {$flage=false;echo "fini!</br>";}
		}
	}
	$t=$trajet;
	if($flagout){
		$n=count($t)-1;
		array_unshift($untrajet,$t[$n]);
		$villeA=$t[$n][5];
		array_splice($t,$n,1);
		$n=count($t)-1;
		while($n>=0){
			if($t[$n][0]==$villeA){
				array_unshift($untrajet,$t[$n]);$villeA=$t[$n][5];array_splice($t,$n,1);
			}
			if($villeA==$depart) break;
			$n--;
		}
	}
	echo "le nombre des étapes：".count($untrajet)."</br>";
	
	
	return $untrajet;
}
function form_arr_for_xml($arr){
	global $route1;
	$arr_xml = array($arr[0]);
	$i = 1;
	$nom_route='';
	for($i = 1 ;$i< count($arr); $i++){		
		foreach($route1 as $rout){	
			foreach($rout->getElementsByTagName("troncon") as $tron){
				if($tron->getElementsByTagName("ville1")[0]->nodeValue==$arr[$i-1]){
				   if($tron->getElementsByTagName("ville2")[0]->nodeValue==$arr[$i]){
					   $nom_route = $rout->getElementsByTagName("nom")[0]->nodeValue;
				   }
				}
			}
		
		}
		$a = array($i ,$nom_route, $arr[$i]);
		print_r($arr[$i]);
		array_push($arr_xml , $a);
	}
	array_push($arr_xml , $arr[$i-1]);
		
	return 	$arr_xml;	
}
function stock_trajet ($arr_xml){
  $xml    = '<trajet></trajet>';
  $xmlObj = simplexml_load_string($xml);
  $k = 1;
  foreach($arr_xml as $rows){
   if (is_string($rows)){
    if ($k==1){
     $xmlObj->addChild('ville-depart',$rows);
     $k ++;
    }
    else {
     $xmlObj->addChild('ville-arrivee',$rows);
    }
    
   }
   else{
    $item    = $xmlObj->addChild('etape');
    $itemSon = $item->addChild('numero',$rows[0]);
	$itemSon = $item->addChild('route',$rows[1]);
    $itemSon = $item->addChild('destination',$rows[2]);
   }
   
  }
  $a = date('Y-m-d');
  $b = time();
  $xmlObj->asXML('../trajets/trajet_'.$a.'_'.$b.'.xml');
  
  return '../trajets/trajet_'.$a.'_'.$b.'.xml';
 
 }
?>

