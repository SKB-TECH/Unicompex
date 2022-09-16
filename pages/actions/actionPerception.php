<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../../Classes/crud.php";
$db = new Crud();

if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = "";
    $resultat = $db->selectalldata('eleves');
    if ($res = $db->total('eleves')) {
        $output .= '
            <table class="table table-striped table-sm table-bordered">
                <thead>
                <th>N°</th>
                <th>Noms</th>
                <th>Classe</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>';

        while ($data = $resultat->fetch()) {
            $output .= '
                <tr class="text-center text-secondary">
                <td>' . $data['id'] . '</td>
                <td>' . $data['nom'] . " " . $data['postnom'] . " " . $data['prenom'] . '</td>
                <td>' . $data['classe'] . '</td>
                <td>
                        <a href="#" class="text-success infoBtn" title="Info"  id="' . $data['id'] . '">
                            <i class="fa fa-info-circle fa-lg "> Solde</i>
                        </a>
                </td>
                <td>
                        <a href="#" class="text-primary editBtn" title="Modifier" data-toggle="modal" data-target="#addModal" id="' . $data['id'] . '">
                            <i class="fa fa-dollar fa-lg"> Payer</i>
                        </a>
                </td>
            </tr>';
        }

        $output .= "</tbody></table>";
        echo ($output);
    } else {
        echo "
            <h3 class='text-center text-secondary mt-5'>
                Pas d'informations sur cette recherche !!!
            </h3>";
    }
}

/** Fonction insert dans la bdd */
if (isset($_POST['action']) && $_POST['action'] == "insert") {
    $date_perception = $_POST['date_perception'];
    $montant_percu = $_POST['montant_percu'];
    $idEleve = $_POST['id'];
    $solde = $_POST['solde'];
    $frais = $_POST['frais'];
    $idFrais = $_POST['idFrais'];
    $idUser=1;
    if(!empty(trim($date_perception)) && !empty(trim($date_perception)))
    $sql = "INSERT INTO perception(date_perception,montant_percu,idEleve,idFrais) 
            VALUES ('$date_perception','$montant_percu','$idEleve','$idFrais')";
      if($frais > floatval($montant_percu) + floatval($solde) ){
          if($db->insert2($sql)){
              $res = "reussi";
          }else{
              $res ="echec";    
          }
          
      }else{
     
        $reste = ( floatval($montant_percu) + floatval($solde) ) - floatval($frais);
        $res ="L'élève reste avec le reste de ".$reste."seulement,  reessayer!"; 
      }  
    echo $frais;
}

/** Fonction info plus de la table  eleves*/

if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];
    $sql="
    SELECT *, count(perception.id) as mouvement, sum(perception.montant_percu) as somme FROM `perception` 
    inner JOIN frais on frais.id=idFrais 
    inner join eleves on eleves.id=idEleve and idEleve ='$id' 
    GROUP by idFrais";
    $row = $db->selectalldata2($sql);
    echo json_encode($row);
}

/** Fonction modification de la table  perception*/
if (isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];
    $row = $db->selectbyid($id, 'eleves');

    echo json_encode($row);
}
// if (isset($_POST['action'])&& $_POST['action']=="update") {

//         $id=$_POST['id'];
//         $montant_percu=$_POST['montant_percu'];
//         $date_perception=$_POST['date_perception'];


//     $sql = "UPDATE FROM perception SET montant_percu='$montant_percu' date_perception='$date_perception'";
//     echo ($data);
// }

// affiche resultat solde 
if (isset($_POST['action']) && $_POST['action'] == "solde") {
    $id = $_POST['idFrais'];
    $idEleve = $_POST['idEleve'];
    $output = "";

    $resultat = $db->selectalldata2("select *, sum(montant_percu) as solde from perception 
            inner join frais on idFrais = frais.id and idFrais = '$id' and idEleve='$idEleve'");
    $data = $resultat->fetch();
    if ($data) {
        $output .= '
                <p class="text-center text-secondary">
                        <b>' . "Solde : " . $data['solde'] . " " . $data['devise'] . "
                         / " . $data['montant_frais'] . " " . $data['devise'] . '</b> 
                         <input type="hidden" id="solde_value" name="solde" value=' . $data['solde'] . '>
                         <input type="hidden" id="" name="frais" value='. $data['montant_frais'].'>
                </p>';
    } else {
        $output .= "
                <p class='text-center text-secondary mt-5'>
                     Le solde est 0 pour le frais selectionné
                </p>";
    }
    echo ($output);
}
