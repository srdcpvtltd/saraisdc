<div class="col-md-4 m-auto">
    <div class="card">
        <div class="card-header">{{ __('Two Factor Authentication') }}</div>
        <div class="card-body">



            @if ($data['user']->loginSecurity == null)
                {!! Form::open(['route' => 'generate2faSecret', 'method' => 'POST']) !!}

                {{ csrf_field() }}
                <div class="form-group">

                    {{ Form::submit(__('Generate Secret Key to Enable 2FA'), ['class' => 'btn btn-primary ']) }}

                </div>
                {!! Form::close() !!}

            @elseif(!$data['user']->loginSecurity->google2fa_enable)
                {{ __('1. Scan this QR code with your Google Authenticator App. Alternatively, you can use the code:') }}
                <code>{{ $data['secret'] }}</code><br />
                <div class="form-group chktxt">
                    <img src="{{ $data['google2fa_url'] }}" alt="">
                    <br /><br />
                </div>
                {{ __('2. Enter the pin from Google Authenticator app:') }}<br /><br />
                {!! Form::open(['route' => 'enable2fa', 'method' => 'POST']) !!}

                {{ csrf_field() }}
                <div class="form-group">

                    {{ Form::label('secret', __('Authenticator Code'), ['class' => 'control-label']) }}
                    {{ Form::password('secret', ['class' => 'form-control', 'required']) }}
                </div>

                {{ Form::submit(__('Enable 2FA'), ['class' => 'btn btn-primary ']) }}

                {!! Form::close() !!}

            @elseif($data['user']->loginSecurity->google2fa_enable)
                <div class="alert alert-success">
                    {{ __('2FA is currently') }} <strong>{{ __('enabled') }}</strong>
                    {{ __('on your account.') }}
                </div>

                {!! Form::open(['route' => 'disable2fa', 'method' => 'POST']) !!}

                {{ csrf_field() }}
                <div class="form-group">

                    {{ Form::label('current-password', __('Current Password'), ['class' => 'control-label']) }}
                    {{ Form::password('current-password', ['class' => 'form-control', 'required']) }}

                </div>
                {{ Form::submit(__('Disable 2FA'), ['class' => 'btn btn-primary ']) }}

                {!! Form::close() !!}

            @endif
        </div>
    </div>
</div>
