 <?php
session_start();
	if(!isset($_SESSION['id'])){
		$id=-1;
	}
	else{
		$id=$_SESSION['id'];
		echo $id;
	}
	
//ouverture de XML
$xml = new DOMDocument();
$xml->load('../Cartes/Carte_2.xml');//recuperer info de la carte
$ville1=$xml->getElementsByTagName('ville');
$route1=$xml->getElementsByTagName('route');
function trajetSA($depart,$destination,$villenonpass,$route,$radar){//algo:Aetoile	
	global $xml;
	global $ville1;
	global $route1;
	$untrajet=array();
	$trajet=array();
	$maintenant=$depart;//la ville ou on est.
	$nb=0;
	$vite=0;
	
    $g=0;//la distance du point current et point départ
	$h=0;//点与重点的直线距离:la distance entre la ville maintenante et la destination 
	$f=$g+$h;//权重:le poid qu'on utilise cette confiance pour chosir la ville prochaine
	$t=0.0;
	$des_x=0.0;
	$des_y=0.0;
	$flagout=true;
	foreach($ville1 as $vi){
		if ($vi->getElementsByTagName("nom")[0]->nodeValue==$destination){//找终点城市的xy坐标	 qu'on veur chercher x y de la ville Arrivée
			$des_x=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("latitude")[0]->nodeValue;
			$des_y=$vi->getElementsByTagName("coordonnees")[0]->getElementsByTagName("longitude")[0]->nodeValue;//la position de la destination
			}
		}
	$flage=true;$start=array();	
	while($flage){
	foreach($route1 as $rout){	
	foreach($rout->getElementsByTagName("troncon") as $tron){// on dois retirer tous les troncons qui a assoiciation avec la ville maintenant dans array de start.
		if($tron->getElementsByTagName("ville1")[0]->nodeValue==$maintenant){//如果找到一个troncon的一个头和当下城市相同 si on trouver un troncon 'ville1'
																				// egale à la ville currente
			$fl=true;
			foreach($ville1 as $vi){///找到另一段的城市
				$v=$tron->getElementsByTagName("ville2")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){//找到后计算权重等
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$nbensuite=$nb+1;
					$viteensuite=$vite+$tron->getElementsByTagName("vitesse")[0]->nodeValue;
					$gensuite=$g+$tron->getElementsByTagName("longueur")[0]->nodeValue;//6是这个troncon的长度 cest la longueur du troncon
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
		else if($tron->getElementsByTagName("ville2")[0]->nodeValue==$maintenant){
			$fl=true;
			foreach($ville1 as $vi){///找到另一段的城市
				$v=$tron->getElementsByTagName("ville1")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){//找到后计算权重等
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$nbensuite=$nb+1;
					$viteensuite=$vite+$tron->getElementsByTagName("vitesse")[0]->nodeValue;
					$gensuite=$tron->getElementsByTagName("longueur")[0]->nodeValue+$g;//6是这个troncon的长度
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
	foreach($start as $choix){//apres on ajoute les troncons vouvels ,il faut quitter les villes on a deja passe dans start(c-a-d:la ville maintenant)                         
		//所有这个城市的信息都要删除，因为这个城市最短路径已经被找到并且丢到trajet里了。
		if($choix[0]==$maintenant) {array_splice($start,$j,1);$j--;}
		$j++;
	}
	//si start est ville, on n'a pas trouve aucun trajet entre depart et destination , on envoie les info.
	if ($start==[]){echo "desole! il n'y a pas de trajet entre ces deux villes!</br>";$flage=false;$flagout=false;}
	/*结束情况一：如果所有的开始数组里的所有城市都被走完了，说明没有匹配的路径通到目的地，所以flage变成结束的标志*/
	else{
		$index=0;
		$long=50000000;
		$i=0;
		foreach($start as $choix){//il nous faut choisir la niuvelle ville comme ville maintenant selon la confiance de f,on choisir le moins.
			if($choix[4]<$long) {$long=$choix[4];$index=$i;}
			$i++;
			//echo "每个路：".$choix[0]." f ".$choix[4]." </br>";
		}
		echo "le petit étape".$start[$index][5]."->".$start[$index][0]."</br>";
		array_push($trajet,$start[$index]);
		$nb=$start[$index][6];$vite=$start[$index][7];
		$g=$start[$index][2];//记录上一记录的走过的路程距离。mais faut que notter les distance de passe de depart a maintenant 
		$maintenant=$start[$index][0];//改变当下城市
		//si maintnant est deja la destination cest a dire on a trouve un trajet deja
		if ($maintenant==$destination) {$flage=false;echo "fini!</br>";}//结束情况2：当前的城市已经是destination：quand la derniere villes est destination,on finis.
		}
	}
	$t=$trajet;//整理一下有用的troncon信息到untrajet里面。
	if($flagout){//on retirer tous les utiles sur le vrai trajet dans l'array de trajet 
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
function trajetRapide($depart,$destination,$villenonpass,$route,$radar){//algo:Aetoile	
	global $xml;
	global $ville1;
	global $route1;
	$untrajet=array();
	$trajet=array();
	$maintenant=$depart;//la ville ou on est.
    $vitesse1=0;//点与起点的速度:sum(vitesse d'un troncon)
	$nb=0;
	$g=0;//点与起点的距离:sum(distance d'un troncon)
	$t=0.0;//总体时间:on utilise cette confiance（temps total） pour chosir la ville prochaine
	$flagout=true;
	$flage=true;$start=array();	
	while($flage){
	foreach($route1 as $rout){	
	foreach($rout->getElementsByTagName("troncon") as $tron){// on dois retirer tous les troncons qui a assoiciation avec la ville maintenant dans array de start.
		if($tron->getElementsByTagName("ville1")[0]->nodeValue==$maintenant){//如果找到一个troncon的一个头和当下城市相同
			$fl=true;
			foreach($ville1 as $vi){///找到另一段的城市
				$v=$tron->getElementsByTagName("ville2")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){//找到后计算权重等
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$vensuite=$vitesse1+$tron->getElementsByTagName("vitesse")[0]->nodeValue;//6是这个troncon的vitesse
					$nbensuite=$nb+1;
					$gensuite=$g+$tron->getElementsByTagName("longueur")[0]->nodeValue;//6是这个troncon的longueur
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
			foreach($ville1 as $vi){///找到另一段的城市
				$v=$tron->getElementsByTagName("ville1")[0]->nodeValue;
				$r=$tron->getElementsByTagName("radar")[0]->nodeValue;
				if ($vi->getElementsByTagName("nom")[0]->nodeValue==$v){//找到后计算权重等
					if($villenonpass!='') {if($v==$villenonpass) $fl=false;}
					if($radar!='') {if($r=="oui") $fl=false;}
					if ($depart==$v ) $fl=false;
					if($trajet!=[]){
					foreach($trajet as $tar){
						if($tar[0]==$v) $fl=false;
					}}
					if ($fl==true){
					$vensuite=$vitesse1+$tron->getElementsByTagName("vitesse")[0]->nodeValue;//6是这个troncon的vitesse
					$nbensuite=$nb+1;
					$gensuite=$g+$tron->getElementsByTagName("longueur")[0]->nodeValue;//6是这个troncon的longueur
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
	foreach($start as $choix){//apres on ajoute les troncons vouvels ,il faut quitter les villes on a deja passe dans start(c-a-d:la ville maintenant)                         
		//所有这个城市的信息都要删除，因为这个城市最短路径已经被找到并且丢到trajet里了。
		if($choix[0]==$maintenant) {array_splice($start,$j,1);$j--;}
		$j++;
	}
	//si start est ville, on n'a pas trouve aucun trajet entre depart et destination , on envoie les info.
	if ($start==[]){echo "desole! il n'y a pas de trajet entre ces deux villes!</br>";$flage=false;$flagout=false;}
	/*结束情况一：如果所有的开始数组里的所有城市都被走完了，说明没有匹配的路径通到目的地，所以flage变成结束的标志*/
	else{
		$index=0;
		$long=50000000;
		$i=0;
		foreach($start as $choix){//il nous faut choisir la niuvelle ville comme ville maintenant selon la confiance de f,on choisir le moins.
			if($choix[4]<$long) {$long=$choix[4];$index=$i;}
			$i++;
		}
		echo "troncon".$start[$index][5]."->".$start[$index][0]."</br>";
		array_push($trajet,$start[$index]);
		$vitesse1=$start[$index][2];//记录上一记录的走过的vitesse。mais faut que notter les distance de passe de depart a maintenant 
		$g=$start[$index][3];
		$nb=$start[$index][6];
		$maintenant=$start[$index][0];//改变当下城市
		//si maintnant est deja la destination cest a dire on a trouve un trajet deja
		if ($maintenant==$destination) {$flage=false;echo "fini!</br>";}//结束情况2：当前的城市已经是destination：quand la derniere villes est destination,on finis.
		}
	}
	$t=$trajet;//整理一下有用的troncon信息到untrajet里面。
	if($flagout){//on retirer tous les utiles sur le vrai trajet dans l'array de trajet 
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
	
	//print_r($untrajet);
	return $untrajet;// on l'envoie.
}
function form_arr_for_xml($arr){
	global $route1;
	$arr_xml = array($arr[0]);
	$i = 1;
	for($i = 1 ;$i< count($arr); $i++){		
		$a = array($i , $arr[$i]);
		print_r($arr[$i]);
		array_push($arr_xml , $a);
	}
	array_push($arr_xml , $arr[$i-1]);
		
	return 	$arr_xml;	
}
function stock_trajet ($arr_xml){
  $xml    = '<trajet></trajet>';
  //以字符串为基础创建xml对
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
    //$itemSon = $item->addChild('route',$rows[1]);
    $itemSon = $item->addChild('destination',$rows[1]);
   }
   
  }
  //保存XML文件
  $a = date('Y-m-d');
  $b = time();
  $xmlObj->asXML('../trajets/trajet_'.$a.'_'.$b.'.xml');
  
  return '../trajets/trajet_'.$a.'_'.$b.'.xml';
 
 }
?>

