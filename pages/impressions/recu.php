 <?php
        require_once("session.php");
        
        include "connexion.php";
            $idRec = $_GET['idRec'];
            	   					               
			$sql = "SELECT * , recouvrements.montant as rec, dettes.montant as dette FROM dettes inner join clients on clients.code_client = dettes.client inner join recouvrements on recouvrements.codeEmprunt = dettes.code_dettes and code_recouvrement = '$idRec' inner join user on user.code_user = recouvrements.idAgent";
            	$res = $pdo->query($sql);
			    $data= $res->fetch();
			    $codeE = $data['code_dettes'];
			    
			    
			    $sql1 = "SELECT sum(montant) AS total FROM recouvrements WHERE codeEmprunt = '$codeE'";
            	$res1 = $pdo->query($sql1);
			    $data1= $res1->fetch();
			    
			    $sql2 = "SELECT *  FROM recouvrements WHERE code_recouvrement = '$idRec'";
            	$res2 = $pdo->query($sql2);
			    $data2= $res2->fetch();
			    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body onload="window.print();">
<h1 id="logo" class="text-center">ACTION JUWA ASBL</h1>
    <title>Recu</title>
     
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
                background-image: url("juwa.jpg")
                background-repeat: no-repeat, repeat;
                background-size: auto;
                padding: 10px;
                border: 2px dotted #000;
                text-align: justify;
            }
            #logo {
                color: black;
                font-size: 25px;
                font-weigth: bold;
                
            }
           .text-center{text-align: center;}
        }
    </style>
</head>
<body onload="window.print();">

<div id='printContainer'>
    <h3 id="slogan" style="margin-top:0" class="text-center">Réçu de paiement n° <?php echo $data['code_recouvrement']?></h3>

    <table>
        <tr>
            <td>Noms  : </td>
            <td><?php echo $data['noms_client']." ".$data['code_client']?></td>
        </tr>
       
    </table>

    <table>
        <tr><td colspan="2"><hr></td></tr>
        <tr>
            <td>Montant payé:</td>
            <td><b ><?php echo $data['rec'] ?> FC</b></td>
        </tr>
        <tr><td colspan="2"><hr></td></tr>
        <tr>
            <td>Dette générale :</td>
            <td><?php echo $data['dette'] ?> FC</td>
        </tr>
        <tr>
            <td>Dette restante : </td>
            <td><?php echo $data['dette'] - $data1['total']; ?> FC</td>
        </tr>
    </table>
    <?php setlocale(LC_TIME, 'fra_fra'); ?>
    <p>Operateur: <?php echo $data['noms']." +243".$data['telephone'] ?> </p>
    <p>Date: <?php echo $data['dateRec'] ?> </p>
</div>
    </body>
</html>