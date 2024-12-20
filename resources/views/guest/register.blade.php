@extends('layouts.admin')
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
    <form action="{{ route('guest.store') }}" id="guest-register" enctype="multipart/form-data" method="post">
        @csrf

        <div class="fade-in guest-register">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                                <div class="form-group row">

                                    <label class="col-6" style="margin-top:20px;">Have you ever visited this location before ?</label>
                                    <div class="col-6">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input name="is_visited_before" id="is_visited_before_0" type="radio" class="custom-control-input" value="1">
                                            <label for="is_visited_before_0" class="custom-control-label">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input name="is_visited_before" id="is_visited_before_1" type="radio" class="custom-control-input" value="0">
                                            <label for="is_visited_before_1" class="custom-control-label">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 searchPhone" style="display:none">
                            <input name="search" id="searchPhone" required placeholder="search number" type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" style="text-align:center">Guest Detail</div>
                <div class="card-body">
                        <div class="take-img">
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <div class="cam-wrapper">
                                        <div id="my_camera" style="width:320px; height:240px;"></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-12">
                                    <img class="d-img" src="{{ asset(url('public\images\user-icon.png')) }}" />
                                    <input type="hidden" name="guest_image" class="image-tag" />
                                    <div id="results"></div>
                                </div>
                                <div class="col-md-5 col-xs-12"></div>
                                <div class="col-md-12">
                                    <button onClick="take_snapshot()" type="button" class="btn btn-primary take-photo-btn"><i class="fa fa-camera"></i> Take Snapshot</button>

                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <label>Guest Name <i class="fa fa-star f-required"></i></label>
                                <input required name="gues_name" placeholder="Guest Name" type="text" class="form-control">
                            </div>
 <div class="col">
