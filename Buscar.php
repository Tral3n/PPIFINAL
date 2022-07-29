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
        <h2><b>Gestor Empleados</b></h2>
    </center>
    <?php
    if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error') {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Escoja un empleado valido para editar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>
  <br>
  <br>
    <?php
    if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado') {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Modificacion exitosa</strong> Campos actualizados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>

    <?php
    if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado') {
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminacion exitosa</strong> El empleado ha sido eliminado con exito.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    ?>
    <br>
    <br>

    <div class="container-fluid">
        <div class="row justify-content-center">
           <div class="col">
           <form role="form" method="POST">
                <div class="form-group" align="left">
                    <label for="formGroupExampleInput" class="form-label"><b>Numero de identificacion del empleado</b></label>
                    <input type="number" class="form-control" id="numero_identificacion_empleado" style="width: 200px;" name="numero_identificacion_empleado" placeholder=" # Identificación">
                    <br>
                    <input type="submit" name="btnConsultar" class="btn btn-primary" value="Consultar">
                </div>
                <br>





                <?php

                if (isset($_REQUEST['btnConsultar'])) {
                    include "Conexion/Conexion.php";
                    $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                    $IDENTIFICACION = $_POST['numero_identificacion_empleado'];

                    if (empty($IDENTIFICACION = $_POST['numero_identificacion_empleado'])) {
                        $consulta = "SELECT e.id_empleado,
                        ti.descripcion tipo_identificacion,
                        e.numero_identificacion,
                        e.nombres,
                        e.apellidos,
                        e.genero,
                        e.direccion,
                        e.telefono,
                        e.fecha_nacimiento,
                        ec.descripcion estado_civil,
                        e.contacto_familiar,
                        e.parentesco,
                        e.telefono_contacto,
                        ca.descripcion cargo,
                        tc.descripcion tipo_contrato,
                        e.estado,
                        e.fecha_ingreso,
                        e.fecha_terminacion,
                        mt.descripcion id_motivo_terminacion
                 FROM empleado e LEFT JOIN motivo_terminacion mt ON e.id_motivo_terminacion=mt.id_motivo_terminacion ,
                     tipo_contrato tc,
                     cargo ca,
                     tipo_identificacion ti,
                     estado_civil ec
                 WHERE e.id_tipo_contrato=tc.id_tipo_contrato
                 and e.id_cargo=ca.id_cargo
                 and e.id_identificacion=ti.id_identificacion
                 and e.id_estado_civil=ec.id_estado_civil
                 ";
                    } else {
                        $consulta = "SELECT e.id_empleado,
        ti.descripcion tipo_identificacion,
        e.numero_identificacion,
        e.nombres,
        e.apellidos,
        e.genero,
        e.direccion,
        e.telefono,
        e.fecha_nacimiento,
        ec.descripcion estado_civil,
        e.contacto_familiar,
        e.parentesco,
        e.telefono_contacto,
        ca.descripcion cargo,
        tc.descripcion tipo_contrato,
        e.estado,
        e.fecha_ingreso,
        e.fecha_terminacion,
        mt.descripcion id_motivo_terminacion
 FROM empleado e LEFT JOIN motivo_terminacion mt ON e.id_motivo_terminacion=mt.id_motivo_terminacion ,
     tipo_contrato tc,
     cargo ca,
     tipo_identificacion ti,
     estado_civil ec
 WHERE e.id_tipo_contrato=tc.id_tipo_contrato
 and e.id_cargo=ca.id_cargo
 and e.id_identificacion=ti.id_identificacion
 and e.id_estado_civil=ec.id_estado_civil
 and e.numero_identificacion='$IDENTIFICACION'";
                    }
                    $resultado = mysqli_query($conexion, $consulta);








                    echo '<table class="table table-dark table-striped align-left">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col"># Empleado</th>';
                    echo '<th scope="col">Numero identificacion</th>';
                    echo '<th scope="col">Nombre</th>';
                    echo '<th scope="col">Apellidos</th>';
                    echo '<th scope="col">Genero</th>';
                    echo '<th scope="col">Direccion</th>';
                    echo '<th scope="col">Telefono</th>';
                    echo '<th scope="col">Fecha Nacimiento</th>';
                    echo '<th scope="col">Estado civil</th>';
                    echo '<th scope="col">Contacto Familiar</th>';
                    echo '<th scope="col">Parentesco</th>';
                    echo '<th scope="col">Telefono contacto</th>';
                    echo '<th scope="col">Cargo</th>';
                    echo '<th scope="col">Tipo contrato</th>';
                    echo '<th scope="col">Estado</th>';
                    echo '<th scope="col">Fecha ingreso</th>';
                    echo '<th scope="col">Fecha terminacion</th>';
                    echo '<th scope="col">Motivo terminacion</th>';
                    echo '<th scope="col" colspan="2">Opciones</th>';
                    echo '</tr>';
                    echo '</thead>';
                    while ($row = mysqli_fetch_array($resultado)) {
                        echo '<tbody>';
                        echo '<tr>';
                        echo '<td>' . $row['id_empleado'] . '</td>';
                        echo '<td>' . $row['numero_identificacion'] . '</td>';
                        echo '<td>' . $row['nombres'] . '</td>';
                        echo '<td>' . $row['apellidos'] . '</td>';
                        echo '<td>' . $row['genero'] . '</td>';
                        echo '<td>' . $row['direccion'] . '</td>';
                        echo '<td>' . $row['telefono'] . '</td>';
                        echo '<td>' . $row['fecha_nacimiento'] . '</td>';
                        echo '<td>' . $row['estado_civil'] . '</td>';
                        echo '<td>' . $row['contacto_familiar'] . '</td>';
                        echo '<td>' . $row['parentesco'] . '</td>';
                        echo '<td>' . $row['telefono_contacto'] . '</td>';
                        echo '<td>' . $row['cargo'] . '</td>';
                        echo '<td>' . $row['tipo_contrato'] . '</td>';
                        echo '<td>' . $row['estado'] . '</td>';
                        echo '<td>' . $row['fecha_ingreso'] . '</td>';
                        echo '<td>' . $row['fecha_terminacion'] . '</td>';
                        echo '<td>' . $row['id_motivo_terminacion'] . '</td>';
                        echo '<td>' . '<a onclick="return confirm('."'Estas seguro de editar?'".');"class="text-success" href="Editar.php?codigo=' . $row['id_empleado'] . '"><i class="bi bi-pencil-square"></i></a>' . '</td>';
                        echo '<td>' . '<a onclick="return confirm('."'Estas seguro de eliminar?'".');" class="text-danger" href="Eliminar.php?codigo=' . $row['id_empleado'] . '"><i class="bi bi-trash3"></i></i></a>' . '</td>';
                        echo '</tr>';
                        echo '</tbody>';
                    }
                    echo '</table>';
                }
                ?>


            </form>
           </div>
        </div>
    </div>


</body>

</html>