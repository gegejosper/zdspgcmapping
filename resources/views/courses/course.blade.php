@extends('layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Course</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Details</li>
            </ol>
            <h1>{{ $course->course_name }}</h1>
            <p>{{ $course->status }}</p>
            <a href="{{ route('courses.index') }}">Back to Course List</a>
        </div>
    </main>
@endsection