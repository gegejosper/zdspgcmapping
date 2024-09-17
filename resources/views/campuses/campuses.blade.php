@extends('layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Campuses</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">List of Campus</li>
                <li class="breadcrumb-item">
                    <a href="/panel/campuses/create" class="btn btn-info">
                        Create Campus
                    </a>
                </li>
            </ol>
            <div class="row">
                <div class="col-lg-6">
                    <!-- <table id="datatablesSimple" class="datatable-table"><thead><tr><th data-sortable="true" style="width: 19.517102615694164%;"><a href="#" class="datatable-sorter">Name</a></th><th data-sortable="true" style="width: 30.046948356807512%;"><a href="#" class="datatable-sorter">Position</a></th><th data-sortable="true" style="width: 15.090543259557343%;"><a href="#" class="datatable-sorter">Office</a></th><th data-sortable="true" style="width: 8.383635144198525%;"><a href="#" class="datatable-sorter">Age</a></th><th data-sortable="true" style="width: 14.352783366867875%;"><a href="#" class="datatable-sorter">Start date</a></th><th data-sortable="true" style="width: 12.608987256874581%;"><a href="#" class="datatable-sorter">Salary</a></th></tr></thead><tbody><tr data-index="0"><td>Tiger Nixon</td><td>System Architect</td><td>Edinburgh</td><td>61</td><td>2011/04/25</td><td>$320,800</td></tr><tr data-index="1"><td>Garrett Winters</td><td>Accountant</td><td>Tokyo</td><td>63</td><td>2011/07/25</td><td>$170,750</td></tr><tr data-index="2"><td>Ashton Cox</td><td>Junior Technical Author</td><td>San Francisco</td><td>66</td><td>2009/01/12</td><td>$86,000</td></tr><tr data-index="3"><td>Cedric Kelly</td><td>Senior Javascript Developer</td><td>Edinburgh</td><td>22</td><td>2012/03/29</td><td>$433,060</td></tr><tr data-index="4"><td>Airi Satou</td><td>Accountant</td><td>Tokyo</td><td>33</td><td>2008/11/28</td><td>$162,700</td></tr><tr data-index="5"><td>Brielle Williamson</td><td>Integration Specialist</td><td>New York</td><td>61</td><td>2012/12/02</td><td>$372,000</td></tr><tr data-index="6"><td>Herrod Chandler</td><td>Sales Assistant</td><td>San Francisco</td><td>59</td><td>2012/08/06</td><td>$137,500</td></tr><tr data-index="7"><td>Rhona Davidson</td><td>Integration Specialist</td><td>Tokyo</td><td>55</td><td>2010/10/14</td><td>$327,900</td></tr><tr data-index="8"><td>Colleen Hurst</td><td>Javascript Developer</td><td>San Francisco</td><td>39</td><td>2009/09/15</td><td>$205,500</td></tr><tr data-index="9"><td>Sonya Frost</td><td>Software Engineer</td><td>Edinburgh</td><td>23</td><td>2008/12/13</td><td>$103,600</td></tr></tbody></table> -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card p-4">
                    <table class="table datatable-table">
                        <tr>
                            <td>ID</td>
                            <td>NAME</td>
                            <td>ADDRESS</td>
                            <td>MAP COLOR</td>
                            <td>ACTION</td>
                        </tr>
                        @foreach($campuses as $campus)
                            <tr>
                                <td>{{$campus->id}}</td>
                                <td>{{$campus->campus_name}}</td>
                                <td>{{$campus->address}}</td>
                                <td>{{$campus->map_color}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{route ('panel.campuses.show', $campus->id) }}"><i class="fa fa-search"> </i></a>
                                    <a class="btn btn-warning" href="{{route ('panel.campuses.edit', $campus->id) }}"><i class="fa fa-pencil"> </i></a>
                                    <form action="{{ route('panel.campuses.destroy', $campus->id) }}" method="POST" style="display:inline;">
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