@extends('layouts.admin')
@section('breadcrumb')
<span class="breadcrumb-item active">{{ __('Guest Detail') }}</span>
@endsection
@section('title')
{{ __(' Dashboard') }}
@endsection
@section('content')

<div class="container-fluid">
<!-- @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif -->
    <div class="fade-in guest-register">
        <div class="card">
            <div class="card-body">
                <form action="{{ asset(url('guest/viewer_report')) }}" method="get" id="reportSearch">
                    <div class="form-row" style="margin-bottom: 15px;">

                        <div class="col">
                            <div>
                                <label>Police Station</label>
                                <select  name="police_station" class="form-select form-select-lg form-control" id="police_station">
                                    <option value="">Select Station</option>
                                    @foreach ($police_stations as $station)
                                    <option value="{{ $station->code }}" @if(isset($inputs) && isset($inputs['police_station']) && $inputs['police_station'] == $station->code) selected @endif>{{ $station->desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <label>Search by Name</label>
                                <input type="text" required class="form-control" name="search" value="{{(isset($inputs) && isset($inputs['search'])) ? $inputs['search'] : ''}}" />
                            </div>
                        </div>
                        
                        <div class="col" style="top: 30px;">
                            <button type="button" class="btn btn-primary" onclick="getFilter()">Filter</button>
                            <button type="button" class="btn btn-success" onclick="getExport()">Export</button>
                        </div>
                    </div>
                </form>
                <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Hotel name</th>
                            <th scope="col">Manage Name</th>
                            <th scope="col">Manager Mobile Number</th>
                            <th scope="col">Owner Name</th>
                            <th scope="col">OwnnerMobile Number</th>
                            <th scope="col">Hotel Address</th>
                            <th scope="col">City</th>
                            <th scope="col">Police Station</th>
                            <th scope="col" style="width:8% !important">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hotels as $row)
                        <tr>
                            <td scope="col">{{$row->hotel_name}}</td>
                            <td scope="col">{{$row->manger_name}}</td>
                            <td scope="col">{{$row->manager_mobile}}</td>
                            <td scope="col">{{$row->owner_name}}</td>
                            <td scope="col">{{$row->owner_mobile}}</td>
                            <td scope="col">{{$row->address}}</td>
                            <td scope="col">{{strtolower($row->city_name)}}</td>
                            <td scope="col">{{strtolower($row->police_station)}}</td>
                            <td scope="col">{{$row->floor}}</td>
                            <td scope="col" style="width:8% !important">
                                <a href="{{ asset(url('/admin/hotel/detail/'.$row->id)) }}" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <div class="text-center">
            {{ $hotels->links() }}
        </div>

    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        
    });
</script>
@endsection
@push('scripts')

<script>
    function getExport(id){
        $('.iframe-div').find('iframe').attr('src',"{{url('/guest/quickinvoice/')}}/"+id);
    }
    function getFilter(){
        $('#reportSearch').attr('action',"{{asset(url('admin/viewer_report'))}}");
        $('#reportSearch').submit();
    }
    function getExport(){
        $('#reportSearch').attr('action',"{{asset(url('admin/viewer_report/export'))}}");
        $('#reportSearch').submit();
    }
</script>


@endpush