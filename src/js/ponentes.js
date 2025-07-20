(function() {

    const ponentesInput = document.querySelector('#ponente')
    
    if (ponentesInput) {
        const listadoPonentes = document.querySelector('.listado-ponentes')
        const inputHiddenPonente = document.querySelector('[name="ponente_id"]')
        ponentesInput.addEventListener('input', searchSpeakers)
        
        let ponentes = []
        let ponentesFiltrados = []

        // 6
        if (inputHiddenPonente) {
            (async()=>{
                const ponente = await getSpeaker(inputHiddenPonente.value)
                const {nombre, apellido} = ponente
                const ponenteHtml = document.createElement('LI')
                ponenteHtml.classList.add('listado-ponentes__ponente', 'listado-ponentes__ponente--seleccionado')
                ponenteHtml.textContent = `${nombre.trim()} ${apellido.trim()}`
                ponentesInput.value = `${nombre.trim()} ${apellido.trim()}`
                listadoPonentes.appendChild(ponenteHtml)
            })();
        }


        async function getSpeaker(id) {
            const url = `/api/ponente?id=${id}`
            const respuesta = await fetch(url)
            const resultado = await respuesta.json()
            return resultado
        }   

        // 1
        getSpeakers()
        async function getSpeakers() {
            const url = `/api/ponentes`
            const respuesta = await fetch(url)
            const resultado = await respuesta.json()
            
            formatSpeakers(resultado)
        }   
    
        // 2
        function formatSpeakers(resultado = []) {
            ponentes = resultado.map(ponente => {
                return {
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id
                }
            })
        }

        // 3
        function searchSpeakers(e) {
            const busqueda = e.target.value
            if (busqueda.length > 3) {
                const expresion = new RegExp(removeAccent(busqueda), "i")
                ponentesFiltrados = ponentes.filter(ponente => {
                    if (removeAccent(ponente.nombre).toLowerCase().search(expresion) != -1) {
                        return ponente
                    }
                })
                showSpeakers()
            }else {
                ponentesFiltrados = []
                while (listadoPonentes.firstChild) {
                    listadoPonentes.removeChild(listadoPonentes.firstChild)
                }
            }
        }
        function removeAccent(texto){
            return texto.normalize('NFD').replace(/[\u0300-\u036f]/g, "")
        }

        // 4
        function showSpeakers() {
            while (listadoPonentes.firstChild) {
                listadoPonentes.removeChild(listadoPonentes.firstChild)
            }
            if (ponentesFiltrados.length > 0) {
                ponentesFiltrados.forEach(ponente => {
                    const ponenteHtml = document.createElement('LI')
                    ponenteHtml.classList.add('listado-ponentes__ponente')
                    ponenteHtml.dataset.ponenteId = ponente.id
                    ponenteHtml.textContent = ponente.nombre
                    ponenteHtml.onclick = selectSpeaker

                    listadoPonentes.appendChild(ponenteHtml)
                })
            }else{
                const noExiste = document.createElement('LI')
                noExiste.classList.add('listado-ponentes__no-existe')
                noExiste.textContent = 'No existe ningun ponente con ese nombre'
                listadoPonentes.appendChild(noExiste)
            }
        }

        // 5
        function selectSpeaker(e) {
            const seleccionado = document.querySelector('.listado-ponentes__ponente--seleccionado')
            if (seleccionado) {
                seleccionado.classList.remove('listado-ponentes__ponente--seleccionado')
            }
            e.target.classList.add('listado-ponentes__ponente--seleccionado')
            inputHiddenPonente.value = e.target.dataset.ponenteId   
        }
    }
})();