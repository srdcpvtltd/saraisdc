@extends('layouts.admin')
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><span
        class="breadcrumb-item active">{{ __('Settings') }}</span>

@endsection
@section('title')
    {{ __('Settings') }}
@endsection
@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-warning p-3 mr-3">
                                <svg class="c-icon c-icon-xl">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                </svg>
                            </div>
                            <div>
                                <div class="text-value text-warning">{{ __('LOGO SETTINGS') }}</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2"><a
                                class="btn-block text-muted d-flex justify-content-between align-items-center"
                                href="{{ route('getlogo') }}"><span
                                    class="small font-weight-bold">{{ __('View Settings') }}</span>
                                <svg class="c-icon">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-chevron-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-primary p-3 mr-3">
                                <svg class="c-icon c-icon-xl">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
                                </svg>
                            </div>
                            <div>
                                <div class="text-value text-primary">{{ __('EMAIL SETTINGS') }}</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2"><a
                                class="btn-block text-muted d-flex justify-content-between align-items-center"
                                href="{{ route('settings.getmail') }}"><span
                                    class="small font-weight-bold">{{ __('View Settings') }}</span>
                                <svg class="c-icon">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-chevron-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4">
                    <div class="card">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-info p-3 mr-3">
                                <svg class="c-icon c-icon-xl">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-clock"></use>
                                </svg>
                            </div>
                            <div>
                                <div class="text-value text-info">{{ __('GENERAL SETTINGS') }}</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2"><a href="{{ route('datetime') }}"
                                class="btn-block text-muted d-flex justify-content-between align-items-center"><span
                                    class="small font-weight-bold">{{ __('View Settings') }}</span>
                                <svg class="c-icon">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-chevron-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
@endsection
