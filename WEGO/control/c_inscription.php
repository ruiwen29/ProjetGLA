<?php
    require_once("../model/bd.php");
    require_once("../model/user.php");
    if(isset($_POST["nom"])&&isset($_POST["mail"])&&isset($_POST["password"])&&isset($_POST["password2"])){
        $nom = $_POST["nom"];
		$mail = $_POST["mail"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        if ($password != $password2){
            echo "<script>alert('mot de passe erreur')</script>
                <a href = '../view/inscription.php'> retoure </a> 
            ";
        }
        else{
            $coBd = new Bd("wego");
            $co = $coBd -> connexion();
            $user = new User(null,$nom,$mail,$password);
            $user ->ajouter($co);
            header('location:../index.php');
        }

    }
    else {
        echo "<script>alert('renpilir tous les trous SVP')</script>
                <a href = '../view/inscription.php'> retoure </a> 
            ";
    }
    mysqli_close($co);

?>
