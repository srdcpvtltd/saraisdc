@extends('layouts.admin')
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('users.index') }}">{{ __('User') }}</a><span
        class="breadcrumb-item active">{{ __('Create') }}</span>
@endsection
@section('title')
    {{ __('Create User') }}
@endsection
@section('content')

    {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New User') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ __('Name:') }}
                    {!! Form::text('name', null, ['placeholder' => __('Hotel Name'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {{ __('Email:') }}
                    {!! Form::text('email', null, ['placeholder' => __('Email'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {{ __('Password:') }}
                    {!! Form::password('password', ['placeholder' => __('Password'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {{ __('Confirm Password:') }}
                    {!! Form::password('confirm-password', ['placeholder' => __('Confirm Password'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group ">
                    {{ __('Role:') }}
                    {!! Form::select('roles', $roles, null, ['class' => 'form-control']) !!}
                </div>
                <div>
                    {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary ']) }}

                    <a class="btn btn-secondary" href="{{ route('users.index') }}"> {{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
