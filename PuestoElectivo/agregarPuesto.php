<?php

require_once '../Layout/layout.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../databaseHandler/databaseConnection.php';
require_once '../iDataBase/IDatabase.php';
require_once '../PuestoElectivo/PuestosHandler.php';
require_once '../objects/Puestos.php';
require_once '../template/template.php';


session_start();

$layout = new Layout(true, 'Agregar Puesto', false);
$data = new PuestosHandler('../databaseHandler');
$template = new template(true, 'Agregar Puesto', false);

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../PagesAdmin/loginAdministracion.php');
}

if(isset($_POST['nombre']) && isset($_POST['descripcion'])) {
    if($_POST['nombre'] == "" || $_POST['descripcion'] == "") {
        echo "<script> alert('Llene los espacios en blanco.'); </script>";

    } else {

        $puesto = new Puestos();
        $puesto->nombre = $_POST['nombre'];
        $puesto->descripcion = $_POST['descripcion'];

        $data->add($puesto);
        echo "<script> alert('El puesto ha sido añadido correctamente.'); </script>";

        header('Location: PuestoElectivo.php');
    }
}

?>

<?php $template->printHeaderAdmin();?>
<?php $template->printLink()?>
<?php $template->printScript() ?>

<br>
<br>
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <img class="mb-4" src="../assets/img/elecciones.jpg" alt="" width="350" height="120">
        <br>
        <form action='agregarPuesto.php' method="POST">
            <div class="form-group text-dark">
                <label for="nombrepuesto">Nombre del puesto</label>
                <input type="text" class="form-control" id="nombrepuesto" placeholder="Ingrese el nombre del nuevo puesto" name='nombre'>
            </div>
            <div class="form-group text-dark">
                <label for="descripcionpuesto">Descripción</label>
                <input type="text" class="form-control" id="descripcionpuesto" placeholder="Ingrese una descripción del puesto" name='descripcion'>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-outline-primary btn-block" type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>

<?php $template->printFooterAdmin(); ?>