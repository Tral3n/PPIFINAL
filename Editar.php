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

    <?php
    if (!isset($_GET['codigo'])) {
        header('Location: Buscar.php?mensaje=error');
        exit();
    }
    include "Conexion/Conexion.php";
    $codigo = $_GET['codigo'];
    $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
    $consulta = "SELECT * FROM empleado WHERE id_empleado='$codigo'";
    $resultado = mysqli_query($conexion, $consulta);
    while ($row = mysqli_fetch_array($resultado)) {
        $codigo=$row['id_empleado'];
        $direccion = $row['direccion'];
        $telefono = $row['telefono'];
        $estadoc = $row['id_estado_civil'];
        $contactof = $row['contacto_familiar'];
        $parentesco = $row['parentesco'];
        $telefonoc = $row['telefono_contacto'];
        $cargo = $row['id_cargo'];
        $tipo_contrato = $row['id_tipo_contrato'];
        $estado = $row['estado'];
    }

    $motivo=NULL;
    ?>
    <div class="container mt-5">

        <div class="form-area">
            <form class="p-4" method="POST" action="editarProceso.php">
                <br>
                <h2 style="margin-bottom: 25px; text-align: center;"><b>Editar Empleado</b></h2>
                <br>
                <br>
                <br>
                <div class="row justify-content-center">
                    <div class="col">


                    <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Empleado</b></label>
                            <select class="form-select" name="empleado" id="empleado" aria-label="Default select example" disabled>
                                
                                <?php
                                include "Conexion/Conexion.php";
                                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                $query = "SELECT  * FROM empleado WHERE id_empleado ='$codigo'";
                                $result = mysqli_query($conexion, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option selected value="' . $row['id_empleado'] . '">' . $row['nombres'] ." ".$row['apeliidos']. '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Dirección</b></label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección"  value="<?php echo $direccion;  ?>">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Telefono</b></label>
                            <input type="number" class="form-control" id="telefono" name="telefono" placeholder=" Telefono"  value="<?php echo $telefono;  ?>">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Estado Civil</b></label>
                            <select class="form-select" name="estadoc" id="estadoc" aria-label="Default select example"  value="<?php echo $estadoc;  ?>">
                                <?php
                                include "Conexion/Conexion.php";
                                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                $query2 = "SELECT * FROM estado_civil";
                                $result2 = mysqli_query($conexion, $query2);
                                while ($row = mysqli_fetch_array($result2)) {
                                    echo '<option value="' . $row['id_estado_civil'] . '">' . $row['descripcion'] . '</option>';
                                }
                                ?>
                                <?php
                                $query = "SELECT 
                                e.id_estado_civil,
                                ec.descripcion estado_civil
                                FROM empleado e,
                                    estado_civil ec
                                    WHERE e.id_estado_civil = ec.id_estado_civil
                                    AND e.id_empleado ='$codigo'";
                                $result = mysqli_query($conexion, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option selected value="' . $row['id_estado_civil'] . '">' . $row['estado_civil'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Contacto Familiar</b></label>
                            <input type="text" class="form-control" id="contactof" name="contactof" oninput="this.value = this.value.replace(/[^a-zA-Z ]/,'')" placeholder="Contacto Familiar"  value="<?php echo $contactof;  ?>">
                        </div>
                        <br>


                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Telefono Contacto</b></label>
                            <input type="number" class="form-control" id="telefonoc" name="telefonoc" placeholder=" Telefono Contacto"  value="<?php echo $telefonoc;  ?>">
                        </div>


                    </div>
                    <div class="col">

                    </div>
                    <div class="col">

                    <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Parentesco</b></label>
                            <select class="form-select" name="parentesco" id="parentesco" aria-label="Default select example"  value="<?php echo $parentesco;  ?>">
                                <option value="Padre">Padre</option>
                                <option value="Madre">Madre</option>
                                <option value="Hermano">Hermano</option>
                                <option value="Hijo">Hijo</option>
                                <option value="Amigo">Amigo</option>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Cargo</b></label>
                            <select class="form-select" name='ca' aria-label="Default select example"  value="<?php echo $cargo;  ?>">
                                
                            <?php
                                include "Conexion/Conexion.php";
                                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                $query2 = "SELECT * FROM cargo";
                                $result2 = mysqli_query($conexion, $query2);
                                while ($row = mysqli_fetch_array($result2)) {
                                    echo '<option value="' . $row['id_cargo'] . '">' . $row['descripcion'] . '</option>';
                                }
                                ?>
                                
                                <?php
                                include "Conexion/Conexion.php";
                                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                $query = "SELECT 
                                e.id_cargo,
                                c.descripcion cargo
                                FROM empleado e,
                                    cargo c
                                    WHERE e.id_cargo = c.id_cargo
                                    AND e.id_empleado ='$codigo'";
                                $result = mysqli_query($conexion, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option selected value="' . $row['id_cargo'] . '">' . $row['cargo'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Tipo Contrato</b></label>
                            <select class="form-select" name='tc' value="<?php echo $tipo_contrato;  ?>">
                                
                            <?php
                                include "Conexion/Conexion.php";
                                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                $query2 = "SELECT * FROM tipo_contrato";
                                $result2 = mysqli_query($conexion, $query2);
                                while ($row = mysqli_fetch_array($result2)) {
                                    echo '<option value="' . $row['id_tipo_contrato'] . '">' . $row['descripcion'] . '</option>';
                                }
                                ?>
                                
                                
                                <?php
                                include "Conexion/Conexion.php";
                                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                $query = "SELECT 
                                e.id_tipo_contrato,
                                tc.descripcion tipo_contrato
                                FROM empleado e,
                                    tipo_contrato tc
                                    WHERE e.id_tipo_contrato = tc.id_tipo_contrato
                                    AND e.id_empleado ='$codigo'";
                                $result = mysqli_query($conexion, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option selected value="' . $row['id_tipo_contrato'] . '">' . $row['tipo_contrato'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Estado</b></label>
                            <select class="form-select" name='es' aria-label="Default select example"  value="<?php echo $estado  ?>">
                                <option value="">Seleccionar</option>
                                <option value="Activo">Activo</option>
                                <option value="Innactivo">Innactivo</option>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Fecha Terminacion</b></label>
                            <input type="date" class="form-control" id="fechat" name="fechat">
                        </div>
                        <br>
                        

                        <div class="form-group">
                            <label for="formGroupExampleInput" class="form-label"><b>Motivo Terminacion</b></label>
                            <select class="form-select" name='mt'>
                                <option value="" selected>Seleccionar</option>
                                <?php
                                include "Conexion/Conexion.php";
                                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                                $query = "SELECT  * FROM motivo_terminacion";
                                $result = mysqli_query($conexion, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $row['id_motivo_terminacion'] . '">' . $row['descripcion'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                    </div>
                    <center><b><input type="hidden" name="codigo" value="<?php echo $codigo  ?>">
                                <input onclick="return confirm('Estas seguro de editar?');" type="submit" class="btn btn-primary" value="Editar">
                                <a href="Buscar.php"><input type="button" name="btnVolver" class="btn btn-primary" value="Volver"></a>
                            </b>
                    </center>
                </div>
            </form>
        </div>
    </div>
</body>

</html>