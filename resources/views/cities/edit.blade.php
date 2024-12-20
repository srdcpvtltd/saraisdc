@extends('layouts.admin')
@section('title')
    {{ __('Edit City') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('cities.index') }}">{{ __('Cities') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>

@endsection
@section('content')
    {!! Form::model($city, ['method' => 'PATCH', 'route' => ['cities.update', $city->id]]) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit City') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}
                    {!! Form::text('name', null, ['placeholder' => __('Name'),  'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <select  class="form-select form-select-lg form-control select2" name="country_id" id="country_id">
                        <option value="" selected>Select country</option>
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @if( $selected_country_id== $country->id) selected @endif>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>State</label>
                    <select  name="state_id" class="form-select form-select-lg form-control select2" id="state">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                        <option value="{{ $state->id }}" @if($selected_state_id == $state->id) selected @endif>{{ $state->name }}</option>
                        @endforeach
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
                url: "{{ route('getCities') }}?country_id=" + countryId,
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
    });
</script>
@endsection
