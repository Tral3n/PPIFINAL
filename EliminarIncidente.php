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
if (!isset($_GET['codigo'])) {
    header('Location: BuscarIncidente.php?mensaje=error');
    exit();
}

include "Conexion/Conexion.php";
$codigo = $_GET['codigo'];
$conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
$consulta = "DELETE FROM incidentes_por_turno WHERE id_incidente_por_turno ='$codigo'";
$resultado = mysqli_query($conexion, $consulta);
    
if($resultado){

    header('Location: BuscarIncidente.php?mensaje=eliminado');
}else{
    header('Location: BuscarIncidente.php?mensaje=error');
}

?>