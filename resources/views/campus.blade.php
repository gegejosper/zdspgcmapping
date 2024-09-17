@extends('layouts.front')
@section('content_front')
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row">
                @foreach($campuses as $campus)
                <a class="text-decoration-none link-dark stretched-link" href="/campus/{{$campus->id}}">
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="https://dummyimage.com/600x350/ced4da/6c757d" alt="...">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-3">{{$campus->campus_name}}</h5>
                                <div class="small">
                                    <div class="text-muted">{{$campus->address}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection