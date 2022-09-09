<?php
    
    error_reporting( E_ALL );
    ini_set( 'display_errors', 1);
    include_once ("../Classes/crud.php"); 
    $taches=new Crud();

    if (isset($_POST['submit'])) {
      
        $data= array( 
            "noms"  => $crud->escape_string($_POST['noms']),            
            "grade"  => $crud->escape_string($_POST['grade']), 
            "sexe"  => $crud->escape_string($_POST['sexe']), 
            "adresse"  => $crud->escape_string($_POST['adresse']),
            "telephone"  => $crud->escape_string($_POST['telephone']),
            "domaine"  => $crud->escape_string($_POST['domaine']) 
          ); 
          $taches->insert($data,"enseignants"); 
          if($data) { 
            echo 'insert successfully';  
          }else { 
             echo 'try again' ; 
          }
    }
?>