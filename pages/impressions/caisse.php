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
        $this->cell(270,6,utf8_decode('Situation generale de la caisse'),0,0,'C');
        $this->Ln();
         //Fin En-tête page 
    }

    //entete du tableau perception
    function headerPerception(){
        $this->SetFont('courier','B',11);
        $this->Cell(80,7,'Perception des frais',0,0,'C');
        $this->Ln(10);

        $this->SetFont('courier','B',11);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(15,7,utf8_decode('N°'),1,0,'C', true);
        $this->Cell(40,7,utf8_decode('Libellé'),1,0,'C', true);
        $this->Cell(30,7,utf8_decode('Montant'),1,0,'C', true);
    }
   
    function rowsPerception($db){
        $i = 0;
        $total = 0;
        $res=$db->selectalldata2("SELECT *, sum(montant_percu) as somme  FROM perception 
            inner join frais on frais.id = idFrais 
            group by idFrais 
            order by libelle asc");
        while($data = $res->fetch()){
            $i++;
            $this->SetFont('times','',12);
            $this->SetFillColor(255, 255, 255);
            $this->Cell(15,7,utf8_decode($i),1,0,'C', true);
            $this->Cell(40,7,utf8_decode($data['libelle']),1,0,'L', true);
            $this->Cell(30,7,$data['somme']." ".$data['devise'],1,0,'C', true);
            $total += $data['somme'];
            $devise = $data['devise'];
            $this->Ln();
        }
         $this->Cell(55,7,"TOTAL",1,0,'C', true);
         $this->Cell(30,7,$total." ".$devise,1,0,'C', true);
    }
    // fin table perception


    // entete du tableau des paie agent
    function headerPaie(){
        $this->SetFont('courier','B',11);
        $this->Cell(80,7,'Salaire',0,0,'C');
        $this->Ln(10);

        $this->SetFont('courier','B',11);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(15,7,utf8_decode('N°'),1,0,'C', true);
        $this->Cell(40,7,utf8_decode('Libellé'),1,0,'C', true);
        $this->Cell(30,7,utf8_decode('Montant'),1,0,'C', true);
    }
   
    function rowsPaie($db){
        $i = 0;
        $res=$db->selectalldata2("SELECT *, sum(montant)  as salaire, sum(avance)  as avance,sum(mituelle)  as mituelle    FROM paie ");
        $data = $res->fetch();
            $this->SetFont('times','',12);
            $this->SetFillColor(255, 255, 255);
            $this->Cell(15,7,utf8_decode(1),1,0,'C', true);
            $this->Cell(40,7,utf8_decode("Salaire"),1,0,'C', true);
            $this->Cell(30,7,$data['salaire'],1,0,'L', true);
            $this->Ln();
            
            $this->Cell(15,7,utf8_decode(2),1,0,'C', true);
            $this->Cell(40,7,utf8_decode("Mituelle"),1,0,'C', true);
            $this->Cell(30,7,$data['mituelle'],1,0,'L', true);

            $total = $data['salaire'] -  $data['mituelle'];
            $this->Ln();
        
         $this->Cell(55,7,"TOTAL(S-M)",1,0,'C', true);
         $this->Cell(30,7,$total." $",1,0,'C', true);
    }
    // fin du tableau de paie agent
    
    
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
$pdf->headerPerception();
$pdf->Cell(30,10,'',0,0);
$pdf->headerPerception();
// $pdf->headerPaie();
$pdf->Ln(7);
// $pdf->rowsPerception($db);
// $pdf->Cell(50,10,'',0,0);
// $pdf->rowsPaie($db);
$pdf->Ln(5);


$pdf->Totalite($db);
$pdf->Ln(5);
$pdf->Cell(450,5,utf8_decode("Fait à Bukavu le ").date('d/m/Y'),0,0,'C');
$pdf->Ln();
$pdf->Cell(100,10,'',0,0);
$pdf->Cell(250,6,utf8_decode("Nom et Signature"),0,1,'C');
$pdf->Output();