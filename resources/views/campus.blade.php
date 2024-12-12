@extends('layouts.front')
@section('content_front')
<section class="py-5 bg-light">
    <div class="container px-5 my-5">
        <!-- Campus Information Panel -->
        <div class="card border-0 shadow-sm mb-5">
            <div class="row">
                <!-- Campus Details -->
                <div class="col-12">
                    <div class="card h-100 text-center">
                        <div class="card-body py-5">
                            <h4 class="text-primary fw-bold mb-3">
                                {{$campus->campus_name}} Campus
                            </h4>
                            <p class="text-muted fs-5 mb-0">{{$campus->address}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Statistics Section -->
            <div class="row g-4 my-5">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card h-100 border-secondary">
                        <div class="card-body">
                            <!-- Total Students -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="text-secondary fw-bold">Total Students:</span>
                                <span class="fs-4 text-dark fw-bold">{{number_format($students->count(), 0)}}</span>
                            </div>

                            <!-- Program Statistics -->
                            <hr>
                            <h4 class="text-secondary fw-bold mb-3">Program Statistics</h4>
                            <div class="table-responsive">
                                <table id="programStats" class="table table-striped table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Programs</th>
                                            <th>Count</th>
                                            <th>Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($courses as $course)
                                        <tr>
                                            <td>{{$course->first()->course_details->course_name}}</td>
                                            <td>{{number_format($course->count(), 0)}}</td>
                                            @php
                                                $percentage_courses = ($course->count() / $students->count()) * 100;
                                            @endphp
                                            <td>{{number_format($percentage_courses, 2)}}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Address Statistics -->
                            <hr>
                            <h4 class="text-secondary fw-bold mb-3">Address Statistics</h4>
                            <div class="table-responsive">
                                <table id="addressStats" class="table table-striped table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Address</th>
                                            <th>Count</th>
                                            <th>Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($addresses as $location => $address)
                                        @php
                                            $percentage_address = ($address->count() / $students->count()) * 100;
                                        @endphp
                                        <tr>
                                            <td>{{$location}}</td>
                                            <td>{{number_format($address->count(), 0)}}</td>
                                            <td>{{number_format($percentage_address, 2)}}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Scholarship Statistics -->
                            <hr>
                            <h4 class="text-secondary fw-bold mb-3">Scholarship Statistics</h4>
                            <div class="table-responsive">
                                <table id="scholarshipStats" class="table table-striped table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Scholarship</th>
                                            <th>Count</th>
                                            <th>Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($scholarships as $scholarship)
                                        @php
                                            $percentage_scholarships = ($scholarship->count() / $students->count()) * 100;
                                        @endphp
                                        <tr>
                                            <td>{{$scholarship->first()->scholarship_details->scholarship_name}}</td>
                                            <td>{{number_format($scholarship->count(), 0)}}</td>
                                            <td>{{number_format($percentage_scholarships, 2)}}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection