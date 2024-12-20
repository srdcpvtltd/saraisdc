@extends('layouts.admin')
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('index') }}">{{ __('Languages') }}</a><span
        class="breadcrumb-item active">{{ __('Create') }}</span>

@endsection
@section('content')
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create Language Code') }} </div>
            <div class="card-body">
                {{ Form::open(['route' => ['store.language']]) }}
                <div class="row">
                    <div class="form-group col-md-12">
                        {{ Form::label('code', __('Language Code')) }}
                        {{ Form::text('code', '', ['class' => 'form-control', 'required' => 'required']) }}
                        @error('code')
                            <span class="invalid-code" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}
                    <a class="btn btn-secondary" href="{{ route('index') }}"> {{ __('Back') }}</a>
                </div>
                {{ Form::close() }}
            </div>
        @endsection
