<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/search.js"></script>


<!-- 做成多个格子进行recherche然后结果我能勾选 然后进行visualization
 -->

</head>
<body>
<?php
if(isset($_POST['searchId'])or isset($_POST['searchUser']) or isset($_POST['searchMotcle']) or isset($_POST['searchMotcle'])){
$fichier = __DIR__ . "/../data/recordings.json";
$contenu = file_get_contents($fichier);

$arr = (array)json_decode($contenu,true);
// echo 'users : '.$arr['recordings'][0]['user'];
// $time = $arr ['recordings'][0]['date'];
// echo 'time : '.$time;
// $date=strtotime($time); 
// echo 'date : '.$date ;
// $ok = date('Y-m-d',$date);
// echo $ok;

$queries = array();
$ids = array();
$usernames = array();
$dates  = array();
$motcles = array();
//echo $_SERVER['QUERY_STRING'];

$id = $_POST['searchId'];


$id =  str_replace('&','%26',$id);


$date = $_POST['searchDate'];
$motcle = $_POST['searchMotcle'];
$user = $_POST['searchUser'];

$res =  array();

$query_string = 'searchUser='.$user.'&'.'searchId='.$id.'&'.'searchDate='.$date.'&'.'searchMotcle='.$motcle;


//parse_str($_SERVER['QUERY_STRING'], $queries);
parse_str($query_string,$queries);
//var_dump($queries);
parse_str($queries['searchId'],$ids);
parse_str($queries['searchUser'],$usernames);
parse_str($queries['searchDate'],$dates);
parse_str($queries['searchMotcle'],$motcles);



//
$queries2 = array();
parse_str($query_string, $queries2);


// var_dump($queries);
// echo "</br>";

// var_dump($queries2);
// echo "</br>";
  
parse_str($queries['searchId'],$ids);
parse_str($queries['searchUser'],$usernames);
parse_str($queries['searchDate'],$dates);
parse_str($queries['searchMotcle'],$motcles);

// var_dump($ids);
// var_dump($usernames);
// var_dump($dates);
// var_dump($motcles);
// echo array_keys($ids)[0];
// echo array_keys($usernames)[0];
// echo array_keys($dates)[0];
// echo array_keys($motcles)[0];
$valueIds = array_keys($ids);
$valueUsers = array_keys($usernames);
$valueDates = array_keys($dates);
$valueMots = array_keys($motcles);









function idExiste($res,$input){
  foreach ($res as $value) {
    if($value['id']==$input){
      return true;
    }
    }
    return false;
}
// if(!empty($user)){
//       foreach($res['recordings'] as $value)
//         {if($value[user] != $user){
//            $key = array_search($value, $res['recordings']);
//           unset($res['recordings'][$key]);
//         }

//         }
// }
// function searchId($id){ 
//   echo "333";
// if(!empty($id)){

//       foreach($arr['recordings'] as $value)
//           {echo "222";

//           if($value['id'] == $id){
//          // $key = array_search($value, $arr['recordings']);
//          // echo $key;
//           //var_dump($value) ;
//         $res[]  =$value;     

//         }

// }
// }
// }

//var_dump($arr);
foreach($valueIds as $value){
   //searchId($value);
   if(!empty($value)){

      foreach($arr['recordings'] as $rec)
          {//echo "222";

          if($rec['id'] == $value){
         // $key = array_search($value, $arr['recordings']);
         // echo $key;
          //var_dump($value) ;
            if(!idExiste($res,$rec['id'])){
        $res[]  =$rec;     
}
}

}
}
  //echo "11";
}



foreach($valueUsers as $value){
   if(!empty($value)){

      foreach($arr['recordings'] as $rec)
          { 


          if($rec['user'] == $value){
       if(!idExiste($res,$rec['id'])){
        $res[]  =$rec;}}
}
}  
}

//var_dump($valueDates);

foreach($valueDates as $value){

   if(!empty($value)){

      foreach($arr['recordings'] as $rec)
          {
            
            $Firstdate=strtotime($rec['date']); 
            //echo 'date : '.$Firstdate ;
            $ResDate = date('Y-m-d',$Firstdate);
            //echo $ResDate;
          if($ResDate == $value){
  // echo  idExiste($res,$rec['id']);

      if(!idExiste($res,$rec['id'])){
        $res[]  =$rec;}
      }
}}

}  

//var_dump($arr['recordings']);
foreach($valueMots as $value){
   if(!empty($value)){
 echo $valueMots;
      foreach($arr['recordings'] as $rec){ 


            foreach($rec['keyword'] as $keyword){
          if($keyword == $value){
       if(!idExiste($res,$rec['id'])){
        $res[]  =$rec;}}
}
}  
}
}



//echo idExiste($res,"5bfd5efc86bf3"); 

// if(!empty($date)){
//       foreach($res['recordings'] as $value)
//         {if($value[date] != $date){
//            $key = array_search($value, $res['recordings']);
//           unset($res['recordings'][$key]);        }

//         }
// }
// if(!empty($motcle)){
//       foreach($res['recordings'] as $value)
//         {if($value[keyword] != $motcle){
//           $key = array_search($value, $res['recordings']);
//           unset($res['recordings'][$key]);
//         }

//         }
// }

/** print array of res
**/
$i = 0;
foreach($res as $value ){

  echo  '<div> <br> ||   Titre : <#'.$i.' requete> || username= '.$value['user'].'  ||  id = '.$value['id'].' || date = '.$value['date'].'  ||  motcle = ';
  foreach($value['keyword'] as $mot){
    echo "  |   ".$mot."  |  ";
  }
  echo "<input type='checkbox' name='getId' value=".$value['id']."/></br>" ;
  echo '</div>';
  
$i++;
}

// echo 'users : '.$arr['recordings'][0]['user'];
// if ($target == "username"){
//   $record = 0;
// foreach($arr['recordings'] as $value){

//     if($value[user] == $text){
//       echo "<table border='1' width = '400'>";
//       echo"<tr>
//       <th>titre</th>
//     <th>user</th>
//     <th>date</th>
    
//     <th>keyword</th>
//     <th>id</th>
//   </tr>";
//   echo"<tr>";
// echo"<th>"." record#".$record."</th>";
//       echo "<th>".$value[user]."</th>";
     
//       echo "<th>".$value[date]."</th>";
      
    
//       echo "<th>" ;
//       foreach($value[keyword] as $Kvalue){
//          echo "<br>".$Kvalue."</br>";
//       }
//       echo "</th>";
//       echo "<th>";
//       echo $value[id];
//       echo "</th>";
//       echo"</tr>";
//     echo "</table>";
//    echo "<a href='../views/visualizationContent.php/?id=".$value[id]."'><button>visualization</button></a>";

//    $record = $record +1;

//     // test
//   }
//   else{
//     echo "  <script>
// $(function(){

//     alertnodata();
// });
// </script> ";

//   }
// }

// }


// if ($target == "date"){
//   $record = 0;

// foreach($arr['recordings'] as $value){
//   $dateR = $value[date];

//   $dateO = strtotime($dateR);

//   $dateN = date('Y-m-d',$dateO);

//     if($dateN == $text){
//       echo "<table border='1' width = '400'>";
//       echo"<tr>
//        <th>titre</th>
//     <th>user</th>
//     <th>date</th>
    
//     <th>keyword</th>
//     <th>id</th>
//   </tr>";
//   echo"<tr>";
//   echo"<th>"." record#".$record."</th>";
//       echo "<th>".$value[user]."</th>";
     
//       echo "<th>".$value[date]."</th>";
       
      
//       echo "<th>" ;
//       foreach($value[keyword] as $Kvalue){
//          echo "<br>".$Kvalue."</br>";
//       }
//       echo "</th>";
//       echo "<th>";
//       echo $value[id];
//       echo "</th>";
//       echo"</tr>";
//     echo "</table>";


//    echo "<a href='../views/visualizationContent.php/?id=".$value[id]."'><button>visualization</button></a>";
   
//   $record = $record +1;
//   }
// }


// }

// if ($target == "keyword"){
//     $record = 0;

// foreach($arr['recordings'] as $value){
//     foreach($value[keyword]as $Kvalue){
//     if($Kvalue == $text){
//       echo "<table border='1' width = '400'>";
//       echo"<tr>
//         <th>titre</th>
//     <th>user</th>
//     <th>date</th>
    
//     <th>keyword</th>
//     <th>id</th>
//   </tr>";
//   echo"<tr>";
//   echo"<th>"." record#".$record."</th>";
//       echo "<th>".$value[user]."</th>";
     
//       echo "<th>".$value[date]."</th>";
       
      
//       echo "<th>" ;
//       foreach($value[keyword] as $Kvalue){
//          echo "<br>".$Kvalue."</br>";
//       }
//       echo "</th>";
//       echo "<th>";
//       echo $value[id];
//       echo "</th>";
//       echo"</tr>";
//     echo "</table>";

//        echo "<a href='../views/visualizationContent.php/?id=".$value[id]."'><button>visualization</button></a>";
//  $record = $record +1;
//     }
//   }
// }
// }



}
?>





              <form  target ="form"method="POST" action="search.php"  style="margin: 10pt 40pt;">
                
                <br> Search by type</br>

                Username:
          <input type="text" name="searchUser" />
                ID:
          <input type="text" name="searchId" />
                Date:
          <input type="text" name="searchDate" />
                Mot clé:

          <input type="text" name="searchMotcle" />
                 
          <input type="submit"  value="Valide">

          
               </form>

              <iframe id="is_iframe" name="form" style="display:none;"></iframe>
              <input  id = "visualization" type="submit" value="visualization" onclick="visu()" >



            <div>attention  :  date format:yyyy-mm-dd </br>
                si vous avez plusieurs parametres à rechercher veuillez utiliser '&' les séparer </br>
                par example : recherche de a et b -> a&b </div>



</body>
</html>