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
        <div class="row row justify-content-center">
            <div class="col-4">
            <form action="PreguntaSeguridad.php" method="POST" >
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center><h2><b>Recuperar Contraseña</b></h2></center>
                    <br>
                    <center><h4>Ingrese el correo para recuperar la contraseña</h4></center>
                    <br>


                    <br>
                    <br>
                    <br>
                    <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Correo Electronico</b></label>
                            <input type="email" class="form-control" id="email"  name="email"  placeholder="alguien@example.com" required>
                        </div>
                        <br>
                        <br>
                        <br>

                        <input type="hidden" name="formulario" class="btn btn-primary" value="recuperar">
                        <input type="submit" name="btnRecuperar" class="btn btn-primary" value="Recuperar Contraseña">
                        <a href="index.php"><input type="button" name="btnVolver" class="btn btn-primary" value="Iniciar Sesion"></a>
                        <a href="Registro.php"><input type="button" name="btnVolver" class="btn btn-primary" value="Registrarse"></a>
            </form>
            <br>
            <br>
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