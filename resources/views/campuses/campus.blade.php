@extends('layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Campus</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Details</li>
            </ol>
            <h1>{{ $campus->campus_name }}</h1>
            <p>{{ $campus->address }}</p>
            <a href="{{ route('panel.campuses.index') }}">Back to Campus List</a>
            <table class="table datatable-table">
                <tr>
                    <td>ID</td>
                    <td>FIRST NAME</td>
                    <td>MIDDLE NAME</td>
                    <td>LAST NAME</td>
                    <td>CAMPUS</td>
                    <td>ACTION</td>
                </tr>
                @foreach($students as $student)
                    <tr>
                        <td>{{$student->id}}</td>
                        <td>{{$student->first_name}}</td>
                        <td>{{$student->middle_name}}</td>
                        <td>{{$student->last_name}}</td>
                        <td>{{$student->campus_details->campus_name}}</td>
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
        
    </main>
@endsection