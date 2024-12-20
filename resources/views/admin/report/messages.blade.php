@extends('layouts.admin')
@section('breadcrumb')
    <span class="breadcrumb-item active">{{ __('Messages') }}</span>
@endsection
@section('title')
    {{ __(' Dashboard') }}
@endsection
@section('content')

    <div class="container-fluid">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @role('admin')
            <div class="d-flex justify-content-between mb-2">
                <a href="{{route('admin.create.message')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Send Message</a>
            </div>
        @endrole
        <div class="fade-in guest-register">
            <div class="card">
                <div class="card-body">
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($messages as $message)
                                <tr>
                                    <td scope="col">{{$message->datetime}}</td>
                                    <td scope="col">{{$message->subject}}</td>
                                    <td scope="col">{{$message->message}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center">
                {{ $messages->links() }}
            </div>

        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
    </script>
@endsection
@push('scripts')

@endpush