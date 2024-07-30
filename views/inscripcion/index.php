<?php include_once '../../includes/header.php' ?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
require '../../models/Estudiante.php';
require '../../models/Curso.php';

$estudianteModel = new Estudiantes();
$cursoModel = new Cursos();

$estudiantes = $estudianteModel->obtenerEstudiantes();
$cursos = $cursoModel->obtenerCursos();

?>

<div class="container mt-5">
    <h1 class="text-center">INSCRIPCION DE ESTUDIANTES A CURSOS</h1>
    <div class="row justify-content-center">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form>
            <div class="row mb-4">
                <div class="col">
                    <label for="estudiante_id" class="form-label">ESTUDIANTE</label>
                    <select name="estudiante_id" id="estudiante_id" class="form-select">
                        <option value="">SELECCIONE...</option>
                        <?php foreach ($estudiantes as $estudiante) : ?>
                            <option value="<?= htmlspecialchars($estudiante['estudiante_id']) ?>"><?= htmlspecialchars($estudiante['estudiante_nombre']), ' ', htmlspecialchars($estudiante['estudiante_apellido']) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label for="curso_id" class="form-label">ASIGNAR CURSO A ESTUDIANTE</label>
                    <select name="curso_id" id="curso_id" class="form-select">
                        <option value="">SELECCIONE...</option>
                        <?php foreach ($cursos as $curso) : ?>
                            <option value="<?= htmlspecialchars($curso['curso_id']) ?>"><?= htmlspecialchars($curso['curso_nombre'])?></option>
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
        <h2 class="text-center">TABLA DE ESTUDIANTES CON SU CURSO</h2>
        <table class="table table-bordered table-hover" id="tablaInscripcion">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nombre Estudiante</th>
                    <th>Apellido Estudiante</th>
                    <th>Curso</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5">No hay Estudiantes con Cursos Registrados</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script defer src="/estudiantil_crudjs/src/js/funciones.js"></script>
<script defer src="/estudiantil_crudjs/src/js/inscripcion/index.js"></script>
<?php include_once '../../includes/footer.php' ?>