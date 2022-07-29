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
if(!isset($_POST['codigo'])){
    header('Location: BuscarEntrada.php?mensaje=error');
        exit();
}

include "Conexion/Conexion.php";
$codigo=$_POST['codigo'];
$hora_fin=$_POST['horaf'];



$consulta="UPDATE planilla_turno SET hora_fin_registrada='$hora_fin' WHERE id_turno='$codigo'";


$resultado = mysqli_query($conexion, $consulta);
if ($resultado) {

    header('Location: BuscarEntrada.php?mensaje=editado');
        
} else {
    header('Location: BuscarEntrada.php?mensaje=error');
        exit();
}


?>