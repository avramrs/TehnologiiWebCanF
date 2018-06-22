<?Php
    session_start();
    $user = null;
    if(isset($_SESSION['user_data']))
    {
        $user = $_SESSION['user_data'];
    }
    if(!$user)
    {
        header('Location: index.php');
    }

    $mysql = new mysqli ('localhost', 'root',   '', 'TWProject');
    if (mysqli_connect_errno()) {
        die ('Conexiunea a esuat...');
    }

    if (!($rez = $mysql->query ('select product_id, upload_date, name, cans_number from products order by upload_date desc'))) {
        die ('A survenit o eroare la interogare');
    }

    require('fpdf.php');
    $pdf = new FPDF(); 
    $pdf->AddPage();

    $width_cell=array(15,70,30,75);
    $pdf->SetFont('Arial','B',14);

    $pdf->SetFillColor(193,229,252);

    $pdf->Cell($width_cell[0],10,'ID',1,0,'C',true);
    $pdf->Cell($width_cell[1],10,'NAME',1,0,'C',true);
    $pdf->Cell($width_cell[2],10,'IN STOCK',1,0,'C',true);
    $pdf->Cell($width_cell[3],10,'LAST UPDATED',1,1,'C',true);

    $pdf->SetFont('Arial','',14);
    $fill=false;

    while ($inreg = $rez->fetch_assoc()) {
        if (strtotime($inreg['upload_date']) > strtotime('-2 hours')) {
            $fill = true;
            $pdf->SetFillColor(20,236,236);
            $pdf->Cell($width_cell[0],10,$inreg['product_id'],1,0,'C',$fill);
            $pdf->Cell($width_cell[1],10,$inreg['name'],1,0,'L',$fill);
            $pdf->Cell($width_cell[2],10,$inreg['cans_number'],1,0,'C',$fill);
            $pdf->Cell($width_cell[3],10,$inreg['upload_date'],1,1,'C',$fill);
        }
        else {
            $pdf->SetFillColor(235,236,236);
            $pdf->Cell($width_cell[0],10,$inreg['product_id'],1,0,'C',$fill);
            $pdf->Cell($width_cell[1],10,$inreg['name'],1,0,'L',$fill);
            $pdf->Cell($width_cell[2],10,$inreg['cans_number'],1,0,'C',$fill);
            $pdf->Cell($width_cell[3],10,$inreg['upload_date'],1,1,'C',$fill);
            $fill = !$fill;
        }
    }

    $pdf->Output();
?>