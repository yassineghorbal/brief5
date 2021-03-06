<?php

// Done (backend) modifications to be made in (frontend)

require_once "Connection.php";


class Admin
{
	private $table="voyages";      
	private $dateDepart;
	private $dateArrivee;
	private $prix;
	private $depart;
	private $arrivee;
	private $places;      
	function __construct($dateDepart,$dateArrivee,$prix,$depart,$arrivee,$places)
	{
		$this->dateDepart=$dateDepart;
		$this->dateArrivee=$dateArrivee;
		$this->prix=$prix;
		$this->depart=$depart;
		$this->arrivee=$arrivee;
		$this->places=$places;
	}


	public function save()
	{
		$ctn=new Connection();
		$ctn->insert($this->table,["dateDepart","dateArrivee","prix","depart","arrivee","places"],[$this->dateDepart,$this->dateArrivee,$this->prix,$this->depart,$this->arrivee,$this->places]);
	}

	public static function select()
	{
		$ctn=new Connection();
		$str = "SELECT * FROM voyages ORDER BY dateDepart";
		$query = $ctn->prepare($str);

		$query->execute();
		$row = $query->fetchAll();

		if($row){
			return $row;
		}else{
			echo 'no trips';
		}
	}

	public static function delete($id)
	{
		$ctn=new Connection();
		$str = "UPDATE `voyages` SET `canceled`='1' WHERE id = $id";
		$query = $ctn->prepare($str);

		$query->execute();
	}

	public static function undo($id)
	{
		$ctn=new Connection();
		$str = "UPDATE `voyages` SET `canceled`='0' WHERE id = $id";
		$query = $ctn->prepare($str);

		$query->execute();
	}


	public static function edit($id)
	{
		$ctn=new Connection();
		return $ctn->selectOne("voyages",$id);
	}

	public function update($id)
	{
		$ctn=new Connection();
		$ctn->update($this->table,["dateDepart","dateArrivee","prix","depart","arrivee","places"],[$this->dateDepart,$this->dateArrivee,$this->prix,$this->depart,$this->arrivee,$this->places],$id);
	}
}
