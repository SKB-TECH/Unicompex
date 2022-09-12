<?php
    error_reporting( E_ALL );
    ini_set( 'display_errors', 1);

    require_once "../Classes/crud.php";
    $db=new Crud();

    if(isset($_POST['action']) && $_POST['action']=="view"){
        $output="";
        $resultat=$db->selectalldata('enseignants');
        if($res=$db->total('enseignants')){
            $output .='
            <table class="table table-striped table-sm table-bordered">
            <thead>
                <th>N°</th>
                <th>Noms</th>
                <th>Sexe</th>
                <th>Grade</th>
                <th>Domaine</th>
                <th>Adresse</th>
                <th>Telephone</th>
                <th>Actions</th>
            </thead>
            <tbody>';

            while ($data=$resultat->fetch()) {
                $output .='
                <tr class="text-center text-secondary">
                <td>'.$data['id'].'</td>
                <td>'.$data['noms'].'</td>
                <td>'.$data['sexe'].'</td>
                <td>'.$data['grade'].'</td>
                <td>'.$data['domaine'].'</td>
                <td>'.$data['adresse'].'</td>
                <td>'.$data['telephone'].'</td>
                <td>
                    <a href="action.php" class="text-success infoBtn" title="Info plus id="'.$data['id'].'">
                        <i class="fa fa-info-circle fa-lg "></i>
                    </a>

                    <a href="" class="text-primary editBtn" title="Modifier" data-toggle="modal" data-target="#editModal" id="'.$data['id'].'">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>

                    <a href="" class="text-danger deleteBtn" title="Supprimer" id="'.$data['id'].'">
                        <i class="fa fa-trash fa-lg"></i>
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
        
        $noms=$_POST['noms'];
        $sexe=$_POST['sexe'];
        $grade=$_POST['grade'];
        $domaine=$_POST['domaine'];
        $adresse=$_POST['adresse'];
        $telephone=$_POST['telephone'];
        $sql=("INSERT INTO enseignants(noms,sexe,grade,domaine,adresse,telephone)VALUES('$noms','$sexe','$grade','$domaine','$adresse','$telephone')");
        
        $db->insert2($sql);
    }

    /** Fonction modification de la table  enseignants*/
    if(isset($_POST['edit_id'])){
        $id=$_POST['edit_id'];
        $row=$db->selectbyid($id,'enseignants');
       
        echo json_encode($row);
    }
    if (isset($_POST['action'])&& $_POST['action']=="update") {
            
            $id=$_POST['id'];
            $noms=$_POST['noms'];
            $sexe=$_POST['sexe'];
            $grade=$_POST['grade'];
            $domaine=$_POST['domaine'];
            $adresse=$_POST['adresse'];
            $telephone=$_POST['telephone'];
        
        $db->Modification($id,$noms,$sexe,$grade,$domaine,$adresse,$telephone);
        echo ($data);
    }

    /** Fonction Suprimmer de la table  enseignants*/
    if(isset($_POST['del_id'])){
        $id=$_POST['del_id'];
        
        $row=$db->deletedata('enseignants','id',$id);
       
    }
?>