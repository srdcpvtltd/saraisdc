@extends('layouts.admin')
@section('breadcrumb')
    <span class="breadcrumb-item active">{{ __('Home') }}</span>
@endsection
@section('title')
    {{ __(' Dashboard') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            @role('admin')
                @include('dashboard.adminuserblocks')
            @endrole
            @role('user')
                @include('dashboard.userblocks')
            @endrole
        </div>
    </div>

@endsection

@section('javascript')
@role('admin')
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script>
        $(document).on("click", "#option2", function() {
            getChartData('year');
        });

        $(document).on("click", "#option1", function() {
            getChartData('month');
        });
        $(document).ready(function() {
            getChartData('month');
        })

        function getChartData(type) {

            $.ajax({
                url: "{{ route('get.chart.data') }}",
                type: 'POST',
                data: {
                    type: type,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },

                success: function(result) {
                    mainChart.data.labels = result.lable;
                    mainChart.data.datasets[0].data = result.value;
                    mainChart.update()
                },
                error: function(data) {
                    console.log(data.responseJSON);
                }
            });
        }
    </script>
    <script>
    $(document).ready(function(){
        setInterval(new_users, 45000);
        function new_users(){
            $.ajax({
                url: "{{url('/dashboardapi/invalid_users')}}",
                method: "GET",
                success: function (data){
                    if(data.status == 'success'){
                        $('.invalid_users').html(data.html);
                    }
                }
            });
        }
        new_users();
    });
</script>
@endrole
@endsection
