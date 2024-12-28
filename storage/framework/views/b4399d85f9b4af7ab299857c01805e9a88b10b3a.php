<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Hotel Visitor Management System')); ?></title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <!-- Styles -->
    <link href="<?php echo e(asset('css/hotel/app.css')); ?>" rel="stylesheet">
</head>
<body>
    <?php echo $__env->yieldContent('content'); ?>

    <!-- Scripts -->
    <script type="text/javascript" src="<?php echo e(asset('third-party/jquery-3.6.0.min.js')); ?>"></script>
   <script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <?php echo $__env->yieldContent('js'); ?>
</body>
</html>
<?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/frontend/layouts/app.blade.php ENDPATH**/ ?>