 <?php
           error_reporting( E_ALL );
           ini_set( 'display_errors', 1);

        require_once("../../Classes/crud.php");
        $db = new crud();
        // $idRec = 2;
        $mois = $_POST['mois'];
        $agent = $_POST['agent'];
                // recherche le paiement a imprimer
                $resultat=$db->selectalldata2("select * from enseignants on ensignants.id = idagent and idagent='$agent' and mois='$mois'");
			    $data= $resultat->fetch();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Fiche de paie</title>
<body onload="window.print();">
    
    <style>
        @media print {
            @page {
                margin: 0 auto; /* imprtant to logo margin */
                sheet-size: 400px 250mm; /* imprtant to set paper size */
            }
            html {
                direction: ltr;
            }
            html,body{margin:0;padding:0}
            #printContainer {
                
                width: 250px;
                margin: auto;
                background-repeat: no-repeat, repeat;
                background-size: auto;
                padding: 10px;
                border: 2px dotted #000;
                text-align: justify;
            }
            #logo {
                color: black;
                font-size: 20px;
                font-weight: bold;
            }
           .text-center{text-align: center;}
        }
        </style>
</head>
<body onload="window.print();">
    <div id='printContainer'>
        <h3 id="logo" class="text-center">Institut NYALUKEMBA</h3>
    <h5 id="slogan" style="margin-top:0" class="text-center">Fiche de paie n° <?php echo $idFrais?></h5>
    <table>
        <tr>
            <td>Nom de l'agent : </td>
            <td><?php echo $data['noms']?></td>
        </tr>
        <tr>
            <td>Grade  : </td>
            <td><?php echo $data['grade']?></td>
        </tr>
    </table>

    <table>
        <tr><td colspan="2"><hr></td></tr>
        <tr>
            <td>Salaire net :</td>
            <td><b ><?php echo $data['net']." $" ?> </b></td>
        </tr>
        <tr>
            <td>Mitualité  : </td>
            <td><?php echo $data['mitualite']." $"?></td>
        </tr>
        <tr><td colspan="2"><hr></td></tr>
        <tr>
            <td>Salaire de base :</td>
            <td><?php echo $data1['solde']." $" ?>  </td>
        </tr>
        <tr>
            <td>Avance sur salaire :</td>
            <td><?php echo $data1['avance']." $" ?>  </td>
        </tr>

    </table>
    <?php setlocale(LC_TIME, 'fra_fra'); ?>
    <p>Percepteur(trice): Caissier </p>
    <p>Date: <?php 
                $dat = date_create($data['date_perception']);
                echo date_format($dat, "d/m/Y"); 
        ?> </p>
</div>
<a href="../registre.php">Retour </a>
    </body>
</html>