<?php


session_start();
$_SESSION['mensaje'] = " ";

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
        <div class="row">
            <div class="col-4">
                <form action="Controladores/controladorLogin.php" method="POST" align="left">
                    <div>

                    </div>
                    <br>
                    <br><br>
                    <br>
                    <br>
                    <br>
                    <h1><b>Gestor de empleados</b></h1>
                    <br>
                    <h4>Ingrese los datos para iniciar sesion</h4>
                    <br>
                    <br>
                    <div class="form-group">
                        <label for="formGroupExampleInput" class="form-label"><b>Usuario</b></label>
                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Usuario" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="formGroupExampleInput" class="form-label"><b>Password</b></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <br>
                    <br>

                    <input type="hidden" name="formulario" class="btn btn-primary" value="index">
                    <input type="submit" name="enviar" class="btn btn-primary" value="Iniciar sesión">
                    <a href="Registro.php"><input type="button" name="btnRegistrar" class="btn btn-primary" value="Registrarse"></a>
                    <br>
                    <br>
                    <a href="RecuperarContraseña.php" class="btn btn-primary">Olvido contraseña?</a>

                </form>

                <br>
                <br>
                <?php
                if (isset($_SESSION['mensaje'])) {
                    echo '<h2>' . $_SESSION['mensaje'] . '</h2>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>