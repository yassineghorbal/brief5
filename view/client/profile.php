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

    <title>Trainline | Profile</title>
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
                            <a href='#' class='nav-link mx-1'><?= ucfirst($_SESSION['nom']) ?></a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/trainline/reservation/voyages/<?= $id ?>" class="nav-link mx-1">Mes voyages</a>
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


    <!-- personal info -->
    
    <div class="container-lg">
    <h1 class="text-center mb-5">Informations Personnelles</h1>
		<form action="">
				<div class="col-md w-50 mx-auto">
					<label class="form-label">nom</label>
					<input type="text" class="form-control" name="nom" value="<?=$user['nom']?>" readonly><br>
					<label class="form-label">prenom</label>
					<input type="text" class="form-control" name="prenom" value="<?=$user['prenom']?>" readonly><br>
					<label class="form-label">telephone</label>
					<input type="tel" class="form-control" name="telephone" value="<?=$user['telephone']?>" readonly><br>
					<label class="form-label">email</label>
					<input type="email" class="form-control" name="email" value="<?=$user['email']?>" readonly><br>
                    <?php $id =  $_SESSION['id']; ?>
                    <a href='http://localhost/trainline/home/edit/<?= $id ?>' class='btn btn-primary'>Modifier profile</a>
				</div>
			
		</form>
	</div>





        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"></script>


</body>

</html>