<label>Guest Mobile Number <i class="fa fa-star f-required"></i></label>
<input name="mobile_number"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "10" required class="form-control" placeholder="Mobile Number"
 />
                            </div>
                            <div class="col">
                                <label>Alternative Moible Number</label>
                                <input name="alter_mobile_number"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "10" required class="form-control" placeholder="Alternate Mobile Number"
 />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label>Age <i class="fa fa-star f-required"></i></label>
                                <input name="age" required placeholder="Age" type="number" class="form-control">
                            </div>
                            <div class="col">
                                <label>Gender <i class="fa fa-star f-required"></i></label>
                                <div>
                                    <select id="gender" name="gender" required="required" class="custom-select">
                                        <option value="">Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label>Guest Email Id</label>
                                <input type="text" class="form-control" placeholder="Email Id" name="email_id">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label>Guest Arrived From <i class="fa fa-star f-required"></i></label>
                                <input name="arrived_from" required placeholder="Arrived From" type="text" class="form-control">
                            </div>
                            <div class="col">
                                <label>Nationality <i class="fa fa-star f-required"></i></label>
                                <div>
                                    <select name="nationality" required="required" class="custom-select" id="nationality">
                                        <option value="" selected>Nationality</option>
                                        <option value="Indian">Indian</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label>Means of Transport <i class="fa fa-star f-required"></i></label>
                                <div>
                                    <select name="transport" required="required" class="custom-select" id="transport">
                                        <option value="">Select means of Transport</option>
                                        <option value="Car">Car</option>
                                        <option value="Bus">Bus</option>
                                        <option value="Train">Train</option>
                                        <option value="Flight">Flight</option>
                                        <option value="Own-Taxi">Own Taxi</option>
                                        <option value="Auto">Auto</option>
                                        <option value="Others">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="present-address">
                            <div class="form-row">
                                <div class="col">
                                    <label>Present Address <i class="fa fa-star f-required"></i></label>
                                    <input name="house_number" required placeholder="Plot/House Number/At" type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <label>&nbsp;</label>
                                    <input name="lane" required placeholder="Lane" type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <label>&nbsp;</label>
                                    <input name="land_mark" required placeholder="Landmark" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <select required class="form-select form-select-lg form-control" name="country" id="country">
                                        <option value="" selected>Select country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col otherHide">
                                    <div>
                                        <select required name="state" class="form-select form-select-lg form-control" id="state">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col otherHide">
                                    <div>
                                        <select required name="city" class="form-select form-select-lg form-control" id="city">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row otherDisplay" style="display:none">
                                <div class="col">
                                        <input name="other_country" required placeholder="Other Country" type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <div>
                                        <input name="other_state" required placeholder="Other State" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                    <input name="other_city" required placeholder="Other City" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <input name="present_town" required placeholder="Town" type="text" class="form-control">
                                </div>
                                <div class="col">
                                    
                                
                                <input name="present_pin" required placeholder="Pin" type="text" class="form-control">
                                </div>
                                <div class="col">
                                </div>
                            </div>
                        </div>
                        <div class="permanent-address">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label>Permanent Address <i class="fa fa-star f-required"></i></label>
                                </div>
                                <div class="col-md-12">
                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input name="same_a_present" id="same_a_present" type="checkbox" class="custom-control-input">
                                        <label for="same_a_present" class="custom-control-label">Same As Present</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <input name="p_house_number" required placeholder="Plot/House Number/At" type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <input name="p_lane" required placeholder="Lane" type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <input name="p_land_mark" required placeholder="Landmark" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <select required name="p_country" class="form-select form-select-lg form-control" id="p-country">
                                        <option value="" selected>Select country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col p_otherHide">
                                    <div>
                                        <select required name="p_state" class="form-select form-select-lg form-control" id="p-state">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col p_otherHide">
                                    <div>
                                        <select required name="p_city" class="form-select form-select-lg form-control" id="p-city">
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-row p_otherDisplay" style="display:none">
                                <div class="col">
                                        <input name="p_other_country" required placeholder="Other Country" type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <div>
                                        <input name="p_other_state" required placeholder="Other State" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div>
                                    <input name="p_other_city" required placeholder="Other City" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <input name="p_town" required placeholder="Town" type="text" class="form-control">
                                </div>
                                <div class="col">
                                    <input name="p_pin" required placeholder="Pin" type="text" class="form-control">
                                </div>
                                <div class="col">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label>Local Contact Name</label>
                                <input name="local_contact_name" placeholder="Contact Name" type="text" class="form-control">
                            </div>
                            <div class="col">
                                <label>Local Contact Number</label>
                                <input name="local_contact_number"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "10" required class="form-control" placeholder="Local Contact Number"
 />
                            </div>
                            <div class="col">
                                <label>Arrival Date & Time At Reception <i class="fa fa-star f-required"></i></label>
                                <div class="row">
                                    <div class="col">
                                        <input type="date" class="form-control" required placeholder="Select Date" name="arrival_date" />
                                    </div>
                                    <div class="col">
                                        <input type="time" class="form-control" required placeholder="Select Date" name="arrival_time" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label>Id Type <i class="fa fa-star f-required"></i></label>
                                <select name="id_type" required="required" class="form-control">
                                    <option value="">Select Id Type</option>
                                    <option value="dl">DL</option>
                                    <option value="aadhaar">AADHAAR</option>
                                    <option value="passport">PASSPORT</option>
                                    <option value="voterid">VOTER ID CARD</option>
                                    <option value="other">OTHERS</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Id Number <i class="fa fa-star f-required"></i></label>
                                <input type="text" class="form-control" required placeholder="Id Number" name="id_number">
                            </div>
                            <div class="col">
                                <label>Id Upload(PDF / Image)</label>
                                <input onchange="loadIdDocument(event)" type="file" name="document_id" class="form-control" />

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label>Visitor Photo Upload (JPEG Image Only)</label>
                                <input onchange="visitorPhoto(event)" type="file" class="form-control" accept="image/*" name="visitor_photo">
                                <img style="display: none;" id="visitor-preview" src="#" alt="your image"/>
                            </div>
                            <div class="col">
                                <img style="display: none;margin-top:0;" id="id-preview" src="#" alt="your image" />
                            </div>
                        </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Accompany Details </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Accompany Person <i class="fa fa-star f-required"></i></label>
                                <div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input name="accompany_person" required id="accompany_person_0" type="radio" class="custom-control-input is_accompany" value="1">
                                        <label for="accompany_person_0" class="custom-control-label">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input name="accompany_person" required id="accompany_person_1" type="radio" class="custom-control-input is_accompany" value="0">
                                        <label for="accompany_person_1" class="custom-control-label">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 accompany-hide">
                            <div class="form-group row">
                                <label for="adult" class="col-3 col-form-label">Adult</label>
                                <div class="col-9">
                                    <input value="" name="accompany_adult" placeholder="Adult" type="number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 accompany-hide">
                            <div class="form-group row">
                                <label for="adult" class="col-3 col-form-label">Children</label>
                                <div class="col-9">
                                    <input value="" name="accompany_children" placeholder="Children" type="number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 accompany-hide">
                            <button id="accompany-add" type="button" style="margin-top: 3px;" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                    <div class="form-row accomapny-lable">
                        <div class="col-md-">SI. Number</div>
                        <div class="col">Guest Name</div>
                        <div class="col">Gender</div>
                        <div class="col">Age</div>
                        <div class="col">Reltion With Guest</div>
                    </div>
                    <div class="accompany-room-wrapper">
                        <div class="form-row booking-item">
                            <!-- Show accompany field here-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Booking Detail</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total Number Of Room Booked</label>
                                <input type="number" required class="form-control selected-room" name="room_booked" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary booking-expand">Add</button>
                        </div>
                    </div>
                    <div class="form-row bookin-lable">
                        <div class="col">SI. Number</div>
                        <div class="col">Building</div>
                        <div class="col">Floor Number</div>
                        <div class="col">Room Number</div>
                    </div>
                    <div class="booking-room-wrapper">
                        <div class="form-row booking-item">
                            <!--- generated div will be show here --->
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Whom To Visit</label>
                            <select name="whom_to_visit" class="custom-select whom-to-visit">
                                <option value="">Select Whom To Visit</option>
                                <option value="friend">Friend</option>
                                <option value="relative">Relative</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="whom-to-visit-wrapper" style="display:none;">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" placeholder="Name" name="whom_to_visit_name" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        <input name="whom_to_visit_mobile"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number"
    maxlength = "10" required class="form-control" placeholder="Mobile Number"
 />
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="center-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="#" style="    margin-top: 30px;margin-left: 10px;" class="btn btn-danger">Close</a>
            </div>

                </div>
            </form>
        </div>

