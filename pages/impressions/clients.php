<?php
    
    session_start();

    require('../fpdf/fpdf.php');
    require('connexion.php');
class myPDF extends FPDF {
    function footer(){    
        $this->Sety(-19);
        $this->SetFont('Arial','',10);
        $this->Cell(0,10,'Page '.$this->PageNo().' sur {nb}',0,0,'C');
        $this->Ln();
        $this->SetFont('Arial','',10);
         }
    function Table($pdo){
        
       
        $this->SetFont('Arial','B',20);
        $this->cell(195,6,'Action Juwa ASBL',0,0,'C');
        $this->Ln();
        $this-> Image('juwa.jpg',170,10,20,20);
        $this-> Image('juwa.jpg',25,10,20,20);
        $this->SetFont('Times','',14);
       
        $this->Ln(3);
        $this->cell(195,6,utf8_decode('LISTE DES CLIENTS '),0,0,'C');
        $this->Ln(7);
         //Fin En-tête page 
    }
    //entete du tableau

    function headerTable(){
        $this->SetFont('Times','',11);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(15,7,utf8_decode('N°'),1,0,'C', true);
        
        $this->Cell(70,7,'Noms',1,0,'C', true);
        
        $this->Cell(15,7,utf8_decode('Code'),1,0,'C', true);
        $this->Cell(25,7,'Adresse',1,0,'C', true);
        $this->Cell(25,7,utf8_decode('Tel'),1,0,'L', true);
        $this->Cell(25,7,utf8_decode('Sexe'),1,0,'L', true);
    }
    function vieTable($pdo){
        $i = 0;
        
        $res=$pdo->query("SELECT  * FROM clients");
        while($data = $res->fetch()){
            $i++;
            $this->SetFont('courier','',10);
            $this->SetFillColor(255, 255, 255);

            $this->Cell(15,7,utf8_decode($i),1,0,'C', true);
            $this->Cell(70,7,$data['noms_client'],1,0,'L', true);
            
            $this->Cell(15,7,utf8_decode($data['code_client']),1,0,'C', true);
            $this->Cell(25,7,$data['adresse_client'],1,0,'C', true);
            $this->Cell(25,7,$data['numero_telephone'],1,0,'C', true);
            $this->Cell(25,7,$data['adresse_client'],1,0,'C', true);
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