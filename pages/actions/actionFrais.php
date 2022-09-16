<?php
    error_reporting( E_ALL );
    ini_set( 'display_errors', 1);

    require_once "../../Classes/crud.php";
    $db=new Crud();

    if(isset($_POST['action']) && $_POST['action']=="view"){
        $output="";
        $resultat=$db->selectalldata('frais');
        if($res=$db->total('frais')){
            $output .='
            <table class="table table-striped table-sm table-bordered">
            <thead>
                <th>N°</th>
                <th>Libelle</th>
                <th>Montant</th>
                <th>Actions</th>
            </thead>
            <tbody>';

            while ($data=$resultat->fetch()) {
                $output .='
                <tr class="text-center text-secondary">
                <td>'.$data['id'].'</td>
                <td>'.$data['libelle'].'</td>
                <td>'.$data['montant_frais']." ".$data['devise'].'</td>
                <td>
                    <a href="#" class="text-success infoBtn" title="Info"  id="'.$data['id'].'">
                        <i class="fa fa-info-circle fa-lg "></i>
                    </a>

                    <a href="#" class="text-primary editBtn" title="Modifier" data-toggle="modal" data-target="#editModal" id="'.$data['id'].'">
                        <i class="fa fa-edit fa-lg"></i>
                    </a>

                    <a href="#" class="text-danger deleteBtn" title="Supprimer" id="'.$data['id'].'">
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
        
        $libelle=$_POST['libelle'];
        $montant=$_POST['montant'];
        $devise=$_POST['devise'];
        $domaine=$_POST['domaine'];

        $sql=("INSERT INTO frais(libelle,montant_frais,devise)VALUES('$libelle','$montant','$devise')");
        
        $db->insert2($sql);
    }

    /** Fonction modification de la table  enseignants*/
    if(isset($_POST['edit_id'])){
        $id=$_POST['edit_id'];
        $row=$db->selectbyid($id,'frais');
       
        echo json_encode($row);
    }
    if (isset($_POST['action'])&& $_POST['action']=="update") {
            
            $id=$_POST['id'];
            $libelle=$_POST['libelle'];
            $montant=$_POST['montant'];
            $devise=$_POST['devise'];
           
        // $db->Modification($id,$libelle,$montant,$devise);
        echo ($data);
    }

    /** Fonction Suprimmer de la table  enseignants*/
    if(isset($_POST['del_id'])){
        $id=$_POST['del_id'];
        
        $row=$db->deletedata('frais','id',$id);
       
    }

    /** Fonction info plus de la table  enseignants*/
    if(isset($_POST['info_id'])){
        $id=$_POST['info_id'];

        $row=$db->selectbyid($id,'frais');
    
        echo json_encode($row);
    }

    /** exportation de la liste Excel */
    if (isset($_GET['export']) && $_GET['export']=="excel") {
        header('Content-type:application/xls');
        header('Content-Disposition:attachement;filename=frais.xls');
        header('Pragma:no-cache');
        header('Expire:0');

        $resultat=$db->selectalldata('frais');
        echo '<table border="1">';
        echo '<tr><th>N°</th><th>Libelle</th><th>Montant</th><th>Devise</th></tr>';

        while ($data=$resultat->fetch()) {
            echo '<tr>
            <tr class="text-center text-secondary">
            <td>'.$data['id'].'</td>
            <td>'.$data['libelle'].'</td>
            <td>'.$data['montant'].'</td>
            <td>'.$data['devise'].'</td>
            
        </tr>';
    
        }
        echo '</table>';
    }

?>