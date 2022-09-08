<?php
    
    session_start();

    require('../fpdf/fpdf.php');
    require('../connexion.php');
class myPDF extends FPDF {
    function footer(){    
        $this->Sety(-19);
        $this->SetFont('Arial','',10);
        $this->Cell(0,10,'Page '.$this->PageNo().' sur {nb}',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','',10);
         }
    function Table($pdo){
        
         $annee = $_SESSION['user']['anneeAcademique'];
         $prom = $_SESSION['user']['promotion'];
            $res1=$pdo->query("SELECT promotion.designation as  promotion, departement.designation as departement,section.designation  as section  from promotion,section,departement,resultats where resultats.promotion=promotion.idPromotion and departement.idDepartement = promotion.idDepartement and departement.idSection = section.idSection and section.anneeAcademique='$annee' and promotion.idPromotion='$prom'"); 
            $prom=$res1->fetch();
            $this->SetFont('Arial','',14);
        $this->cell(195,6,'REPUBLIQUE DEMOCRATIQUE DU CONGO',0,0,'C');
        $this->Ln();
        $this-> Image('../assets/images/logo/logo.png',170,10,17,17);
        $this-> Image('../assets/images/logo/logo2.png',25,10,17,17);
        $this->SetFont('Times','',14);
        $this->cell(195,6,utf8_decode('INSTITUT SUPERIEUR DE COMMERCE D\'UVIRA'),0,0,'C');
        $this->Ln();
        $this->cell(195,6,utf8_decode('I.S.C-UVIRA'),0,0,'C');
        $this->Ln();
        
        $this->SetFillColor(3, 1, 10);
        $this->Setx(10);
        $this->Cell(189,1,'',0,0,'L', true);
        $this->Ln(3);
        $this->cell(195,6,utf8_decode('RESULTATS DE LA : '.$prom['promotion']." ".$prom['departement']." | ".$prom['section']),0,0,'C');
        $this->Ln();
        $this->cell(195,6,utf8_decode("Annee academique : ".$annee),0,0,'C');
        $this->Ln(9);
        $this->SetFillColor(3, 1, 10);
        $this->Setx(10);
        $this->Cell(189,1,'',0,0,'L', true);
        $this->Ln();
         //Fin En-tête page 
    }
    //entete du tableau

    function headerTable(){
        $this->SetFont('courier','B',12);
        $this->SetFillColor(500, 1, 1);
        $this->Cell(30,7,utf8_decode('N°'),1,0,'C', true);
        $this->Cell(80,7,'NOM ET POST-NOM',1,0,'C', true);
        $this->Cell(20,7,'SESSION',1,0,'C', true);
        $this->Cell(30,7,utf8_decode('POURCENTAGE'),1,0,'C', true);
        $this->Cell(25,7,utf8_decode('MENTION'),1,0,'C', true);
    }
    function vieTable($pdo){
       
        $annee = $_SESSION['user']['anneeAcademique'];
        $pr = $_SESSION['user']['promotion'];
        $res=$pdo->query("SELECT *
        FROM resultats
        INNER JOIN etudiants ON etudiants.idEtudiant = resultats.idEt and promotion='$pr'");
        while($result = $res->fetch()){
            $this->SetFont('courier','B',12);
            $this->SetFillColor(209, 204, 206);
            $this->Cell(30,7,utf8_decode($result['idRes']),1,0,'C', true);
            $this->Cell(80,7,$result['nom']." ".$result['postnom']." ".$result['prenom'],1,0,'C', true);
            $this->Cell(20,7,$result['sess'],1,0,'C', true);
            $this->Cell(30,7,$result['pourcentage'],1,0,'C', true);
            $this->Cell(25,7,$result['mention'],1,0,'C', true);
            $this->Ln();
        }
    }
function Totalite(){ 
$this->Ln(6);
$this->Cell(0,0,utf8_decode("Date d'impression : ").date('d/m/Y'),0,0,'L');
$this->Ln(6);
$this->Cell(0,0,utf8_decode("Heure d'impression : ").date('H:i:s'),0,0,'L');
$this->Ln(6);
$this->SetFillColor(3, 1, 10);
$this->Setx(27);
$this->Cell(150,1,'',1,0,'L', true);
$this->Ln();     
        }
  
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->Table($pdo);
$pdf->Ln(7);
$pdf->headerTable();
$pdf->Ln(7);
$pdf->vieTable($pdo);
$pdf->Ln(5);
$pdf->Totalite($pdo);
$pdf->Ln(5);
$pdf->Cell(280,5,utf8_decode("Fait à Bukavu le ").date('d/m/Y'),0,0,'C');
$pdf->Ln();
$pdf->Cell(100,10,'',0,0);
$pdf->Cell(75,6,utf8_decode("Nom et Signature"),0,0,'C');
$pdf->Ln();
$pdf->Cell(100,10,'',0,0);
$pdf->Cell(75,6,utf8_decode($_SESSION['user']['nomSec']),0,1,'C');
$pdf->Output();