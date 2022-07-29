<?php

session_start();
$_SESSION['mensaje'] = " ";


if($_POST['formulario'] == 'index'){



    $user = trim($_POST['user_name']);
    $pass = trim($_POST['password']);
    

    if (empty($user) or empty($pass)) {
        
        if (isset($_SESSION['mensaje'])) {
            
            $_SESSION['mensaje']= "
           <div class='center'>
            <div class='alert-danger '>
           
            Debes ingresar el usuario y el password 
            </div>
            </div>
             "
            ;
            header('Location:../index.php');
            

        }




    } else{

        if (!empty($_POST["user_name"]) and !empty($_POST["password"])) {

            $con = mysqli_connect(
                "localhost",
                "root",
                "",
                "gestor_empleados"
            ) or die("No se conecto.");

            $resultado_sql = mysqli_query(
                $con,
                "SELECT id, email FROM login_user WHERE user_name='" .$user. "'
                 AND pass= '" .$pass . "'"
            );
            print_r($con);

            $registro = mysqli_fetch_array($resultado_sql);

            if (is_array($registro)) {


                $_SESSION['id_session'] = $registro['id']."1000";
                $_SESSION['nombre_usuario'] = $registro['email'];
               
               

        
                header("Location:../Menu.php");
            } else {

                if (isset($_SESSION['mensaje'])) {
                      
                    $_SESSION['mensaje']= "
                    <div class='center'>
                    <div class='alert-danger '>
                    El usuario o password no son validos
                    </div>
                    </div>";
                    
                    header("Location:../index.php");
                    
                }
            }


    }


    }

}
?>
