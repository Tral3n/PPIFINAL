<?php

session_start();
if (
    isset($_SESSION['id_session']) and
    isset($_SESSION['nombre_usuario'])
) {


    $session = $_SESSION["id_session"];
    $usuario = $_SESSION["nombre_usuario"];
} else {
    header("Location:pirata.php");
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
    <br>
    <br>

    <center>
        <h2><b>Gestor Incidentes</b></h2>
    </center>
    <br>
  <br>
    <?php
    if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error') {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Escoja un incidente valido para editar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>

    <?php
    if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado') {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Modificacion exitosa</strong> incidente actualizado.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>

    <?php
    if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado') {
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminacion exitosa</strong> El incidente ha sido eliminado con exito.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>
    <br>
    <br>

    <div class="container">
    <div class="row justify-content-center">
    <?php
            include "Conexion/Conexion.php";
            $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
            $consulta ="SELECT 
            ipt.id_incidente_por_turno,
            ipt.id_incidente,
            i.descripcion incidentes,
            ipt.id_turno,
            ipt.fecha_incidente,
            ipt.descripcion
            FROM incidentes_por_turno ipt,
                    incidentes i
            WHERE ipt.id_incidente = i.id_incidente;";
            $resultado = mysqli_query($conexion, $consulta);

            echo '<table class="table table-dark table-striped align-left">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Id Incidente Por Turno</th>';
                    echo '<th scope="col">Id Incidente</th>';
                    echo '<th scope="col">Tipo Incidente</th>';
                    echo '<th scope="col">Id Turno</th>';
                    echo '<th scope="col">Fecha Incidente</th>';
                    echo '<th scope="col">Descripcion</th>';
                    echo '<th scope="col" colspan="2">Opciones</th>';
                    echo '</tr>';
                    echo '</thead>';
                    while ($row = mysqli_fetch_array($resultado)) {
                        echo '<tbody>';
                        echo '<tr>';
                        echo '<td>' . $row['id_incidente_por_turno'] . '</td>';
                        echo '<td>' . $row['id_incidente'] . '</td>';
                        echo '<td>' . $row['incidentes'] . '</td>';
                        echo '<td>' . $row['id_turno'] . '</td>';
                        echo '<td>' . $row['fecha_incidente'] . '</td>';
                        echo '<td>' . $row['descripcion'] . '</td>';
                        echo '<td>' . '<a onclick="return confirm('."'Estas seguro de editar?'".');"class="text-success" href="EditarIncidente.php?codigo=' . $row['id_incidente_por_turno'] . '"><i class="bi bi-pencil-square"></i></a>' . '</td>';
                        echo '<td>' . '<a onclick="return confirm('."'Estas seguro de eliminar?'".');" class="text-danger" href="EliminarIncidente.php?codigo=' . $row['id_incidente_por_turno'] . '"><i class="bi bi-trash3"></i></i></a>' . '</td>';
                        echo '</tr>';
                        echo '</tbody>';
                    }
                    echo '</table>';

            





            ?>
    </div>
    </div>
    
</body>
</html>