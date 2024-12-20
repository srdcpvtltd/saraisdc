@extends('layouts.admin')
@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><span
        class="breadcrumb-item active">{{ __(' Languages') }}</span>
@endsection
@section('content')

    <div class="col-md-4 m-auto">

        <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i> {{ __('Manage Languages') }}
                <a href="{{ route('create.language') }}" data-url=""
                    class="btn btn-sm btn-icon icon-left btn-primary width-auto float-right"
                    data-ajax-popup="true" data-title="{{ __('Create New Language') }}">
                    <i class="fa fa-plus"></i> {{ __('Create') }}
                </a>
            </div>
            <div class="card-body">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('No.') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Action') }}</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($languages as $key=> $lang)
                            <tr>
                                <td class="w-50">
                                    {{$key+1 }}
                                </td>
                                <td class="w-100">
                                    {{ Str::upper($lang) }}
                                </td>
                                <td class="w-100">
                                    @include('lang.action')
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
