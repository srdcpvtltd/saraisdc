@extends('layouts.auth')

@section('title')
{{ __('Reset Password') }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ Form::open(['route' => 'password.email', 'method' => 'post']) }}

                        <div class="form-group">
                            {{ Form::label('email', __('E-Mail Address'), ['class' => ' col-form-label']) }}
                            {{ Form::text('email', null, ['class' => 'form-control']) }}
                            @error('email')
                                <span class="invalid-email text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>

                            {{ Form::submit(__('Send Password Reset Link'), ['class' => 'btn btn-primary ']) }}

                        </div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
