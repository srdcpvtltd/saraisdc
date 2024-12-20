@extends('frontend.layouts.app')

@section('title')
{{ __('Login') }}
@endsection

@php
$logo = asset(Storage::url('uploads/logo/'));
@endphp
@section('content')
    <div class="main-box">
        <img class="banner-bg" src="{{ asset('images/bannerbg.jpeg') }}">
        <div class="banner-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-12 col-md-12">
                        <div class="login-form-box-main">
                            <div class="login-form-box-left">
                                <div class="logo-box">
                                    <a href="#"><img src="{{ asset('images/log.png') }}"></a>
                                    <h1>
                                        <span>Police Commissionerate</span>
                                        <span>Cuttack-Bhubaneswar</span>
                                        <span>S A R A I</span>
                                        (Hotel Visitors Management System)
                                    </h1>
                                </div>
                                <p>Visitor management system helps to track over the people who visit to a particular hotel for various purposes. This can give the complete details of the visitors who check in and thus providing an easy monitoring for different activities done by the police.</p>
                            </div>
                            <div class="login-form-box">
                                  <span class="ico-box"><i class="fa fa-user-o" aria-hidden="true"></i>  <h6>Login</h6></span>
                                  {!! Form::open(['route' => 'login', 'method' => 'POST','class'=>'login-form', 'id'=>'loginform']) !!}
                                                    @csrf
                                                    
                                                    @if(session()->has('loginError'))
                                                    <div class="alert alert-danger">
                                                        {{ session()->get('loginError') }}
                                                    </div>
                                                    @endif
                                                    <div class="form-group">
                                                        {{-- Form::label('email', __('Email Id')) --}}
                                                        {!! Form::text('email', null, ['placeholder' => __('Email'), 'class' => 'form-control', 'required']) !!}
                        
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        {{-- Form::label('Password', __('Password')) --}}
                                                        {!! Form::password('password', ['placeholder' => __('Password'), 'type' => '', 'class' => 'form-control', 'required']) !!}
                        
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group forgot_password">
                                                        <a href="{{ route('password.request') }}">Forgot Password ?</a>
                                                    </div>
                                                    <div class="form-check" align="center">
                                                        <button type="submit" class="btn btn-login float-right">{{__('Login')}}</button>
                                                    </div>
                                                    {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('javascript')

@endsection
