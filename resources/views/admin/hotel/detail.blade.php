@extends('layouts.admin')
@section('title')
    {{ __('Hotel Detail View') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('admin.report') }}">{{ __('Report') }}</a><span
        class="breadcrumb-item active">{{ __('Hotel Detail View') }}</span>
@endsection
<style>
    .detil-item {
        margin-top: 20px;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <section class="content">
                <div class="fade-in guest-register">
                    <div class="card">
                        <div class="fade-in guest-register">
                            <div class="card">
                            <div class="card-header">Hotel Detail</div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 detil-item">
                                            <b>Hotel Name:</b> {{(isset($user) && $user->name) ? $user->name : ''}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Manager Name:</b> {{$hotel->manager_name}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Owner Name:</b> {{$hotel->owner_name}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Manager Mobile  Number:</b> {{ $hotel->manager_mobile }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Owner Mobile Name:</b> {{ $hotel->owner_mobile }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Adress:</b> {{ $hotel->address }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Registration Number:</b> {{$hotel->registration_number}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Home Country:</b> {{ (!empty($hotel->otherCountry)) ? $hotel->otherCountry : $countries->name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Home State:</b> {{ (!empty($hotel->otherState)) ? $hotel->otherState : $state->name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Home City:</b> {{ (!empty($hotel->otherCity)) ? $hotel->otherCity : $city->name }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Police Station:</b> {{ (!empty($hotel->police_station)) ? $hotel->police_station : '' }}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Number Of Floors:</b> {{$hotel->floors}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Number Of Rooms:</b> {{$hotel->rooms}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Direct Employee Count:</b> {{$hotel->direct_employee_count}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Outsource Employee Count:</b> {{$hotel->outsource_employee_count}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Website:</b> {{$hotel->website}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Email:</b> {{(isset($user) && $user->email) ? $user->email : ''}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Geo tagging:</b> {{($hotel->geo_tagging == 1) ? 'Yes' : 'No'}}
                                        </div>

                                        <div class="col-md-4 detil-item">
                                            <b>Having Swimming Pool:</b> {{($hotel->swimming_pool == 1) ? 'Yes' : 'No'}}
                                        </div>

                                        <div class="col-md-4 detil-item">
                                            <b>Aggregator:</b> {{($hotel->aggregator == 1) ? 'Yes' : 'No'}}
                                        </div>

                                        <div class="col-md-4 detil-item">
                                            <b>Security:</b> {{($hotel->security == 1) ? 'Direct' : 'Out Source'}}
                                        </div>

                                        <div class="col-md-4 detil-item">
                                            <b>Banquet Hall:</b> {{($hotel->banquet_hall == 1) ? 'YES' : 'No'}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Number Of Restaurant:</b> {{$hotel->restaurant_count}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Leased Room:</b> {{($hotel->leased_room == 1) ? 'Yes' : 'No'}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Having Bar:</b> {{($hotel->has_bar == 1) ? 'Yes' : 'No'}}
                                        </div>
                                        
                                        <div class="col-md-4 detil-item">
                                            <b>Pub:</b> {{($hotel->has_pub == 1) ? 'Yes' : 'No'}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Bagage Scanner available:</b> {{($hotel->baggage_scanner == 1) ? 'Yes' : 'No'}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Metal Detector:</b> {{($hotel->metal_detector == 1) ? 'Yes' : 'No'}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Fire &amp; Smoke detection:</b> {{($hotel->fire_detector == 1) ? 'Yes' : 'No'}}
                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>CCTV available:</b> {{($hotel->cctv == 1) ? 'Yes' : 'No'}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection