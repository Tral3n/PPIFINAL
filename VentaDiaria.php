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
    <form role="form" method="POST">
        <div class="row justify-content-center">
        <br>
                <br>

                <center>
                    <h4><b>Registro de ventas diarias</b></h4>
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
                                    <label for="formGroupExampleInput" class="form-label"><b>ID Turno(*)</b></label>
                                    <select name="id_turno" id="id_turno" class="form-control"  required>
                                        <option value="">Seleccione...</option>
                                        <?php
                                        include "Conexion/Conexion.php";
                                        $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                        $query = "SELECT 
                                        pt.id_turno,
                                        pt.id_empleado,
                                        e.nombres,
                                        e.apellidos,
                                        tt.descripcion tipo_turno
                                        FROM planilla_turno pt,
                                            empleado e,
                                            tipo_turno tt
                                        WHERE pt.id_empleado=e.id_empleado
                                        AND pt.id_tipo_turno=tt.id_tipo_turno;";
                                        $result = mysqli_query($conexion, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $row['id_turno'] . '">' . $row['id_empleado'] . " " . $row['nombres']." ".$row['apellidos']." ".$row['tipo_turno']. '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <br>
                    
                                <div class="form-group">
                                    <br>
                                    <label for="formGroupExampleInput" class="form-label"><b>ID Producto(*)</b></label>
                                    <select name="id_producto" id="id_producto" class="form-control"  required>
                                        <option value="">Seleccione...</option>
                                        <?php
                                        include "Conexion/Conexion.php";
                                        $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                        $query = "SELECT * from producto";
                                        $result = mysqli_query($conexion, $query);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value="' . $row['id_producto'] . '">' .$row['id_producto']." ". $row['descripcion']. '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                    </div>
                    </div>
                    </div>
        </div>
        
        <div class="col-4">
        <div class="session-box">
        <div class="media-body">
        <div class="media align-items-center sm-avatar">
            <br>
            <br>
            <br>
                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Valor Total(*)</b></label>
                            <input type="number" class="form-control" id="valort"  name="valort" placeholder="$$$$$" required>
                        </div>
                        <br>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Cantidad(*)</b></label>
                            <input type="number" class="form-control" id="cantidad"  name="cantidad" placeholder="#" required>
                        </div>
                        <br>                
        </div>
        </div>
        </div>
        </div>
        </div>
        <br>
        <br>
        <br>
        <center><b><input type="submit" name="btnRegistrar" class="btn btn-primary" value="Registrar Venta"></b>

                <a href="BuscarVenta.php"><input type="button" name="btnBuscar" class="btn btn-primary" value="Consultar Ventas"></a>

                <a href="VentaDiaria.php"><input type="button" name="btnLimpiar" class="btn btn-primary" value="Limpiar"></a>

                <a href="Menu.php"><input type="button" name="btnVolver" class="btn btn-primary" value="Volver"></a>
            </center>
            <br>
            <br>
    </form>
</div>

<?php
    if (isset($_REQUEST['btnRegistrar'])) {
        include "Conexion/Conexion.php";
        $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
    
    $ID_TURNO = $_POST['id_turno'];
    $ID_PRODUCTO = $_POST['id_producto'];
    $VALOR_TOTAL= $_POST['valort'];
    $CANTIDAD= $_POST['cantidad'];

        $consulta="INSERT INTO venta_diaria VALUES('','$ID_TURNO','$ID_PRODUCTO', '$VALOR_TOTAL', '$CANTIDAD')";

        $resultado = mysqli_query($conexion, $consulta);
        if ($resultado) {
    
            echo '<div class="alert alert-success">';
            echo '<Strong>---------Registro completo!</Strong>Se ha registrado una venta correctamente.';
            echo '</div>';
        } else {
            echo '<div class="alert alert-danger">';
            echo '<Strong> No se ha registrado la venta..</Strong>';
            echo '</div>';
        }
        mysqli_close($conexion);
    
    
    
    }
    ?>

    
</body>
</html>