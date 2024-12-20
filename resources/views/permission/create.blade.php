@extends('layouts.admin')
@section('title')
    {{ __(' Create Permission') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('permission.index') }}">{{ __('Permission') }}</a><span
        class="breadcrumb-item active">{{ __('Create') }}</span>

@endsection
@section('content')
    {{ Form::open(['url' => 'permission', 'method' => 'post']) }}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __(' Create New Permission') }}
                </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Permission Name')]) }}
                    @error('name')
                        <span class="invalid-name" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    @if (!$roles->isEmpty())
                        {{ __('Assign Permission to Roles') }}
                        @foreach ($roles as $role)
                            <div class="custom-control custom-checkbox">
                                {{ Form::checkbox('roles[]', $role->id, false, ['class' => 'custom-control-input', 'id' => 'role' . $role->id]) }}
                                {{ Form::label('role' . $role->id, __(ucfirst($role->name)), ['class' => 'custom-control-label ']) }}
                            </div>
                        @endforeach
                    @endif
                    @error('roles')
                        <span class="invalid-roles" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{Form::submit( __('Submit'),['class' => 'btn btn-primary'])}}
                <a class="btn btn-secondary" href="{{ route('permission.index') }}"> {{ __('Back') }}</a>
            </div>
            <div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection
