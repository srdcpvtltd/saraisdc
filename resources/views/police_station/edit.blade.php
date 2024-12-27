@extends('layouts.admin')
@section('title')
    {{ __('Edit Police Station') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('policestation.index') }}">{{ __('Police Station') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>
@endsection
@section('content')
    {!! Form::model($policestation, ['method' => 'PATCH', 'route' => ['policestation.update', $policestation->id]]) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit Police Station') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Police Station')) }}
                    {!! Form::text('name', $policestation->code ?? null, ['placeholder' => __('Enter Police Station'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <select class="form-select form-select-lg form-control select2" name="country_id" id="country_id">
                        <option value="" selected>Select country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @if ($selected_country_id == $country->id) selected @endif>
                                {{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <select name="state_id" class="form-select form-select-lg form-control select2" id="state">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" @if ($selected_state_id == $state->id) selected @endif>
                                {{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <select name="city_id" class="form-select form-select-lg form-control select2" id="city">
                        <option value="">Select City</option>
                        @foreach ($citty as $cities)
                            <option value="{{ $cities->id }}" @if ($policestation->city_id == $cities->id) selected @endif>
                                {{ $cities->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}

                <a class="btn btn-secondary" href="{{ route('policestation.index') }}"> {{ __('Back') }}</a>
            </div>
            <div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#country_id').on('change', function() {
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
