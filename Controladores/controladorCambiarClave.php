<?php
session_start();
$_SESSION['mensaje'] = " ";

if ($_POST['formulario'] == 'recuperar') {

    $email = trim($_POST['email']);
    $respuesta = trim($_POST['respuesta']);

    $con = mysqli_connect(
        "us-cdbr-east-04.cleardb.com",
            "be638dfe02bc87",
            "18c8a290",
            "heroku_f7036baf347b6a5"
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



