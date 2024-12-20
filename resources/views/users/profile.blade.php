@extends('layouts.admin')
@section('title')
    {{ __('Profile') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><span
        class="breadcrumb-item active">{{ __('Profile') }}</span>
@endsection
@php
use App\Facades\UtilityFacades;
$profile = asset(Storage::url('uploads/avatar/'));
$setting = UtilityFacades::settings();
@endphp
@section('content')
    {{ Form::model($userDetail, ['route' => ['update.profile'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit Profile') }} </div>
            <div class="card-body">
                <div class="form-group chktxt" >
                    <img alt="" style="height:150px;"
                        src="{{ !empty($userDetail->avatar) ? $profile . '/' . $userDetail->avatar : $profile . '/avatar.jpg' }}"
                        class="c-avatar-img">
                </div>
                <div class="form-group">
                     {{ Form::label('name', __('Name'), ['class' => 'form-control-label']) }}
                    {{ Form::text('name', null, ['class' => 'form-control font-style', 'placeholder' => __('Enter User Name')]) }}
                </div>
                <div class="form-group">
                     {{ Form::label('email', __('Email'), ['class' => 'form-control-label']) }}
                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter User Email')]) }}
                </div>
                <div class="form-group">
                    <div class="choose-file">
                        <div for="avatar">
                            <div>{{ __('Choose file here') }}</div>
                            <input type="file" class="form-control" name="profile" data-filename="profiles">
                        </div>
                        <p class="profiles"></p>
                    </div>
                </div>
                <div>
                    {{ Form::submit(__('Update'), ['class' => 'btn btn-primary ']) }}

                    <a class="btn btn-secondary" href="{{ route('home') }}"> {{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    @if (isset($setting['authentication']) && $setting['authentication'] == 'activate')
        @include('auth.2fa_settings')
        @endif
@endsection
