@extends('layouts.admin')
@section('title')
    {{ __('Create Police station') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('cities.index') }}">{{ __('Police Station') }}</a><span
        class="breadcrumb-item active">{{ __('Create') }}</span>

@endsection
@section('content')

    {!! Form::open(['route' => 'policestation.store', 'method' => 'POST']) !!}
    @csrf
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Create New Police Station') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Police Station')) }}
                    {!! Form::text('name', null, ['placeholder' => __('Enter Police Station'),  'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <select  class="form-select form-select-lg form-control select2" name="country_id" id="country">
                        <option value="" selected>Select country</option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <select  name="state_id" class="form-select form-select-lg form-control select2" id="state">
                        <option value="">Select State</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <select  name="city_id" class="form-select form-select-lg form-control select2" id="city">
                        <option value="">Select City</option>
                    </select>
                </div>
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}

                <a class="btn btn-secondary" href="{{ route('cities.index') }}"> {{ __('Back') }}</a>
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
