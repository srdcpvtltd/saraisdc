@extends('layouts.admin')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('users.index') }}">{{ __('User') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>
@endsection
@section('title')
    {{ __('Edit User') }}
@endsection
@section('content')
    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><strong>{{ __('Edit User') }}</strong> </div>
            <div class="card-body">
                <div class="form-group">
                    <strong>{{ __('Name:') }}</strong>
                    {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <strong>{{ __('Email:') }}</strong>
                    {!! Form::text('email', null, ['placeholder' => __('Email'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group ">
                    <strong>{{ __('Role:') }}</strong>
                    {!! Form::select('roles', $roles, $userRole, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group ">
                    <strong>{{ __('Password:') }} <small style="color:red;">Leave it blank if you don't want to change</small></strong>
                    {!! Form::password('password', ['placeholder' => __('Password'), 'type' => '', 'class' => 'form-control']) !!}
                </div>
                <div>
                    {{ Form::submit(__('Update Permission'), ['class' => 'btn btn-primary ']) }}

                    <a class="btn btn-secondary" href="{{ route('users.index') }}"> {{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
