@extends('layouts.admin')
@section('breadcrumb')
    <span class="breadcrumb-item active">{{ __('Guest Detail') }}</span>
@endsection
@section('title')
    {{ __(' Dashboard') }}
@endsection
@section('content')

    <div class="container-fluid">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="fade-in guest-register">
            <div class="card">
                <div class="card-body">
                    <form action="{{ asset(url('guest/report')) }}" method="get" id="reportSearch">
                        <div class="form-row" style="margin-bottom: 15px;">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label>From</label>
                                        <input type="date" required class="form-control" placeholder="Select Date" name="searchFrom"
                                               value="{{(isset($inputs) && isset($inputs['searchFrom'])) ? $inputs['searchFrom'] : ''}}"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label>To</label>
                                        <input type="date" required class="form-control" placeholder="Select Date" name="searchTo"
                                               value="{{(isset($inputs) && isset($inputs['searchTo'])) ? $inputs['searchTo'] : ''}}"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col" style="top: 30px;">
                                <button type="button" class="btn btn-primary" onclick="getFilter()">Filter</button>
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
                                    <td scope="col">{{$row->id}}</td>
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
            $(".accompany-hide").hide();
            $('.accomapny-lable').hide();
            $('.bookin-lable').hide();
            $('#country').on('change', function() {
                var countryId = this.value;
                $('#state').html('');
                $.ajax({
                    url: "{{ route('getStates') }}?country_id=" + countryId,
                    type: 'get',
                    success: function(res) {
                        $('#state').html('<option value="">Select State</option>');
                        $.each(res, function(key, value) {
                            $('#state').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state').on('change', function() {
                var stateId = this.value;
                $('#city').html('');
                $.ajax({
                    url: "{{ route('getCities') }}?state_id=" + stateId,
                    type: 'get',
                    success: function(res) {
                        $('#city').html('<option value="">Select City</option>');
                        $.each(res, function(key, value) {
                            $('#city').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
@push('scripts')

    <script>
        function getFilter(){
            $('#reportSearch').attr('action',"{{asset(url('admin/irregular_checkin'))}}");
            $('#reportSearch').submit();
        }
    </script>


@endpush