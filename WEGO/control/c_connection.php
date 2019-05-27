<?php

require_once("../model/bd.php");
require_once("../model/user.php");
if(isset($_POST["login"])&&isset($_POST["password"])){
    $login = $_POST["login"];
    $password = $_POST["password"];

    $coBd = new Bd("wego");
    $co = $coBd -> connexion();
    $user = new User($login,null,null,$password);
    $user->connection($co);

}
else{
    echo "<script>alert('renpilir tous les trous SVP')</script>
			<a href = '../index.php'> retoure </a> 
		";
}
?>
