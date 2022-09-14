<?php

error_reporting( E_ALL );
ini_set( 'display_errors', 1);

require('../Classes/excel/library/php-excel-reader/excel_reader2.php');

require('../Classes/excel/library/SpreadsheetReader.php');

require('../Classes/crud.php');
$crud  = new Crud();

if(isset($_POST['Submit'])){


  $mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet'];

  if(in_array($_FILES["file"]["type"],$mimes)){


    $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);

    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);

    $Reader = new SpreadsheetReader($uploadFilePath);


    $totalSheet = count($Reader->sheets());


    echo "You have total ".$totalSheet." sheets".

    $html="<table border='1'>";

    $html.="<tr><th>Title</th><th>Description</th></tr>";


    /* For Loop for all sheets */

    for($i=0;$i<$totalSheet;$i++){


      $Reader->ChangeSheet($i);


      foreach ($Reader as $Row)

      {

        $html.="<tr>";

        $title = isset($Row[0]) ? $Row[0] : '';

        $description = isset($Row[1]) ? $Row[1] : '';

        $html.="<td>".$title."</td>";

        $html.="<td>".$description."</td>";

        $html.="</tr>";


        $query = "insert into section(designation) values('".$title."')";


        $crud->insert2($query);

       }


    }


    $html.="</table>";

    echo $html;

    echo "<br />Data Inserted in dababase";


  }else { 

    die("<br/>Sorry, File type is not allowed. Only Excel file."); 

  }


}


?>