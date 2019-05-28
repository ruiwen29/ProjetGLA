<!doctype html>
<?php session_start();?>
<html lang="fr">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accuille</title>
<link rel="stylesheet" type="text/css" href="../style/style.css" />


</head>
<body>
	<h3> La carte </h3>
		
	<canvas id = "carte" width ="1600px" height = "900px" style = "border:1px solid #000000; background-color:#AAFFA0">
	</canvas>
	<script type = "text/javascript">
	/*background-color:#D5F5E3*/
	var c = document.getElementById("carte");
	var context = c.getContext("2d");
	var contextt = c.getContext("2d");
	var contexttt = c.getContext("2d");
	
	
	if (window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
		//document.write("Request ok<br/>");
	}else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		//document.write("Request not ok");
	}
	xmlhttp.open("GET","../Cartes/Carte_2.xml",false);
	xmlhttp.send();
	xmlDoc = xmlhttp.responseXML;
	
	var v = xmlDoc.getElementsByTagName("ville");
	var r = xmlDoc.getElementsByTagName("route");
	
	for (i = 0;i<v.length;i++){
		var n = v[i].getElementsByTagName("nom")[0].childNodes[0].nodeValue;
		/*document.write(n);
		document.write(v[i].getElementsByTagName("type")[0].childNodes[0].nodeValue);
		
		document.write("<br/>");*/
		var co = v[i].getElementsByTagName("coordonnees");
		
		for( j = 0;j<co.length;j++){
		var la = co[j].getElementsByTagName("latitude")[0].childNodes[0].nodeValue;
		var lo = co[j].getElementsByTagName("longitude")[0].childNodes[0].nodeValue;
		/*document.write(la);
		document.write("<br/>");
		document.write(lo);
		document.write("<br/>");*/

		
		context.fillStyle = "#0055FF";
		context.beginPath();
		context.fillText(n,340*(la-25),220*(lo-25)-15);
		context.arc(340*(la-25),220*(lo-25),10,0,Math.PI*2,true);
		context.closePath();
		context.fill();
		
		}
	}
	
	for (i = 0;i<r.length;i++){
		var rn = r[i].getElementsByTagName("nom")[0].childNodes[0].nodeValue;
		/*document.write(rn);
		document.write("<br/>");*/
		var tr = r[i].getElementsByTagName("troncon");
		for(j=0;j<tr.length;j++){
			var villedebut = tr[j].getElementsByTagName("ville1")[0].childNodes[0].nodeValue;
			var villefin = tr[j].getElementsByTagName("ville2")[0].childNodes[0].nodeValue;
			/*document.write("villedebut :"+villedebut);
			document.write(" ");
			document.write("villefin :"+villefin);
			document.write("<br/>");*/
			
			for (k = 0;k<v.length;k++){
				for (l = 0; l<v.length;l++){
					if ((villedebut == v[k].getElementsByTagName("nom")[0].childNodes[0].nodeValue)&& (villefin == v[l].getElementsByTagName("nom")[0].childNodes[0].nodeValue))
					{
						var co_debut = v[k].getElementsByTagName("coordonnees");
						for( m = 0;m<co_debut.length;m++){
							var la_debut = co_debut[m].getElementsByTagName("latitude")[0].childNodes[0].nodeValue;
							var lo_debut = co_debut[m].getElementsByTagName("longitude")[0].childNodes[0].nodeValue;
							/*document.write(la_debut);
							document.write("haha<br/>");
							document.write(lo_debut);
							document.write("hoho<br/>");*/
						}
						var co_fin = v[l].getElementsByTagName("coordonnees");
						for( m = 0;m<co_fin.length;m++){
							var la_fin = co_fin[m].getElementsByTagName("latitude")[0].childNodes[0].nodeValue;
							var lo_fin = co_fin[m].getElementsByTagName("longitude")[0].childNodes[0].nodeValue;
							/*document.write(la_fin);
							document.write("haahaa<br/>");
							document.write(lo_fin);
							document.write("hoohoo<br/>");*/
						}
					}
				}
			}

			contextt.strokeStyle = "#FBFED8";
			contextt.beginPath();
			contextt.lineWidth = 5;
			
			contextt.moveTo(340*(la_debut-25),220*(lo_debut-25));
			contextt.lineTo(340*(la_fin-25),220*(lo_fin-25));
			contextt.closePath();
			contextt.stroke();
	}
}
	</script>
	<div class = 'codition'>
		 <h1>cherche un trajet</h1>
        <form  method="post" action="../control/c_chercher.php">
			Codition: <select name = 'codition'>
			  <option value="court">Court</option>
			  <option value="rapide">Rapide</option>
			  <option value="eco">Economique</option>
			  <option value="ecologique">Ecologique</option>
			</select>
			<br>
            Depart:
            <input type="text" name="depart" placeholder = 'ville' >
            <br>
            Destination:
            <input type="text" name="destination" placeholder = 'ville'>
            <br>
            <input type="submit" value="Go" name = "btnCherche">
        </form>
        
	</div>
	
	
	
	<div class = 'favori'>
	<h1>List de Favori </h1>
	<?php 
		
		if (isset($_SESSION['id']))
		{	
			require_once("../model/bd.php");
			require_once("../model/user.php");
			echo "connecte id = ".$_SESSION['id'];
			$id = $_SESSION['id'];
			$coBd = new Bd("wego");
			$co = $coBd -> connexion();
			$user = new User($id);					
			echo "<ul>";
			$user->favori($co);
			echo "</ul>";
			echo "<a href='../control/c_deconnection.php'>Deconnecter </a>";
			//afficher la liste de favori 
			
			mysqli_close($co);
		}
		else{
			echo "vous n'avez pas <a href='../index.php'>connecter </a>";
		}
	?>
	
	</div>

</body>
</html>