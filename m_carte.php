
<?php
include 'tools.php';

	Class carte{
	public $arr; //stocké en $arr
	


 	public function __construct($fichier) // 文件路径
    { 

  
	$xml = file_get_contents($fichier);
	$objectxml = simplexml_load_string($xml);//将文件转换成 对象
	$xmljson= json_encode($objectxml );//将对象转换个JSON
	$xmlarray=json_decode($xmljson,true);//将json转换成数组
	$this->arr=$xmlarray ;
	
  
       
    } 
	public function getCarte(){
		return  $this->arr;

	}  


}




?>
