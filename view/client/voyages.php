<?php
// session_start();
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

    <title>Trainline | Tickets</title>
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
                        <?php $idUser =  $_SESSION['id']; ?>
                        <li class="nav-item">
                            <a href='http://localhost/trainline/home/profile/<?= $idUser ?>' class="nav-link mx-1"><?= ucfirst($_SESSION['nom']) ?></a>
                        </li>
                        <li class="nav-item">
                            <a href="http://localhost/trainline/reservation/voyages/<?= $idUser ?>" class="nav-link mx-1">Mes voyages</a>
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


    <h1 class="text-center mb-5">Voyages Réservés</h1>
    <div class="container mb-5">
        <?php 
            $array = array($result);
            // echo '<pre>';
            // print_r($array);
        ?>
        
        <?php foreach ($array as $row): ?>
                <?php foreach ($row as $ticket): ?>
                            <div class="card text-center mb-3 mx-auto bg-dark" style="width: 50%;">
                                <div class="card-body text-light">
                                    <?php 
                                    date_default_timezone_set('Africa/Casablanca');
                                    $date = date('Y-m-d H:i:s', time());
                                    $time = strtotime($ticket['dateDepart'])  - strtotime($date);
                                    ?>
                                    <h4 class="card-title"><?= ucfirst($ticket['depart']); ?> <i class="bi bi-arrow-right"></i> <?= ucfirst($ticket['arrivee']); ?></h4>
                                    <h6><?= $ticket['prix']; ?> DH</h6>
                                    <p class="card-text"><?= date("D, d M Y H:i", strtotime($ticket['dateDepart'])); ?> <i class="bi bi-arrow-right"></i> <?= date("D, d M Y H:i", strtotime($ticket['dateArrivee'])); ?></p>
                                    
                                        <?php if($ticket['canceledticket'] == 0 && $time > 3600) { ?>
                                            <form action='http://localhost/trainline/reservation/cancel/<?= $ticket['idTicket'] ?>' method="POST">
                                            <button type="submit" name="cancel" class="btn btn-danger">Annuler</button>
                                            </form>
                                        <?php } elseif($ticket['canceledticket'] == 0 && $time < 3600) { ?>
                                            <p class="text-danger">
                                                Voyage est Passé
                                            </p>
                                        
                                        <?php } elseif($ticket['canceledticket'] == 1 && $time < 3600) { ?>
                                            <p class="text-danger">
                                                Ticket est Annulé<br>
                                                Voyage est Passé
                                            </p>
                                        <?php } else { ?>
                                            <p class="text-danger">
                                                Ticket est Annulé 
                                            </p>
                                        <?php } ?>
                                </div>        
                            </div>
                <?php endforeach; ?>
        <?php endforeach; ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</body>

</html>