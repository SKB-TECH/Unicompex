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
        $this->SetFont('Arial','B',16);
        $this->cell(190,6,'INSTIUT NYALUKEMBA',0,0,'C');
        $this->Ln();
        // $this-> Image('juwa.jpg',240,10,25,25);
        // $this-> Image('juwa.jpg',40,10,25,25);
        $this->SetFont('Times','B',14);
        $this->Ln();
        $this->cell(190,6,utf8_decode('Registre de paie '),0,0,'C');
        $this->Ln();
         //Fin En-tête page 
    }
    //entete du tableau
    function headerTable(){
        $this->SetFont('courier','B',11);
        $this->SetFillColor(255, 255, 255);
        $this->Cell(10,7,utf8_decode('N°'),1,0,'C', true);
        $this->Cell(60,7,utf8_decode('Nom de l\'élève'),1,0,'C', true);
        $this->Cell(20,7,utf8_decode('Classe'),1,0,'C', true);
        $this->Cell(40,7,'Frais',1,0,'C', true);
        $this->Cell(40,7,utf8_decode('Solde'),1,0,'C', true);
        $this->Cell(25,7,utf8_decode('Reste'),1,0,'C', true);
    }
    function vieTable($db){
        $i = 0;
        $idFrais = $_POST['idFrais'];
        $classe = $_POST['classe'];
        $tranche = $_POST['tranche'];
        $sql="SELECT *, sum(montant_percu) as solde FROM perception inner join frais on frais.id=idFrais and idFrais='$idFrais' 
        inner join  eleves on eleves.id = idEleve and  classe= '$classe' group by idEleve";
        $res=$db->selectalldata2($sql);
        while($data = $res->fetch()){
            if($data['solde'] >=  $tranche ){
                $i++;
                $this->SetFont('times','',12);
                $this->SetFillColor(255, 255, 255);
                $this->Cell(10,7,utf8_decode($i),1,0,'C', true);
                $this->Cell(60,7,$data['nom']." ".$data['postnom']." ".$data['prenom'],1,0,'L', true);
                $this->Cell(20,7,utf8_decode($data['classe']),1,0,'C', true);
                $this->Cell(40,7,utf8_decode($data['libelle']),1,0,'C', true);
                $this->Cell(40,7,utf8_decode($data['solde']." ".$data['devise']." / ".$data['montant_frais']),1,0,'C', true);
                $this->Cell(25,7,utf8_decode($data['montant_frais'] - $data['solde']." ".$data['devise']),1,0,'C', true);
            }
            
            // $res4 = $db->selectalldata2("SELECT * from perception 
            // inner join frais on frais.id=idFrais  where idFrais = '$idFrais'");
            // $idEleve=$data['id'];
            // $idEleve_array = [];
            // while($data5 = $res4->fetch()){
            // 	array_push($idEleve_array, $data5['idEleve']); 	
            //     $reste = $data5['montant_frais'];
            //     $montantfrais = $data5['montant_frais'];
            //     $devise =  $data5['devise'];
            // }
            //     $this->Cell(40,7,$montantfrais,1,0,'C', true);
            //      if(in_array($idEleve, $idEleve_array)){
            //             $sql = "SELECT sum(montant_percu) as solde  from perception where idFrais='$idFrais' and idEleve='$idEleve'";
            //           $res6 =  $db->selectalldata2($sql);
            //           $data10 = $res6->fetch();
            //           $reste -=  $data10['solde'];
            //           $solde =  $data10['solde'];
            //      }else{
            //         $solde = 0;
            //      } 
            // $this->Cell(25,7,$solde,1,0,'C', true);
            // $this->Cell(25,7,$reste,1,0,'C', true);
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