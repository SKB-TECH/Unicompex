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
         $res=$pdo->query("SELECT promotion.designation as  promotion, departement.designation as departement,section.designation  as section  from promotion inner join departement on departement.idDepartement = promotion.idDepartement inner join section on  section.idSection=departement.idSection where promotion.idPromotion = '$prom'");
         $prom = $res->fetch();
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
        $this->cell(195,6,utf8_decode('LISTE DES ETUDIANTS DE LA '.$prom['promotion']." ".$prom['departement']." | ".$prom['section']),0,0,'C');
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
        $this->SetFillColor(209, 206, 206);
        $this->Cell(15,7,utf8_decode('N°'),1,0,'C', true);
        $this->Cell(80,7,'NOM, POST-NOM ET PRENOM',1,0,'C', true);
        $this->Cell(20,7,'SEXE',1,0,'C', true);
        $this->Cell(30,7,utf8_decode('NUMERO'),1,0,'C', true);
        $this->Cell(40,7,utf8_decode('MAIL'),1,0,'C', true);
    }
    function vieTable($pdo){
        $annee = $_SESSION['user']['anneeAcademique'];
        $prom= $_SESSION['user']['promotion'];
        $res=$pdo->query("SELECT idEtudiant,mail,numero,nom,postnom,prenom,sexe,promotion.designation as promotion,departement.designation as departement, section.designation as section 
        FROM etudiants
        INNER JOIN promotion ON etudiants.idPromotion = promotion.idPromotion and promotion.idPromotion = '$prom'
        INNER JOIN departement ON departement.idDepartement = promotion.idDepartement
        INNER JOIN section ON section.idSection = departement.idSection and anneeAcademique ='$annee'");
        while($et = $res->fetch()){
            $this->SetFont('courier','B',10);
            $this->SetFillColor(209, 206, 206);
            $this->Cell(15,7,utf8_decode($et['idEtudiant']),1,0,'C', true);
            $this->Cell(80,7,$et['nom']." ".$et['postnom']." ".$et['prenom'],1,0,'C', true);
            $this->Cell(20,7,$et['sexe'],1,0,'C', true);
            $this->Cell(30,7,$et['numero'],1,0,'C', true);
            $this->Cell(40,7,$et['mail'],1,0,'C', true);
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
$pdf->Cell(75,6,utf8_decode("Nom et Signature"),0,1,'C');
$pdf->Output();