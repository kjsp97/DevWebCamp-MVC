import Swal from "sweetalert2";

(function () {
    const botonEvento = document.querySelectorAll('.evento__boton')
    const registroResumen = document.querySelector('#registro-resumen')
    const formularioRegistro = document.querySelector('#registro')
    let eventos = []
    if (registroResumen) {
        botonEvento.forEach(boton => boton.addEventListener('click', addEvent))

        showEvents()

        // 1
        function addEvent(e) {
            if (eventos.length < 5) {
                e.target.disabled = true
                eventos = [...eventos, {
                    titulo: e.target.parentElement.querySelector('.evento__nombre').textContent.trim(),
                    id: e.target.dataset.id
                }]
                showEvents()
            }else{
                Swal.fire({
                    title: "Oops...",
                    icon: "error",
                    text: "Solo se puede seleccionar cinco eventos."
                })
            }
        }

        // 2
        function showEvents() {
            registroResumen.textContent = ''
            if (eventos.length > 0) {
                eventos.forEach(evento => {
                    const eventoDom = document.createElement('DIV')
                    eventoDom.classList.add('registro__evento')
                    
                    const titulo = document.createElement('H3')
                    titulo.classList.add('registro__nombre')
                    titulo.textContent = evento.titulo 
                    
                    const botonEliminar = document.createElement('BUTTON')
                    botonEliminar.classList.add('registro__eliminar')
                    botonEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`
                    botonEliminar.onclick = () => {
                        deleteEvent(evento.id)
                    }
                    
                    eventoDom.appendChild(titulo)
                    eventoDom.appendChild(botonEliminar)
                    registroResumen.appendChild(eventoDom)
                })
            }else{
                const noEventos = document.createElement('P')
                noEventos.textContent = 'Selecciona 5 eventos de la parte izquierda.'
                noEventos.style.textAlign = 'center'
                noEventos.style.margin = 0
                registroResumen.appendChild(noEventos)
            }
        }

        // 3
        function deleteEvent(id) {
            eventos = eventos.filter(evento => evento.id !== id)
            showEvents()
            const eventoSeleccionado = document.querySelector(`[data-id="${id}"]`)
            eventoSeleccionado.disabled = false
        }

        // 4
        formularioRegistro.addEventListener('submit', sendData)
        async function sendData(e) {
            e.preventDefault()
            const regaloId = document.querySelector('#regalo').value
            const eventosId = eventos.map(evento => evento.id)

            if (regaloId == '' || eventosId.length === 0) {
                Swal.fire({
                    title: "Oops...",
                    icon: "error",
                    text: "Es obligatorio un evento y un regalo."
                })
            }else{
                const url = '/finalizar-registro/conferencias'
                const data = new FormData
                data.append('regalo', regaloId)
                data.append('eventos', eventosId)

                const respuesta = await fetch(url, {method: 'POST', body: data})
                const resultado = await respuesta.json()
                if (resultado.resultado) {
                    Swal.fire(
                        'Registro Completado',
                        'Conferencias guardadas correctamente, te esperamos en DevWebCamp!',
                        'success'
                    ).then(() => location.href = `/entrada?id=${resultado.token}`)
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo completar',
                        icon: 'error',
                        connfirmButtonText: 'OK'
                    }).then(() => location.reload())
                }
            }
        }
    }
})();