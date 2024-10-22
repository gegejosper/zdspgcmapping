@extends('layouts.front')
@section('content_front')
    <section class="py-5">
        <div class="container px-5 my-5">
            <h1>List of Campus</h1>
            <div class="panel border border-solid rounded-1 p-3">
            <div class="row">
                @foreach($campuses as $campus)
                    <div class="col-lg-4 mb-5">
                        
                        <div class="card h-100 shadow border-0">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-3">{{$campus->campus_name}}</h5>
                                <div class="small">
                                    Address: <div class="text-muted">{{$campus->address}}</div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                
                @endforeach
            </div>
            </div>
           
        </div>
    </section>
@endsection