@extends('layouts.front')
@section('content_front')
<section class="py-5 bg-light">
    <div class="container px-5 my-5">
        <!-- Title -->
        <h1 class="text-center mb-5 fw-bold text-primary">List of Campuses</h1>

        <!-- Campus List -->
        <div class="row g-4">
            @foreach($campuses as $campus)
            <div class="col-lg-4 col-md-6">
                <a href="/campuses/{{$campus->id}}" class="text-decoration-none text-dark">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <!-- Campus Name -->
                            <h5 class="card-title fw-bold text-secondary mb-3">{{$campus->campus_name}}</h5>

                            <!-- Campus Address -->
                            <p class="small text-muted mb-0">
                                <strong>Address:</strong> {{$campus->address}}
                            </p>
                        </div>
                        <!-- Card Footer -->
                        <div class="card-footer bg-transparent border-0 text-center">
                            <span class="text-primary small">View Details &rarr;</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection