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


    <div class="container">
        <div class="row">
          <div class="col-sm">

            <div class="card">
                <div class="card-header">Guest Detail</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center" style="margin-bottom: 15px;">
                                <img src="{{ asset(url('storage/bookings/'.$booking->guest_image)) }}"/>
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Guest Name:</b> {{ $booking->gues_name }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Mobile Number:</b> {{ $booking->mobile_number }}
                            </div>

                            <div class="col-md-4 detil-item">
                                <b>Guest Email:</b> {{ $booking->email_id }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Arrived From:</b> {{ $booking->arrived_from }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Arrival Date:</b> {{ $booking->arrival_date }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Arrival Time:</b> {{ $booking->arrival_time }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

          <div class="col-sm">

            @if(!empty($criminal))
            <div class="card">
                <div class="card-header">Criminal Detail</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center" style="margin-bottom: 15px;">
                                <img src="{{ asset(url('storage/criminals/'.$criminal->photo)) }}"/>
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Name:</b> {{ $criminal->name }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Mobile Number:</b> {{ $criminal->mobile }}
                            </div>

                            <div class="col-md-4 detil-item">
                                <b>Age:</b> {{ $criminal->age }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Gender:</b> {{ $criminal->gender }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <b>Remarks:</b> {{ $criminal->remarks }}
                            </div>
                            <div class="col-md-4 detil-item">
                                <a class="btn btn-danger btn-xs" href="{{ asset(url('/mark/unsuspicious/'.$booking->id)) }}">Mark as Not Suspicious</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endif

          </div>
        </div>
    </div>

        <div class="card">
            <div class="card-header">Booking Detail</div>
            <div class="card-body">
                <h5><b>Room Booked :</b> {{ $booking->room_booked }}</h5>
                @foreach($booking->rooms as $room)
                    <div class="row">
                        <div class="col-md-3 detil-item">
                            <b>Building Number:</b> {{ $room->building_number }}
                        </div>
                        <div class="col-md-3 detil-item">
                            <b>Floor Number:</b> {{ $room->floor_number }}
                        </div>
                        <div class="col-md-2 detil-item">
                            <b>Room Number:</b> {{ $room->room_number }}
                        </div>

                        <div class="col-md-3 detil-item">
                            @role('user')
                            <button class="btn btn-info">{{ $room->status ? 'Completed' : 'In Progress' }}</button>
                                <a href="{{ $room->status ? '#' : asset(url('/guest/checkout/'.$booking->id.'/room/'.$room->id)) }}"
                                    style="{{ $room->status ? 'cursor: not-allowed; pointer-events:none' : '' }}"
                                    class="btn btn-primary"
                                    onclick="return disableDoubleClick()">Checkout</a>
                            </div>
                            @endrole
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
<style>
.detil-item {
    margin-bottom: 15px;
}
.v-p-i img {
    width: 100%;
    height: 250px;
}
</style>
<script type="text/javascript">
    disableDoubleClick = function() {
        if (typeof(_linkEnabled)=="undefined") _linkEnabled = true;
        setTimeout("blockClick()", 100);
        return _linkEnabled;
    }
    blockClick = function() {
        _linkEnabled = false;
        setTimeout("_linkEnabled=true", 1000);
    }
</script>
@endsection
