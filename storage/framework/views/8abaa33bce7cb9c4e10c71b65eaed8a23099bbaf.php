<?php $__env->startSection('breadcrumb'); ?>
    <span class="breadcrumb-item active"><?php echo e(__('Home')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__(' Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="fade-in">
            <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
                <?php echo $__env->make('dashboard.adminuserblocks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <?php if(auth()->check() && auth()->user()->hasRole('user')): ?>
                <?php echo $__env->make('dashboard.userblocks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
    <script src="<?php echo e(asset('js/Chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/coreui-chartjs.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>" defer></script>
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
                url: "<?php echo e(route('get.chart.data')); ?>",
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
                url: "<?php echo e(url('/dashboardapi/invalid_users')); ?>",
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
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/dashboard/homepage.blade.php ENDPATH**/ ?>