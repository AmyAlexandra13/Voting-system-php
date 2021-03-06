<?php

require_once '../Layout/layout.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../iDataBase/IDatabase.php';
require_once 'CiudadanosHandler.php';
require_once '../objects/Ciudadanos.php';
require_once '../template/template.php';

session_start();

$layout = new Layout(true, 'Agregar Ciudadano', false);
$data = new CiudadanosHandler('../databaseHandler');
$template = new template(true, 'Agregar Ciudadano', false);

if (isset($_SESSION['administracion'])) {
    $administrador = json_decode($_SESSION['administracion']);
} else {
    header('Location: ../PagesAdmin/loginAdministracion.php');
}

if(isset($_POST['cedula']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email'])) {
    if($_POST['cedula'] == "" || $_POST['nombre'] == "" || $_POST['apellido'] == "" || $_POST['email'] == "") {
        echo "<script> alert('Llene los espacios en blanco.'); </script>";

    } else {

        $Ciudadanos = new Ciudadanos();
        $Ciudadanos->cedula = $_POST['cedula'];
        $Ciudadanos->nombre = $_POST['nombre'];
        $Ciudadanos->apellido = $_POST['apellido'];
        $Ciudadanos->email = $_POST['email'];

        $data->Add($Ciudadanos);

        echo "<script> alert('Ciudadano agregado con éxito'); </script>";
        header('Location: CiudadanosAdmin.php');
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
        <img class="mb-4" src="../assets/img/ciudadano.png" alt="" width="350" height="120">
        <br>
        <form enctype="multipart/form-data" action='agregarCiudadano.php' method="POST">
        <div class="form-group">
                <label for="cedulaciudadano">Cédula:</label>
                <input type="text" class="form-control" id="cedulaciudadano" placeholder="Ingrese la cédula del nuevo ciudadano" required name='cedula'>
            </div>
            <div class="form-group">
                <label for="nombreciudadano">Nombre del Ciudadano</label>
                <input type="text" class="form-control" id="nombreciudadano" placeholder="Ingrese el nombre del nuevo ciudadano" required name='nombre'>
            </div>
            <div class="form-group">
                <label for="apellidociudadano">Apellido del Candidato</label>
                <input type="text" class="form-control" id="apellidociudadano" placeholder="Ingrese el apellido del nuevo ciudadano" required name='apellido'>
            </div>
            <div class="form-group">
                <label for="apellidocandidato">Correo electrónico</label>
                <input type="email" class="form-control" id="emailciudadano" placeholder="example@correo.com" required name='email'>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-outline-primary btn-block" type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>


<<?php $template->printFooterAdmin() ?>