if (document.querySelector('#mapa')) {
    const lat = 41.363534712154056;
    const long = 2.1525340233077834;
    const zoom = 16;

    const map = L.map('mapa', { scrollWheelZoom: false }).setView([lat, long], zoom);

    L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a> & OpenStreetMap contributors'
    }).addTo(map);

    L.marker([lat, long]).addTo(map)
        .bindPopup('<h3 style="margin: 10px 0;">DevWebCamp</h3><h4 style="color: grey; font-size: 20px; margin: 0;">Palau Sant Jordi, Barcelona</h4>')
        .openPopup();

    map.on('click', () => {
        map.scrollWheelZoom.enable();
    });
}