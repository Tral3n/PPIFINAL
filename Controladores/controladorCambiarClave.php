<?php
session_start();
$_SESSION['mensaje'] = " ";

if ($_POST['formulario'] == 'recuperar') {

    $email = trim($_POST['email']);
    $respuesta = trim($_POST['respuesta']);

    $con = mysqli_connect(
        "localhost",
            "root",
            "",
            "gestor_empleados"
       )or die(" no se conecto.");

    $consulta = "SELECT * FROM login_user WHERE email='$email'";
    $resultado = mysqli_query($con,$consulta);
    $row = mysqli_fetch_array($resultado);

    if($respuesta != $row['respuesta_seguridad']){
        $_SESSION['mensaje']= "<div class='alert alert-danger'><Strong>La respuesta es incorrecta, ingrese la respuesta correcta o contacte al administrador</Strong></div>";
            header('Location:../RecuperarContraseña.php');
    }else{
       
        header('Location:../CambiarClave.php?email='.$email.'');
    }
}

?>



