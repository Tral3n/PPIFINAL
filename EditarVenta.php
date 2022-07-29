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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
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
              <li>
                <hr class="dropdown-divider">
              </li>
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
    header('Location: BuscarVenta.php?mensaje=error');
    exit();
  }
  include "Conexion/Conexion.php";
  $codigo = $_GET['codigo'];
  $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
  $consulta = "SELECT * FROM venta_diaria WHERE id_venta_diaria='$codigo'";
  $resultado = mysqli_query($conexion, $consulta);

  while ($row = mysqli_fetch_array($resultado)) {

    $codigo = $row['id_venta_diaria'];
    $id_turno = $row['id_turno'];
    $id_producto = $row['id_producto'];
    $valor_total = $row['valor_total'];
    $cantidad = $row['cantidad_galones'];
  }
  ?>

  <div class="container mt-5">
    <div class="form-area">
      <form class="p-4" method="POST" action="editarVentaProceso.php">
        <br>
        <h2 style="margin-bottom: 25px; text-align: center;"><b>Editar Venta</b></h2>
        <br>
        <br>
        <br>
        <div class="row justify-content-center">
          <div class="col-4">
            <div class="form-group">
              <br>
              <label for="formGroupExampleInput" class="form-label"><b>ID Turno</b></label>
              <select name="id_turno" id="id_turno" class="form-control"  value="<?php echo $id_turno;  ?>" disabled>
                <option selected value="<?php echo $id_turno;  ?>"><?php echo $id_turno;  ?></option>
              </select>
            </div>
            <br>

            <div class="form-group">
              <br>
              <label for="formGroupExampleInput" class="form-label"><b>ID Producto</b></label>
              <select name="id_producto" id="id_producto" class="form-control" value="<?php echo $id_producto;  ?>">
                
                <?php
                include "Conexion/Conexion.php";
                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                $query = "SELECT * from producto";
                $result = mysqli_query($conexion, $query);
                while ($row = mysqli_fetch_array($result)) {
                  echo '<option value="' . $row['id_producto'] . '">' . $row['id_producto'] . " " . $row['descripcion'] . '</option>';
                }
                ?>

                <?php
                include "Conexion/Conexion.php";
                $conexion = mysqli_connect($db_host, $db_usuario, $db_pw, $db_nombre);
                $query = "SELECT  
                vd.id_venta_diaria,
                vd.id_producto,
                p.descripcion producto
                FROM venta_diaria vd,
                    producto p
                WHERE vd.id_producto = p.id_producto
                AND id_venta_diaria ='$codigo'";
                $result = mysqli_query($conexion, $query);
                while ($row = mysqli_fetch_array($result)) {
                  echo '<option selected value="' . $row['id_producto'] . '">' . $row['producto'] . '</option>';
                }
                ?>
              </select>
            </div>
          </div>

          <div class="col-4">
            <br>

            <div class="form-group">
              <label for="formGroupExampleInput" class="form-label"><b>Valor Total</b></label>
              <input type="number" class="form-control" id="valort" name="valort" placeholder="$$$$$" value="<?php echo $valor_total;  ?>" required>
            </div>
            <br>
            <br>

            <div class="form-group">
              <label for="formGroupExampleInput" class="form-label"><b>Cantidad</b></label>
              <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="#" value="<?php echo $cantidad;  ?>" required>
            </div>
            <br>
          </div>

          <center><b><input type="hidden" name="codigo" value="<?php echo $codigo  ?>">
              <input onclick="return confirm('Estas seguro de editar?');" type="submit" class="btn btn-primary" value="Editar">
              <a href="BuscarVenta.php"><input type="button" name="btnVolver" class="btn btn-primary" value="Volver"></a>
            </b>
          </center>

        </div>

      </form>
    </div>
  </div>

</body>

</html>