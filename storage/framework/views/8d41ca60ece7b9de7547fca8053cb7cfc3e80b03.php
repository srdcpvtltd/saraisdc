<?php
use App\Facades\UtilityFacades;
$logo = asset('uploads/logo/');
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

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('css/free.min.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/select2.min.css')); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('css/bootstrap-datetimepicker.css')); ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <link href="<?php echo e(asset('css/guest_invoice_style.css')); ?>" rel="stylesheet">
        <?php if(env('SITE_RTL') == 'on'): ?>
            <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-rtl.css')); ?>">
        <?php endif; ?>
        <link href="<?php echo e(asset('css/toastr.min.css')); ?>" rel="stylesheet">
        <?php echo $__env->yieldContent('css'); ?>
        <script type="text/javascript" src="<?php echo e(asset(url('public\js\webcam.min.js'))); ?>"></script>

    </head>

    <body>
        <div class="wrapper">
            <a class="btn btn-danger" href="<?php echo e(url('/guest/pdfquickinvoice/'.$booking->id)); ?>" target="_blank">Print</a>
            <div class="wrapper_inside">
                <div class="wrapper_right_side">
                    <div class="logo_area">
                         <img class="c-sidebar-brand-full" src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : '/light_logo.png')); ?>" height="100" class="navbar-brand-img">
                    </div>
                    <div class="guest_image">
                            <img src="<?php echo e(url('storage/bookings/'.$booking->guest_image)); ?>"/>
                    </div>
                </div>
                <div class="wrapper_left_side">
                    <table class="table">
                        <tr class="table_heading">
                            <th colspan="2"><h3> Police Commissionerate </h3></th>
                        </tr>
                        <tr class="table_heading">
                            <th colspan="2"><h3> Guest Slip </h3></th>
                        </tr>
                        <tr>
                            <th>Name Of the Guest</th>
                            <td><?php echo e($booking->gues_name); ?></td>
                        </tr>
                        <tr>
                            <th>Mobile Number Of the Guest</th>
                            <td><?php echo e($booking->mobile_number); ?></td>
                        </tr>
                        <tr>
                            <th>Guest Email Id</th>
                            <td><?php echo e($booking->email_id); ?></td>
                        </tr>
                        <tr>
                            <th>Total Number Of Room Booked</th>
                            <td><?php echo e(count($booking->rooms)); ?></td>
                        </tr>
                        <tr>
                            <th>Arrival Time at Reception</th>
                            <td><?php echo e($booking->arrival_date .' '.$booking->arrival_time); ?></td>
                        </tr>
                        <tr>
                            <th>Guest Arrived From</th>
                            <td><?php echo e($booking->arrived_from); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </body>

</html>
<?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/guest/quickInvoice.blade.php ENDPATH**/ ?>