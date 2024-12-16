@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Students</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">List of Students</li>
                <li class="breadcrumb-item">
                    <a href="/panel/dashboard" class="btn btn-warning">
                        <i class="fa fa-reply"></i>
                    </a>
                </li>
            </ol>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card-header">
                        
                            <div class="card-toolbar">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <!-- Search Form -->
                                        <form action="/panel/students/search" method="post" class="mb-3">
                                            @csrf
                                            <div class="input-group">
                                                <input 
                                                    type="text" 
                                                    name="search_query" 
                                                    class="form-control" 
                                                    placeholder="Search Name" 
                                                    aria-label="Search Name" 
                                                    required
                                                >
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                    
                                    <div class="col-lg-2">
                                        <a href="/panel/students/create" class="btn btn-info">
                                            Add Student
                                        </a>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- Import Form -->
                                        <form action="{{ route('panel.students.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
                                            @csrf
                                            <label for="file" class="form-label mb-0 me-2">Import Excel File:</label>
                                            <input 
                                                type="file" 
                                                name="file" 
                                                id="file" 
                                                class="form-control" 
                                                style="max-width: 300px;" 
                                                required
                                            >
                                            <button type="submit" class="btn btn-primary">
                                                Import
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <table class="table datatable-table">
                            @if(isset($keyword))
                            <tr><td><em>Search Result for: <span class="text-danger">{{$keyword}}</span></em></td></tr>
                            @endif
                            <tr>
                                <td>#</td>
                                <td>NAME</td>
                                <td>ADDRESS</td>
                                <td>SCHOLARSHIPS</td>
                                <td>COURSE</td>
                                <td>CAMPUS</td>
                                <!-- <td>STATUS</td> -->
                                <!-- <td>ACTION</td> -->
                            </tr>
                            @php
                                $count = ($students->currentPage() - 1) * $students->perPage() + 1;
                            @endphp
                            @foreach($students as $student)
                                <tr>
                                    <td>{{$count}}.</td>
                                    <td>{{$student->last_name}}, {{$student->first_name}} {{$student->middle_name}}</td>
                                    <td>{{$student->address}}, {{$student->municipality}}, {{$student->province}}</td>
                                    @if($student->scholarship_details != null)
                                        <td>{{$student->scholarship_details->scholarship_name}}</td>
                                        @else
                                        <td>NONE</td>
                                    @endif
                                    <td>{{$student->course_details?->course_name}}</td>
                                    <td>{{$student->campus_details?->campus_name}}</td>
                                    <!-- <td>{{$student->status}}</td> -->
                                    <td>
                                        <!-- <a class="btn btn-success" href="{{route ('panel.students.show', $student->id) }}"><i class="fa fa-search"> </i></a> -->
                                        <a class="btn btn-warning" href="{{route ('panel.students.edit', $student->id) }}"><i class="fa fa-pencil"> </i></a>
                                        <!-- <form action="{{ route('panel.students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-times"> </i></button>
                                        </form> -->
                                    </td>
                                </tr>
                                <?php $count += 1; ?>
                                @php $count++; @endphp
                            @endforeach
                        </table>
                        <!-- Pagination Links -->
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $students->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
@endsection