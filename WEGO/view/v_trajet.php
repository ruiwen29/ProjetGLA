<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trajet</title>
	<link rel="stylesheet" type="text/css" href="../style/style.css" />
	<link rel="icon" href="../style/logo.ico" type="image/x-icon">
	<link rel="shortcut icon" href="../style/logo.ico" type="image/x-icon">
</head>
<body>
	 <div class = "trajetfinal">
		<a href = "../view/v_accuille.php">
		<img class = "smallImage" src = "../style/logoWego.jpg"/>
		</a>
   <h1> Le carte de trajet de votre choix </h1>
			<div class = "canvas">
			<canvas id = "carte" width ="1600px" height = "900px" style = "border:1px solid #000000; background-color:#AAFFA0">
			</canvas>
			</div>
			
	<script type = "text/javascript">
	function getQueryString(name) {  
		location.href.replace("#","");  
		// 如果链接没有参数，或者链接中不存在我们要获取的参数，直接返回空       
		if(location.href.indexOf("?")==-1 || location.href.indexOf(name+'=')==-1)     {          
		   return '';      
		}        
		// 获取链接中参数部分       
		var queryString = location.href.substring(location.href.indexOf("?")+1);        
		// 分离参数对 ?key=value&key2=value2       
		var parameters = queryString.split("&");        
		  
		var pos, paraName, paraValue;       
		for(var i=0; i<=parameters.length; i++) {  
		   // 获取等号位置           
		   pos = parameters[i].split('=');           
		   if(pos == -1) { continue; }            
		   // 获取name 和 value           
		   paraName = pos[0];           
		   paraValue = pos[1];           
		   // 如果查询的name等于当前name，就返回当前值，同时，将链接中的+号还原成空格          
		   if(paraName == name) {       
			return decodeURIComponent(paraValue.replace(/\+/g, " "));           
		   }       
		}       
		return '';   
	}   
	/*Affiche la carte de base*/
	var c = document.getElementById("carte");
	var context = c.getContext("2d");

	context.fillStyle = "#0055FF";
	
	if (window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.open("GET","../Cartes/Carte_2.xml",false);
	xmlhttp.send();
	xmlDoc = xmlhttp.responseXML;
	
	var v = xmlDoc.getElementsByTagName("ville");
	var r = xmlDoc.getElementsByTagName("route");
	
	for (i = 0;i<r.length;i++){
		var rn = r[i].getElementsByTagName("nom")[0].childNodes[0].nodeValue;
		var tr = r[i].getElementsByTagName("troncon");
		for(j=0;j<tr.length;j++){
			var villedebut = tr[j].getElementsByTagName("ville1")[0].childNodes[0].nodeValue;
			var villefin = tr[j].getElementsByTagName("ville2")[0].childNodes[0].nodeValue;
			
			for (k = 0;k<v.length;k++){
				for (l = 0; l<v.length;l++){
					if ((villedebut == v[k].getElementsByTagName("nom")[0].childNodes[0].nodeValue)&& (villefin == v[l].getElementsByTagName("nom")[0].childNodes[0].nodeValue))
					{
						var co_debut = v[k].getElementsByTagName("coordonnees");
						for( m = 0;m<co_debut.length;m++){
							var la_debut = co_debut[m].getElementsByTagName("latitude")[0].childNodes[0].nodeValue;
							var lo_debut = co_debut[m].getElementsByTagName("longitude")[0].childNodes[0].nodeValue;
						}
						var co_fin = v[l].getElementsByTagName("coordonnees");
						for( m = 0;m<co_fin.length;m++){
							var la_fin = co_fin[m].getElementsByTagName("latitude")[0].childNodes[0].nodeValue;
							var lo_fin = co_fin[m].getElementsByTagName("longitude")[0].childNodes[0].nodeValue;
						}
					}
					context.beginPath();
					context.strokeStyle = "#FBFED8";
					context.lineWidth = 5;					
					context.moveTo(340*(la_debut-25),220*(lo_debut-25));
					context.lineTo(340*(la_fin-25),220*(lo_fin-25));
					context.stroke();
					context.closePath();
				}
			}
			
		}
	}
	
	for (i = 0;i<v.length;i++){
		var n = v[i].getElementsByTagName("nom")[0].childNodes[0].nodeValue;
		var co = v[i].getElementsByTagName("coordonnees");
		
		for( j = 0;j<co.length;j++){
		var la = co[j].getElementsByTagName("latitude")[0].childNodes[0].nodeValue;
		var lo = co[j].getElementsByTagName("longitude")[0].childNodes[0].nodeValue;
		
		context.beginPath();
		context.fillStyle = "#0055FF";
		context.fillText(n,340*(la-25),220*(lo-25)-15);
		context.arc(340*(la-25),220*(lo-25),10,0,Math.PI*2,true);
		context.fill();	
		context.closePath();
		}
	}

	
	
	/*Affiche le trajet */

	if (window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	//xmlhttp.open("GET","../trajets/Carte_exemple_2_resultat.xml",false);
	var adr = getQueryString('adr');
	//document.write(adr);	
	xmlhttp.open("GET",adr,false);
	
	xmlhttp.send();
	xmlDoc = xmlhttp.responseXML;

	var etape = xmlDoc.getElementsByTagName("etape");
	var el = etape.length;
	
	for(i=0;i<etape.length;i++){
		var ed = etape[i].getElementsByTagName("destination")[0].childNodes[0].nodeValue;
		for(j = 0;j<v.length;j++)
		{
			if(ed == v[j].getElementsByTagName("nom")[0].childNodes[0].nodeValue)
			{
				var coo = v[j].getElementsByTagName("coordonnees");
				for (l = 0;l<coo.length;l++)
				{
					var coo_la = coo[l].getElementsByTagName("latitude")[0].childNodes[0].nodeValue;
					var coo_lo = coo[l].getElementsByTagName("longitude")[0].childNodes[0].nodeValue;
					context.beginPath();
					context.fillStyle = "#C0392B";
					context.fillText(ed,340*(coo_la-25),220*(coo_lo-25)-15);
					context.arc(340*(coo_la-25),220*(coo_lo-25),10,0,Math.PI*2,true);
					context.fill();
					context.closePath();
				}
			}
		}
	}
	
	var start = xmlDoc.getElementsByTagName("ville-depart")[0].childNodes[0].nodeValue;
	
	for(j = 0;j<v.length;j++)
	{
		if(start == v[j].getElementsByTagName("nom")[0].childNodes[0].nodeValue)
		{
			var coo = v[j].getElementsByTagName("coordonnees");
			for (l = 0;l<coo.length;l++)
			{
				var start_la = coo[l].getElementsByTagName("latitude")[0].childNodes[0].nodeValue;
				var start_lo = coo[l].getElementsByTagName("longitude")[0].childNodes[0].nodeValue;
				
				context.beginPath();
				context.fillStyle = "#C0392B";
				context.fillText(start,340*(start_la-25),220*(start_lo-25)-15);
				context.arc(340*(start_la-25),220*(start_lo-25),10,0,Math.PI*2,true);
				context.fill();
				context.closePath();
			}
		}
	}
	
	var firstStepName = etape[0].getElementsByTagName("destination")[0].childNodes[0].nodeValue;
		for(m = 0;m<v.length;m++)
		{
			if(firstStepName == v[m].getElementsByTagName("nom")[0].childNodes[0].nodeValue)
			{
				var firstStep_co = v[m].getElementsByTagName("coordonnees");
				for (n = 0;n<firstStep_co.length;n++)
				{
					var firstStep_co_la = firstStep_co[n].getElementsByTagName("latitude")[0].childNodes[0].nodeValue;
					var firstStep_co_lo = firstStep_co[n].getElementsByTagName("longitude")[0].childNodes[0].nodeValue;							
				}
			}

		}

	context.beginPath();
	context.strokeStyle = "#C0392B";
	context.lineWidth = 5;	
	context.moveTo(340*(start_la-25),220*(start_lo-25));
	context.lineTo(340*(firstStep_co_la-25),220*(firstStep_co_lo-25));
	context.stroke();
	context.closePath();
	
	var fin = xmlDoc.getElementsByTagName("ville-arrivee")[0].childNodes[0].nodeValue;
	for(j = 0;j<v.length;j++)
	{
		if(fin == v[j].getElementsByTagName("nom")[0].childNodes[0].nodeValue)
		{
			var coo = v[j].getElementsByTagName("coordonnees");
			for (l = 0;l<coo.length;l++)
			{
				var fin_la = coo[l].getElementsByTagName("latitude")[0].childNodes[0].nodeValue;
				var fin_lo = coo[l].getElementsByTagName("longitude")[0].childNodes[0].nodeValue;
				
				context.beginPath();
				context.fillStyle = "#C0392B";
				context.fillText(fin,340*(fin_la-25),220*(fin_lo-25)-15);
				context.arc(340*(fin_la-25),220*(fin_lo-25),10,0,Math.PI*2,true);
				context.fill();
				context.closePath();
			}
		}
	}

	var lastStepName = etape[el-1].getElementsByTagName("destination")[0].childNodes[0].nodeValue;
	for(m = 0;m<v.length;m++)
	{
		if(lastStepName == v[m].getElementsByTagName("nom")[0].childNodes[0].nodeValue)
		{
			var lastStep_co = v[m].getElementsByTagName("coordonnees");
			for (n = 0;n<lastStep_co.length;n++)
			{
				var lastStep_co_la = lastStep_co[n].getElementsByTagName("latitude")[0].childNodes[0].nodeValue;
				var lastStep_co_lo = lastStep_co[n].getElementsByTagName("longitude")[0].childNodes[0].nodeValue;							
			}
		}
	}

	context.beginPath();
	context.strokeStyle = "#C0392B";
	context.lineWidth = 5;	
	context.moveTo(340*(fin_la-25),220*(fin_lo-25));
	context.lineTo(340*(lastStep_co_la-25),220*(lastStep_co_lo-25));
	context.stroke();
	context.closePath();
	
	var latitudes = new Array();
	var longtitudes = new Array();
	for (i=0;i<el;i++){
		var ss = etape[i].getElementsByTagName("destination")[0].childNodes[0].nodeValue;
		for( m = 0;m<v.length;m++)
		{
			if(ss == v[m].getElementsByTagName("nom")[0].childNodes[0].nodeValue)
			{
				var cooo = v[m].getElementsByTagName("coordonnees");
				for (n = 0;n<cooo.length;n++)
				{
					latitudes.push(cooo[n].getElementsByTagName("latitude")[0].childNodes[0].nodeValue);
					longtitudes.push(cooo[n].getElementsByTagName("longitude")[0].childNodes[0].nodeValue);
					
				}
			}
		}
	}
	
	for (i=0;i<el;i++){
		context.beginPath();
		context.strokeStyle = "#C0392B";
		context.lineWidth = 5;	
		context.moveTo(340*(latitudes[i]-25),220*(longtitudes[i]-25));
		context.lineTo(340*(latitudes[i+1]-25),220*(longtitudes[i+1]-25));
		context.stroke();
		context.closePath();
	}
	

	//var routes = new Array();
	var destinations = new Array();
	for (i=0;i<el;i++){
		//routes.push(etape[i].getElementsByTagName("route")[0].childNodes[0].nodeValue);
		destinations.push(etape[i].getElementsByTagName("destination")[0].childNodes[0].nodeValue);
	}
	
	document.write("Ville depart: "+start+"<br/>");
	
	for(i=0;i<el;i++){
		document.write("Etape "+(i+1)+" to destination : "+destinations[i]+"<br/>");
	}
	
	document.write("Ville fin: "+fin+"<br/>");
	
	</script>
    </div>   

</body>
</html>
