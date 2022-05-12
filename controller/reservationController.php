<?php

require_once __DIR__."/../model/Reservation.php";

class ReservationController
{
	
	public function __construct()
	{
	}

	public function search()
	{
		unset($_SESSION['not_found']);
		$reservation = new Reservation();
		$depart = $_POST['depart'];
		$arrivee = $_POST['arrivee'];
		$result = $reservation->search($depart, $arrivee);
		// print_r($result);
		if(count($result) == 0)
		{
			$_SESSION['not_found'] = true;
			echo "<center class='alert alert-danger' role='alert'><div>
					<h4>Voyage n'est Pas Disponible Pour Le Moment</h4>
					</div></center>";
			require_once __DIR__."/../view/index.php";
		}else{
			session_start();
			require_once __DIR__."/../view/client/search.php";
		}
	}

	public function view($id)
	{
		$reservation = new Reservation();
		session_start();
		if(isset($_SESSION['id']))
		{
			$voyage = $reservation->view($id);
			require_once __DIR__."/../view/client/view.php";
		}else{
			$voyage = $reservation->view($id);
			require_once __DIR__."/../view/client/signup.php";
		}
	}

	public function book($id)
	{
		session_start();
		$idUser = $_SESSION['id'];

		$reservation = new Reservation();

		$reservation->book($idUser, $id);

		header("location: http://localhost/trainline/reservation/voyages/$idUser");
	}

	public function voyages($idUser)
	{
		$reservation = new Reservation();
		session_start();
		$idUser = $_SESSION['id'];

		if(isset($_SESSION['id'])){

		$result = $reservation->voyages($idUser);
		// print_r($result);
		if($result)
		{
			require_once __DIR__."/../view/client/voyages.php";
		}else{
			// echo "<center class='alert alert-danger' role='alert'><div>
			// <h4>Réserver un Ticket pour le voir Ici!</h4>
			// </div></center>";
			require_once __DIR__."/../view/client/voyages.php";
		}
		}
	}

	public function cancel($id)
	{
		unset($_SESSION['canceled']);
		$reservation = new Reservation();

		$reservation->cancel($id);
		require_once __DIR__."/../view/index.php";
	}

	// public function guest_view()
	// { 
	// 	$reservation = new Reservation();

	// 	if(isset($_POST['view']))
	// 	$reservation->guest_view();

	// 	require_once __DIR__.'../view/client/guest_book.php';
	// }

	// public function guest_book($id)
	// { 
		
	// 	$reservation = new Reservation();

		
	// 	// $idUser = $result['id'];
		
	// 	$reservation->guest_book($id);

	// 	header("location: http://localhost/trainline/home");
	// }
}