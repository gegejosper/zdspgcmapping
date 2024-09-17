@extends('layouts.front')
@section('content_front')
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row">
                <div class="col-lg-12">
                <div id="map"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiZ2VnZWpvc3BlciIsImEiOiJja3Flb3dxM2cwam40MnBxdmUyZ3ptd2d4In0.gtM2xu-epJ56CCUUHbuU0A';

    function init_map() {
        const coordinates = [123.625389, 7.931833];  // Example coordinates [longitude, latitude]

        const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/gegejosper/cm0am1vpz00q201pn7dpo0rpx',
        zoom: 9,
        center: coordinates, // Center the map on the coordinates
        projection: 'mercator' // Use 'mercator' or another supported projection
    });

    new mapboxgl.Marker()
        .setLngLat(coordinates)
        .addTo(map);
    }

    document.addEventListener('DOMContentLoaded', init_map);

</script>
@endsection