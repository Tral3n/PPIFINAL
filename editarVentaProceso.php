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
    header('Location: BuscarVenta.php?mensaje=error');
        exit();
}
include "Conexion/Conexion.php";
    $codigo=$_POST['codigo'];
    $ID_PRODUCTO = $_POST['id_producto'];
    $VALOR_TOTAL= $_POST['valort'];
    $CANTIDAD= $_POST['cantidad'];

    $consulta="UPDATE venta_diaria SET id_producto='$ID_PRODUCTO', valor_total='$VALOR_TOTAL', cantidad_galones='$CANTIDAD'
                WHERE id_venta_diaria='$codigo'";

$resultado = mysqli_query($conexion, $consulta);
if ($resultado) {

    header('Location: BuscarVenta.php?mensaje=editado');
        
} else {
    header('Location: BuscarVenta.php?mensaje=error');
        exit();
}
?>