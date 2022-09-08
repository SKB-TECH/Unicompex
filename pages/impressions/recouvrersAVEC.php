<?php
    
include "session.php";

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
        
       
        $this->SetFont('Arial','',14);
        $this->cell(195,6,'Action Juwa  - MUSOE ASBL',0,0,'C');
        $this->Ln();
        $this-> Image('../assets/images/logo/juwa.png',170,10,17,17);
        $this-> Image('../assets/images/logo/juwa.png',25,10,17,17);
        $this->SetFont('Times','',14);
       
        $this->Ln(3);
        $this->cell(195,6,utf8_decode('LISTE DES RECOUVREMENTS DES PART'),0,0,'C');
        $this->Ln();

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
        $this->Cell(30,7,utf8_decode('N°'),1,0,'C', true);
        $this->Cell(30,7,utf8_decode('CODE'),1,0,'C', true);
        
        $this->Cell(80,7,'MEMBRE',1,0,'C', true);
        $this->Cell(20,7,'TELEPHONE',1,0,'C', true);
        $this->Cell(20,7,'PART',1,0,'C', true);
        $this->Cell(30,7,utf8_decode('DATE'),1,0,'C', true);
        $this->Cell(25,7,utf8_decode('MONTANT'),1,0,'C', true);
         $this->Cell(25,7,utf8_decode('SEMAINE'),1,0,'C', true);
         $this->Cell(25,7,utf8_decode('AGENT'),1,0,'C', true);
        
    }
    function vieTable($pdo){
        $i = 0;
        
        $res=$pdo->query("SELECT  *, sum(recouvrer.montant) as somme) FROM recouvrer 
            inner join membres on recouvrer.idMembre = membres.code_membres
        ");
        while($data = $res->fetch()){
            $i++;
            $this->SetFont('courier','B',12);
            $this->SetFillColor(209, 206, 206);

            $this->Cell(30,7,utf8_decode($id),1,0,'C', true);
            $this->Cell(30,7,utf8_decode($data['code_rec']),1,0,'C', true);
            $this->Cell(80,7,$data['noms_membre'],1,0,'C', true);
            $this->Cell(20,7,$data['telephone_membre'],1,0,'C', true);
            $this->Cell(30,7,$data['part'],1,0,'C', true);
            $this->Cell(25,7,$data['date_rec'],1,0,'C', true);
            $this->Cell(25,7,$data['montant'],1,0,'C', true);
    
            $this->Cell(25,7,$data2['noms'],1,0,'C', true);
            
            $this->Ln();
        }
        $this->Cell(25,7,$data['somme'],1,0,'C', true);
            
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