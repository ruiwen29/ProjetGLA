<?php
Class Bd{
	private $co;
	private $host; // ou 127.0.0.1
	private $user;
	private $bdd; // le nom de votre base de données
	private $passwd;
	public function __construct($bdd){
		$this -> host = "127.0.0.1";
		$this -> user = "root";
		$this -> bdd = $bdd;
		$this -> passwd = "960124aa";
	}
	public function connexion(){
		$this -> co = mysqli_connect($this -> host, $this -> user, $this -> passwd, $this -> bdd) or die ("erreur de connection");
		return $this -> co;
	}
	public function deconnexion(){
		mysqli_close($this -> co);
	}
}
?>