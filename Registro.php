<?php
session_start();
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
        <br>
        <br>
        <center>
            <h2><b>Registro de usuarios</b></h2>
        </center>
        <br>
        <br>
        <br>
        <br>
        <form action="Controladores/controladorRegistro.php" method="POST" >
            <div class="row justify-content-center">
                <div class="col-4">
                    <div class="session-box">
                        <div class="media-body">
                            <div class="media align-items-center sm-avatar">

                                <div class="form-group">
                                    <label for="formGroupExampleInput" class="form-label"><b>Email</b></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                    <br>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="formGroupExampleInput" class="form-label"><b>Usuario</b></label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Usuario" required>
                                    <br>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="formGroupExampleInput" class="form-label"><b>Password</b></label><br>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <br>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="session-box">
                        <div class="media-body">
                            <div class="media align-items-center sm-avatar">
                                <div class="form-group">
                                    <label for="formGroupExampleInput" class="form-label"><b>Confirmar Password</b></label><br>
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Password" required>
                                    <br>
                                </div>
                                <br>


                                <div class="form-group">
                                    <label for="formGroupExampleInput" class="form-label"><b>Pregunta Seguridad</b></label><br>
                                    <select name="pregunta" id="pregunta" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        <?php
                                        include "Conexion/Conexion.php";
                                        $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                        $query = "SELECT  * FROM preguntas_seguridad";
                                        $result = mysqli_query($conexion, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $row['id_pregunta_seguridad'] . '">' . $row['descripcion'] . '</option>';
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <center><input type="hidden" name="formulario" class="btn btn-primary" value="registro">
            <input type="submit" name="enviar" class="btn btn-primary" value="Registrar">
            <a href="Registro.php"><input type="button" name="btnLimpiar" class="btn btn-primary" value="Limpiar"></a></center>
            <br><br>

            <?php
        session_destroy();
        ?>

        <center><a href="index.php"><input type="button" name="btnIniciar" class="btn btn-primary" value="Iniciar Sesion"></a></center>
        </form>

        <br><br>
        <?php
                if (isset($_SESSION['mensaje'])) {
                    echo '<h5>' . $_SESSION['mensaje'] . '</h5>';
                }
                ?>
    </div>
</body>

</html>