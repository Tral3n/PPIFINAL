<?php
session_start();
$_SESSION['mensaje'] = " ";

if ($_POST['formulario'] == 'cambio') {
    $pass = trim($_POST['password']);
    $pass2= trim($_POST['password2']);
    $email = trim($_POST['email']);

    if ($pass != $pass2) {

        if (isset($_SESSION['mensaje'])) {

          
           
            
            $_SESSION['mensaje']= "<div class='alert alert-danger'> <Strong>Las contraseñas no coinciden </Strong></div>";
            header('Location:../CambiarClave.php?email='.$email.'');
            
        
    }}else{
        $con = mysqli_connect(
            "us-cdbr-east-04.cleardb.com",
                "be638dfe02bc87",
                "18c8a290",
                "heroku_f7036baf347b6a5"
           )or die(" no se conecto.");
            
           $consulta= "UPDATE login_user SET pass ='$pass' WHERE email='$email'";
           $resultado = mysqli_query($con,$consulta);

           if($resultado){

            $_SESSION['mensaje']= "<div class='alert alert-success'><Strong>Contraseña Cambiada Exitosamente</Strong></div>";
            header('Location:../index.php');
           }
    }
}
?>