<?php
    require('fpdf18/fpdf.php');
    include('../config.php');
   
    class ReportCard extends FPDF{
        function header(){
            $this->Image('../img/sch_sign.PNG',10,6,26,26);
            $this->SetFont('Arial','B',13);
            $this->Cell(140,5,'REPUBLIC OF RWANDA',0,0,'C');
            $this->Ln();
            $this->Cell(145,5,'MINISTRY OF EDUCATION',0,0,'C');
            $this->Ln();
            $this->Cell(175,5,'Saint Philip Technical Secondary School',0,0,'C');
            $this->Ln();
            $this->Cell(134,5,'P.O.BOX 1692 KIGALI',0,0,'C');
            $this->Ln();
            $this->Cell(123,5,'+250 788 565 100',0,0,'C');
            $this->Image('../img/7.PNG',250,6,36,40);
            $this->Ln(20);
            $this->SetFont('Times','B','14');
            $this->Cell(255 ,5,'PROGRESSIVE SCHOOL REPORT',0,1,'C');
            $this->Ln();

            $this->SetFont('Times','','12');
            $this->Cell(60 ,5,'Names Of Student',0,0);
            $this->SetFont('Times','B','12');
            $this->Cell(20 ,5,'Ndayishimiye Muhamudu',0,0);
            $this->SetFont('Times','','12');
            $this->Cell(110 ,5,'Year',0,0,'R');
            $this->SetFont('Times','B','12');
            $this->Cell(15,5,'2017',0,1,'R');
        
            $this->SetFont('Times','','12');
            $this->Cell(60 ,5,'Class',0,0);
            $this->SetFont('Times','B','12');
            $this->Cell(20 ,5,'S6 CSC',0,0);
            $this->SetFont('Times','','12');
            $this->Cell(110 ,5,'Term',0,0,'R');
            $this->SetFont('Times','B','12');
            $this->Cell(24,5,'3rd Term',0,1,'R');
            
            $this->SetFont('Times','','12');
            $this->Cell(60 ,5,'Student Serial Number',0,0);
            $this->SetFont('Times','B','12');
            $this->Cell(20 ,5,'S6CSC4094',0,0);
            $this->Ln(10);
        }
        function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','',8);
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
        function headerTable(){
            $this->SetFont('Times','B',12);
            $this->Cell(40,10,'Subjects',1,0,'C');
            $this->Cell(40,5,'Max Points',1,0,'C');

            $this->Cell(40,10,'home',1,0,'C');
            $this->Cell(40,10,'2nd Term',1,0,'C');
            $this->Cell(40,10,'3rd Term',1,0,'C');
            $this->Cell(40,10,'Annual Points',1,0,'C');
            $this->Cell(40,10,'2nd Sitting',1,0,'C');
            $this->Ln();
        }
        function viewTable(){
            $this->SetFont('Times','',12);
            $query = mysql_query("SELECT* FROM student_tb ORDER BY firstname ASC");
            $count = 0;
            while($row = mysql_fetch_assoc($query)){
                $count++;
                $this->Cell(40,10,$row['firstname'],1,0,'L');
                $this->Cell(40,10,$row['lastname'],1,0,'L');
                $this->Cell(30,10,$row['class'],1,0,'L');
                $this->Cell(50,10,$row['school_fees'],1,0,'L');
                $this->Cell(40,10,$row['father_name'],1,0,'L');
                $this->Cell(50,10,$row['father_phone'],1,0,'L');
                $this->Ln();
            }
        }
    }

    $pdf = new ReportCard();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->viewTable();
    $pdf->Output();
?>

<?php
    require('fpdf18/fpdf.php');
    //A4 width : 219mm
    //default margin : 10mm each side
    //writable horizontal : 219-(10*2)=189mm

    $pdf = new FPDF('p','mm','A4');

    $pdf->AddPage();

    //set font to arial, bold, 14pt
    $pdf->SetFont('Times', 'B',11);

    //Cell (width, height, text, border, end line, [align])

    
    $pdf->Ln();

    //set font to Arial, regular, 12pt
    $pdf->SetFont('Times','B','13');
    $pdf->Cell(191 ,5,'PROGRESSIVE SCHOOL REPORT',0,1,'C');
    $pdf->Ln();

    $pdf->SetFont('Times','','12');
    $pdf->Cell(60 ,5,'Names Of Student',0,0);
    $pdf->SetFont('Times','B','12');
    $pdf->Cell(20 ,5,'Ndayishimiye Muhamudu',0,1);

    $pdf->SetFont('Times','','12');
    $pdf->Cell(60 ,5,'Class',0,0);
    $pdf->SetFont('Times','B','12');
    $pdf->Cell(20 ,5,'S6 CSC',0,1);
    
    $pdf->SetFont('Times','','12');
    $pdf->Cell(60 ,5,'Student Serial Number',0,0);
    $pdf->SetFont('Times','B','12');
    $pdf->Cell(20 ,5,'S6CSC4094',0,1);





    $pdf->Output();
?>