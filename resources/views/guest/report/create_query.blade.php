@extends('layouts.admin')
@section('breadcrumb')
    <span class="breadcrumb-item active">{{ __('Send Query') }}</span>
@endsection
@section('title')
    {{ __('Send Query') }}
@endsection
@section('content')

    {!! Form::open(['route' => 'guest.store.query', 'method' => 'POST']) !!}
    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header">{{ __('Send Query') }} </div>
            <div class="card-body">
                <div class="form-group">
                    {{ __('Subject:') }}
                    {!! Form::text('subject', null, ['placeholder' => __('Subject'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {{ __('Message:') }}
                    {!! Form::textarea('message', null, ['placeholder' => __('Message'), 'class' => 'form-control']) !!}
                </div>

                <div>
                    {{ Form::submit(__('Send'), ['class' => 'btn btn-primary ']) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
