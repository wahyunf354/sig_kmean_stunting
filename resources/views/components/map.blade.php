<div id="map"></div>

@section("script")
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <script>
        
        var map = L.map('map').setView([2.446095, 98.764511], 10.5);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        const url = window.location.origin;

        Promise.all([
    fetch('http://localhost:8000/assets/geojson/SitioSito.geojson').then((result) => result.json()),
    fetch(url + '/getDataStunting').then((result) => result.json()),
])
    .then(([geojsonData, stuntingData]) => {

        geojsonData.features.forEach((item2, key) => {
            // console.log(item2)
            stuntingData.forEach((item) => {
                if((item.name.toUpperCase()) == item2.properties.name.toUpperCase()) {
                    geojsonData.features[key].properties = item
                }
            })
        })

        console.log(geojsonData)
        // Process GeoJSON data
        L.geoJson(geojsonData, {
            style: function(feature) {
                var color = feature.properties.cluster[0].order
                if(color == 0) {
                    return {
                        fillColor: '#22A699',
                        fillOpacity: 0.6, // Opasitas isi
                        color: '#22A699',  // Warna garis batas
                        weight: 1        // Ketebalan garis batas
                    };
                } else if(color == 1) {
                    return {
                        fillColor: '#F2BE22',
                        fillOpacity: 0.6, // Opasitas isi
                        color: '#F2BE22',  // Warna garis batas
                        weight: 1        // Ketebalan garis batas
                    };
                } else {
                    return {
                        fillColor: '#F24C3D',
                        fillOpacity: 0.6, // Opasitas isi
                        color: '#F24C3D',  // Warna garis batas
                        weight: 1        // Ketebalan garis batas
                    };
                }
            },
            onEachFeature: function(feature, layer) {
                var desa = feature.properties.name;
                var jumlah_laki_laki = feature.properties.jumlah_laki_laki;
                var jumlah_prempuan = feature.properties.jumlah_prempuan;
                var status = feature.properties.cluster[0].title;
                
                // Membuat konten popup
                var popupContent = `<p><strong>Data Desa</strong></p>
                            <b>Nama:</b> ${desa}<br>
                            <b>Jumlah Laki-Laki:</b> ${jumlah_laki_laki}<br>
                            <b>Jumlah Perempuan:</b> ${jumlah_prempuan}<br>
                            <b>Status:</b> ${status}<br>
                            `
                
                // Menambahkan popup ke fitur
                layer.bindPopup(popupContent);
            }
        }).addTo(map);

    })
    .catch((err) => {
        console.log(err);
    });

    </script>
@endsection