@extends('layouts.admin')
@section('title')
    {{ __('Edit notificationsettings') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('notificationsettings.index') }}">{{ __('notificationsettings') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>

@endsection
@section('content')

    {!! Form::model($modual, ['method' => 'PATCH', 'route' => ['notificationsettings.update', $modual->id]]) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit Notification') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}
                    {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                    {!! Form::hidden('old_name', $modual->name, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <select  class="form-select form-select-lg form-control" name="country" id="country">
                        <option value="" selected>Select country</option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @if($modual->country == $country->id) selected @endif>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <select  name="state" class="form-select form-select-lg form-control" id="state">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->id }}" @if($modual->state == $state->id) selected @endif>{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <select  name="city" class="form-select form-select-lg form-control" id="city">
                        <option value="">Select City</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}" @if($modual->city == $city->id) selected @endif>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{ Form::label('age_from', __('Age from')) }}
                    {!! Form::text('age_from', null, ['placeholder' => __('Age From'),  'class' => 'form-control']) !!}
                    {!! Form::hidden('old_name', $modual->age_from, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                </div>
               <div class="form-group">
                    {{ Form::label('age_to', __('Age To')) }}
                    {!! Form::text('age_to', null, ['placeholder' => __('Age To'),  'class' => 'form-control']) !!}
                    {!! Form::hidden('old_name', $modual->age_to, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                </div>
                {{ Form::submit(__('Update'), ['class' => 'btn btn-primary']) }}

                <a class="btn btn-secondary" href="{{ route('modules.index') }}"> {{ __('Back') }}</a>
            </div>
            <div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
