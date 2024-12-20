@extends('frontend.layouts.app')

@section('content')
    <p class="h3 text-center"><u>HOTEL REGISTRATION FORM</u></p>

    <div class="container-fluid" style=" padding-bottom: 50px;">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
        <div class="row">
            <div class="alert alert-danger alert-dismissible" id="alertmessageDiv" role="alert" style="display:none;">
                <!-- Alert for error -->
                <div id="alertmessage"></div>
            </div>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12" style="padding-left: 10px; padding-right:10px;">
                        <div class="panel with-nav-tabs">

                            <span class="pull-right post-name"
                                style="margin-top:10px;margin-right: 10px;margin-bottom: 10px;margin-left: 15px;">
                                <b style="color: #37806c;"></b></span>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane in active" id="address_tab" style="max-height: 40px !important;">
                                        @if(session()->has('success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif 
                                        @if(session()->has('error'))
                                            <div class="alert alert-danger">
                                                {{ session()->get('error') }}
                                            </div>
                                        @endif
                                        <form action="{{ route('post-add-hotel') }}" method="post" id="hotel_registration_form"
                                            name="hotel_registration_form" novalidate="novalidate" class="bv-form">
                                            @csrf
                                            <div>
                                                <!--***********START OF Hotel Details SECTION************-->
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"
                                                    style="padding: 0px;margin-top: 10px;">
                                                    <fieldset>
                                                        <legend>Hotel Details</legend>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="" class="col-lg-5"
                                                                        style="padding: 0;float: left;">Hotel
                                                                        Name:</label>
                                                                    <div class="col-lg-7">
                                                                        <input type="text" style="margin-left: -10px;"
                                                                            readonly="readonly"
                                                                            class="form-control"
                                                                            placeholder="Hotel Name *" value="{{(isset($user) && $user->name) ? $user->name : ''}}"
                                                                            name="hotel_name" id="hotel_name" required=""
                                                                            data-bv-field="hotel_name">
                                                                        <small data-bv-validator="notEmpty"
                                                                            data-bv-validator-for="hotel_name"
                                                                            class="help-block"
                                                                            style="display: none;">Required</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="" class="col-lg-5"
                                                                        style="padding-left:0;">Manager Name:</label>
                                                                    <div class="col-lg-7">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Manager Name*" value="{{old('manager_name')}}"
                                                                            name="manager_name" id="manager_name" 
                                                                            required="" data-bv-field="manager_name">
                                                                        <small data-bv-validator="notEmpty"
                                                                            data-bv-validator-for="manager_name"
                                                                            class="help-block"
                                                                            style="display: none;">This value is not
                                                                            valid</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label for="" class="col-lg-5"
                                                                        style="padding-left: 0;"> Owner Name:</label>
                                                                    <div class="col-lg-7">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Owner Name*" required=""
                                                                            name="owner_name" id="owner_name" required="" value="{{old('owner_name')}}"
                                                                            data-bv-field="owner_name">
                                                                        <small data-bv-validator="notEmpty"
                                                                            data-bv-validator-for="owner_name"
                                                                            class="help-block"
                                                                            style="display: none;">This value is not
                                                                            valid</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 10px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5"
                                                                            style="float: left;"> Manager Mobile
                                                                            Number:</label>
                                                                        <div class="col-lg-7">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Manager Mobile Number *"
                                                                                value="{{old('manager_no')}}" id="manager_no" name="manager_no"
                                                                                required="" data-bv-field="manager_no">
                                                                            <small data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="manager_no"
                                                                                class="help-block"
                                                                                style="display: none;">Required</small><small
                                                                                data-bv-validator="regexp"
                                                                                data-bv-validator-for="manager_no"
                                                                                class="help-block"
                                                                                style="display: none;">Sorry Invalid
                                                                                Data</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5"
                                                                            style="float: left;"> Owner Mobile
                                                                            Number:</label>
                                                                        <div class="col-lg-7">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Owner Mobile Number *" value="{{old('owner_no')}}"
                                                                                id="owner_no" name="owner_no" required=""
                                                                                data-bv-field="owner_no" />
                                                                            <small data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="owner_no"
                                                                                class="help-block"
                                                                                style="display: none;">Required</small><small
                                                                                data-bv-validator="regexp"
                                                                                data-bv-validator-for="owner_no"
                                                                                class="help-block"
                                                                                style="display: none;">Sorry Invalid
                                                                                Data</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 10px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5"
                                                                            style="float: left;"> Address:</label>
                                                                        <div class="col-lg-7">
                                                                            <textarea name="address" class="form-control" placeholder="Your Address *" style="width: 100%; height: 50px;"
                                                                                id="address" required=""
                                                                                data-bv-field="address">{{old('address')}}</textarea>
                                                                            <small data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="address"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5">Registration
                                                                            Number:</label>
                                                                        <div class="col-lg-7">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Registration Number *" value="{{old('regd_no')}}"
                                                                                id="regd_no" name="regd_no" required=""
                                                                                data-bv-field="regd_no">
                                                                            <small data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="regd_no"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5">Home Country:</label>
                                                                        <div class="col-lg-7">
                                                                            <select class="form-control"
                                                                                style="margin-left: -10px;" id="cmbcountry"
                                                                                name="cmbcountry" required
                                                                                placeholder="City *"
                                                                                data-bv-field="cmbcountry">
                                                                                <option value="">Select country
                                                                                </option>
                                                                                @foreach ($countries as $country)
                                                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            <small data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="cmbcountry"
                                                                                class="help-block"
                                                                                style="display: all;">Required</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 20px;">
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5">Home
                                                                            State:</label>
                                                                        <div class="col-lg-7">
                                                                            <select class="form-control"
                                                                                style="margin-left: -10px;" id="cmbstate"
                                                                                name="cmbstate" required="required"
                                                                                placeholder="City *"
                                                                                data-bv-field="cmbstate">
                                                                                <option value="">Select City
                                                                                </option>
                                                                            </select>
                                                                            <small data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="cmbstate"
                                                                                class="help-block"
                                                                                style="display: all;">Required</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5">Home
                                                                            City:</label>
                                                                        <div class="col-lg-7">
                                                                            <select class="form-control"
                                                                                style="margin-left: -10px;" id="cmbcity"
                                                                                name="cmbcity" required="required"
                                                                                placeholder="City *"
                                                                                data-bv-field="cmbcity">
                                                                                <option value="">Select City
                                                                                </option>
                                                                            </select>
                                                                            <small data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="cmbcity"
                                                                                class="help-block"
                                                                                style="display: all;">Required</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group" id="HidPS">
                                                                        <label for="" class="col-lg-5">Police
                                                                            Station:</label>
                                                                        <div class="col-lg-7">
                                                                            <select class="form-control"
                                                                                style="margin-left: 0px;"
                                                                                id="police_station" name="police_station"
                                                                                required=""
                                                                                placeholder="Police Station *"
                                                                                data-bv-field="police_station">
                                                                                <option value="">Select Police Station
                                                                                </option>
                                                                            </select>
                                                                            <small data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="police_station"
                                                                                class="help-block"
                                                                                style="display: none;">Required</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--**************START OF GENDER AND PHYSICAL FITNESS*********-->
                                                        <div class="row" style="margin-top: 20px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5"> Number Of
                                                                            Floors:</label>
                                                                        <div class="col-lg-7">
                                                                            <input type="number" class="form-control"
                                                                                placeholder="Number Of Floors *" value=""
                                                                                name="no_of_floor" id="no_of_floor"
                                                                                required="" data-bv-field="no_of_floor">
                                                                            <small data-bv-validator="integer"
                                                                                data-bv-validator-for="no_of_floor"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small><small
                                                                                data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="no_of_floor"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5">Number Of
                                                                            Rooms:</label>
                                                                        <div class="col-lg-7">
                                                                            <input type="number" class="form-control"
                                                                                placeholder="Number Of Rooms *" value=""
                                                                                name="no_of_rooms" id="no_of_rooms"
                                                                                required="" data-bv-field="no_of_rooms">
                                                                            <small data-bv-validator="integer"
                                                                                data-bv-validator-for="no_of_rooms"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small><small
                                                                                data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="no_of_rooms"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5"
                                                                            style="padding-left: 15px;">Direct Employee
                                                                            Count:</label>
                                                                        <div class="col-lg-7">
                                                                            <input type="number" class="form-control"
                                                                                placeholder="Direct Employee Count *"
                                                                                value="" name="direct_employee_count"
                                                                                id="direct_employee_count" required=""
                                                                                data-bv-field="direct_employee_count">
                                                                            <small data-bv-validator="integer"
                                                                                data-bv-validator-for="direct_employee_count"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small><small
                                                                                data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="direct_employee_count"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin-top: 20px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5"
                                                                            style="padding-left: 15px;">Outsource
                                                                            Employee Count:</label>
                                                                        <div class="col-lg-7">
                                                                            <input type="number" class="form-control"
                                                                                placeholder="Outsource Employee Count *"
                                                                                value="" name="outsource_employee_count"
                                                                                id="outsource_employee_count" required=""
                                                                                data-bv-field="outsource_employee_count">
                                                                            <small data-bv-validator="integer"
                                                                                data-bv-validator-for="outsource_employee_count"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small><small
                                                                                data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="outsource_employee_count"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for=""
                                                                            class="col-lg-5">Website:</label>
                                                                        <div class="col-lg-7">
                                                                            <input type="url" class="form-control"
                                                                                placeholder="Website *" value=""
                                                                                name="website" id="website"
                                                                                data-bv-field="website">
                                                                            <small data-bv-validator="uri"
                                                                                data-bv-validator-for="website"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5">
                                                                            Email:</label>
                                                                        <div class="col-lg-7">
                                                                            <input type="email" class="form-control"
                                                                            readonly="readonly"
                                                                                placeholder="Email*" name="email" value="{{(isset($user) && $user->email) ? $user->email : ''}}"
                                                                                id="email" data-bv-field="email">
                                                                            <small data-bv-validator="emailAddress"
                                                                                data-bv-validator-for="email"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin-top: 20px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group" style="padding-left: 0;">
                                                                        <label for="" class="col-lg-6 ">Geo
                                                                            tagging:</label>
                                                                        <div class="col-lg-6"
                                                                            style="padding-left: 0px;">
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="tagging_radio_btn"
                                                                                    id="tagging_radio_btn1" value="yes">YES
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="tagging_radio_btn"
                                                                                    id="tagging_radio_btn" value="no"
                                                                                    checked=""> NO
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-4" id="HidgeoTag"
                                                                    style="display: none;">
                                                                    <!-- <div class="form-group" style="padding-left: 0;">
                                                                                <label for="" class="col-lg-5">Geo Coordinates:</label>
                                                                                <div class="col-lg-7">
                                                                                    <input type="text" class="form-control" id="txtlongitude" name="txtlongitude" placeholder="longitude*">
                                                                                    </input>
                                                                                    <input type="text" class="form-control" id="txtlatitude" name="txtlatitude" placeholder="latitude *" style="margin-top: 5px;">
                                                                                    </input>
                                                                                </div>
                                                                            </div> -->
                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-6 "> Having
                                                                            Swimming Pool:</label>
                                                                        <div class="col-lg-6"
                                                                            style="padding-left: 0px;">
                                                                            <label class="radio-inline">
                                                                                <input type="radio"
                                                                                    name="swimming_radio_btn"
                                                                                    id="swimming_radio_btn" value="yes">YES
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio"
                                                                                    name="swimming_radio_btn"
                                                                                    id="swimming_radio_btn" value="no"
                                                                                    checked=""> NO
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin-top: 20px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for=""
                                                                            class="col-lg-6 ">Aggregator:</label>
                                                                        <div class="col-lg-6"
                                                                            style="padding-left: 0px;">

                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="aggr_radio_btn"
                                                                                    id="aggr_radio_btn1" value="yes">YES
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="aggr_radio_btn"
                                                                                    id="aggr_radio_btn" value="no"
                                                                                    checked=""> NO
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin-top: 20px;"
                                                            id="hidagr_div">
                                                            <div class="row">
                                                                <div class="col-lg-4" id="hidagr_regno_div"
                                                                    style="display: none;">
                                                                    <!-- <div class="form-group">
                                                                                <label for="" class="col-lg-5">Aggregator Registration Number:</label>
                                                                                <div class="col-lg-7">
                                                                                    <input type="text" class="form-control" placeholder="Registration number" name="agr_regno" id="agr_regno" required />
                                                                                </div>
                                                                            </div> -->
                                                                </div>
                                                                <div class="col-lg-4" id="hidagr_name_div"
                                                                    style="display: none;">
                                                                    <!-- <div class="form-group">
                                                                                <label for="" class="col-lg-5">Name of Aggregator:</label>
                                                                                <div class="col-lg-7">
                                                                                    <input type="text" class="form-control" placeholder="Aggregator Name" name="agr_name" id="agr_name" required />
                                                                                </div>
                                                                            </div> -->
                                                                </div>
                                                                <div class="col-lg-4" id="hidagr_nostaff_div"
                                                                    style="display: none;">
                                                                    <!-- <div class="form-group">
                                                                                <label for="" class="col-lg-5">Number of Staff:</label>
                                                                                <div class="col-lg-7">
                                                                                    <input type="text" class="form-control" placeholder="Number of Staff" name="no_of_staf" id="no_of_staf" required />
                                                                                </div>
                                                                            </div> -->
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin-top: 20px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for=""
                                                                            class="col-lg-6 ">Security:</label>
                                                                        <div class="col-lg-6"
                                                                            style="padding-left: 0px;">
                                                                            <label class="radio-inline">
                                                                                <input type="radio"
                                                                                    name="security_radio_btn"
                                                                                    id="security_radio_btn1" value="yes"
                                                                                    checked="">Direct
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio"
                                                                                    name="security_radio_btn"
                                                                                    id="security_radio_btn"
                                                                                    value="out_source"> Out Source
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4" id="hidsec_regno_div"
                                                                    style="display: none;">
                                                                    <!-- <div class="form-group">
                                                                                <label for="" class="col-lg-5">Security Registration Number :</label>
                                                                                <div class="col-lg-7">
                                                                                    <input type="text" class="form-control" placeholder="Registration Number *" name="security_reg_no" id="security_reg_no" required />
                                                                                </div>
                                                                            </div> -->
                                                                </div>
                                                                <div class="col-lg-4" id="hidsec_name_div"
                                                                    style="display: none;">
                                                                    <!-- <div class="form-group">
                                                                                <label for="" class="col-lg-5">Name of Security Firm:</label>
                                                                                <div class="col-lg-7">
                                                                                    <input type="text" class="form-control" placeholder="Security Firm Name" name="security_name" id="security_name" required />
                                                                                </div>
                                                                            </div> -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin-top: 20px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-6 ">Banquet
                                                                            Hall:
                                                                        </label>
                                                                        <div class="col-lg-6"
                                                                            style="padding-left: 0px;">

                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="banquet_radio_btn"
                                                                                    id="banquet_radio_btn1" value="yes">YES
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="banquet_radio_btn"
                                                                                    id="banquet_radio_btn" value="no"
                                                                                    checked=""> NO
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group" id="banquet_yes_div">
                                                                        <!--<label for="" class="col-lg-6 " >
                                                                               </label>
                                                                               <div class="col-lg-6" style="padding-left: 0px;" id="banquet_yes_div">
                                                                                   
                                                                               </div>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>




                                                        <!--**************START OF WHETHER CANDIDATE BELONGS TO NORTH EAST REGION ?*********-->

                                                    </fieldset>
                                                </div>

                                                <!--***********START OF Resturant & Bar details SECTION************-->
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 "
                                                    style="padding: 0px; margin-top: 30px;">
                                                    <fieldset class="">
                                                        <legend>Restaurant &amp; Bar Details</legend>
                                                        <div class="row" style="margin-top: 10px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-5">Number Of
                                                                            Restaurant:</label>
                                                                        <div class="col-lg-7">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Number Of Restaurant *"
                                                                                value="" name="no_of_restaurant"
                                                                                id="no_of_restaurant" required=""
                                                                                data-bv-field="no_of_restaurant">
                                                                            <small data-bv-validator="notEmpty"
                                                                                data-bv-validator-for="no_of_restaurant"
                                                                                class="help-block"
                                                                                style="display: none;">This value is not
                                                                                valid</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--<div class="col-lg-4">
                                                                           <div class="form-group">
                                                                               <label for="" class="col-lg-5" >Website:</label>
                                                                               <div class="col-lg-7">
                                                                                   <input type="url" class="form-control" placeholder="Website *" value="" name="website" id="website" required/>
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                       <div class="col-lg-4">
                                                                           <div class="form-group">
                                                                               <label for="" class="col-lg-5" > Email:</label>
                                                                               <div class="col-lg-7">
                                                                                   <input type="email" class="form-control" placeholder="Email*" value="" name="email" id="email" required/>
                                                                               </div>
                                                                           </div>
                                                                       </div>-->
                                                            </div>
                                                            <!--************ROW END***************-->

                                                            <!--********PLOT AND LOCALITY***********-->
                                                            <div class="row" style="margin-top: 20px;">
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label for="" class="col-lg-6 ">Leased
                                                                                    Room:</label>
                                                                                <div class="col-lg-6"
                                                                                    style="padding-left: 0px;">

                                                                                    <label class="radio-inline">
                                                                                        <input type="radio"
                                                                                            name="leased_radio_btn"
                                                                                            id="leased_radio_btn1"
                                                                                            value="yes">YES
                                                                                    </label>
                                                                                    <label class="radio-inline">
                                                                                        <input type="radio"
                                                                                            name="leased_radio_btn"
                                                                                            id="leased_radio_btn" value="no"
                                                                                            checked=""> NO
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="form-group"
                                                                                id="leased_yes_div">

                                                                            </div>
                                                                        </div>
                                                                        <!--<div class="col-lg-4">
                                                                                   <div class="form-group" >
                                                                                       <label for="" class="col-lg-6 " >Dancer Bar:</label>
                                                                                       <div class="col-lg-6" style="padding-left: 0px;">
                                                                                           
                                                                                           <label class="radio-inline">
                                                                                               <input type="radio" name="dance_bar_radio_btn" id="dance_bar_radio_btn1" value="yes">YES
                                                                                           </label>
                                                                                           <label class="radio-inline">
                                                                                               <input type="radio"  name="dance_bar_radio_btn" id="dance_bar_radio_btn" value="no" checked> NO
                                                                                           </label>
                                                                                       </div>
                                                                                   </div>
                                                                               </div>-->
                                                                        <!-- <div class="col-lg-4">
                                                                                   <div class="form-group" >
                                                                                       <label for="" class="col-lg-6 " >Having Bar:</label>
                                                                                       <div class="col-lg-6" style="padding-left: 0px;">
                                                                                       <label class="radio-inline">
                                                                                               <input type="radio" name="bar_radio_btn" id="bar_radio_btn" value="yes">YES
                                                                                           </label>
                                                                                           <label class="radio-inline">
                                                                                               <input type="radio"  name="bar_radio_btn" id="bar_radio_btn" value="no" checked> NO
                                                                                           </label>
                                                                                           
                                                                                       </div>
                                                                                   </div>
                                                                               </div>
                                                                               <div class="col-lg-4">
                                                                                   <div class="form-group" >
                                                                                       <label for="" class="col-lg-6 " >Pub:</label>
                                                                                       <div class="col-lg-6" style="padding-left: 0px;">
                                                                                           
                                                                                           <label class="radio-inline">
                                                                                               <input type="radio" name="pub_radio_btn" id="pub_radio_btn1" value="yes">YES
                                                                                           </label>
                                                                                           <label class="radio-inline">
                                                                                               <input type="radio"  name="pub_radio_btn" id="pub_radio_btn" value="no" checked> NO
                                                                                           </label>
                                                                                       </div>
                                                                                   </div>
                                                                               </div> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="margin-top: 20px;">
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label for="" class="col-lg-6 ">Having
                                                                                    Bar:</label>
                                                                                <div class="col-lg-6"
                                                                                    style="padding-left: 0px;">
                                                                                    <label class="radio-inline">
                                                                                        <input type="radio"
                                                                                            name="bar_radio_btn"
                                                                                            id="bar_radio_btn"
                                                                                            value="yes">YES
                                                                                    </label>
                                                                                    <label class="radio-inline">
                                                                                        <input type="radio"
                                                                                            name="bar_radio_btn"
                                                                                            id="bar_radio_btn" value="no"
                                                                                            checked=""> NO
                                                                                    </label>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="form-group">
                                                                                <label for=""
                                                                                    class="col-lg-6 ">Pub:</label>
                                                                                <div class="col-lg-6"
                                                                                    style="padding-left: 0px;">

                                                                                    <label class="radio-inline">
                                                                                        <input type="radio"
                                                                                            name="pub_radio_btn"
                                                                                            id="pub_radio_btn1"
                                                                                            value="yes">YES
                                                                                    </label>
                                                                                    <label class="radio-inline">
                                                                                        <input type="radio"
                                                                                            name="pub_radio_btn"
                                                                                            id="pub_radio_btn" value="no"
                                                                                            checked=""> NO
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- <div class="col-lg-4">
                                                                                   <div class="form-group" id="leased_yes_div">
                                                                                       
                                                                                   </div>
                                                                               </div> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <!--***********END OF PRESENT ADDRESS SECTION************-->

                                                <!--***********START OF Security Measures SECTION************-->
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 "
                                                    style="padding: 0px; margin-top: 20px;">
                                                    <fieldset class="">
                                                        <legend>Security Measures</legend>
                                                        <div class="row" style="margin-top: 20px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-6 ">Bagage
                                                                            Scanner available:</label>
                                                                        <div class="col-lg-6"
                                                                            style="padding-left: 0px;">
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="bagage_radio_btn"
                                                                                    id="bagage_radio_btn1" value="yes">YES
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="bagage_radio_btn"
                                                                                    id="bagage_radio_btn" value="no"
                                                                                    checked=""> NO
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-6 ">Metal
                                                                            Detector:</label>
                                                                        <div class="col-lg-6"
                                                                            style="padding-left: 0px;">
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="metal_radio_btn"
                                                                                    id="metal_radio_btn1" value="yes">YES
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="metal_radio_btn"
                                                                                    id="metal_radio_btn" value="no"
                                                                                    checked=""> NO
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 20px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-6 ">Fire &amp;
                                                                            Smoke detection:</label>
                                                                        <div class="col-lg-6"
                                                                            style="padding-left: 0px;">
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="fire_radio_btn"
                                                                                    id="fire_radio_btn1" value="yes">YES
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="fire_radio_btn"
                                                                                    id="fire_radio_btn" value="no"
                                                                                    checked=""> NO
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group" id="fire_yes_div">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top: 20px;">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="" class="col-lg-6 ">CCTV
                                                                            available:</label>
                                                                        <div class="col-lg-6"
                                                                            style="padding-left: 0px;">
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="cctv_radio_btn"
                                                                                    id="cctv_radio_btn1" value="yes">YES
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" name="cctv_radio_btn"
                                                                                    id="cctv_radio_btn" value="no"
                                                                                    checked=""> NO
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group" id="cctv_yes_div">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset> <br>
                                                    <button type="submit" class="btnSubmit"
                                                        id="submit_btn">Submit</button>
                                                    <!--<button type="submit" class="COL-XS-12 COL-SM-12 COL-MD-12 COL-LG-12 COL-XL-12 BTN BTN-WARNING BTNNEXT1" id="submit_btn">Submit</button>-->
                                                    <br>
                                                </div>
                                                <!--***********END OF PRESENT ADDRESS SECTION************-->
                                            </div>
                                            <input type="hidden" value="">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hidden-sm hidden-xs col-lg-1 col-md-1 col-xl-1 " style="padding-top:0px;"></div>
        </div>
    </div>
@endsection

@section('js')
    <!-- <button onclick="download_pdf()">pdfkjnn</button> -->
    <script>
        window.onload = function() {
            document.getElementById("hotel_registration_form").reset();
        };
    </script>
    <script>
        $(document).ready(function($) {
            $('#cmbcountry').on('change', function() {
                var countryId = this.value;
                if(countryId == 165)
                {
                    $('.otherDisplay').show();
                    $('.otherHide').hide();
                } else {
                    
                    $('.otherDisplay').hide();
                    $('.otherHide').show();
                    $('.otherDisplay').find('input').val('');

                    $('#cmbstate').html('');
                    $.ajax({
                        url: "{{ route('getStates') }}?country_id=" + countryId,
                        type: 'get',
                        success: function(res) {
                            $('#cmbstate').html('<option value="">Select State</option>');
                            $.each(res, function(key, value) {
                                $('#cmbstate').append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                            $('#cmbcity').html('<option value="">Select City</option>');
                        }
                    });
                }
            });
            $('#cmbstate').on('change', function() {
                var stateId = this.value;
                $('#cmbcity').html('');
                $.ajax({
                    url: "{{ route('getCities') }}?state_id=" + stateId,
                    type: 'get',
                    success: function(res) {
                        $('#cmbcity').html('<option value="">Select City</option>');
                        $.each(res, function(key, value) {
                            $('#cmbcity').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
            $('#cmbcity').change(function() {
                if ($("#cmbcity").val() == '' && $("#cmbcity").val() == null && $("#cmbcity").val() ==
                    'default') {
                    $("#HidPS").hide();
                } else {
                    $("#HidPS").show(500);
                    var city = $("#cmbcity").val();
                    $.ajax({
                        url: "{{ route('get-police-station') }}",
                        mType: "get",
                        data: {
                            type: "GET_PS",
                            city
                        },
                        success: function(response) {
                            var options = "";
                            var res1 = response;//JSON.parse(response);
                            var defaultoption =
                                "<option selected value=''>Select Police Station</option>";
                            $.each(res1.aaData, function(i, data) {
                                options = options + "<option value='" + data.code +
                                    "'>" + data.desc + "</option>";
                            });

                            $('#police_station').html("");
                            $('#police_station').append(defaultoption);
                            $('#police_station').append(options);

                        },
                        error: function() {
                            toastr.error("Unable to process please contact support");
                        },
                    });
                }


            });

            $('input[type=radio][name=tagging_radio_btn]').change(function() {
                if (this.value == 'yes') {
                    $("#HidgeoTag").append(
                        '<div class="form-group" style="padding-left: 0;" ><label for="" class="col-lg-5" >Geo Coordinates:</label><div class="col-lg-7"><input type="text"class="form-control"  id="txtlongitude" name="txtlongitude" placeholder="longitude*" required/><input type="text"class="form-control" id="txtlatitude" name="txtlatitude" placeholder="latitude *" style="margin-top: 5px;" required/></div></div>'
                        );
                    $("#txtlongitude").prop('required', true);
                    $("#txtlatitude").prop('required', true);

                    $("#HidgeoTag").show(500);
                    $("#HidgeoTag").attr('style', 'padding-left: 15;');
                } else if (this.value == 'no') {
                    $("#HidgeoTag").html('');
                    $("#HidgeoTag").hide(500);
                }
            });

            $('input[type=radio][name=aggr_radio_btn]').change(function() {
                if (this.value == 'yes') {
                    $("#hidagr_div").show(500);
                    $("#hidagr_regno_div").append(
                        '<div class="form-group" ><label for="" class="col-lg-5" >Aggregator Registration Number:</label><div class="col-lg-7"><input type="text" class="form-control" placeholder="Registration number"  name="agr_regno" id="agr_regno" required/></div></div> '
                        );
                    $("#hidagr_name_div").append(
                        '<div class="form-group" ><label for="" class="col-lg-5" >Name of Aggregator:</label><div class="col-lg-7" ><input type="text" class="form-control" placeholder="Aggregator Name"  name="agr_name" id="agr_name"  required/></div></div> '
                        );
                    $("#hidagr_nostaff_div").append(
                        '<div class="form-group" ><label for="" class="col-lg-5" >Number of Staff:</label><div class="col-lg-7" ><input type="text" class="form-control" placeholder="Number of Staff"  name="no_of_staf" id="no_of_staf"  required/></div></div> '
                        );

                    $("#hidagr_regno_div").show(500);
                    $("#hidagr_name_div").show(500);
                    $("#hidagr_nostaff_div").show(500);

                } else if (this.value == 'no') {
                    $("#hidagr_div").hide(500);
                    $("#hidagr_regno_div").html('');
                    $("#hidagr_name_div").html('');
                    $("#hidagr_nostaff_div").html('');
                    $("#hidagr_regno_div").hide(500);
                    $("#hidagr_name_div").hide(500);
                    $("#hidagr_nostaff_div").hide(500);
                }
            });

            // $('input[type=radio][name=category_radio_btn]').change(function() {
            //     if (this.value == 'staf') {
            //         $("#no_os_staf_div").append('<input type="text" class="form-control" placeholder="No of Staf*" id="no_of_staf" name="no_of_staf" />');
            //     }
            //      else{
            //           $("#no_os_staf_div").html('');
            //      }
            // });
            $('input[type=radio][name=security_radio_btn]').change(function() {
                if (this.value == 'out_source') {
                    $("#hidsec_regno_div").append(
                        '<div class="form-group" ><label for="" class="col-lg-5" >Security Registration Number :</label><div class="col-lg-7"><input type="text" class="form-control" placeholder="Registration Number *" name="security_reg_no" id="security_reg_no" required/></div></div>'
                        );
                    $("#hidsec_name_div").append(
                        '<div class="form-group" ><label for="" class="col-lg-5" >Name of Security Firm:</label><div class="col-lg-7" ><input type="text" class="form-control" placeholder="Security Firm Name" name="security_name" id="security_name"  required/></div></div>'
                        );

                    $("#hidsec_regno_div").show(500);
                    $("#hidsec_name_div").show(500);
                } else {
                    $("#hidsec_regno_div").html('');
                    $("#hidsec_name_div").html('');
                    $("#hidsec_regno_div").hide(500);
                    $("#hidsec_name_div").hide(500);
                }
            });

            $('input[type=radio][name=banquet_radio_btn]').change(function() {
                if (this.value == 'yes') {
                    $("#banquet_yes_div").append(
                        '<label for="" class="col-lg-5" >Number of Banquet Hall :</label><div class="col-lg-7"><input type="text" class="form-control" placeholder="Number of Banquet Hall *"  name="no_of_banquet" id="no_of_banquet" required/></div>'
                        );
                    //$("#banquet_yes_div").append('<input type="text" class="form-control" placeholder="No of Banquet Hall  *" id="no_of_banquet" name="no_of_banquet" />');
                } else {
                    $("#banquet_yes_div").html('');
                }
            });

            $('input[type=radio][name=leased_radio_btn]').change(function() {
                if (this.value == 'yes') {
                    $("#leased_yes_div").append(
                        '<label for="" class="col-lg-5" >Leased Room Count :</label><div class="col-lg-7"><input type="text" class="form-control" placeholder="Leased Room Count *"  name="no_of_leased_room" id="no_of_leased_room" required/></div>'
                        );
                    // $("#leased_yes_div").append('<input type="text" class="form-control" placeholder="Leased Room Count  *" id="no_of_leased_room" name="no_of_leased_room" />');
                } else {
                    $("#leased_yes_div").html('');
                }
            });

            $('input[type=radio][name=cctv_radio_btn]').change(function() {
                if (this.value == 'yes') {
                    $("#cctv_yes_div").html(
                        '<label for="" class="col-lg-5" >Number of Camera:</label><div class="col-lg-7"><input type="text" class="form-control" placeholder="Number of Camera"  name="no_of_camera" id="no_of_camera" required/></div><label for="" class="col-lg-5" >Camera Towards Outside:</label><div class="col-lg-7" ><input type="text" class="form-control" placeholder="Camera towards outside"  name="no_of_camera_outside" id="no_of_camera_outside" style="margin-top:8px;" required/></div></br>'
                        );
                    //$("#cctv_yes_div").append('<input type="text" class="form-control" placeholder="No of Camera  *" id="no_of_camera" name="no_of_camera" /><input type="text" class="form-control" placeholder="Camera towords outside*" id="no_of_camera_outside" name="no_of_camera_outside" />');
                } else {
                    $("#cctv_yes_div").html('');
                }
            });

            $('input[type=radio][name=fire_radio_btn]').change(function() {
                if (this.value == 'yes') {
                    $("#fire_yes_div").append(
                        '<label for="" class="col-lg-5" >Fire License Number:</label><div class="col-lg-7"><input type="text" class="form-control" placeholder="Fire License Number *"  name="fire_license_no" id="fire_license_no" required/></div>'
                        );
                    //  $("#fire_yes_div").append('<input type="text" class="form-control" placeholder="Fire License No *" id="fire_license_no" name="fire_license_no" />');
                } else {
                    $("#fire_yes_div").html('');
                }
            });
        });
    </script>
@endsection
