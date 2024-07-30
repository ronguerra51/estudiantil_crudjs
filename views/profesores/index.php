
<?php include_once '../../includes/header.php'; ?>

<div class="container">
    <h1 class="text-center">FORMULARIO DE PROFESORES</h1>
    <div class="row justify-content-center mb-3">
        <form class="col-lg-8 border bg-light p-3" id="formProfesores">
            <input type="hidden" name="profesor_id" id="profesor_id">
            <div class="row mb-3">
                <div class="col">
                    <label for="profesor_nombre">Nombre</label>
                    <input type="text" name="profesor_nombre" id="profesor_nombre" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="profesor_apellido">Apellido</label>
                    <input type="text" name="profesor_apellido" id="profesor_apellido" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="profesor_email">Correo Electrónico</label>
                    <input type="text" name="profesor_email" id="profesor_email" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="profesor_telefono">Teléfono</label>
                    <input type="text" name="profesor_telefono" id="profesor_telefono" class="form-control" required>
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col">
                    <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
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
    <div class="row justify-content-center">
        <div class="col-lg-8 table-responsive">
            <h2 class="text-center">LISTA DE PROFESORES</h2>
            <table class="table table-bordered table-hover" id="tablaProfesores">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="10">NO HAY PROFESORES REGISTRADOS</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script defer src="/estudiantil_crudjs/src/js/funciones.js"></script>
<script defer src="/estudiantil_crudjs/src/js/profesores/index.js"></script>
<?php include_once '../../includes/footer.php'?>
