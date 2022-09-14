<?php
    error_reporting( E_ALL );
    ini_set( 'display_errors', 1);

    require_once "../../Classes/crud.php";
    $db=new Crud();

    if(isset($_POST['action']) && $_POST['action']=="view"){
        $output="";
        $resultat=$db->selectalldata('eleves');
        if($res=$db->total('eleves')){
            $output .='
            <table class="table table-striped table-sm table-bordered">
                <thead>
                <th>N°</th>
                <th>Noms</th>
                <th>Classe</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>';

            while ($data=$resultat->fetch()) {
                $output .='
                <tr class="text-center text-secondary">
                <td>'.$data['id'].'</td>
                <td>'.$data['nom']." ".$data['postnom']." ".$data['prenom'].'</td>
                <td>'.$data['classe'].'</td>
                <td>
                        <a href="#" class="text-success infoBtn" title="Info"  id="'.$data['id'].'">
                            <i class="fa fa-info-circle fa-lg "> Solde</i>
                        </a>
                </td>
                <td>
                        <a href="#" class="text-primary editBtn" title="Modifier" data-toggle="modal" data-target="#addModal" id="'.$data['id'].'">
                            <i class="fa fa-dollar fa-lg"> Payer</i>
                        </a>
                </td>
            </tr>'
                ;
            }

            $output .="</tbody></table>";
            echo ($output);
        }

        else {
            echo "
            <h3 class='text-center text-secondary mt-5'>
                Pas d'informations sur cette recherche !!!
            </h3>";
        }
    }
    
    /** Fonction insert dans la bdd */
    if(isset($_POST['action']) && $_POST['action']=="insert"){
        
        $date_perception=$_POST['date_perception'];
        $montant_percu=$_POST['montant_percu'];
        $idEleve=$_POST['id'];
        $idFrais=$_POST['idFrais'];
        // $idUser=$_POST['adresse'];
        $sql="INSERT INTO perception(date_perception,montant_percu,idEleve,idFrais,idUser)VALUES('$date_perception','$montant_percu','$idEleve','$idFrais','$iduser')";        
        $db->insert2($sql);
    }

    
    /** Fonction info plus de la table  eleves*/
    if(isset($_POST['info_id'])){
        $id=$_POST['info_id'];

        $row=$db->selectbyid('1','eleves');
        
        echo json_encode($row);
    }

    
    // affiche resultat solde 
    if(isset($_POST['action']) && $_POST['action']=="solde"){
        $id=$_POST['idFrais'];
        $idEleve=$_POST['idEleve'];
        $output="";
       
        $resultat=$db->selectalldata2("select *, sum(montant_percu) as solde from perception 
            inner join frais on idFrais = frais.id and idFrais = '$id' and idEleve='$idEleve'");   
            $data=$resultat->fetch();
            if ($data) {
                $output .='
                <p class="text-center text-secondary">
                        <b>'."Solde : ".$data['solde']." ".$data['devise']."
                         / ".$data['montant_frais']." ".$data['devise'].'</b> 
                         <input type="hidden" id="solde_value" name="solde" value='.$data['solde'].'>
                </p>';
            }else{
                $output .= "
                <p class='text-center text-secondary mt-5'>
                     Le solde est 0 pour le frais selectionné
                </p>";
            }
            echo ($output);
        }
    

?>
