@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                        <canvas id="campusChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-body">
                        <canvas id="courseChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card h-100">
                        <div class="card-body">
                        <canvas id="addressChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        </div>
    </main>
    <script>
        const courseLabels = @json($course_labels);
        const courseData = @json($course_data);

        const addressLabels = @json($address_labels);
        const addressData = @json($address_data);

        const campusLabels = @json($campus_labels);
        const campusData = @json($campus_data);

        // Create the course distribution pie chart
        const courseCtx = document.getElementById('courseChart').getContext('2d');
        new Chart(courseCtx, {
            type: 'pie',
            data: {
                labels: courseLabels,
                datasets: [{
                    label: 'Courses',
                    data: courseData,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',   // Teal
                        'rgba(255, 159, 64, 0.2)',   // Orange
                        'rgba(255, 205, 86, 0.2)',   // Yellow
                        'rgba(54, 162, 235, 0.2)',   // Blue
                        'rgba(153, 102, 255, 0.2)',  // Purple
                        'rgba(201, 203, 207, 0.2)',  // Grey
                        'rgba(255, 99, 132, 0.2)',   // Red
                        'rgba(0, 128, 128, 0.2)',    // Dark Teal
                        'rgba(0, 204, 102, 0.2)',    // Green
                        'rgba(204, 0, 102, 0.2)'     // Dark Pink
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(201, 203, 207, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(0, 128, 128, 1)',
                        'rgba(0, 204, 102, 1)',
                        'rgba(204, 0, 102, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
            }
        });

        // Create the address distribution bar chart
        const addressCtx = document.getElementById('addressChart').getContext('2d');
        new Chart(addressCtx, {
            type: 'bar', // Change to bar chart
            data: {
                labels: addressLabels,
                datasets: [{
                    label: 'Addresses',
                    data: addressData,
                    backgroundColor: 'rgba(153, 102, 255, 0.5)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
            
        });
        // Campus Polar Area Chart
        const campusCtx = document.getElementById('campusChart').getContext('2d');
        new Chart(campusCtx, {
            type: 'polarArea',
            data: {
                labels: campusLabels,
                datasets: [{
                    label: 'Campus',
                    data: campusData,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',   // Teal
                        'rgba(255, 159, 64, 0.2)',   // Orange
                        'rgba(255, 205, 86, 0.2)',   // Yellow
                        'rgba(54, 162, 235, 0.2)',   // Blue
                        'rgba(153, 102, 255, 0.2)',  // Purple
                        'rgba(201, 203, 207, 0.2)',  // Grey
                        'rgba(255, 99, 132, 0.2)',   // Red
                        'rgba(0, 128, 128, 0.2)',    // Dark Teal
                        'rgba(0, 204, 102, 0.2)',    // Green
                        'rgba(204, 0, 102, 0.2)'     // Dark Pink
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(201, 203, 207, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(0, 128, 128, 1)',
                        'rgba(0, 204, 102, 1)',
                        'rgba(204, 0, 102, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    r: {
                        beginAtZero: true
                    }
                }
            }
        });
</script>
@endsection

