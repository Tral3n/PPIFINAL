<?php

if ($_POST['formulario'] == 'generar') {

    $fechai = trim($_POST['fechai']);
    $fechaf= trim($_POST['fechaf']);
}

?>



<?php

require 'vendor/autoload.php';
include "Conexion/Conexion.php";
$conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);


$consulta="SELECT 
vd.id_turno,
vd.id_producto,
p.descripcion producto,
vd.valor_total,
vd.cantidad_galones,
pt.fecha_inicio_programada,
pt.fecha_fin_programada
FROM venta_diaria vd,
	producto p,
    planilla_turno pt
WHERE vd.id_producto = p.id_producto
AND vd.id_turno = pt.id_turno
AND pt.fecha_inicio_programada BETWEEN '$fechai' AND '$fechaf'
AND pt.fecha_fin_programada BETWEEN '$fechai' AND '$fechaf'";
$resultado = mysqli_query($conexion, $consulta);


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;


$excel= new Spreadsheet();
$hojaActiva= $excel->getActiveSheet();
$hojaActiva->setTitle("InformeGestionPrimax");

$hojaActiva->getColumnDimension('A')->setWidth(20);
$hojaActiva->setCellValue('A1', 'PRODUCTOS');
$hojaActiva->getColumnDimension('B')->setWidth(20);
$hojaActiva->setCellValue('B1', 'VALOR TOTAL');
$hojaActiva->getColumnDimension('C')->setWidth(20);
$hojaActiva->setCellValue('C1', 'CANTIDAD');
$fila =2;


while ($row = $resultado->fetch_assoc()) {
$hojaActiva->setCellValue('A'.$fila, $row['producto']);
$hojaActiva->setCellValue('B'.$fila, $row['valor_total']);
$hojaActiva->setCellValue('C'.$fila, $row['cantidad_galones']);
$fila++;
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="InformeGestionPrimax.xls"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xls');
ob_clean();
$writer->save('php://output');
exit;
?>

