@extends('layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Students</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">List of Students</li>
                <li class="breadcrumb-item">
                    <a href="/panel/students/create" class="btn btn-info">
                        Create Student
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
                        <table class="table datatable-table">
                            <tr>
                                <td>ID</td>
                                <td>FIRST NAME</td>
                                <td>MIDDLE NAME</td>
                                <td>LAST NAME</td>
                                <td>COURSE</td>
                                <td>ACTION</td>
                            </tr>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{$student->id}}</td>
                                    <td>{{$student->first_name}}</td>
                                    <td>{{$student->middle_name}}</td>
                                    <td>{{$student->last_name}}</td>
                                    <td>{{$student->course_details->course_name}}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{route ('panel.students.show', $student->id) }}"><i class="fa fa-search"> </i></a>
                                        <a class="btn btn-warning" href="{{route ('panel.students.edit', $student->id) }}"><i class="fa fa-pencil"> </i></a>
                                        <form action="{{ route('panel.students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-times"> </i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
@endsection