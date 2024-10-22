@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Student</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Details</li>
            </ol>
            <h1>{{ $student->first_name }}</h1>
            <p>{{ $student->middle_name }}</p>
            <p>{{ $student->last_name }}</p>
            <a href="{{ route('students.index') }}">Back to Student List</a>
        </div>
    </main>
@endsection