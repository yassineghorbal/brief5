<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <style>
        body::before {
            display: block;
            content: '';
            height: 100px;
        }
    </style>

    <title>trainline.ma</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 fixed-top">
        <div class="container">
            <a href="http://localhost/trainline/home" class="navbar-brand h1">Trainline</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['id'])) : ?>

                        <li class="nav-item">
                            <a href='#' class='nav-link mx-1'><?= $_SESSION['nom'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/trainline/home/voyages" class="nav-link mx-1">Mes voyages</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/trainline/login/logout" class="nav-link mx-1">Se deconnecter</a>
                        </li>

                    <?php else : ?>
                        <li class="nav-item">
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/trainline/login" class="nav-link mx-1" class="nav-link mx-1">Se connecter<i class="bi bi-box-arrow-in-right"></i></a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/trainline/signup" class="nav-link mx-1">S'inscrire<i class="bi bi-person"></i></a>
                        </li>

                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- trip info -->

    <h3 class="text-center mb-3 p-3">Informations de voyage selectionné</h3>

	<div class="container">
		<form action="http://localhost/trainline/reservation/book/<?= $voyage['id'] ?>" method="POST">
			<div class="row">
				<div class="col-md">
					<label class="form-label">date de depart</label>
					<input type="text" class="form-control" name="dateDepart" value="<?=$voyage['dateDepart']?>" readonly><br>
					<label class="form-label">date d'arrivee</label>
					<input type="text" class="form-control" name="dateArrivee" value="<?=$voyage['dateArrivee']?>" readonly><br>
					<label class="form-label">prix</label>
					<input type="number" class="form-control" name="prix" value="<?=$voyage['prix']?>" readonly><br>
				</div>
				<div class="col-md">
					<label class="form-label">gare de depart</label>
					<input type="text" class="form-control" name="depart" value="<?=$voyage['depart']?>" readonly><br>
					<label class="form-label">gare d'arrivee</label>
					<input type="text" class="form-control" name="arrivee" value="<?=$voyage['arrivee']?>" readonly><br>
				</div>
			</div>
            <button name="book" type="submit" class="btn btn-success">Réserver</button>
		</form>
	</div>

    <!-- personal info
    <div class="container-lg">
    <h3 class="text-center mb-5">Informations Personnelles</h3>
		<form action="">
				<div class="col-md w-50 mx-auto">
					<label class="form-label">nom</label>
					<input type="text" class="form-control" name="nom" value="<?=$user['nom']?>" readonly><br>
					<label class="form-label">prenom</label>
					<input type="text" class="form-control" name="prenom" value="<?=$user['prenom']?>" readonly><br>
					<label class="form-label">telephone</label>
					<input type="phone" class="form-control" name="telephone" value="<?=$user['telephone']?>" readonly><br>
					<label class="form-label">email</label>
					<input type="email" class="form-control" name="email" value="<?=$user['email']?>" readonly><br>
                    <?php $id =  $_SESSION['id']; ?>
				</div>
		</form>
	</div> -->


        <!-- Footer -->
        <footer class="p-5 mt-2 bg-light text-center position-relative">
            <div class="container">



                <p class="lead">Copyright &copy; 2021 trainline.ma</p>
                <div class="p-1">
                    <a href="#" class="text-decoration-none">
                        <i class="bi bi-facebook h3 m-1"></i>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <i class="bi bi-instagram h3 m-1"></i>
                    </a>
                    <a href="#" class="text-decoration-none">
                        <i class="bi bi-twitter h3 m-1"></i>
                    </a>

                </div>

                <a href="#" class="position-absolute bottom-0 end-0 p-5">
                    <i class="bi bi-arrow-up-circle h1"></i>
                </a>
            </div>
        </footer>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"></script>


</body>

</html>