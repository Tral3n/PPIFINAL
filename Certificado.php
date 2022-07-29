<?php
require('fpdf/fpdf.php');
session_start();
if (
    isset($_SESSION['id_session']) and
    isset($_SESSION['nombre_usuario'])
) {
    
    $session = $_SESSION["id_session"];
    $usuario = $_SESSION["nombre_usuario"];
    $CC = $_POST["CC"]; 
     
 
   

  
} else {

    header("Location:pirata.php");
}

require 'D:/Xampp/htdocs/Gestor-Empleados/Conexion/Conexion.php';
$sql = "SELECT 
e.nombres,
e.apellidos,
e.numero_identificacion,
e.fecha_ingreso,
c.descripcion cargo
FROM empleado e,
  cargo c
WHERE e.id_cargo = c.id_cargo
AND numero_identificacion = ?;";
$stmt = mysqli_stmt_init($conexion);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Hubo un error al buscar la cedula en la base de datos o expiro";
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $CC);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
      
    
        if(mysqli_num_rows($result)>0){
            $followresult = $result->fetch_array(MYSQLI_ASSOC);
            class PDF extends FPDF
            {
            // Cabecera de página
            function Header()
            {
                // Logo
              
                // Arial bold 15
                $this->SetFont('Arial','',12);
                // Movernos a la derecha
                $this->Cell(-130);
                // Título
               
                // Salto de línea
                setlocale(LC_TIME, 'es_CO.UTF-8');
                $tDate = date("F j, Y");
                $this->Cell(0, 10, $tDate, 0, false, 'C', 0, '', 0, false, 'T', 'M');
                $this->Ln(30);
            }
            
            // Pie de página
            function Footer()
            {
                // Posición: a 1,5 cm del final
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                // Número de página
                $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
            }
            }
            
            $pdf = new PDF('P','mm','A4');
            $logo = "fpdf/formats/Logo.png";
            
            $pdf-> AliasNbPages();
            $pdf->SetMargins( 15,  15 );
            $pdf->AddPage();
            $pdf->SetFont('Arial','',10);
            $pdf->Image($logo, 100, 20, 70);
            $pdf->SetFont('Arial','B',12);
            $pdf->Ln(20);
            $pdf->Cell(0,15,utf8_decode('Asunto: Certificado Laboral'));
            $pdf->Ln(20);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,10,utf8_decode('A quien interese:'));
            $pdf->Ln(10);
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(0,15,utf8_decode('Mediante el presente documento yo, Luz Magaly Arango Munera identificada, con la cedula de ciudadania '));
            $pdf->Ln(5);
            $pdf->Cell(0,15,utf8_decode('numero: 43593254 doy fe de que '.$followresult['nombres'].' '.$followresult['apellidos']));
            $pdf->Ln(5);
            $pdf->Cell(0,15,utf8_decode('identificado con la cedula de ciudadania numero: '.$followresult['numero_identificacion']));
            $pdf->Ln(5);
            $pdf->Cell(0,15,utf8_decode('presta sus servicios en la compañia desde el: '.$followresult['fecha_ingreso']));
            $pdf->Ln(5);
            $pdf->Cell(0,15,utf8_decode('en el cargo de '.$followresult['cargo']));
            $pdf->Ln(5);
            $pdf->Cell(0,15,utf8_decode('Durante el tiempo en la compañia el desempeño de sus labores ha sido satisfactorio.'));
            $pdf->Ln(5);
            $pdf->Cell(0,15,utf8_decode('Esta carta se emite a solicitud del interesado'));
            $pdf->Ln(40);
            $pdf->Cell(0,15,utf8_decode('DEL EMPLEADOR'));

            
            
            $pdf->Output();
             
            
        }else{
            class PDF extends FPDF
            {
            // Cabecera de página
            function Header()
            {
                // Logo
              
                // Arial bold 15
                $this->SetFont('Arial','',12);
                // Movernos a la derecha
                $this->Cell(-130);
                // Título
               
                // Salto de línea
              
            }
            
            // Pie de página
            function Footer()
            {
                // Posición: a 1,5 cm del final
                $this->SetY(-15);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                // Número de página
                $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
            }
            }
            $link = "Reportes.php";
            $pdf = new PDF('P','mm','A4');
            
            
            $pdf-> AliasNbPages();
            $pdf->SetMargins( 15,  15 );
            $pdf->AddPage();
            $pdf->SetFont('Arial','',10);
            $pdf->SetFont('Arial','B',40);
            $pdf->Ln(10);
            $pdf->Cell(0,15,utf8_decode('EMPLEADO NO EXISTE!'));
            $pdf->SetLink($link);

          
            $pdf->Output();
            
            
            exit();
         
        
                 }
               ##///      
                              
                
                }