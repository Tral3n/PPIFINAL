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
    <link rel="stylesheet" type="text/css" href="Presentacion/css/estiloTabla.css">
    <link rel="stylesheet" type="text/css" href="Presentacion/css/fondop.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

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
        <form role="form" method="POST">
            <div class="row justify-content-center">
                <br>
                <br>

                <center>
                    <h4><b>Registro de turnos</b></h4>
                </center>
                <br>
                <h5 style="margin-bottom: 25px; text-align: center;">Los campos marcados con (*) son obligatorios</h5>
                <div class="col-4">
                    <br>
                    <br>

                    <div class="session-box">
                        <div class="media-body">
                            <div class="media align-items-center sm-avatar">

                                <div class="form-group">
                                    <br>
                                    <label for="formGroupExampleInput" class="form-label"><b>ID Empleado</b></label>
                                    <select name="id_empleado" id="id_empleado" class="form-control"  required>
                                        <option value="">Seleccione...</option>
                                        <?php
                                        include "Conexion/Conexion.php";
                                        $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                        $query = "SELECT  * FROM empleado";
                                        $result = mysqli_query($conexion, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $row['id_empleado'] . '">' . $row['nombres'] . " " . $row['apellidos'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="formGroupExampleInput" class="form-label"><b>Tipo turno</b></label>
                                    <select name="tipo_turno" id="tipo_turno" class="form-control"  required>
                                        <option value="">Seleccione...</option>
                                        <?php
                                        include "Conexion/Conexion.php";
                                        $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                        $query = "SELECT  * FROM tipo_turno";
                                        $result = mysqli_query($conexion, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $row['id_tipo_turno'] . '">' . $row['descripcion'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="formGroupExampleInput" class="form-label"><b>Fecha Inicio(*)</b></label>
                                    <input type="date" class="form-control" id="fechai" name="fechai"  required value="<?php echo date("Y-m-d");?>" min="<?php echo date("Y-m-d");?>" >
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="formGroupExampleInput" class="form-label"><b>Fecha Fin(*)</b></label>
                                    <input type="date" class="form-control" id="fechaf" name="fechaf"  required value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-4">
                    <br>
                    <br>
                    <br>

                    <div class="form-group">
                        <label for="formGroupExampleInput" class="form-label"><b>Hora Inicio(*)</b></label>
                        <input type="time" class="form-control" id="horai" name="horai"  placeholder="Hora Inicio" value="06:00" required></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="formGroupExampleInput" class="form-label"><b>Hora Fin(*)</b></label>
                        <input type="time" class="form-control" id="horaf" name="horaf"  placeholder="Hora Fin"  required></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="formGroupExampleInput" class="form-label"><b>Novedad</b></label>
                        <textarea type="text" class="form-control" id="novedad"   name="novedad" value="" style="height: 134px;" placeholder="Novedad"></textarea>
                    </div>
                    <br>
                </div>
            </div>
            <br>
            <br>
            <center><b><input type="submit" name="btnRegistrar" class="btn btn-primary" value="Registrar Turno"></b>

                <a href="BuscarTurno.php"><input type="button" name="btnBuscar" class="btn btn-primary" value="Consultar Turnos"></a>

                <input type="submit" name="btnLimpiar" class="btn btn-primary" value="Limpiar">

                <a href="Menu.php"><input type="button" name="btnVolver" class="btn btn-primary" value="Volver"></a>
            </center>
        </form>
    </div>


    <?php
    if (isset($_REQUEST['btnRegistrar'])) {
        include "Conexion/Conexion.php";
        $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);

        $ID_EMPLEADO = $_POST['id_empleado'];
        $TIPO_TURNO = $_POST['tipo_turno'];
        $FECHA_INICIO=$_POST['fechai'];
        $FECHA_FIN=    $_POST['fechaf'];
        $HORA_INICIO =$_POST['horai'];
        $HORA_FIN =$_POST['horaf'];
        $NOVEDAD =$_POST['novedad'];

        if(empty($ID_EMPLEADO= $_POST['id_empleado'])){
            echo '<div class="alert alert-danger">';
                echo '<Strong>Seleccione un empleado para asignar el turno</Strong>';
                echo '</div>';
        }elseif(empty($TIPO_TURNO= $_POST['tipo_turno'])){
            echo '<div class="alert alert-danger">';
                echo '<Strong>Ingrese la hora de inicio del turno</Strong>';
                echo '</div>';
        }elseif(empty($HORA_FIN= $_POST['horaf'])){
            echo '<div class="alert alert-danger">';
                echo '<Strong>Ingrese la hora de terminacion del turno</Strong>';
                echo '</div>';
        }else{
    
    
    
    
        $consulta = "INSERT INTO planilla_turno (id_turno,id_empleado,id_tipo_turno,fecha_inicio_programada,fecha_fin_programada,
        hora_inicio_programada,hora_fin_programada,novedad) VALUES('','$ID_EMPLEADO','$TIPO_TURNO','$FECHA_INICIO','$FECHA_FIN',
    '$HORA_INICIO','$HORA_FIN','$NOVEDAD')";
    
    
    
        $resultado = mysqli_query($conexion, $consulta);
        if ($resultado) {
    
            echo '<div class="alert alert-success">';
            echo '<Strong>---------Registro completo!</Strong>Se ha registrado un turno correctamente.';
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger">';
            echo '<Strong> No se ha registrado el turno..</Strong>';
            echo '</div>';
        }
        }
        mysqli_close($conexion);


    }
    ?>


</body>

</html>