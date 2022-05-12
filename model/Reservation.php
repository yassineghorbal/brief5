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
		$str= "SELECT * FROM voyages WHERE depart = '$departSearch' AND arrivee = '$arriveeSearch' AND canceled = 0 AND places > 0 AND dateDepart > CURRENT_TIMESTAMP ORDER BY dateDepart";
		
		$query = $ctn->prepare($str);

		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function view($id)
	{
		$ctn = new Connection();
		if(isset($_POST['view']))
		{
			return $ctn->selectOne("voyages", $id);
		}
	}

	public function book($idUser, $id)
	{
		$ctn = new Connection();
		if(isset($_SESSION['id']) && isset($_POST['book']))
		{
			$ctn->insert($this->table, ["idUser", "idVoyage"], [$idUser, $id]);

			$str = "UPDATE voyages SET places = (places-1) WHERE id = $id";
			$query = $ctn->prepare($str);
			$query->execute();
		}
	}

	
	public function voyages($idUser)
	{
		$idUser = $_SESSION['id'];

		$ctn = new Connection();
		
		$str = "SELECT * FROM tickets
		INNER JOIN voyages
		ON tickets.idVoyage = voyages.id
		INNER JOIN users
		ON tickets.idUser = users.id
		WHERE users.id = $idUser and voyages.canceled = '0'
		ORDER BY dateDepart";
		$query = $ctn->prepare($str);
		
		$query->execute();
		$row = $query->fetchAll();
		
		if($row){
			return $row;
		}else{
			return false;
		}

	}
	
	public function cancel($idTicket)
	{
		
		$ctn = new Connection();
		if(isset($_POST['cancel']))
		{
			$str1 = "UPDATE tickets SET canceledticket = 1 WHERE idTicket = $idTicket";
			$query1 = $ctn->prepare($str1);
			$query1->execute();
		}else{
			echo "nnn";
		}
	}

	// public function guest_view()
	// {
	// 	$ctn = new Connection();
	// 	if(isset($_POST['guest_view'])){
			
	// 		$nom=$_POST['guest_nom'];
	// 		$prenom=$_POST['guest_prenom'];
	// 		$telephone=$_POST['guest_telephone'];
	// 		$email=$_POST['guest_email'];
	// 		$str = "INSERT INTO users (nom, prenom, telephone, email, password) VALUES ('$nom', '$prenom', '$telephone', '$email', 'nopassword')";

	// 		$query = $ctn->prepare($str);
	// 		$query->execute();
	// 		echo "executed1";
	// 	}
	// }

	// public function guest_book($id)
	// {
	// 	$ctn = new Connection();
	// 	if(isset($_POST['guest_book'])){

	// 		$email=$_POST['guest_email'];
			
	// 		$str = "SELECT * FROM `users` WHERE email = $email";
			
	// 		$query = $ctn->prepare($str);
	// 		$query->execute();
	// 		echo "executed2";
			
	// 		$row = $query->fetch(PDO::FETCH_ASSOC);
	// 		$result = array($row);
	// 		return $result;

	// 		echo $row['id'];
			
	// 		$ctn->insert($this->table, ["idUser", "idVoyage"], [$result['id'], $id]);
	// 		echo "executed3";
	// 	}
	// }
}
