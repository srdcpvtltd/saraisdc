@extends('layouts.admin')
@section('title')
    {{ __('Create notificationsettings') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('notificationsettings.index') }}">{{ __('notificationsettings') }}</a><span
        class="breadcrumb-item active">{{ __('Create') }}</span>

@endsection
@section('content')

    {!! Form::open(['route' => 'notificationsettings.store', 'method' => 'POST']) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New Notification') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}
                    {!! Form::text('name', null, ['placeholder' => __('Name'),  'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <select  class="form-select form-select-lg form-control" name="country" id="country">
                        <option value="" selected>Select country</option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @if(isset($inputs) && isset($inputs['country']) && $inputs['country'] == $country->id) selected @endif>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <select  name="state" class="form-select form-select-lg form-control" id="state">
                        <option value="">Select State</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <select  name="city" class="form-select form-select-lg form-control" id="city">
                        <option value="">Select City</option>
                    </select>
                </div>
                <div class="form-group">
                    {{ Form::label('age_from', __('Age from')) }}
                    {!! Form::text('age_from', null, ['placeholder' => __('Age From'),  'class' => 'form-control']) !!}
                </div>
               <div class="form-group">
                    {{ Form::label('age_to', __('Age To')) }}
                    {!! Form::text('age_to', null, ['placeholder' => __('Age To'),  'class' => 'form-control']) !!}
                </div>
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}

                <a class="btn btn-secondary" href="{{ route('notificationsettings.index') }}"> {{ __('Back') }}</a>
            </div>
            <div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#country').on('change', function() {
            var countryId = this.value;
            $('#state').html('');
            $.ajax({
                url: "{{ route('getStates') }}?country_id=" + countryId,
                type: 'get',
                success: function(res) {
                    $('#state').html('<option value="">Select State</option>');
                    $.each(res, function(key, value) {
                        $('#state').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city').html('<option value="">Select City</option>');
                }
            });
        });
        $('#state').on('change', function() {
            var stateId = this.value;
            $('#city').html('');
            $.ajax({
                url: "{{ route('getCities') }}?state_id=" + stateId,
                type: 'get',
                success: function(res) {
                    $('#city').html('<option value="">Select City</option>');
                    $.each(res, function(key, value) {
                        $('#city').append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
</script>
@endsection
