<?php
Class User
{
    private  $id;
    private $login;
	private $nom;
	private $mail;
    private $password;

    public function __construct($login,$nom,$mail, $password)
    {
        $this->login=$login ;
		$this->nom=$nom ;
		$this->mail=$mail ;
        $this->password = $password;
    }

    public function connection($co)
    {   echo  '1';
        $password = $this->password;
        $login = $this->login;
        $requete = "SELECT * FROM `user` WHERE nom = '$login' or mail = '$login' AND passeword = '$password'";
        $result = mysqli_query($co, $requete) or die ("Erreur:Execution de la requete impossible1:" . mysqli_error($co));

        if (mysqli_num_rows($result) == 1) {
			echo  '2';
            $this->nom = $nom;
			$this->mail = $mail;
            $this->password = $password;
            $row = mysqli_fetch_assoc($result);
            $this->id = $row["id"];
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


}
?>