<style>
    .take-img {
        text-align: center;
        margin: 0 auto;
        margin-top: 0px;
    }

    .take-img img {
        height: 170px;
        width: 200px;
        margin-top: 20px;
    }

    .take-img button {
        margin-top: 15px;
        margin-bottom: 30px;
    }

    .guest-register .present-address,
    .permanent-address {
        margin-top: 15px;
    }

    .guest-register .form-row {
        margin-bottom: 15px;
    }

    button.btn.btn-primary {
        margin-top: 32px;
    }

    .center-submit {
        text-align: center;
        margin-bottom: 20px;
        margin-top: -45px;
    }

    i.fa.fa-star.f-required {
        font-size: 8px;
        color: red;
    }

    label.error {
        color: red;
    }

    img#id-preview,
    #visitor-preview {
        height: 100px;
        object-fit: contain;
        margin-top: 10px;
    }

    div#results img {
        width: 100%;
        border-radius: 10px;
        height: 175px;
    }

    button.btn.btn-primary.take-photo-btn {
        float: left;
        margin-top: -20px;
        margin-bottom: 10px;
    }
</style>
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $(".booking-expand").click(function() {
            $('.bookin-lable').show();
            var getBookinRoom = $(".selected-room").val();
            $('.booking-room-wrapper').empty()

            for (let i = 0; i < getBookinRoom; i++) {
                $('.booking-room-wrapper').append("<div class='form-row booking-item'><div class='col-md-1'>" + (i + 1) + "</div><div class='col'><input type='text' required class='form-control' placeholder='Building Number' name='bookingdata[booking" + i + "][building_number]'></div><div class='col'><input type='text' required class='form-control' placeholder='Floor Number' name='bookingdata[booking" + i + "][floor_number]'></div><div class='col'><input type='text' required class='form-control' placeholder='Room Number' name='bookingdata[booking" + i + "][room_number]'></div></div>");
            }
        });
    });
