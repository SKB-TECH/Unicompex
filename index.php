<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./node_modules//sweetalert2/dist/sweetalert2.min.css">
  <script src="./node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./node_modules/jquery/dist/jquery.js"></script>
  <link rel="stylesheet" href="./node_modules/datatables.net-dt/css/jquery.dataTables.min.css">
  <script src="./node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="./node_modules/popper.js/dist/popper.js"></script>
  <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./font/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./style.css">

  <title>Bienvenu</title>
</head>

<body>
  <?php
  require_once('./pages/Menus/Navbar.php');
  ?>
  <div id="sousmenu">
    <div class="gauche">
      <div>
        <h1 class="entreprise">
          Unicompex
        </h1>
        <p>
          Nous mettons la satisfaction de nos client avant toute autre chose en leurs fournissant </br>
          un ttravail de qualite et appreciable
        </p>

        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
          Connectez-vous
        </button>
      </div>
    </div>
    <div class="droite">
      <div class="imgs">
        <img src="./assets/images/image1.png" alt="">
      </div>
    </div>
  </div>
  <div class="title">
    <h2 style="text-align: center; font-weight:400;">
      Nos Services
    </h2>
  </div>
  <div class="cards" style="margin-bottom: 50px;">
    <div class="card ">
      <div class="container">
        <h4><b>Entretien</b></h4>
        <img src="./assets/images/entretien.png" alt="" class="imgCard">
        <p style="padding: 2px;">
          services d'entretiens des antennes
          de telecommunication
        </p>
      </div>
    </div>

    <div class="card ">
      <div class="container">
        <h4><b>Ventes</b></h4>
        <img src="./assets/images/groupes.png" alt="" class="imgCard">
        <p style="padding: 2px;">
          Nous vendons des groupes electrogene de bonne qualites
        </p>
      </div>
    </div>

    <div class="card">
      <div class="container">
        <h4><b>Reparation</b></h4>
        <img src="./assets/images/reparation.png" alt="" class="imgCard">
        <p style="padding: 2px;">
          Nous offrons le services de reparations
        </p>
      </div>
    </div>

    <div class="card ">
      <div class="container">
        <h4><b>Maintenances</b></h4>
        <img src="./assets/images/res.png" alt="" class="imgCard">
        <p style="padding: 2px;">
          Nous offrons le services de maintenance reseaux
        </p>
      </div>
    </div>

  </div>

  <div>
    <h1 style="text-align: center; font-weight:400;">AVEC DES TECHNICIENS SPECIALISES</h1>
  </div>
  <!-- Debut Carousel -->
  <div id="carouselExampleCaptions" class="carousel slide mt-30" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./assets/images/reseaux.png" class="d-block w-100" alt="img">
      </div>
      <div class="carousel-item">
        <img src="./assets/images/groupes.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./assets/images/entretien.png" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </button>
  </div>
  <!-- Fin Carousel -->

  <!-- Fenetre Modal -->
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <h4>Authentification</h4>
          <form action="index.php" method="POST">
            <input type="text" name="" id="" class="form-control"> <br>
            <input type="text" name="" id="" class="form-control"><br>
            <button class="btn btn-primary bg-lg form-control">Connexion</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        </div>
      </div>

    </div>
  </div>
  <script src=""></script>
</body>

</html>