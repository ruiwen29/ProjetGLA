
<?php

	function delByValue($arr, $value){
	if(!is_array($arr)){
		return $arr;
	}
	foreach($arr as $k=>$v){
		if($v == $value){
			//unset($arr[$k]);
			array_splice($arr,$k,1);   
			}
	}
	return $arr;
}

?>