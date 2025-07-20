(function () {

    const tagsInput = document.querySelector('#tags_input')
    
    if (tagsInput) {
        const listado = document.querySelector('#tags')
        const inputHidden = document.querySelector('[name="tags"]')
        
        tagsInput.addEventListener('keypress', content)
        let datos = []
        
        if (inputHidden.value) {
            datos = inputHidden.value.split(',')
            showTag();
        }
        function content(e) {
            if (e.keyCode === 44) {
                e.preventDefault()
                if (e.target.value.trim() === '') {
                    return
                }
                datos =  [...datos, e.target.value.trim()]
                e.target.value = ''
                showTag()
                updateInputHidden()
            }
        }
        
        function showTag() {
            listado.textContent = ''
            
            datos.forEach(dato => {
                const tag = document.createElement('LI')
                tag.textContent = dato
                tag.classList.add('formulario__tag')
                listado.appendChild(tag)
                tag.onclick = deleteTag
            });
        }
        
        function deleteTag(e) {
            e.target.remove()
            datos = datos.filter(dato => dato !== e.target.textContent)
            updateInputHidden()
        }

        function updateInputHidden() {
            inputHidden.value = datos.toString()
        }
    }
})();