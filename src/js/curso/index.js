document.addEventListener('DOMContentLoaded', () => {
    const btnAsignar = document.getElementById('btnAsignar');
    const btnBuscar = document.getElementById('btnBuscar');
    const btnCancelar = document.getElementById('btnCancelar');
    const btnLimpiar = document.getElementById('btnLimpiar');
    const tablaCursos = document.getElementById('tablaCursos');
    const formulario = document.querySelector('form');


    const getCursos = async () => {
        const nombre = formulario.curso_nombre.value;
        const profesor = formulario.profesor_id.value;
        const url = `/estudiantil_crudjs/controllers/cursos/index.php?curso_nombre=${nombre}&profesor_id=${profesor}`;
        const config = {
            method: 'GET'
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            tablaCursos.tBodies[0].innerHTML = '';
            const fragment = document.createDocumentFragment();
            let contador = 1;

            if (respuesta.status == 200) {
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: 'Cursos encontrados',
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();

                if (data.length > 0) {
                    data.forEach(curso => {
                        const tr = document.createElement('tr');
                        const celda1 = document.createElement('td');
                        const celda2 = document.createElement('td');
                        const celda3 = document.createElement('td');
                        const celda4 = document.createElement('td');
                        const celda5 = document.createElement('td');
                        const celda6 = document.createElement('td');
                        const buttonEliminar = document.createElement('button');

                        celda1.innerText = contador;
                        celda2.innerText = curso.curso_nombre;
                        celda3.innerText = curso.profesor_nombre;
                        celda4.innerText = curso.profesor_apellido;

                        buttonEliminar.textContent = 'Eliminar';
                        buttonEliminar.classList.add('btn', 'btn-danger', 'w-100');
                        buttonEliminar.addEventListener('click', () => eliminarCurso(curso.curso_id));

                        celda5.appendChild(buttonEliminar);

                        tr.appendChild(celda1);
                        tr.appendChild(celda2);
                        tr.appendChild(celda3);
                        tr.appendChild(celda4);
                        tr.appendChild(celda5);
                        fragment.appendChild(tr);

                        contador++;
                    });
                } else {
                    const tr = document.createElement('tr');
                    const td = document.createElement('td');
                    td.innerText = 'No hay Cursos registrados';
                    td.colSpan = 5;

                    tr.appendChild(td);
                    fragment.appendChild(tr);
                }
            } else {
                console.log('Error al buscar cursos');
            }

            tablaCursos.tBodies[0].appendChild(fragment);
        } catch (error) {
            console.log(error);
        }
    };

    const guardarCurso = async (e) => {
        e.preventDefault();
        btnAsignar.disabled = true;

        const url = '/estudiantil_crudjs/controllers/cursos/index.php';
        const formData = new FormData(formulario);
        formData.append('tipo', 1);
        formData.delete('curso_id');
        const config = {
            method: 'POST',
            body: formData
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            const { mensaje, codigo, detalle } = data;
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "success",
                title: mensaje,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
            if (codigo == 1 && respuesta.status == 200) {
                getCursos();
                formulario.reset();
            } else {
                console.log(detalle);
            }

        } catch (error) {
            console.log(error);
        }
        btnAsignar.disabled = false;
    };

    const modificar = async (e) => {
        e.preventDefault();
        btnModificar.disabled = true;

        const url = '/estudiantil_crudjs/controllers/cursos/index.php';
        const formData = new FormData(formulario);
        formData.append('tipo', 2);
        formData.append('curso_id', formulario.curso_id.value);
        const config = {
            method: 'POST',
            body: formData
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            const { mensaje, codigo, detalle } = data;
            if (respuesta.ok && codigo === 1) {
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: mensaje,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();
                formulario.reset();
                getCursos();
                btnBuscar.parentElement.style.display = '';
                btnAsignar.parentElement.style.display = '';
                btnLimpiar.parentElement.style.display = '';
                if (btnModificar) {
                    btnModificar.parentElement.style.display = 'none';
                }
                if (btnCancelar) {
                    btnCancelar.parentElement.style.display = 'none';
                }
            } else {
                console.log('Error:', detalle);
                Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "error",
                    title: 'Error al guardar',
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                }).fire();
            }
        } catch (error) {
            console.log('Error de conexión:', error);
            Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: "error",
                title: 'Error de conexión',
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire();
        }
        btnModificar.disabled = false;
    };

    const eliminarCurso = async (curso_id) => {
        const confirmacion = await Swal.fire({
            title: '¿Estás seguro de eliminar a este curso?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        });

        if (confirmacion.isConfirmed) {
            const url = '/estudiantil_crudjs/controllers/cursos/index.php';
            const formData = new FormData();
            formData.append('tipo', 3);
            formData.append('curso_id', curso_id);
            const config = {
                method: 'POST',
                body: formData
            };

            try {
                const respuesta = await fetch(url, config);
                const data = await respuesta.json();
                const { mensaje, codigo, detalle } = data;
                if (codigo === 1 && respuesta.status === 200) {
                    Swal.fire({
                        title: mensaje,
                        icon: 'success',
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    }).fire();
                    getCursos();
                } else {
                    console.log(detalle);
                }
            } catch (error) {
                console.log(error);
            }
        }
    };
    
    formulario.addEventListener('submit', guardarCurso)
    btnBuscar.addEventListener('click', getCursos)
});
