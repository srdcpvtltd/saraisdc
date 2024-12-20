@extends('layouts.admin')
@section('title')
    {{ __('Edit Module') }}
@endsection
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('modules.index') }}">{{ __('Module') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>

@endsection
@section('content')

    {!! Form::model($modual, ['method' => 'PATCH', 'route' => ['modules.update', $modual->id]]) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Edit Module') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}
                    {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                    {!! Form::hidden('old_name', $modual->name, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
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
