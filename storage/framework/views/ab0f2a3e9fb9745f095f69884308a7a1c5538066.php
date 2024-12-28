
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Hotel Detail View')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('admin.report')); ?>"><?php echo e(__('Report')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Hotel Detail View')); ?></span>
<?php $__env->stopSection(); ?>
<style>
    .detil-item {
        margin-top: 20px;
    }
</style>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="fade-in">
            <section class="content">
                <div class="fade-in guest-register">
                    <div class="card">
                        <div class="fade-in guest-register">
                            <div class="card">
                            <div class="card-header">Hotel Detail</div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 detil-item">
                                            <b>Hotel Name:</b> <?php echo e((isset($user) && $user->name) ? $user->name : ''); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Manager Name:</b> <?php echo e($hotel->manager_name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Owner Name:</b> <?php echo e($hotel->owner_name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Manager Mobile  Number:</b> <?php echo e($hotel->manager_mobile); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Owner Mobile Name:</b> <?php echo e($hotel->owner_mobile); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Adress:</b> <?php echo e($hotel->address); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Registration Number:</b> <?php echo e($hotel->registration_number); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Home Country:</b> <?php echo e((!empty($hotel->otherCountry)) ? $hotel->otherCountry : $countries->name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Home State:</b> <?php echo e((!empty($hotel->otherState)) ? $hotel->otherState : $state->name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Home City:</b> <?php echo e((!empty($hotel->otherCity)) ? $hotel->otherCity : $city->name); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Police Station:</b> <?php echo e((!empty($hotel->police_station)) ? $hotel->police_station : ''); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Number Of Floors:</b> <?php echo e($hotel->floors); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Number Of Rooms:</b> <?php echo e($hotel->rooms); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Direct Employee Count:</b> <?php echo e($hotel->direct_employee_count); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Outsource Employee Count:</b> <?php echo e($hotel->outsource_employee_count); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Website:</b> <?php echo e($hotel->website); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Email:</b> <?php echo e((isset($user) && $user->email) ? $user->email : ''); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Geo tagging:</b> <?php echo e(($hotel->geo_tagging == 1) ? 'Yes' : 'No'); ?>

                                        </div>

                                        <div class="col-md-4 detil-item">
                                            <b>Having Swimming Pool:</b> <?php echo e(($hotel->swimming_pool == 1) ? 'Yes' : 'No'); ?>

                                        </div>

                                        <div class="col-md-4 detil-item">
                                            <b>Aggregator:</b> <?php echo e(($hotel->aggregator == 1) ? 'Yes' : 'No'); ?>

                                        </div>

                                        <div class="col-md-4 detil-item">
                                            <b>Security:</b> <?php echo e(($hotel->security == 1) ? 'Direct' : 'Out Source'); ?>

                                        </div>

                                        <div class="col-md-4 detil-item">
                                            <b>Banquet Hall:</b> <?php echo e(($hotel->banquet_hall == 1) ? 'YES' : 'No'); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Number Of Restaurant:</b> <?php echo e($hotel->restaurant_count); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Leased Room:</b> <?php echo e(($hotel->leased_room == 1) ? 'Yes' : 'No'); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Having Bar:</b> <?php echo e(($hotel->has_bar == 1) ? 'Yes' : 'No'); ?>

                                        </div>
                                        
                                        <div class="col-md-4 detil-item">
                                            <b>Pub:</b> <?php echo e(($hotel->has_pub == 1) ? 'Yes' : 'No'); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Bagage Scanner available:</b> <?php echo e(($hotel->baggage_scanner == 1) ? 'Yes' : 'No'); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Metal Detector:</b> <?php echo e(($hotel->metal_detector == 1) ? 'Yes' : 'No'); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>Fire &amp; Smoke detection:</b> <?php echo e(($hotel->fire_detector == 1) ? 'Yes' : 'No'); ?>

                                        </div>
                                        <div class="col-md-4 detil-item">
                                            <b>CCTV available:</b> <?php echo e(($hotel->cctv == 1) ? 'Yes' : 'No'); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/admin/hotel/detail.blade.php ENDPATH**/ ?>