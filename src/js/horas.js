(function() {
    
    const horas = document.querySelector('.horas')

    if (horas) {

        const dias = document.querySelectorAll('[name="dia"]')
        const categoria = document.querySelector('[name="categoria_id"]')
        const inputHiddenDia = document.querySelector('[name="dia_id"]')
        const inputHiddenHora = document.querySelector('[name="hora_id"]')
        
        let busqueda = {
            categoria_id: +categoria.value || '',
            dia: +inputHiddenDia.value || ''
        }

        if (!Object.values(busqueda).includes('')) {
            (async() => {
                await searchEvents()
                const id = inputHiddenHora.value
                const diaSeleccionado = document.querySelector(`[data-hora-id="${id}"]`)
                diaSeleccionado.classList.remove('horas__hora--deshabilitado')
                diaSeleccionado.classList.add('horas__hora--seleccionado')
                diaSeleccionado.onclick = selectHour
            })();
        }
        
        dias.forEach(dia => {
            dia.addEventListener('change', completeSearch)
        })

        categoria.addEventListener('change', completeSearch)

        function completeSearch(e) {
            inputHiddenHora.value = ''
            inputHiddenDia.value = ''
            const horaSeleccionada = document.querySelector('.horas__hora--seleccionado')
            if (horaSeleccionada) {
                horaSeleccionada.classList.remove('horas__hora--seleccionado')
            }

            busqueda[e.target.name] = e.target.value
            if (Object.values(busqueda).includes('')) {
                return
            }
            searchEvents()
        }
        
        async function searchEvents() {
            const {categoria_id , dia} = busqueda
            
            const url = `/api/eventos?dia_id=${dia}&categoria_id=${categoria_id}`
            const resultado = await fetch(url)
            const eventos = await resultado.json()
            
            getHoursAvailable(eventos)
        }   
        
        function getHoursAvailable(eventos = []) {
            const horas = document.querySelectorAll('[name="hora"]')
            horas.forEach(hora => {
                hora.classList.add('horas__hora--deshabilitado')
                hora.removeEventListener('click', selectHour)    
            })

            const horasTomadas = eventos.map(event => event.hora_id)

            horas.forEach(hora =>{
                if (!horasTomadas.includes(hora.dataset.horaId)) {
                    hora.classList.remove('horas__hora--deshabilitado')
                    hora.addEventListener('click', selectHour)
                }
            })        
        }
        
        function selectHour(e) {
            const horaSeleccionada = document.querySelector('.horas__hora--seleccionado')
            if (horaSeleccionada) {
                horaSeleccionada.classList.remove('horas__hora--seleccionado')
            }
            e.target.classList.add('horas__hora--seleccionado')
            inputHiddenHora.value = e.target.dataset.horaId
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value
        }
    }
})();