</script>
<script language="JavaScript">
    Webcam.set('constraints',{
        facingMode: "environment"
    });
    Webcam.attach( '#my_camera' );

    function take_snapshot() {
        $(".d-img").hide();
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById("results").innerHTML =
                '<img src="' + data_uri + '"/>';
        });
    }
</script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script type="text/javascript">
    var gustDetail;
    function getStatelist(countryId,is_parent) { 
        $('#'+is_parent+'state').html('');
        $.ajax({
            url: "{{ route('getStates') }}?country_id=" + countryId,
            type: 'get',
            success: function(res) {
                $('#'+is_parent+'state').html('<option value="">Select State</option>');
                let sel_state = '';
                if(is_parent == '')
                {
                    sel_state = (!jQuery.isEmptyObject( gustDetail ) ) ? gustDetail['state_id'] : '';
                } else {
                    sel_state = (!jQuery.isEmptyObject( gustDetail ) ) ? gustDetail['p_state_id'] : '';
                }
                $.each(res, function(key, value) {
                    if(sel_state == value.id)
                        $('#'+is_parent+'state').append('<option value="' + value.id + '" selected="">' + value.name + '</option>');
                    else
                        $('#'+is_parent+'state').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
                $('#'+is_parent+'city').html('<option value="">Select City</option>');
            }
        });            
    }    
    function getCityList(stateId,is_parent) { 
        $('#'+is_parent+'city').html('');
        $.ajax({
            url: "{{ route('getCities') }}?state_id=" + stateId,
            type: 'get',
            success: function(res) {
                $('#'+is_parent+'city').html('<option value="">Select City</option>');
                let sel_city = '';
                if(is_parent == '')
                {
                    sel_city = (!jQuery.isEmptyObject( gustDetail ) ) ? gustDetail['city_id'] : '';
                } else {
                    sel_city = (!jQuery.isEmptyObject( gustDetail ) ) ? gustDetail['p_city_id'] : '';
                }
                $.each(res, function(key, value) {
                    if(sel_city == value.id)
                        $('#'+is_parent+'city').append('<option value="' + value.id + '" selected="">' + value.name + '</option>');
                    else
                        $('#'+is_parent+'city').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });           
    }
    $(document).ready(function() {
        $(".accompany-hide").hide();
        $('.accomapny-lable').hide();
        $('.bookin-lable').hide();
        $('#country').on('change', function() {
            var countryId = this.value;
            if(countryId == 165)
            {
                $('.otherDisplay').show();
                $('.otherHide').hide();
            } else {
                
                $('.otherDisplay').hide();
                $('.otherHide').show();
                $('.otherDisplay').find('input').val('');

                getStatelist(countryId,'');
            }
        });
        $('#state').on('change', function() {
            var stateId = this.value;
            getCityList(stateId,'');
        });
        
        $("input[name=is_visited_before]").on('change',function(){
            if(this.value == 1) {
                $('.searchPhone').show();
            } else {
                $('.searchPhone').hide();
                $('#searchPhone').val('');
                if(!jQuery.isEmptyObject( gustDetail ) )
                {
                    $.each(gustDetail, function(key, value) {
                        if(key == 'guest_image'){
                            $('.d-img').attr('src',"{{ asset(url('public/images/user-icon.png')) }}"); 
                        }else if(key == 'country_id'){
                            $('#country option[value="'+value+'"]').prop('selected',false);
                        }else if(key == 'p_country_id'){
                            $('#p_country option[value="'+value+'"]').prop('selected',false);
                        }else{
                            if(key != 'id_number' && key != 'arrival_date' && key != 'arrival_time' && key != 'room_booked' && key != 'accompany_person')
                                $('input[name="'+key+'"]').val('');
                        }
                    });

                    $('#state').html('<option value="">Select State</option>');
                    $('#p_state').html('<option value="">Select State</option>');
                    $('#city').html('<option value="">Select City</option>');
                    $('#p_city').html('<option value="">Select City</option>');
                    gustDetail = {};
                }
            }
        });

        $('#searchPhone').on('change',function(){
            let val = this.value;
            let imgPath = "{{ asset(url('storage/app/public/')) }}";
            $.ajax({
                url: "{{ route('getGuestDetail') }}?mobile=" + val,
                type: 'get',
                success: function(res) {
                    if(!jQuery.isEmptyObject( res ) )
                    {
                        gustDetail = res;
                        getStatelist(gustDetail['country_id'],'');
                        getCityList(gustDetail['state_id'],'');
                        getStatelist(gustDetail['p_country_id'],'p-');
                        getCityList(gustDetail['p_state_id'],'p-');
                        $.each(res, function(key, value) {
                            if(key == 'guest_image'){
                                $('.d-img').attr('src',imgPath+'/'+value); 
                            } else if(key == 'country_id'){
                                $('#country option[value="'+value+'"]').prop('selected',true);
                            }else if(key == 'city_id'){
                                $('#city option[value="'+value+'"]').prop('selected',true);
                            }else if(key == 'state_id'){
                                $('#state option[value="'+value+'"]').prop('selected',true); 
                            }else if(key == 'p_country_id'){
                                $('#p-country option[value="'+value+'"]').prop('selected',true);
                            }else if(key == 'p_city_id'){
                                $('#p-city option[value="'+value+'"]').prop('selected',true);
                            }else if(key == 'p_state_id'){
                                $('#p-state option[value="'+value+'"]').prop('selected',true); 
                            }else if(key == 'gender'){
                                $('#gender option[value="'+value+'"]').prop('selected',true); 
                            }else if(key == 'nationality'){
                                $('#nationality option[value="'+value+'"]').prop('selected',true); 
                            } else if(key == 'transport'){
                                $('#transport option[value="'+value+'"]').prop('selected',true); 
                            } else {
                                if(key != 'id_number' && key != 'arrival_date' && key != 'arrival_time' && key != 'room_booked' && key != 'accompany_person')
                                    $('input[name="'+key+'"]').val(value);
                            }
                        });
                    } else {
                        if(!jQuery.isEmptyObject( gustDetail ) )
                        {
                            $.each(gustDetail, function(key, value) {

                                if(key == 'guest_image'){
                                    $('.d-img').attr('src',"{{ asset(url('public/images/user-icon.png')) }}"); 
                                }else if(key == 'country_id'){
                                    $('#country option[value="'+value+'"]').prop('selected',false);
                                }else if(key == 'p_country_id'){
                                    $('#p_country option[value="'+value+'"]').prop('selected',false);
                                }else{
                                    if(key != 'id_number' && key != 'arrival_date' && key != 'arrival_time' && key != 'room_booked' && key != 'accompany_person')
                                        $('input[name="'+key+'"]').val('');
                                }
                            });
                            
                            $('#state').html('<option value="">Select State</option>');
                            $('#p_state').html('<option value="">Select State</option>');
                            $('#city').html('<option value="">Select City</option>');
                            $('#p_city').html('<option value="">Select City</option>');
                            gustDetail = {};
                        }
                    }
                }
            });
        });
    });

  // For Permanent address 
    $(document).ready(function() {
        $('#p-country').on('change', function() {
            var countryId = this.value;
            if(countryId == 165)
            {
                $('.p_otherDisplay').show();
                $('.p_otherHide').hide();
            } else {
                
                $('.p_otherDisplay').hide();
                $('.p_otherHide').show();
                $('.p_otherDisplay').find('input').val('');

                getStatelist(countryId,'p-');
            }
        });
        $('#p-state').on('change', function() {
            var stateId = this.value;
            getCityList(stateId,'p-');
        });
    });
    // For same a present
    var getSameAsPresent = $("#same_a_present").val();
    $("#same_a_present").click(function() {
        if ($('#same_a_present').is(":checked")) {
            // get all value
            var house_number = $("input[name*='house_number']").val();
            var lane = $("input[name*='lane']").val();
            var land_mark = $("input[name*='land_mark']").val();
            var country = $('#country :selected').val();
            var state = $('#state :selected').val();
            var city = $('#city :selected').val();
            var otherCountry = $("input[name*='other_country']").val();
            var otherstate = $("input[name*='other_state']").val();
            var othercity = $("input[name*='other_city']").val();
            var town = $("input[name*='present_town']").val();
            var pin = $("input[name*='present_pin']").val();
            console.log("state", state)
            // replace all value
            $("input[name*='house_number']").val(house_number);
            $("input[name*='p_lane']").val(lane);
            $("input[name*='p_land_mark']").val(land_mark);
            $("input[name*='p_other_country']").val(otherCountry);
            $("input[name*='p_other_state']").val(otherstate);
            $("input[name*='p_other_city']").val(othercity);
            $("#p-country").val(country).change();
            setTimeout(function(){
                $("#p-state").val(state).change();
                setTimeout(function(){
                                $("#p-city").val(city).change();
                },500);
            },500);
            

            $("input[name*='p_town']").val(town);
            $("input[name*='p_pin']").val(pin);
        } else {
            $("input[name*='house_number']").val('');
            $("input[name*='p_lane']").val('');
            $("input[name*='p_land_mark']").val('');
            $("#p-country").val('').change();
            $("#p-state").val('').change();
            $("#p-city").val('').change();
            $("input[name*='p_town']").val('');
            $("input[name*='p_pin']").val('');
            $("input[name*='p_other_country']").val('');
            $("input[name*='p_other_state']").val('');
            $("input[name*='p_other_city']").val('');
        }
    })

    // form validation
    jQuery("#guest-register").validate({
        rules: {
            'guest_name': 'required'
        },
        messages: {
            guest_name: "This filed is required"
        }
    })

    // upload id preveiw
    var loadIdDocument = function(event) {
        var output = document.getElementById('id-preview');
        output.style.display = "block";
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    // visitorPhoto
    var visitorPhoto = function(event) {
        var output = document.getElementById('visitor-preview');
        output.style.display = "block";
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    // Accompany 
    $('input[name="accompany_person"]').on('change',function() {
        if (this.value == 1) {
            $(".accompany-hide").show();
        } else {
            $(".accompany-hide").hide();
        }
    });

    // Add accompany
    $("#accompany-add").click(function() {
        $('.accomapny-lable').show();
        var get_adult = $("input[name*='accompany_adult']").val();
        var get_child = $("input[name*='accompany_children']").val();
        var total_people = parseInt(get_adult ? get_adult : 0) + parseInt(get_child ? get_child : 0);

        $('.accompany-room-wrapper').empty()
        for (let i = 0; i < total_people; i++) {
            $('.accompany-room-wrapper').append('<div class="form-row accompany-item"><div class="col-md-1">' + (i + 1) + '</div><div class="col"><input type="text" required="" class="form-control" placeholder="Guest Name" name="accompany[' + i + '][guest_name]"></div><div class="col"><select name="accompany[' + i + '][gender]" required="required" class="custom-select"><option value="" selected="">Select Gender</option><option value="male">Male</option><option value="female">Female</option><option value="other">Other</option></select></div><div class="col"><input type="number" required="" class="form-control" placeholder="Age" name="accompany[' + i + '][age]"></div><div class="col"><select name="accompany[' + i + '][relation]" required="required" class="custom-select"><option value="" selected="">Select Relation</option><option value="friend">Friend</option><option value="family">Family</option><option value="other">Other</option></select></div></div>');
        }
    })

    // Whom to visit
    $(".whom-to-visit").change(function(){
        var whoToVisit = $('.whom-to-visit :selected').val();
        if(whoToVisit) {
            $(".whom-to-visit-wrapper").css('display','block');
        } else {
            $(".whom-to-visit-wrapper").css('display','none');
        }
    })
</script>
@endsection