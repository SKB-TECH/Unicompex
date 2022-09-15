<?php

error_reporting( E_ALL );
ini_set( 'display_errors', 1);

require('../../Classes/excel/php-excel-reader/excel_reader2.php');

require('../../Classes/excel/spreadsheet-reader/SpreadsheetReader.php');

require('../../Classes/crud.php');
$crud  = new Crud();

if(isset($_POST['Submit'])){
  $mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet'];

  if(in_array($_FILES["file"]["type"],$mimes)){
    $uploadFilePath = '../../Classes/excel/uploads/'.basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);
    $Reader = new SpreadsheetReader($uploadFilePath);
    $totalSheet = count($Reader->sheets());
    /* For Loop for all sheets */
    for($i=0;$i<$totalSheet;$i++){
      $Reader->ChangeSheet($i);
      foreach ($Reader as $Row)
      {
        // $title = isset($Row[1]) ? $Row[0] : '';
        $nom = isset($Row[1]) ? $Row[1] : '';
        $postnom = isset($Row[2]) ? $Row[2] : '';
        $prenom = isset($Row[3]) ? $Row[3] : '';
        $sexe = isset($Row[4]) ? $Row[4] : '';
        $classe = isset($Row[5]) ? $Row[5] : '';
        $lieu_naissance = isset($Row[6]) ? $Row[6] : '';
        $date_naissance = isset($Row[7]) ? $Row[7] : '';
            $query = "insert into eleves(nom,postnom,prenom,sexe,classe,lieu_naissance)
               values('".$nom."','".$postnom."','".$prenom."','".$sexe."','".$classe."','".$lieu_naissance."')";
              $crud->insert2($query);
              header("location:Eleves.php");
            
       }
    }
  }else { 
    die("<br/>Sorry, type pas permis."); 
  }
}
?>