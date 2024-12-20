@extends('layouts.admin')
@section('title')
    {{ __('Edit Roles') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('roles.index') }}">{{ __('Roles') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>
@endsection
@section('content')

    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit Roles') }}
            </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}

                    {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                </div>
                <div>
                    {{ Form::submit(__('Update'), ['class' => 'btn btn-primary']) }}

                    <a class="btn btn-secondary" href="{{ route('roles.index') }}"> {{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
