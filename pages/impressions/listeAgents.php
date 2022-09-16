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
    function Table($db){
        
       
        $this->SetFont('Arial','B',14);
        $this->cell(170,2,'INSITUT NYALUKEMBA',0,0,'C');
        $this->Ln();
        // $this-> Image('juwa.jpg',240,10,25,25);
        // $this-> Image('juwa.jpg',40,10,25,25);
        $this->SetFont('Times','B',12);
       
        $this->Ln(4);
        $this->cell(170,6,utf8_decode('Liste des agens '),0,0,'C');
        $this->Ln();
     
         //Fin En-tête page 
    }
    //entete du tableau

    function headerTable(){
        $this->SetFont('courier','',11);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(10,7,utf8_decode('N°'),1,0,'C', true);
        $this->Cell(40,7,'Noms',1,0,'C', true);
        $this->Cell(20,7,'Adresse',1,0,'C', true);
        $this->Cell(25,7,utf8_decode('Telephone'),1,0,'C', true);
        $this->Cell(20,7,utf8_decode('Sexe'),1,0,'C', true);
        $this->Cell(15,7,utf8_decode('Grade'),1,0,'C', true);
        $this->Cell(40,7,utf8_decode('Domaine'),1,0,'C', true);
        
    }
    function vieTable($db){
        $i = 0;
        $res=$db->selectalldata2("SELECT  * FROM enseignants");
        while($data = $res->fetch()){
            $i++;
            $this->SetFont('times','',12);
            $this->SetFillColor(255, 255, 255);
            $this->Cell(10,7,utf8_decode($i),1,0,'C', true);
            $this->Cell(40,7,$data['noms'],1,0,'L', true);
            $this->Cell(20,7,$data['adresse'],1,0,'L', true);
            $this->Cell(25,7,$data['telephone'],1,0,'C', true);
            $this->Cell(20,7,$data['sexe'],1,0,'C', true);
            $this->Cell(15,7,$data['grade'],1,0,'C', true);
            $this->Cell(40,7,$data['domaine'],1,0,'C', true);
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
$this->Cell(230,1,'',1,0,'L', true);
$this->Ln();     
        }
  
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
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