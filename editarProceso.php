<?php

session_start();
if (
    isset($_SESSION['id_session']) and
    isset($_SESSION['nombre_usuario'])
) {


    $session = $_SESSION["id_session"];
    $usuario = $_SESSION["nombre_usuario"];
} else {
    header("Location:pirata.php");
}

?>
<?php
print_r($_POST);
if (!isset($_POST['codigo'])) {
    header('Location: Buscar.php?mensaje=error');
    exit();
}

include "Conexion/Conexion.php";
$codigo = $_POST['codigo'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$estadoc = $_POST['estadoc'];
$contactof = $_POST['contactof'];
$parentesco = $_POST['parentesco'];
$telefonoc = $_POST['telefonoc'];
$cargo = $_POST['ca'];
$tipo_contrato = $_POST['tc'];
$estado = $_POST['es'];
$fecha_terminacion = $_POST['fechat'];
$motivo = $_POST['mt'];


if (!empty($_POST["mt"])) {

    $consulta = "UPDATE empleado SET direccion='$direccion',telefono='$telefono',id_estado_civil='$estadoc',contacto_familiar='$contactof',parentesco='$parentesco',
telefono_contacto='$telefonoc',
id_cargo='$cargo',id_tipo_contrato='$tipo_contrato',estado='$estado',fecha_terminacion='$fecha_terminacion',id_motivo_terminacion='$motivo' 
WHERE id_empleado ='$codigo'";
    
}else{
    $consulta = "UPDATE empleado SET direccion='$direccion',telefono='$telefono',id_estado_civil='$estadoc',contacto_familiar='$contactof',parentesco='$parentesco',
telefono_contacto='$telefonoc',
id_cargo='$cargo',id_tipo_contrato='$tipo_contrato',estado='$estado',fecha_terminacion='$fecha_terminacion' 
WHERE id_empleado ='$codigo'";
}

$resultado = mysqli_query($conexion, $consulta);
if ($resultado) {

    header('Location: Buscar.php?mensaje=editado');
} else {
    header('Location: Buscar.php?mensaje=error');
    exit();
}
?>