@extends('layouts.admin')
@section('title')
    {{ __('Edit Permission') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('permission.index') }}">{{ __('Permissions') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>
@endsection
@section('content')

    {{ Form::model($permission, ['route' => ['permission.update', $permission->id], 'method' => 'PUT']) }}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><strong>{{ __('Edit Permission') }}
                </strong> </div>
            <div class="card-body">
                <div class="form-group">
                    <strong> {{ Form::label('name', __('Name')) }} </strong>
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Permission Name')]) }}
                    @error('name')
                        <span class="invalid-name" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{ Form::submit(__('Update'), ['class' => 'btn btn-primary']) }}
                <a class="btn btn-secondary" href="{{ route('permission.index') }}"> {{ __('Back') }}</a>
            </div>
            <div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection
