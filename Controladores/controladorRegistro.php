<?php
session_start();
$_SESSION['mensaje'] = " ";

if ($_POST['formulario'] == 'registro') {

    $email = trim($_POST['email']);
    $user = trim($_POST['user_name']);
    $pass = trim($_POST['password']);
    $pass2= trim($_POST['password2']);
    $pregunta=trim($_POST['pregunta']);
    $respuesta=trim($_POST['respuesta']);

    

    if ($pass != $pass2) {

        if (isset($_SESSION['mensaje'])) {

          
           
            $_SESSION['mensaje']= "<div class='alert alert-danger'> <Strong>Las contraseñas no coinciden </Strong></div>";
            header('Location:../Registro.php');
            
        
    }} else {
        if (!empty($_POST["user_name"]) and !empty($_POST["password"]) and !empty($_POST["password2"])) {

           $con = mysqli_connect(
            "us-cdbr-east-04.cleardb.com",
                "be638dfe02bc87",
                "18c8a290",
                "heroku_f7036baf347b6a5"
           )or die(" no se conecto.");
            
           $consulta= "SELECT * FROM login_user WHERE email='$email'";
           $resultado = mysqli_query($con,$consulta);

           if(mysqli_num_rows($resultado) > 0){

            $_SESSION['mensaje']= "<div class='alert alert-danger'><Strong>El correo ya esta registrado, porfavor inicie sesion</Strong></div>";
            header('Location:../Registro.php');
           }else{
            $sql = "INSERT INTO login_user VALUES('','$email','$user','$pass','$pregunta','$respuesta')";
                echo $sql;
                if($con->query($sql)===TRUE){
                    "<br><br>";
                    "<center>".
                    $_SESSION['mensaje']= "<div class='alert alert-success'><Strong>Usuario Registrado Correctamente , Inicie sesion</Strong></div>"
                    ."</center>";
                    header("Location:../Registro.php");
                }else{
                    echo "Error: " . $sql . "<br>" . $con->error;
                }

           }
        }
    }
}
?>
