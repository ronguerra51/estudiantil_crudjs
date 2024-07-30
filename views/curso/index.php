<?php include_once '../../includes/header.php' ?>

<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?> 

<?php
require '../../models/Profesor.php';

$profesorModel = new Profesores();

$profesores = $profesorModel->obtenerProfesores();

?>

<div class="container mt-5">
    <h1 class="text-center">CURSOS</h1>
    <div class="row justify-content-center">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form>
            <div class="row mb-4">
            <div class="row mb-3">
                <div class="col">
                    <label for="curso_nombre">NOMBRE DEL CURSO</label>
                    <input type="text" name="curso_nombre" id="curso_nombre" class="form-control" required>
                </div>
            </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label for="profesor_id" class="form-label">PROFESOR A IMPARTIR EL CURSO</label>
                    <select name="profesor_id" id="profesor_id" class="form-select">
                        <option value="">SELECCIONE...</option>
                        <?php foreach ($profesores as $profesor) : ?>
                            <option value="<?= htmlspecialchars($profesor['profesor_id']) ?>"><?= htmlspecialchars($profesor['profesor_nombre']), ' ' , htmlspecialchars($profesor['profesor_apellido']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col">
                    <button type="submit" id="btnAsignar" class="btn btn-primary w-100">Asignar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-secondary w-100">Cancelar</button>
                </div>
                <div class="col">
                    <button type="reset" id="btnLimpiar" class="btn btn-secondary w-100">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-8 table-responsive">
        <h2 class="text-center">TABLA DE AREAS CON SU PUESTO</h2>
        <table class="table table-bordered table-hover" id="tablaCursos">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre</th>
                    <th>Profesor</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5">No hay Cursos Registrados</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script defer src="/estudiantil_crudjs/src/js/funciones.js"></script>
<script defer src="/estudiantil_crudjs/src/js/curso/index.js"></script>

<?php include_once '../../includes/footer.php' ?>
