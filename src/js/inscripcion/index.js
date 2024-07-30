document.addEventListener('DOMContentLoaded', () => {
    const btnAsignar = document.getElementById('btnAsignar');
    const btnBuscar = document.getElementById('btnBuscar');
    const tablaInscripcion = document.getElementById('tablaInscripcion');
    const formulario = document.querySelector('form');


    const getInscripcion = async () => {
        const estudiante = formulario.estudiante_id.value;
        const curso = formulario.curso_id.value;
        const url = `/estudiantil_crudjs/controllers/inscripcion/index.php?estudiante_id=${estudiante}&curso_id=${curso}`;
        const config = {
            method: 'GET'
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            tablaInscripcion.tBodies[0].innerHTML = '';
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
                    title: 'Estudiantes Inscritos encontrados',
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
                        const buttonEliminar = document.createElement('button');

                        celda1.innerText = contador;
                        celda2.innerText = estudiante.estudiante_nombre;
                        celda3.innerText = estudiante.estudiante_apellido;
                        celda4.innerText = curso.curso_nombre;

                        buttonEliminar.textContent = 'Eliminar';
                        buttonEliminar.classList.add('btn', 'btn-danger', 'w-100');
                        buttonEliminar.addEventListener('click', () => eliminarInscripcion(inscripcion.inscripcion_id));

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
                    td.innerText = 'No hay Inscripciones registradas';
                    td.colSpan = 5;

                    tr.appendChild(td);
                    fragment.appendChild(tr);
                }
            } else {
                console.log('Error al buscar Inscripcion');
            }

            tablaInscripcion.tBodies[0].appendChild(fragment);
        } catch (error) {
            console.log(error);
        }
    };

    const guardarInscripcion = async (e) => {
        e.preventDefault();
        btnAsignar.disabled = true;

        const url = '/estudiantil_crudjs/controllers/inscripcion/index.php';
        const formData = new FormData(formulario);
        formData.append('tipo', 1);
        formData.delete('inscripcion_id');
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

    const eliminarInscripcion = async (inscripcion_id) => {
        const confirmacion = await Swal.fire({
            title: '¿Estás seguro de eliminar a este inscripcion?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        });

        if (confirmacion.isConfirmed) {
            const url = '/estudiantil_crudjs/controllers/inscripcion/index.php';
            const formData = new FormData();
            formData.append('tipo', 3);
            formData.append('inscripcion_id', inscripcion_id);
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
    
    formulario.addEventListener('submit', guardarInscripcion)
    btnBuscar.addEventListener('click', getInscripcion)
});
