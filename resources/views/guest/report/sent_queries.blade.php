@extends('layouts.admin')
@section('breadcrumb')
    <span class="breadcrumb-item active">{{ __('Queries') }}</span>
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
        <div class="d-flex justify-content-between mb-2">
            <a href="{{route('guest.create.query')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Send Query</a>
        </div>
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
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($queries as $query)
                                <tr>
                                    <td scope="col">{{$query->datetime}}</td>
                                    <td scope="col">{{$query->subject}}</td>
                                    <td scope="col">{{$query->message}}</td>
                                    <td scope="col">
                                        @if($query->status) Resolved @else Pending @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center">
                {{ $queries->links() }}
            </div>

        </div>
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
    </script>
@endsection
@push('styles')
    <style>
        .disabled {
            pointer-events: none;
            cursor: default;
            opacity: .6;
        }
    </style>


@endpush
@push('scripts')
    <script>

        $(document).on('click', '#resolve', function (e) {
            let id = $(this).attr('data-id');
            $.ajax({
                type: 'get',
                url: 'resolve/' + id,
                success: function(data) {
                    let element = $("a[data-id='" + data +"']")
                    element.css('cursor','default');
                    element.css('opacity',.6);
                    element.css('pointerEvents', 'none');
                }
            });
        });
    </script>
@endpush