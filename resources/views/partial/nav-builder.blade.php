@php
$users = \Auth::user();
$currantLang = $users->currentLanguage();
$logo = asset('uploads/logo/');
$checkIsHotelCreated = DB::table('hotel_profiles')->where('user_id', Auth::id())->first();
@endphp
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <img class="c-sidebar-brand-full"
            src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : '/light_logo.png') }}"
             height="46" class="navbar-brand-img">
        <img class="c-sidebar-brand-minimized"
            src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : '/small_logo.png') }}"
             height="46" class="navbar-brand-img">
    </div>
    <ul class="c-sidebar-nav ps ps--active-y">
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link c-active" href="{{ url('/dashboard') }}">
            <i class="cil-speedometer c-sidebar-nav-icon"></i> {{ __('Dashboard') }}</a>
        </li>
        @can('manage-user')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link " href="{{ route('users.index') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Users') }}
                </a>
            </li>
        @endcan

        @role('admin')


        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link " href="{{ route('criminals.index') }}">
                <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Criminals') }}
            </a>
        </li>

            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('admin.report') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Report') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('admin.irregular_checkin') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Irregular Check Ins ') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('admin.suspicious_checkins') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Suspicicous Check Ins ') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('messages') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Messages ') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('admin.queries') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Queries ') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('hotel_report.report') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Hotel Report') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{url('/notificationsettings')}}" class="c-sidebar-nav-link" >
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Notification Settings') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{url('/countries')}}" class="c-sidebar-nav-link" >
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Countries') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{url('/states')}}" class="c-sidebar-nav-link" >
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('States') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a href="{{url('/cities')}}" class="c-sidebar-nav-link" >
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Cities') }}
                </a>
            </li>
        @endrole
        @role('viewer')
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('admin.report') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Report') }}
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('viewer_report.report') }}">
                    <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Hotel Report') }}
                </a>
            </li>
        @endrole
        @role('user')
            @if($checkIsHotelCreated && ($checkIsHotelCreated->city != NULL || $checkIsHotelCreated->police_station != NULL))
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('guest.create') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Guest Check In') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('guest.list') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Guest Check Out') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('messages') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Messages ') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('guest.queries') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Queries ') }}
                    </a>
                </li>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('guest.report') }}">
                        <i class="cil-user c-sidebar-nav-icon"></i>{{ __('Report') }}
                    </a>
                </li>
            @endif
        @endrole
                @role('user')
            <li class="c-sidebar-nav-item">
                @if($checkIsHotelCreated)
                    <a class="c-sidebar-nav-link" href="{{ asset(url('edit-hotel/'.$checkIsHotelCreated->id)) }}">
                        <i class="cil-building c-sidebar-nav-icon"></i>{{ __('Edit Hotel') }}
                    </a>
                @else
                    <a class="c-sidebar-nav-link" href="{{ route('add-hotel') }}">
                        <i class="cil-building c-sidebar-nav-icon"></i>{{ __('Add Hotel') }}
                    </a>
                @endif
            </li>
        @endrole
        @include('layouts.menu')
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
