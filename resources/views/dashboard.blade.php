@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Total Students
                            <div class="badge bg-warning bg-gradient rounded-pill mb-2 px-2">{{$students->count()}}</div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="/panel/students">View Details</a>
                            <div class="small text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Total Campus
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2 px-2">{{$campuses->count()}}</div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="/panel/campuses">View Details</a>
                            <div class="small text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Total Courses
                            <div class="badge bg-warning bg-gradient rounded-pill mb-2 px-2">{{$courses->count()}}</div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="/panel/courses">View Details</a>
                            <div class="small text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div id="map-dashboard"></div>
                </div>
            </div>
        </div>
    </main>
    
@endsection
@section('scripts')
<script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZ2VnZWpvc3BlciIsImEiOiJja3Flb3dxM2cwam40MnBxdmUyZ3ptd2d4In0.gtM2xu-epJ56CCUUHbuU0A';

        // Function to initialize the map
        function init_map() {
            const coordinates = [123.625389, 7.931833];  // Example coordinates [longitude, latitude]

            const map = new mapboxgl.Map({
                container: 'map-dashboard',
                style: 'mapbox://styles/mapbox/satellite-streets-v11',
                zoom: 9,
                center: coordinates, // Center the map on the coordinates
                projection: 'mercator' // Use 'mercator' or another supported projection
            });

            // Add markers for locations with custom colors
            const campuses = @json($campuses);

            // Transform the data to the desired format
            const locations = campuses.map(campus => ({
                name: campus.address,
                color: campus.map_color,
                campus: campus.campus_name.toUpperCase()
            }));
            locations.forEach(function (location) {
                geocode_location(location, map);
            });
        }

        // Function to geocode the location and add markers with custom colors
        function geocode_location(location, map) {
            const geocoding_url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(location.name)}.json?access_token=${mapboxgl.accessToken}`;

            fetch(geocoding_url)
                .then(response => response.json())
                .then(data => {
                    const coordinates = data.features[0].center;

                    // Create a popup with location details
                    const popup = new mapboxgl.Popup({ offset: 25 })
                        .setHTML(`
                        <div id="popup-content">
                            <h3>${location.campus}</h3>
                            <p>Population: <strong>1, 000</strong><br>
                            BSIS: <strong>500</strong><br>
                            BSA: <strong>300</strong><br>
                            Scholars: <strong>800</strong></p>
                        </div>
                        `)
                        .on('open', () => {
                        // Access the popup content and apply styles
                        const popup_content = document.querySelector('#popup-content');
                        popup_content.style.minWidth = '500px';
                        popup_content.style.maxWidth = '600px';
                    });;

                    // Create a marker with a custom color and attach the popup to it
                    const marker = new mapboxgl.Marker({
                        color: location.color // Use the custom color for the marker
                    })
                    .setLngLat(coordinates)
                    .setPopup(popup) // Attach the popup to the marker
                    .addTo(map);
                })
                .catch(error => console.error('Error with geocoding:', error));
        }

        document.addEventListener('DOMContentLoaded', init_map);
</script>
@endsection