<?php
require("fpdf/fpdf.php");
include("conexion.php");
//include("config.php");
foreach($_POST as $n => $v) $$n = mysql_real_escape_string($v);




class PDF extends FPDF
{
// Cabecera de página
	function Footer() // Pie de página  
	{       
 		$this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Mercancia destinada a la exportacion, sujeta a control de la aduana','T',0,'C');
    }
 
    function Header() //Encabezado
    {
        $this->SetFont('Arial','B',16);
 
        $this->Line(10,10,206,10);
        $this->Line(10,45,206,45);
 
        $this->Cell(40,10,'Datos Bertschi ',0,1,'L');
        $this->Cell(40,10,'direccion',0,1,'L');
        $this->Cell(40,10,'codigo asignado',0,1,'L');
 
        $this->Ln(25);
    }


}
        
		$pdf = new PDF();             //Crea objeto PDF


//Disable automatic page break
//$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();


//print column titles
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',8);
$cod="12552364";

	if(isset($_POST["nexport1"])){ 
		$cod=$_POST["nexport1"];
	} 

$sql='SELECT nexport1,nexport2,nexport3,nexport4,codi_taric,tipo_aduana,tipo_declaracio,num_formulari,des_mercaderia,regim_aduaner,pes_export,ncontenedor,tipo_salida,fecha_salida FROM ctexport WHERE nexport1="'.$cod.'"';
$result=mysql_query($sql);
$colu = mysql_fetch_array($result);


$pdf->Cell(40,6,'Dispo 1: ',1,0,'L',1);
$pdf->Cell(60,6,$colu[0],1,1,'L',1);
$pdf->Cell(40,6,'Dispo 2: ',1,0,'L',1);
$pdf->Cell(60,6,$colu[1],1,1,'L',1);
$pdf->Cell(40,6,'Dispo 3: ',1,0,'L',1);
$pdf->Cell(60,6,$colu[2],1,1,'L',1);
$pdf->Cell(40,6,'Dispo 4: ',1,0,'L',1);
$pdf->Cell(60,6,$colu[3],1,1,'L',1);
$pdf->Cell(40,6,'Codigo Taric: ',1,0,'L',1);
$pdf->Cell(60,6,$colu[4],1,1,'L',1);
$pdf->Cell(40,6,'Aduana: ',1,0,'L',1);
$pdf->Cell(60,6,$colu[5],1,1,'L',1);
$pdf->Cell(40,6,'Tipo Declaracion: ',1,0,'L',1);
$pdf->Cell(60,6,$colu[6],1,1,'L',1);
$pdf->Cell(40,6,'Numero Formularios: ',1,0,'L',1);
$pdf->Cell(60,6,$colu[7],1,1,'L',1);
$pdf->Cell(40,6,'Mercancia:',1,0,'L',1);
$pdf->Cell(60,6,$trow[8],1,1,'L',1);
$pdf->Cell(40,6,'Regimen Aduanero: ',1,0,'L',1);
$pdf->Cell(60,6,$colu[9],1,1,'L',1);
$pdf->Cell(40,6,'Peso Total: ',1,0,'L',1);
$pdf->Cell(60,6,$colu[10],1,1,'L',1);

$pdf->Ln(25);
$pdf->SetFont('Arial','B',12);
		
$pdf->Cell(30,6,'Contenedor',1,0,'L',1);
$pdf->Cell(25,6,'Tipo salida',1,0,'L',1);
$pdf->Cell(30,6,'Fecha salida',1,0,'L',1);
$pdf->Cell(20,6,'Sector',1,0,'L',1);
$pdf->Cell(20,6,'Carril',1,0,'L',1);
$pdf->Cell(20,6,'Piso',1,0,'L',1);
$pdf->Cell(20,6,'Posicion',1,1,'L',1);

$pdf->SetFont('Arial','',10);
$result=mysql_query($sql);
while($trow = mysql_fetch_array($result))
{
    //If the current row is the last one, create new page and print column title
	$pdf->Cell(30,6,$trow[11],1,0,'L',1);
	$pdf->Cell(25,6,$trow[12],1,0,'L',1);
	$pdf->Cell(30,6,$trow[13],1,0,'L',1);
	$sqlct='SELECT sector,carril,pis,posicio FROM ctcontenedor WHERE codigo="'.$trow[11].'"';
	$resultct=mysql_query($sqlct);
	$lugar = mysql_fetch_array($resultct);
	$pdf->Cell(20,6,$lugar[0],1,0,'L',1);
	$pdf->Cell(20,6,$lugar[1],1,0,'L',1);
	$pdf->Cell(20,6,$lugar[2],1,0,'L',1);
	$pdf->Cell(20,6,$lugar[3],1,1,'L',1);
//Go to next row
}


 $pdf->Output();               //Salida al navegador
?>