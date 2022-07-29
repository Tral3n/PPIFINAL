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
if(!isset($_POST['codigo'])){
    header('Location: BuscarTurno.php?mensaje=error');
        exit();
}

include "Conexion/Conexion.php";
$codigo=$_POST['codigo'];
$tipo_turno=$_POST['tipo_turno'];
$fecha_inicio=$_POST['fechai'];
$fecha_fin=$_POST['fechaf'];
$hora_inicio=$_POST['horai'];
$hora_fin=$_POST['horaf'];
$novedad=$_POST['novedad'];

$consulta="UPDATE planilla_turno SET id_tipo_turno='$tipo_turno', fecha_inicio_programada='$fecha_inicio', fecha_fin_programada='$fecha_fin',
                                        hora_inicio_programada='$hora_inicio', hora_fin_programada='$hora_fin', novedad='$novedad' WHERE id_turno='$codigo'";


$resultado = mysqli_query($conexion, $consulta);
if ($resultado) {

    header('Location: BuscarTurno.php?mensaje=editado');
        
} else {
    header('Location: BuscarTurno.php?mensaje=error');
        exit();
}


?>