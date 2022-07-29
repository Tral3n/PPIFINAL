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

<?php
if (!isset($_GET['email'])) {
        exit();
    }


    $email = $_GET['email'];
?>



    <div class="container">
        <div class="row row justify-content-center">
            <div class="col-4">
            <form action="Controladores/controladorContraseñaCambiada.php" method="POST" >
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <center><h2><b>Cambiar Clave</b></h2></center>
                    <br>
                    <center><h4>Ingrese una nueva contraseña</h4></center>
                    <br>


                    <br>
                    <br>
                    <br>
                    <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Password</b></label>
                            <input type="password" class="form-control" id="password"  name="password"  placeholder="*******" required>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Confirmar Password</b></label>
                            <input type="password" class="form-control" id="password2"  name="password2"  placeholder="*******" required>
                        </div>
                        <br>
                        <br>
                        <br>

                        <center><input type="hidden" name="formulario" class="btn btn-primary" value="cambio">
                        <input type="hidden" name="email" id="email" class="form-control" value="<?php echo $email  ?>">
                        <input type="submit" name="btnRecuperar" class="btn btn-primary" value="Cambiar Contraseña">
                        <a href="index.php"><input type="button" name="btnVolver" class="btn btn-primary" value="Cancelar"></a></center>
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
</body>
</html>