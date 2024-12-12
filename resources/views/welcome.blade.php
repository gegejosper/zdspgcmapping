@extends('layouts.front')
@section('content_front')
    <section>
        <div class="container-fluid"> <!-- container-fluid makes it full width -->
            <form action="/filter_campus" method="post">
                @csrf
                <div class="row my-2">
                    <div class="col-lg-6 ">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="">Campus</label>
                                <select name="campus" id="campus" class="form-control">
                                    @foreach($campuses as $campus)
                                        <option value="{{$campus->id}}">{{$campus->campus_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label for="">Distance(KM)</label>
                                <input name="radius" id="radius" class="form-control" placeholder="Kilometers" required>
                            </div>
                            <div class="col-lg-2 mt-4">
                                <button class="btn btn-info" type="submit">
                                    Search
                                </button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="@if($filter_data != null) col-lg-8 @else col-lg-12 @endif p-0"> <!-- Remove padding to make it fullwidth -->
                    <div id="map"></div>
                </div>
                @if($filter_data != null)
                <div class="col-lg-4">
                    <h3 class="text-danger">Result</h3>
                    <div class="row g-5 mb-3">
                        <!--end::Col-->
                        <div class="col-sm-4">
                            <!--end::Label-->
                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Campus:</div>
                            <!--end::Label-->
                            <!--end::Description-->
                            <div class="fw-semibold fs-7 text-gray-600">{{$filter_data['campus']}}</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Col-->
                        <!--end::Col-->
                        <div class="col-sm-4">
                            <!--end::Label-->
                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Address:</div>
                            <!--end::Label-->
                            <!--end::Description-->
                            <div class="fw-semibold fs-7 text-gray-600">{{$filter_data['campus_address']}}</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Col-->
                        <!--end::Col-->
                        <div class="col-sm-4">
                            <!--end::Label-->
                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Radius:</div>
                            <!--end::Label-->

                            <!--end::Description-->
                            <div class="fw-semibold fs-7 text-gray-600">{{$filter_data['radius']}} Kilometer</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <hr class="my-5">
                    <h3>Municipality Statistics</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Address</td>
                                <td>Count</td>
                                <td>Percentage</td>
                            </tr>
                        </thead>
                        @php
                            $total_count = array_sum(array_column($locations_list, 'address_count'));
                        @endphp
                        @foreach($locations_list as $location)
                            <tr>
                                <td>{{$location['address']}}</td>
                                <td>{{$location['address_count']}}</td>
                                <td>@php
                                        $percentage = $total_count > 0 ? ($location['address_count'] / $total_count) * 100 : 0;
                                    @endphp
                                    {{ number_format($percentage, 2) }}%
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <hr class="my-5">
                    <h3>Scholarship Statistics</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Scholarship</td>
                                <td>Count</td>
                                <td>Percentage</td>
                            </tr>
                        </thead>
                        @php
                            $total_count_scholarship = array_sum(array_column($scholarship_counts, 'count'));
                        @endphp
                        @foreach($scholarship_counts as $scholarship)
                            <tr>
                                <td>{{$scholarship['name']}}</td>
                                <td>{{$scholarship['count']}}</td>
                                <td>@php
                                        $percentage_scholarship = $total_count_scholarship > 0 ? ($scholarship['count'] / $total_count_scholarship) * 100 : 0;
                                    @endphp
                                    {{ number_format($percentage_scholarship, 2) }}%
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <hr class="my-5">
                    <h3>Program Statistics</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Program</td>
                                <td>Count</td>
                                <td>Percentage</td>
                            </tr>
                        </thead>
                        @php
                            $total_count_course = array_sum(array_column($course_counts, 'count'));
                        @endphp
                        @foreach($course_counts as $course)
                            <tr>
                                <td>{{$course['name']}}</td>
                                <td>{{$course['count']}}</td>
                                <td>@php
                                        $percentage_course = $total_count_course > 0 ? ($course['count'] / $total_count_course) * 100 : 0;
                                    @endphp
                                    {{ number_format($percentage_course, 2) }}%
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                @endif
            </div>
        </div>
    </section>
    <div id="location-modal" class="modal modal-xl" style="margin-top:100px; max-height: 500px;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="btn-close close-button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')

<!-- <script>
    const locations = @json($locations_list); // Get full locations list with details
    mapboxgl.accessToken = 'pk.eyJ1IjoiZ2VnZWpvc3BlciIsImEiOiJja3Flb3dxM2cwam40MnBxdmUyZ3ptd2d4In0.gtM2xu-epJ56CCUUHbuU0A';

    function init_map() {
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/satellite-streets-v11',
            zoom: 9,
            center: [123.625389, 7.931833],
            projection: 'mercator'
        });

        locations.forEach(function (location) {
            geocode_location(location, map);
        });
    }

    function geocode_location(location, map) {
        const geocoding_url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(location.address)}.json?access_token=${mapboxgl.accessToken}`;

        fetch(geocoding_url)
        .then(response => response.json())
        .then(data => {
            if (data.features && data.features.length > 0) {
                const coordinates = data.features[0].center;

                const marker = new mapboxgl.Marker({ color: 'blue' })
                    .setLngLat(coordinates)
                    .addTo(map);

                marker.getElement().addEventListener('click', () => {
                    show_modal(location); // Show modal with location details
                });
            } else {
                console.error('Geocode not found for address:', location.address);
            }
        })
        .catch(error => {
            console.error('Error with geocoding:', error);
        });
    }

    function create_popup_content(location) {
        let content = `<div class="row">`;
        location.campuses.forEach(campus => {
            content += `<div class="col-lg-4 mb-2">
                        <div class="card"><div class="card-header">Campus: ${campus.campus_name} - (${campus.campus_count})</div><div class="card-body">
                        `;
            content += `<h6>Programs:</h6><ul>`;
            campus.programs.forEach(program => {
                content += `<li>${program.course_name} - ${program.count}</li>`;
            });
            content += `</ul>`;
            content += `<h6>Scholarships:</h6><ul>`;
            campus.scholarships.forEach(scholarship => {
                content += `<li>${scholarship.scholarship_name} - ${scholarship.count}</li>`;
            });
            content += `</ul></div></div></div>`;
        });
        content += `</div>`;
        return content;
    }

    function show_modal(location) {
        const modal = document.getElementById("location-modal");
        const modalBody = document.getElementById("modal-body");
        const modalTitle = document.getElementById("modal-title");
        modalTitle.innerHTML = 'Address: ' + location.address + ' - ('+location.address_count + ')';
        modalBody.innerHTML = create_popup_content(location);
        modal.style.display = "block";

        const closeButton = document.querySelector(".close-button");
        closeButton.onclick = function() {
            modal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    }
    

    document.addEventListener('DOMContentLoaded', init_map);
</script> -->
<script>
    async function get_coordinates(address) {
        const response = await fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(address)}.json?access_token=${mapbox_token}`);
        const data = await response.json();
        if (data.features && data.features.length > 0) {
            return data.features[0].geometry.coordinates; // [longitude, latitude]
        } else {
            console.error(`Coordinates not found for address: ${address}`);
            return null;
        }
    }
    function campus_location(location, map, color) {
            const geocoding_url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(location)}.json?access_token=${mapboxgl.accessToken}`;
            fetch(geocoding_url)
            .then(response => response.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    const coordinates = data.features[0].center;
                    const marker = new mapboxgl.Marker({ color: color })
                        .setLngLat(coordinates)
                        .addTo(map);
                    marker.getElement().addEventListener('click', () => {
                        show_modal(location); // Show modal with location details
                    });
                } else {
                    console.error('Geocode not found for address:', location.address);
                }
        })
        .catch(error => {
            console.error('Error with geocoding:', error);
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        const locations = @json($locations_list);
        //console.log(locations);
        const campus_address = "{{ $main_address }}";
        let selected_campus_coordinates;

        get_coordinates(campus_address)
            .then((coordinates) => {
                selected_campus_coordinates = coordinates;
                campus_location(selected_campus_coordinates, map, 'blue');
            })
            .catch((error) => {
                console.error("Error fetching coordinates:", error);
            });
        console.log(selected_campus_coordinates);
        mapboxgl.accessToken = 'pk.eyJ1IjoiZ2VnZWpvc3BlciIsImEiOiJja3Flb3dxM2cwam40MnBxdmUyZ3ptd2d4In0.gtM2xu-epJ56CCUUHbuU0A'; // Add your Mapbox token here
        const map = new mapboxgl.Map({
            container: 'map', // ID of the HTML element
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [123.5785, 7.9438], // Starting position [longitude, latitude]
            zoom: 9
        });
        
        //console.log(selected_campus_coordinates);
        locations.forEach(function (location) {
            geocode_location(location, map, 'red');
        });

        map.on('load', () => {
            // Define the center point and radius (in kilometers)
            const center = selected_campus_coordinates;
            const radius_km = {{$distance}}; // 5 km radius

            // Create a circle as a polygon using Turf.js
            const circle = turf.circle(center, radius_km, {
                steps: 64,       // Number of points in the circle
                units: 'kilometers'
            });

            // Add the circle as a GeoJSON source
            map.addSource('circle-source', {
                type: 'geojson',
                data: circle
            });

            // Add a layer to display the circle
            map.addLayer({
                id: 'circle-layer',
                type: 'fill',
                source: 'circle-source',
                paint: {
                    'fill-color': '#007cbf',
                    'fill-opacity': 0.3
                }
            });
        });

        function geocode_location(location, map, color) {
            const geocoding_url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(location.address)}.json?access_token=${mapboxgl.accessToken}`;

            fetch(geocoding_url)
            .then(response => response.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    const coordinates = data.features[0].center;
                    const marker = new mapboxgl.Marker({ color: color })
                        .setLngLat(coordinates)
                        .addTo(map);
                    marker.getElement().addEventListener('click', () => {
                        show_modal(location); // Show modal with location details
                    });
                } else {
                    console.error('Geocode not found for address:', location.address);
                }
        })
        .catch(error => {
            console.error('Error with geocoding:', error);
        });
    }

    function create_popup_content(location) {
        let content = `<div class="row">`;
        location.campuses.forEach(campus => {
            content += `<div class="col-lg-4 mb-2">
                        <div class="card"><div class="card-header">Campus: ${campus.campus_name} - (${campus.campus_count})</div><div class="card-body">
                        `;
            content += `<h6>Programs:</h6><ul>`;
            campus.programs.forEach(program => {
                content += `<li>${program.course_name} - ${program.count}</li>`;
            });
            content += `</ul>`;
            content += `<h6>Scholarships:</h6><ul>`;
            campus.scholarships.forEach(scholarship => {
                content += `<li>${scholarship.scholarship_name} - ${scholarship.count}</li>`;
            });
            content += `</ul></div></div></div>`;
        });
        content += `</div>`;
        return content;
    }

    function show_modal(location) {
        const modal = document.getElementById("location-modal");
        const modalBody = document.getElementById("modal-body");
        const modalTitle = document.getElementById("modal-title");
        modalTitle.innerHTML = 'Address: ' + location.address + ' - ('+location.address_count + ')';
        modalBody.innerHTML = create_popup_content(location);
        modal.style.display = "block";

        const closeButton = document.querySelector(".close-button");
        closeButton.onclick = function() {
            modal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    }
    });
    //get the coordinates
    // Your Mapbox access token
    const mapbox_token = 'pk.eyJ1IjoiZ2VnZWpvc3BlciIsImEiOiJja3Flb3dxM2cwam40MnBxdmUyZ3ptd2d4In0.gtM2xu-epJ56CCUUHbuU0A';

    // The starting address for Aurora, Zamboanga del Sur
    //const aurora_address = {{$main_address}};
    const aurora_address = "{{ $main_address }}";

    //console.log(selected_campus_coordinates);
    // Example locations array
    // const locations = [
    //     { address: 'Aurora, Zamboanga del Sur', address_count: 50, campuses: Array(4) },
    //     { address: 'San Miguel, Zamboanga del Sur', address_count: 52, campuses: Array(3) },
    //     { address: 'Molave, Zamboanga del Sur', address_count: 48, campuses: Array(3) },
    //     { address: 'Pagadian, Zamboanga del Sur', address_count: 61, campuses: Array(3) },
    //     { address: 'San Pablo, Zamboanga del Sur', address_count: 70, campuses: Array(3) },
    //     { address: 'Dumingag, Zamboanga del Sur', address_count: 53, campuses: Array(3) },
    // ];
    const locations = @json($locations_list);

    // Function to get coordinates using Mapbox Geocoding API


    // Calculate distances from Aurora
    async function calculate_distances_from_aurora(locations, aurora_address) {
        const aurora_coordinates = await get_coordinates(aurora_address);

        // Fetch coordinates and calculate distance for each location
        const results = await Promise.all(locations.map(async location => {
            const destination_coordinates = await get_coordinates(location.address);
            
            if (destination_coordinates) {
                // Calculate distance using Turf.js
                const distance = turf.distance(
                    turf.point(aurora_coordinates),
                    turf.point(destination_coordinates),
                    { units: 'kilometers' }
                );
                return { ...location, distance_from_aurora: distance };
            } else {
                return { ...location, distance_from_aurora: null };
            }
        }));
        
        return results;
    }

    // Run the distance calculation and log results
    calculate_distances_from_aurora(locations, aurora_address).then(results => {
        console.log(results);
    });
</script>
@endsection