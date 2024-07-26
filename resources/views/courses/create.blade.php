@extends('layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create Course</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Fill Details</li>   
            </ol>
            <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        <div>
                        <label>Course </label>
                        <input type="text" name="course_name" value="{{ old('course_name') }}" class="form-control">
                        </div>
                        <input type="hidden" name="status" value="active">
                        <button type="submit" class="btn btn-info">Create</button>
                    </form>
            </div>
        </div>
    </main>
@endsection