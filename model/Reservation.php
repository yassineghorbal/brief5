<?php

require_once "Connection.php";

class Reservation{
	private $table="tickets";
	function __construct()
	{
	}

	public function search($departSearch, $arriveeSearch)
	{
		$ctn = new Connection();
		$str="SELECT * FROM voyages WHERE depart = '$departSearch' AND arrivee = '$arriveeSearch'";
		$query = $ctn->prepare($str);

		$query->execute();
		$row = $query->fetch(PDO::FETCH_ASSOC);

		if($departSearch == $row['depart'] && $arriveeSearch == $row['arrivee'])
		{
			return $row;
		}else{
			header('Location: http://localhost/trainline/home');
		}
	}
	
	public function view($id)
	{
		
		$ctn = new Connection();
		if(isset($_POST['view']))
		{
			return $ctn->selectOne("voyages", $id);
			// return $ctn->selectOne("users",$_SESSION['id']);
		}
	}

	public function book($idUser, $id)
	{
		$ctn = new Connection();
		if(isset($_SESSION['id']) && isset($_POST['book']))
		{
			$ctn->insert($this->table, ["idUser", "idVoyage"], [$idUser, $id]);
		}
	}

	public function voyages($idUser)
	{
		$idUser = $_SESSION['id'];

		$ctn = new Connection();
		// $str="SELECT voyages.dateDepart, voyages.dateArrivee, voyages.depart, voyages.arrivee, voyages.prix FROM voyages INNER JOIN users ON users.id = tickets.idUser;";
		$str = "SELECT * FROM tickets 
		INNER JOIN voyages
		ON tickets.idVoyage = voyages.id
		INNER JOIN users
		ON tickets.idUser = users.id
		WHERE users.id = $idUser";
		$query = $ctn->prepare($str);

		$query->execute();
		$row = $query->fetch(PDO::FETCH_ASSOC);

		if(count($row) > 0){
			return $row;
		}else{
			echo "réserver un voyage pour le voir ici";
		}
	}

}
