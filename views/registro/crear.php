<main class="finalizar-registro">
    <h2 class="finalizar-registro__heading">Elige tu Plan</h2>

    <div class="paquetes__grid">
        <div class="paquete"  data-aos="flip-left" data-aos-easing="ease-out-cubic">
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
            </ul>
            <p class="paquete__precio">0 €</p>
            <form method="POST" action="/finalizar-registro/gratis">
                <input class="paquete__boton" type="submit" value="Seleccionar">
            </form>
        </div>

        <div class="paquete"  data-aos="flip-left" data-aos-easing="ease-out-cubic">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las Grabaciones</li>
                <li class="paquete__elemento">Camiseta del evento</li>
                <li class="paquete__elemento">Comida y bebida</li>
            </ul>
            <p class="paquete__precio">199 €</p>
            <div id="smart-button-container" style="margin-top: 3rem;">
                 <div style="text-align: center;">
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>

        <div class="paquete"  data-aos="flip-left" data-aos-easing="ease-out-cubic">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Enlace a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las Grabaciones</li>
            </ul>
            <p class="paquete__precio">49 €</p>
            <div id="smart-button-container" style="margin-top: 3rem;">
                <div style="text-align: center;">
                    <div id="paypal-button-container-virtual"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://www.paypal.com/sdk/js?client-id=AcKHbiMxXCaUJnonAUDihojkVJ3taqNtAON6WCFmCQIu2zZ3vozsGXKTXyv7wn7pl-QJqjKCka4w1eSH&enable-funding=venmo&currency=EUR" data-sdk-integration-source="button-factory"></script>
<script>
    function initPayPalButton() {
        paypal.Buttons({
        style: {
            shape: 'rect',
            color: 'blue',
            layout: 'vertical',
            label: 'pay',
        },
    
        createOrder: function(data, actions) {
            return actions.order.create({
            purchase_units: [{"description":"1","amount":{"currency_code":"EUR","value":199}}]
            });
        },
    
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
    
            const datos = new FormData()
            datos.append('paquete_id', orderData.purchase_units[0].description)
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id)
            fetch('/finalizar-registro/pagar', { method: 'POST', body: datos })
            .then(respuesta => respuesta.json())
            .then(resultado => {
                if (resultado.resultado) {
                    actions.redirect('http://localhost:3000/finalizar-registro/conferencias')
                }
            })
            })
        },
        onError: function(err) {
            console.log(err);
        }
        }).render('#paypal-button-container');

        // virtual
        paypal.Buttons({
        style: {
            shape: 'rect',
            color: 'blue',
            layout: 'vertical',
            label: 'pay',
        },

        createOrder: function(data, actions) {
            return actions.order.create({
            purchase_units: [{"description":"2","amount":{"currency_code":"EUR","value":49}}]
            });
        },
    
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
    
            const datos = new FormData()
            datos.append('paquete_id', orderData.purchase_units[0].description)
            datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id)
            fetch('/finalizar-registro/pagar', { method: 'POST', body: datos })
            .then(respuesta => respuesta.json())
            .then(resultado => {
                if (resultado.resultado) {
                    actions.redirect('http://localhost:3000/finalizar-registro/conferencias')
                }
            })
            })
        },
        onError: function(err) {
            console.log(err);
        }
        }).render('#paypal-button-container-virtual');
    }
    initPayPalButton();
</script>