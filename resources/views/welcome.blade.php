@extends('layouts.front')
@section('content_front')
    <section>
        <div class="container-fluid"> <!-- container-fluid makes it full width -->
            <div class="row">
                <div class="col-lg-12 p-0"> <!-- Remove padding to make it fullwidth -->
                    <div id="map"></div>
                </div>
                <!-- <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header">
                           Student Statistics
                        </div>
                        <div class="card-body">
                            @foreach($students as $location => $student_group)
                                @php
                                    $location_data = [
                                        'address' => $location,
                                        'address_count' => $student_group->count(),
                                        'campuses' => []
                                    ];
                                @endphp
                                <div class="card mb-4">
                                    <div class="card-header">
                                    Address: {{$location}} - {{$student_group->count()}}
                                    </div>
                                    <div class="card-body">
                                        @php 
                                            $campuses = $student_group->groupBy('campus_id');
                                        @endphp
                                            @foreach($campuses as $campus => $campus_group)
                                                @php
                                                    $campus_data = [
                                                        'campus_name' => $campus_group->first()->campus_details->campus_name,
                                                        'campus_count' => $campus_group->count(),
                                                        'programs' => [],
                                                        'scholarships' => []
                                                    ];
                                                @endphp
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                    Campus: {{$campus_group->first()->campus_details->campus_name}} - {{$campus_group->count()}} 
                                                    </div>
                                                    <div class="card-body">
                                                    @php 
                                                    $courses = $campus_group->groupBy('course_id');
                                                    $scholarships = $campus_group->groupBy('scholarship_id');
                                                    
                                                    @endphp
                                                    <h3>Programs</h3>
                                                    @foreach($courses as $course => $course_group)
                                                    @php
                                                        // Add program information to campus data
                                                        $campus_data['programs'][] = [
                                                            'course_name' => $course_group->first()->course_details->course_name,
                                                            'count' => $course_group->count()
                                                        ];
                                                    @endphp
                                                    <h5> {{$course_group->first()->course_details->course_name}} - {{$course_group->count()}}</h5>
                                                    @endforeach
                                                    <h3>Scholarships</h3>
                                                    @foreach($scholarships as $scholarship => $scholarship_group)
                                                        @php
                                                            // Add scholarship information to campus data
                                                            $campus_data['scholarships'][] = [
                                                                'scholarship_name' => $scholarship_group->first()->scholarship_details->scholarship_name,
                                                                'count' => $scholarship_group->count()
                                                            ];
                                                        @endphp
                                                        @if($scholarship_group != null)
                                                            <h5> {{$scholarship_group->first()->scholarship_details->scholarship_name}} - {{$scholarship_group->count()}}</h5>
                                                        @endif
                                                    @endforeach
                                                    </div>
                                                </div>
                                                @php
                                                $location_data['campuses'][] = $campus_data;
                                                @endphp
                                            @endforeach
                                    </div>
                                </div>
                               @php 
                               $locations_list[] = $location_data;
                               @endphp
                            @endforeach
                            
                        </div>
                    </div>
                   
                    
                </div> -->
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

@section('scripts')
<!-- <script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiZ2VnZWpvc3BlciIsImEiOiJja3Flb3dxM2cwam40MnBxdmUyZ3ptd2d4In0.gtM2xu-epJ56CCUUHbuU0A';

    function init_map() {
        const coordinates = [123.625389, 7.931833];  // Example coordinates [longitude, latitude]

        const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/satellite-streets-v11',
        //style: 'mapbox://styles/gegejosper/cm0am1vpz00q201pn7dpo0rpx',
        zoom: 9,
        center: coordinates, // Center the map on the coordinates
        projection: 'mercator' // Use 'mercator' or another supported projection
    });

    new mapboxgl.Marker()
        .setLngLat(coordinates)
        .addTo(map);
    }

    document.addEventListener('DOMContentLoaded', init_map);

</script> -->
<script>
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
</script>
@endsection