<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../Classes/crud.php";
$taches = new Crud();

if (isset($_POST['submit'])) {

  $noms = trim($_POST['noms']);
  $grade = trim($_POST['grade']);
  $sexe = trim($_POST['sexe']);
  $adresse = trim($_POST['adresse']);
  $telephone = trim($_POST['telephone']);
  $domaine = trim($_POST['domaine']);

  if (
    !empty($_POST['noms']) || !empty($_POST['grade']) || !empty($_POST['sexe'])
    || !empty($_POST['adresse']) || !empty($_POST['telephone']) || !empty($_POST['doamine'])
  ) {
    $sql = "INSERT INTO enseignants(noms,grade,sexe,adresse,telephone,domaine)
        VALUES('$noms','$grade','$sexe','$adresse','$telephone','$domaine')";
    $taches->insert2($sql);
  }
}


if(isset($_GET['delete'])){
    $id=$_GET['id'];
    $taches->deletedata('enseignants','code_enseignants',$id);
    echo("Suppression");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Styles/style.css">
  <link rel="stylesheet" href="../Styles/styleII.css">

  <link rel="stylesheet" href="../font/font-awesome-4.7.0/css/font-awesome.min.css">
  <title>Enseignant</title>
</head>

<body>
  <?php include('./static/header.php') ?>
  <main id="main">
    <?php include("./static/sidebar.php") ?>
    <section id="principal">
      <?php include("./static/topcard.php") ?>
      <div class="tableau">
        <div>
          <div class="container-form">
            <form action="" class="form">
              <input type="text" class="text" id="search" autocomplete="off">
              <input type="date" name="" id="date">
              <select name="" id="" class="combobox">
                <option value="">Tout</option>
                <option value="">Par Domaine</option>
                <option value="">Homme</option>
                <option value="">Femme</option>

              </select>
              <button class="btne">Exporter F Excel</button>
              <button class="btni">Importer F Excel</button>
              <button class="btnim modal-btn modal-trigger">Nouveau</button>
            </form>
          </div>
          <table class="tableau-style">
            <thead>
              <tr>
                <th>N°</th>
                <th>Noms</th>
                <th>Sexe</th>
                <th>Grade</th>
                <th>Domaine</th>
                <th>Adresse</th>
                <th>Telephone</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
             
              $result = $taches->selectalldata("enseignants");
              
              while ($data = $result->fetch()) {
               
              ?>

                <tr>
                  <td><?php $id?></td>
                  <td><?php echo $data['noms']; ?></td>
                  <td><?php echo $data['sexe']; ?></td>
                  <td><?php echo $data['grade']; ?></td>
                  <td><?php echo $data['domaine']; ?></td>
                  <td><?php echo $data['adresse']; ?></td>
                  <td><?php echo $data['telephone']; ?></td>
                  <td>
                    <a  href="Enseignants.php?id=<?php echo $data['code_enseignants']; ?>" name="update" class="btne">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a  href="Enseignants.php?id=<?php echo $data['code_enseignants']; ?>" name="delete" class="btni">
                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
              <?php } ?>


            </tbody>
          </table>
        </div>
      </div>
      <div class="container_card2">
        <div class="card2"></div>
        <div class="card2"></div>
      </div>
    </section>
  </main>

  <!-- Fenetre modal pour l'enregistrement -->
  <div class="modal-container">
    <div class="overlay modal-trigger1">
    </div>
    <div class="modal">
      <span class="close-modal modal-trigger">X</span>
      <h3>MODIFICATION ENSEIGNANT</h3>
      <form action="../pages/Enseignants.php" method="POST" class="form-control">
        <input type="text" name="noms" id="" class="inputs" placeholder="noms de l'enseignant">
        <input type="text" name="grade" id="" class="inputs" placeholder="grade">
        <select name="sexe" id="" class="inputs">
          <option value="" class="inputs">Selectionner le sexe...</option>
          <option value="Homme" class="inputs">Homme</option>
          <option value="Femme" class="inputs">Femme</option>
        </select>

        <input type="text" name="adresse" id="" class="inputs" placeholder="adresse">
        <input type="text" name="telephone" id="" class="inputs" placeholder="telephone">
        <input type="text" name="domaine" id="" class="inputs">
        <input type="submit" name="submit" id="" class="inputs" value="ENREGISTRER" placeholder="domaine">
      </form>
    </div>
  </div>


  <!-- POUR LA MODIFICATION DE L'ENSEIGNANT -->
    <div class="modals" id="modals">
      <div class="modalContainer">
             <form action="">
                <input type="text" name="" id="">
                <input type="text" name="" id="">
                <input type="text" name="" id="">
             </form>   
      </div>
      <div class="modal_buttons">
          <button class="btn-secondary" id="modal-skip">Annuler</button>
          <button type="submit" name="modifier" class="btna btnm">Modifier</button>
      </div>
    </div>
  </div>
</body>
<script src="../Classes/Javascript/modal.js"></script>

</html>