<?php 
    $userBlock = new App\Services\Dashboard\GetUserBlocks();
    $block = $userBlock->handleResponce();
?> 
<section class="content">
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner" style="height: 135px">
                        <h4 align="center">
                       <b>Guest Count</b>
                    </h4>
                    <table>
                        <tbody>
                            <tr style="font-weight: bold">
                                <td width="150px">Today</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #f73209">{{$block['todayGuest']}}</span></td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td width="150px">Yesterday</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #dfa620">{{$block['yesterdayGuest']}}</span></td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td width="150px">Day before yesterday</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #c5d629">{{$block['daybeforeYesterdayGuest']}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="icon">
                     <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('guest.list') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner" style="height: 135px">
                <h4 align="center">
                    <b>Checked in Guest</b>
                </h4>
                    <table>
                        <tbody>
                            <tr style="font-weight: bold">
                                <td width="60px">Date</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #86c43c">{{date('d-M-Y',time())}}</span></td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td width="60px">Total</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #2ddc23">{{$block['totalCheckIn']}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
                <a href="{{ route('guest.list') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner" style="height: 135px">
                <h4>
               <b>Checked out Guest</b>
            </h4>
                <table>
                    <tbody>
                        <tr style="font-weight: bold">
                            <td width="60px">Date</td>
                            <td width="10px">:</td>
                            <td><span class="badge" style="background-color: #86c43c">{{date('d-M-Y',time())}}</span></td>
                        </tr>
                        <tr style="font-weight: bold">
                            <td width="60px">Total</td>
                            <td width="10px">:</td>
                            <td><span class="badge" style="background-color: #86c43c">{{$block['totalCheckOut']}}</span></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                
                <div class="icon">
                     <i class="fa fa-sign-out"></i>
                </div>
                <a href="{{ route('guest.list') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="fade-in guest-register">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Guest Name</th>
                                    <th scope="col">Mobile Number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No of Rooms Booked</th>
                                    <th scope="col">Arrival Date</th>
                                    <th scope="col">Arrival Time</th>
                                    <th scope="col">Status</th>
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
                                            occupied
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-xs" href="{{ asset(url('/guest/detail/'.$booking->id)) }}">Proceed to Check-Out</a>
                                            <a class="btn btn-danger btn-xs" href="{{ asset(url('/mark/suspicious/'.$booking->id)) }}">Mark as Suspicious</a>
                                            <div class="row text-danger">
                                                @if($errors->has('message'))
                                                    <strong>{{$errors->first('message')}}</strong>
                                                @endif
                                            </div>
                                            <button class="btn btn-github btn-xs" data-toggle="modal" data-target="#quickView" onclick="open_quickView({{$booking->id}})"><i class="fa fa-eye"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
</section>
@push('scripts')

<script>
    function open_quickView(id){
        $('.iframe-div').find('iframe').attr('src',"{{url('/guest/quickinvoice/')}}/"+id);
    }

</script>


@endpush