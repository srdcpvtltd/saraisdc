@extends('layouts.admin')

@section('breadcrumb')
    <a class="breadcrumb-item" href="{{ route('home') }}">{{ __('Home') }}</a><a class="breadcrumb-item"
        href="{{ route('criminals.index') }}">{{ __('Criminal') }}</a><span
        class="breadcrumb-item active">{{ __('Edit') }}</span>
@endsection
@section('title')
    {{ __('Edit Criminal') }}
@endsection
@section('content')
    {!! Form::model($criminal, ['method' => 'PATCH', 'enctype' => 'multipart/form-data', 'route' => ['criminals.update', $criminal->id]]) !!}
    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header"><strong>{{ __('Edit Criminal') }}</strong> </div>
            <div class="card-body">
                <div class="form-group">
                    {{ __('Name:') }}
                    {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {{ __('Photo:') }}
                    <input name="photo" type="file" id='photo' class='form-control'>
                    <canvas id= "canvas" style="display: none"></canvas>

                    @if(!empty($criminal->photo))
                        <div id='oldimage'>
                            @include('criminals.image')
                        </div>
                    @endif

                </div>
                <div class="form-group">
                    {{ __('Age:') }}
                    {!! Form::text('age', null,['placeholder' => __('Age'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {{ __('Gender:') }}
                    {!! Form::text('gender', null,['placeholder' => __('Gender'), 'class' => 'form-control']) !!}
                </div>
                <div class="form-group ">
                    {{ __('Remarks:') }}
                    {!! Form::text('remarks', null,['placeholder' => __('Remarks'), 'class' => 'form-control']) !!}

                </div>
                <div>
                    {{ Form::submit(__('Update'), ['class' => 'btn btn-primary ']) }}

                    <a class="btn btn-secondary" href="{{ route('criminals.index') }}"> {{ __('Back') }}</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

<script language="JavaScript">
    let fileInput = document.getElementById('photo');
    fileInput.addEventListener('change', function(ev) {
    if(ev.target.files) {
        let file = ev.target.files[0];
        var reader  = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = function (e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function(ev) {
                var canvas = document.getElementById('canvas');
                canvas.width = image.width;
                canvas.height = image.height;
                var ctx = canvas.getContext('2d');
                ctx.drawImage(image,0,0);
            }

        }
        document.getElementById('canvas').style="display:block";
        document.getElementById('oldimage').style="display:none";
    }
    });
</script>
@endsection
