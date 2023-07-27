@extends('layouts.index')
@section('title', "Home")

@section('content')
<style>
    #map { height: 70vh; }
</style>
<main class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-5 shadow-lg border-0 rounded-lg">
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
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

        fetch(url+"/getDataStunting").then((result) => {
            return result.json()
        }).then((data) => {
            data.forEach(item => {
                console.log(item)
                L.marker([item.long, item.lat])
                .bindPopup(`<p><strong>Data Desa</strong></p>
                            <b>Nama:</b> ${item.name}<br>
                            <b>Jumlah Laki-Laki:</b> ${item.jumlah_laki_laki}<br>
                            <b>Jumlah Prempuan:</b> ${item.jumlah_prempuan}<br>
                            <b>Status:</b> ${item.cluster[0].title}<br>
                            `).openPopup().addTo(map);
            });
        }).catch((err) => {
            console.log(err)
        })

        
    </script>
@endsection

