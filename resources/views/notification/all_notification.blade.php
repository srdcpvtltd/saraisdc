@extends('layouts.admin')
@section('breadcrumb')
<span class="breadcrumb-item active">{{ __('All Notification') }}</span>
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
    <div class="fade-in guest-register">
        <div class="card">
            <div class="card-body">
                <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <th>Guest Name</th>
                        <th>State Name</th>
                        <th>City Name</th>
                        <th>Hotel Name</th>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td><a href="{{ asset(url('/admin/guest/detail/'.$row->id)) }}">{{$row->gues_name}}</a></td>
                            <td>{{(isset($row->state)) ? $row->state->name : ''}}</td>
                            <td>{{(isset($row->city)) ? $row->city->name : ''}}</td>
                            <td>{{(isset($row->hotelProfile)) ? $row->hotelProfile->hotel_name : ''}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <div class="text-center">
            {{ $data->links() }}
        </div>
    </div>
</div>
@endsection