<?php
Class User
{
    private $id;
    private $login;
	private $nom;
	private $mail;
    private $password;

	function __construct() 
    { 
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    } 
    
    function __construct1($id)
    {
        $this->id=$id ;
    }
   
    function __construct4($login,$nom,$mail, $password)
    {	
        $this->login=$login ;
		$this->nom=$nom;
		$this->mail=$mail;
        $this->password = $password;
    }
    

    public function connection($co)
    {   
        $password = $this->password;
        $login = $this->login;
        $requete = "SELECT * FROM `user` WHERE nom = '$login' or mail = '$login' AND passeword = '$password'";
        $result = mysqli_query($co, $requete) or die ("Erreur:Execution de la requete impossible1:" . mysqli_error($co));

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $this->id = $row["id_user"];
			session_start();
			$_SESSION['id']=$row["id_user"];
            header('location:../view/v_accuille.php');

        } else {
			echo  '$login = '.$login;
            echo "<script>alert('login ou mot de passe incorrect')</script>
                    <a href = '../index.php'> retoure </a> ";
           // header('location:../index.php');
        }
    }

    public function ajouter($co)
    {
        $this->co = $co;
        $nom = $this->nom;
		$mail = $this->mail;
        $password = $this->password;
		//INSERT INTO `user` (`id_user`, `nom`, `mail`, `passeword`, `id_type_TypeUser`, `id_coord`) VALUES (NULL, 'toto', 'toto@gmail.com', 'toto', '2', NULL);
        $requete = "INSERT INTO `user` (`id_user`, `nom`, `mail`, `passeword`, `id_type_TypeUser`, `id_coord`) VALUES (NULL, '$nom', '$mail', '$password', '2', NULL);";
        mysqli_query($co, $requete) or die ("Erreur:Execution de la requete impossible1:" . mysqli_error($co));
    }

	public function favori ($co)
	{
		$this->co = $co;
		$id = $this->id;
		$requete = "SELECT * FROM `trajetfavori` WHERE id_user = '$id'";
        $result = mysqli_query($co, $requete) or die ("Erreur:Execution de la requete impossible1:" . mysqli_error($co));
		if (mysqli_num_rows($result) <= 0) {
			echo "<li>vous n'a pas de favori</li>";
		}
		else {
			
			$row  =  mysqli_fetch_assoc($result);
			$adr  = $row['Trajet'];
			echo "<li><a href = '../view/v_trajet.php?adr=$adr' >".$adr ."</a>  <a href = '../control/c_supprimer.php?adr=$adr' > Supprimer</a></li>";
			//echo "<li>".$adr ."</li>";
		
			
		}
    		
	}
	
	public function ajoute_favori ($co ,$t){
		$id = $this->id;
		$requete = "INSERT INTO `trajetfavori` (`id_trajet`, `Trajet`, `id_user`) VALUES (NULL, '$t', '$id');";
        $result = mysqli_query($co, $requete) or die ("Erreur:Execution de la requete impossible1:" . mysqli_error($co));
	     	
	}
	
	public function supprimer_favori ($co ,$t){;
		$id = $this->id;
		$requete = "DELETE FROM `trajetfavori` WHERE  id_user = '$id' and Trajet = '$t';";
        $result = mysqli_query($co, $requete) or die ("Erreur:Execution de la requete impossible1:" . mysqli_error($co));
	     	
	}
}
?>
