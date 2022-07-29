<?php
session_start();

$_SESSION['mensaje'] = " ";

if ($_POST['formulario'] == 'recuperar') {

    $email = trim($_POST['email']);
}

include "Conexion/Conexion.php";
        $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
       

        $consulta="SELECT * FROM login_user WHERE email='$email'";
        $resultado = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($resultado) == 0){

            $_SESSION['mensaje']= "<div class='alert alert-danger'><Strong>El correo no esta registrado</Strong></div>";
            header('Location:index.php');
           }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Presentacion/css/fondo.css">
</head>

<body>
    <div class="container">
        <div class="row row justify-content-center">
            <div class="col-4">
                <form role="form" action="Controladores/controladorCambiarClave.php" method="POST">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center>
                        <h2><b>Pregunta Seguridad</b></h2>
                    </center>
                    <br>
                    <center>
                        <h4>Responda la pregunta de seguridad para cambiar la contraseña</h4>
                    </center>
                    <br>


                    <br>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="formGroupExampleInput" class="form-label"><b>Pregunta Seguridad</b></label><br>
                        <select name="pregunta" id="pregunta" class="form-control" required disabled>
                            <?php
                            include "Conexion/Conexion.php";
                            $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                            $query = "SELECT 
                                        lu.id_pregunta_seguridad,
                                        ps.descripcion preguntas_seguridad
                                        FROM login_user lu,
                                            preguntas_seguridad ps
                                        WHERE lu.id_pregunta_seguridad = ps.id_pregunta_seguridad
                                        AND lu.email = '$email'";
                            $result = mysqli_query($conexion, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option selected value="' . $row['id_pregunta_seguridad'] . '">' . $row['preguntas_seguridad'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <br>

                    <div class="form-group">
                        <label for="formGroupExampleInput" class="form-label"><b>Respuesta</b></label><br>
                        <input type="text" class="form-control" id="respuesta" name="respuesta" placeholder="Respuesta" required>
                        <br>
                    </div>
                    <br>

                    
                    <center><input type="hidden" name="formulario" class="btn btn-primary" value="recuperar">
                    <input type="hidden" name="email" id="email" class="form-control" value="<?php echo $email  ?>">
                        <input type="submit" name="btnRecuperar" class="btn btn-primary" value="Validar Respuesta">
                        <a href="RecuperarContraseña.php"><input type="button" name="btnVolver" class="btn btn-primary" value="Volver"></a>
                    </center>

                </form>

                <?php
                if (isset($_SESSION['mensaje'])) {
                    echo '<h5>' . $_SESSION['mensaje'] . '</h5>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>