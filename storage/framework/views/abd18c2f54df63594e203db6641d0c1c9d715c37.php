<?php
use App\Facades\UtilityFacades;
$logo = asset(Storage::url('uploads/logo/'));
$company_favicon = UtilityFacades::getValByName('company_favicon');
?>
<!DOCTYPE html>
<html dir="<?php echo e(env('SITE_RTL') == 'on' ? 'rtl' : ''); ?>" lan="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(config('app.name')); ?></title>
    <link rel="icon" href="<?php echo e($logo . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>" type="image" sizes="16x16">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/free.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/select2.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/bootstrap-datetimepicker.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href="<?php echo e(asset('css/style.css?ver=1')); ?>" rel="stylesheet">
    <?php if(env('SITE_RTL') == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-rtl.css')); ?>">
    <?php endif; ?>
    <link href="<?php echo e(asset('css/toastr.min.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('css'); ?>
    <script type="text/javascript" src="<?php echo e(asset(url('public\js\webcam.min.js'))); ?>"></script>

</head>

<body class="c-app">

    <?php echo $__env->make('partial.nav-builder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partial.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row bg-white ">
        <div class=" px-3 col-auto">
            <ol class="breadcrumb border-0 m-0">
                <?php echo $__env->yieldContent('breadcrumb'); ?>
            </ol>
        </div>
        <div class="col">
            <?php echo $__env->yieldContent('action'); ?>
        </div>
    </div>
    <div class="c-body">
        <main class="c-main">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        <?php echo $__env->make('partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    </div>
    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div>
                    <h4 class="h4 font-weight-400 float-left modal-title" id="exampleModalLabel"></h4>
                    <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal"
                        aria-label="Close"><?php echo e(__('Close')); ?></a>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('js/coreui.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/coreui-utils.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-datetimepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <script>
        var toster_pos = "<?php echo e(env('SITE_RTL') == 'on' ? 'left' : 'right'); ?>";
    </script>

    <script>
        function delete_record(id) {
            event.preventDefault();
            if (confirm('Are You Sure?')) {
                document.getElementById(id).submit();
            }
        }
    </script>

    <script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>
    <?php if(Session::has('message')): ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("<?php echo e(session('message')); ?>");
        </script>
    <?php endif; ?>

    <?php if(Session::has('errors')): ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("<?php echo e(session('errors')->first()); ?>");
        </script>
    <?php endif; ?>
    <?php if(Session::has('error')): ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("<?php echo e(session('error')); ?>");
        </script>
    <?php endif; ?>
    <?php if(Session::has('info')): ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("<?php echo e(session('info')); ?>");
        </script>
    <?php endif; ?>
    <?php if(Session::has('warning')): ?>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("<?php echo e(session('warning')); ?>");
        </script>
    <?php endif; ?>
    <?php echo $__env->yieldContent('javascript'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/layouts/admin.blade.php ENDPATH**/ ?>