@extends('layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create Student</h1>
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
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf
                        <div>
                        <label>First Name </label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control">
                        </div>
                        <div>
                        <label>Middle Name </label>
                        <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="form-control">
                        </div>
                        <div>
                        <label>Last Name </label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-info">Create</button>
                    </form>
            </div>
        </div>
    </main>
@endsection