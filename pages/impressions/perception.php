<?php
    require_once("../../Classes/crud.php");
    $db = new crud();
    require('fpdf/fpdf.php');
    
class myPDF extends FPDF {
    function footer(){    
        $this->Sety(-19);
        $this->SetFont('Arial','',10);
        $this->Cell(0,10,'Page '.$this->PageNo().' sur {nb}',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','',10);
         }
    function Table($pdo){
        
       
        $this->SetFont('Arial','B',24);
        $this->cell(270,6,'INSTIUT NYALUKEMBA',0,0,'C');
        $this->Ln();
        // $this-> Image('juwa.jpg',240,10,25,25);
        // $this-> Image('juwa.jpg',40,10,25,25);
        $this->SetFont('Times','B',20);
        $this->Ln(4);
        $this->cell(270,6,utf8_decode('Registre de paie '),0,0,'C');
        $this->Ln();
         //Fin En-tête page 
    }
    //entete du tableau
    function headerTable(){
        $this->SetFont('courier','',11);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(15,7,utf8_decode('N°'),1,0,'C', true);
        $this->Cell(80,7,'Eleve',1,0,'L', true);
        $this->Cell(20,7,utf8_decode('Classe'),1,0,'C', true);
        $this->Cell(30,7,'Frais',1,0,'C', true);
        $this->Cell(45,7,utf8_decode('montant'),1,0,'C', true);
        $this->Cell(25,7,utf8_decode('Date'),1,0,'L', true);
         $this->Cell(25,7,utf8_decode('Solde'),1,0,'C', true);
    }
    function vieTable($db){
        $i = 0;
        $sql="select *, sum(montant_percu) as solde from perception 
        inner join frais on idFrais = frais.id inner join eleves on eleves.id=idEleve";
        $res=$db->selectalldata2($sql);
        while($data = $res->fetch()){
            $i++;
            $this->SetFont('times','',12);
            $this->SetFillColor(255, 255, 255);
            $this->Cell(15,7,utf8_decode($i),1,0,'C', true);
            $this->Cell(80,7,$data['nom']." ".$data['postnom']." ".$data['prenom'],1,0,'L', true);
            $this->Cell(20,7,utf8_decode($data['classe']),1,0,'C', true);
            $this->Cell(30,7,$data['libelle'],1,0,'L', true);
            $this->Cell(45,7,$data['montant_percu'],1,0,'C', true);
            $this->Cell(25,7,$data['date_perception'],1,0,'C', true);
            $this->Cell(25,7,$data['solde'],1,0,'C', true);
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
$this->Cell(230,1,'',1,0,'L', true);
$this->Ln();     
        }
  
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('M','A4',0);
$pdf->Table($db);
$pdf->Ln(7);
$pdf->headerTable();
$pdf->Ln(7);
$pdf->vieTable($db);
$pdf->Ln(5);
$pdf->Totalite($db);
$pdf->Ln(5);
$pdf->Cell(450,5,utf8_decode("Fait à Bukavu le ").date('d/m/Y'),0,0,'C');
$pdf->Ln();
$pdf->Cell(100,10,'',0,0);
$pdf->Cell(250,6,utf8_decode("Nom et Signature"),0,1,'C');
$pdf->Output();