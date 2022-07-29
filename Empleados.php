<?php
session_start();
if (
    isset($_SESSION['id_session']) and
    isset($_SESSION['nombre_usuario'])
) {




    $session = $_SESSION["id_session"];

    $usuario = $_SESSION["nombre_usuario"];
} else {
    header("location:pirata.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Presentacion/css/estiloTabla.css">
    <link rel="stylesheet" type="text/css" href="Presentacion/css/fondop.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="Menu.php"><b>Primax</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="EntradaSalida.php">Entrada Y Salida</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Empleados.php">Gestor Empleados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="Turnos.php">Turnos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="VentaDiaria.php">Ventas diarias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="Incidentes.php">Incidentes</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reportes
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="Reportes.php">Certificado Laboral</a></li>
            <li><a class="dropdown-item" href="Constancia.php">Constancia Laboral</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="Gestion.php">Informe Gestion</a></li>
          </ul>
        </li>
      </ul>
      <li class="nav-item">
      <a onclick="return confirm('Cerrar sesion?');" class="nav-link active" href="logout.php"><b>Cerrar Sesion <i class="bi bi-box-arrow-right"></i></b></a>
        </li>
    </div>
  </div>
</nav>
    <?php
    echo '<h6 align="left">' . '<b>' . $usuario . '</b>' . ' </h6>' . '<br/>';
    ?>
    <div class="container">
        <div class="form-area">
            <form role="form" method="POST">
                <br>
                <h3 style="margin-bottom: 25px; text-align: center;"><b>Gestor de empleados</b></h3>
                <br>
                
                <div>
                    <h5 style="margin-bottom: 50px; text-align: center;">Los campos marcados con (*) son obligatorios</h5>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Tipo Identificación(*)</b></label>
                            <select class="form-select" name='t' style="width: 300px;" aria-label="Default select example">
                                <option value="" selected>Seleccionar</option>
                                <?php
                                include "Conexion/Conexion.php";
                                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                $query = "SELECT  * FROM tipo_identificacion";
                                $result = mysqli_query($conexion, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $row['id_identificacion'] . '">' . $row['descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Numero Identificación(*)</b></label>
                            <input type="number" class="form-control" id="numero_identificacion" style="width: 300px;" name="numero_identificacion" placeholder="############">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Nombre(*)</b></label>
                            <input type="text" class="form-control" id="nombre" style="width: 300px;" name="nombre" oninput="this.value = this.value.replace(/[^a-zA-Z ]/,'')" placeholder="Nombre">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Apellidos(*)</b></label>
                            <input type="text" class="form-control" id="apellidos" style="width: 300px;" name="apellidos" oninput="this.value = this.value.replace(/[^a-zA-Z ]/,'')" placeholder="Apellidos">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Genero(*)</b></label>
                            <select class="form-select" name="genero" style="width: 300px;" required id="genero" aria-label="Default select example">
                                <option selected>Seleccionar</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Masculino">Masculino</option>
                                <option value="LGBTI">LGBTI</option>
                                <option value="No binario">No binario</option>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Dirección(*)</b></label>
                            <input type="text" class="form-control" id="direccion" style="width: 400px;" name="direccion" placeholder="Dirección">
                        </div>
                        <br>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Telefono(*)</b></label>
                            <input type="number" class="form-control" id="telefono" style="width: 200px;" name="telefono" placeholder=" ##########">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Fecha Nacimiento(*)</b></label>
                            <input type="date" class="form-control" id="fechan" style="width: 200px;" name="fechan" value="2005-12-31" min="1962-01-01" max="2005-12-31">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Estado Civil(*)</b></label>
                            <select class="form-select" name="estadoc" style="width: 200px;" id="estadoc" aria-label="Default select example">
                                <option selected>Seleccionar</option>
                                <?php
                                include "Conexion/Conexion.php";
                                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                $query = "SELECT  * FROM estado_civil";
                                $result = mysqli_query($conexion, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $row['id_estado_civil'] . '">' . $row['descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Contacto Familiar(*)</b></label>
                            <input type="text" class="form-control" id="contactof" style="width: 300px;" name="contactof" oninput="this.value = this.value.replace(/[^a-zA-Z ]/,'')" placeholder="Contacto Familiar">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Telefono Contacto(*)</b></label>
                            <input type="number" class="form-control" id="telefonoc" style="width: 200px;" name="telefonoc" placeholder="##########">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Parentesco(*)</b></label>
                            <select class="form-select" name="parentesco" style="width: 300px;" id="parentesco" aria-label="Default select example">
                                <option selected>Seleccionar</option>
                                <option value="Padre">Padre</option>
                                <option value="Madre">Madre</option>
                                <option value="Hermano">Hermano</option>
                                <option value="Hijo">Hijo</option>
                                <option value="Amigo">Amigo</option>
                            </select>
                        </div>
                        <br>
                    </div>
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Cargo(*)</b></label>
                            <select class="form-select" name='ca' style="width: 250px;" aria-label="Default select example">
                                <option value="">Seleccionar</option>
                                <?php
                                include "Conexion/Conexion.php";
                                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                $query = "SELECT  * FROM cargo";
                                $result = mysqli_query($conexion, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $row['id_cargo'] . '">' . $row['descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Tipo Contrato(*)</b></label>
                            <select class="form-select" name='ti' style="width: 250px;">
                                <option value="">Seleccionar</option>
                                <?php
                                include "Conexion/Conexion.php";
                                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                $query = "SELECT  * FROM tipo_contrato";
                                $result = mysqli_query($conexion, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $row['id_tipo_contrato'] . '">' . $row['descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Estado</b></label>
                            <select class="form-select" name='es' style="width: 250px;" aria-label="Default select example">
                                <option selected>Seleccionar</option>
                                <option value="Activo">Activo</option>
                                <option value="Innactivo">Innactivo</option>

                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Fecha Ingreso(*)</b></label>
                            <input type="date" class="form-control" id="fechai" style="width: 250px;" name="fechai" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <br>

                        

                    </div>
                </div>
                <br>

                <center>
                    <input type="submit" name="btnGuardar" class="btn btn-primary" value="Guardar">
                    <a href="Buscar.php"><input type="button" name="btnBuscar" class="btn btn-primary" value="Consultar"></a>
                    <input type="submit" name="btnLimpiar" class="btn btn-primary" value="Limpiar">
                    <a href="Menu.php"><input type="button" name="btnVolver" class="btn btn-primary" value="Volver"></a>

                </center>


                <br />

            </form>
        </div>
    </div>
    <?php
    if (isset($_REQUEST['btnGuardar'])) {
        include "Conexion/Conexion.php";
        $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);

        $TIPO_IDENTIFICACION = $_POST['t'];
        $NUMERO_IDENTIFICACION = $_POST['numero_identificacion'];
        $NOMBRE = $_POST['nombre'];
        $APELLIDOS = $_POST['apellidos'];
        $GENERO = $_POST['genero'];
        $DIRECCION = $_POST['direccion'];
        $TELEFONO = $_POST['telefono'];
        $FECHA_NACIMIENTO = $_POST['fechan'];
        $ESTADO_CIVIL = $_POST['estadoc'];
        $CONTACTO_FAMILIAR = $_POST['contactof'];
        $PARENTESCO = $_POST['parentesco'];
        $TELEFONO_CONTACTO = $_POST['telefonoc'];
        $CARGO = $_POST['ca'];
        $TIPO_CONTRATO = $_POST['ti'];
        $ESTADO = $_POST['es'];
        $FECHA_INGRESO = $_POST['fechai'];


        if (empty($TIPO_IDENTIFICACION = $_POST['t'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo tipo de identificacion es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($NUMERO_IDENTIFICACION = $_POST['numero_identificacion'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo numero de identificacion es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($NOMBRE = $_POST['nombre'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo nombre es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($APELLIDOS = $_POST['apellidos'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo apellidos es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($GENERO = $_POST['genero'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo sexo es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($DIRECCION = $_POST['direccion'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo direccion es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($TELEFONO = $_POST['telefono'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo telefono es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($ESTADO_CIVIL = $_POST['estadoc'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo estado civil es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($CONTACTO_FAMILIAR = $_POST['contactof'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo contacto familiar es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($PARENTESCO = $_POST['parentesco'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo parentesco es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($TELEFONO_CONTACTO = $_POST['telefonoc'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo telefono contacto es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($CARGO = $_POST['ca'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo cargo es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($TIPO_CONTRATO = $_POST['ti'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo tipo contrato es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } elseif (empty($ESTADO = $_POST['es'])) {
            echo '<div class="alert alert-danger">';
            echo '<Strong>---------El campo estado es obligatorio!</Strong> No se ha creado el empleado..';
            echo '</div>';
        } else {
            $consulta = "SELECT * FROM empleado WHERE numero_identificacion='$NUMERO_IDENTIFICACION'";
            $resultado = mysqli_query($conexion, $consulta);

            if (mysqli_num_rows($resultado) > 0) {
                echo '<div class="alert alert-danger">';
                echo '<Strong> El empleado ya existe..!</Strong>';
                echo '</div>';
            } else {
                $consulta1 = "INSERT INTO empleado(id_empleado, id_identificacion,numero_identificacion,nombres,apellidos,genero,direccion,telefono,fecha_nacimiento,id_estado_civil,contacto_familiar,parentesco,telefono_contacto,id_cargo, id_tipo_contrato, estado, fecha_ingreso)
                VALUES('','$TIPO_IDENTIFICACION','$NUMERO_IDENTIFICACION',
            '$NOMBRE','$APELLIDOS','$GENERO','$DIRECCION','$TELEFONO','$FECHA_NACIMIENTO','$ESTADO_CIVIL','$CONTACTO_FAMILIAR','$PARENTESCO','$TELEFONO_CONTACTO','$CARGO'
            ,'$TIPO_CONTRATO','$ESTADO','$FECHA_INGRESO')";
                $resultado1 = mysqli_query($conexion, $consulta1);



                if ($resultado1) {
                    echo '<div class="alert alert-success">';
                    echo '<Strong>---------Registro completo!</Strong>Se ha registrado un empleado correctamente.';
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-danger">';
                    echo '<Strong> No se ha creado el empleado..!</Strong>';
                    echo '</div>';
                }
            }
        }
        mysqli_close($conexion);
    }
    ?>




</body>

</html>