@php
use App\Facades\UtilityFacades;
$logo = asset(Storage::url('uploads/logo/'));
$company_favicon = UtilityFacades::getValByName('company_favicon');
@endphp
<!DOCTYPE html>
<html dir="{{ env('SITE_RTL') == 'on' ? 'rtl' : '' }}" lan="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="icon" href="{{ $logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') }}" type="image" sizes="16x16">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href="{{ asset('css/style.css?ver=1') }}" rel="stylesheet">
    @if (env('SITE_RTL') == 'on')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">
    @endif
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    @yield('css')

    <script type="text/javascript" src="{{ asset('js/webcam.min.js') }}"></script>

</head>

<body class="c-app">

    @include('partial.nav-builder')
    @include('partial.header')
    <div class="row bg-white ">
        <div class=" px-3 col-auto">
            <ol class="breadcrumb border-0 m-0">
                @yield('breadcrumb')
            </ol>
        </div>
        <div class="col">
            @yield('action')
        </div>
    </div>
    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
        @include('partial.footer')
    </div>
    </div>
    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div>
                    <h4 class="h4 font-weight-400 float-left modal-title" id="exampleModalLabel"></h4>
                    <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal"
                        aria-label="Close">{{ __('Close') }}</a>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('js/coreui-utils.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        var toster_pos = "{{ env('SITE_RTL') == 'on' ? 'left' : 'right' }}";
    </script>

    <script>
        function delete_record(id) {
            event.preventDefault();
            if (confirm('Are You Sure?')) {
                document.getElementById(id).submit();
            }
        }
    </script>

    <script src="{{ asset('js/toastr.min.js') }}"></script>
    @if (Session::has('message'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        </script>
    @endif

    @if (Session::has('errors'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{  session('errors')->first()  }}");
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{  session('error')  }}");
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        </script>
    @endif
    @if (Session::has('warning'))
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        </script>
    @endif
    @yield('javascript')
    @stack('scripts')
</body>

</html>
