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
    header('Location: BuscarIncidente.php?mensaje=error');
        exit();
}

include "Conexion/Conexion.php";
$codigo=$_POST['codigo'];
$id_incidente=$_POST['id_incidente'];
$fecha_incidente=$_POST['fechai'];
$descripcion=$_POST['descripcion'];


$consulta="UPDATE incidentes_por_turno SET id_incidente='$id_incidente', fecha_incidente='$fecha_incidente', descripcion='$descripcion'
            WHERE id_incidente_por_turno='$codigo'";


$resultado = mysqli_query($conexion, $consulta);
if ($resultado) {

    header('Location: BuscarIncidente.php?mensaje=editado');
        
} else {
    header('Location: BuscarIncidente.php?mensaje=error');
        exit();
}


?>