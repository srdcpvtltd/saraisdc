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
                <form action="{{ asset(url('guest/filter')) }}" method="get">
                    <div class="form-row" style="margin-bottom: 15px;">
                        <div class="col">
                            <div class="form-grup">
                                <input placeholder="Enter Guest Name" name="guest_name" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-grup">
                                <input placeholder="Enter Guest Mobile Number" name="mobile_number" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-grup">
                                <input placeholder="Enter Email" name="email" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Guest Name</th>
                            <th scope="col">Mobile Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">No of Rooms Booked</th>
                            <th scope="col">Arrival Date</th>
                            <th scope="col">Arrival Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                        <tr>
                            <th>{{ $booking->gues_name }}</th>
                            <td>{{ $booking->mobile_number }}</td>
                            <td>{{ $booking->email_id }}</td>
                            <td>{{ $booking->room_booked }}</td>
                            <td>{{ $booking->arrival_date }}</td>
                            <td>{{ $booking->arrival_time }}</td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="{{ asset(url('/guest/detail/'.$booking->id)) }}">Proceed to Check-Out</a>
                                <button class="btn btn-github btn-xs" data-toggle="modal" data-target="#quickView" onclick="open_quickView({{$booking->id}})"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
<div class="modal fade" id="quickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="h4 font-weight-400 float-left modal-title" id="exampleModalLabel"> View Guest Details </h4>
                <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal" aria-label="Close">&times;</a>
            </div>
            <div class="modal-body">
                <div class="iframe-div">
                    <iframe></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery library -->

@endsection
@push('scripts')

<script>
    function open_quickView(id){
        $('.iframe-div').find('iframe').attr('src',"{{url('/guest/quickinvoice/')}}/"+id);
    }

</script>


@endpush