<?php $__env->startSection('breadcrumb'); ?>
<span class="breadcrumb-item active"><?php echo e(__('Guest Detail')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__(' Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <?php if(session()->has('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session()->get('success')); ?>

        </div>
    <?php endif; ?>
    <div class="fade-in guest-register">
        <div class="card">
            <div class="card-header">Guest Detail</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center" style="margin-bottom: 15px;">
                            <img src="<?php echo e(asset(url('storage/bookings/'.$booking->guest_image))); ?>"/>
                        </div>
                        <div class="col-md-4 detil-item">
                            <b>Guest Name:</b> <?php echo e($booking->gues_name); ?>

                        </div>
                        <div class="col-md-4 detil-item">
                            <b>Mobile Number:</b> <?php echo e($booking->mobile_number); ?>

                        </div>
                        
                        <div class="col-md-4 detil-item">
                            <b>Guest Email:</b> <?php echo e($booking->email_id); ?>

                        </div>
                        <div class="col-md-4 detil-item">
                            <b>Arrived From:</b> <?php echo e($booking->arrived_from); ?>

                        </div>
                        <div class="col-md-4 detil-item">
                            <b>Arrival Date:</b> <?php echo e($booking->arrival_date); ?>

                        </div>
                        <div class="col-md-4 detil-item">
                            <b>Arrival Time:</b> <?php echo e($booking->arrival_time); ?>

                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">Booking Detail</div>
            <div class="card-body">
                <h5><b>Room Booked :</b> <?php echo e($booking->room_booked); ?></h5>
                <?php $__currentLoopData = $booking->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <div class="col-md-3 detil-item">
                            <b>Building Number:</b> <?php echo e($room->building_number); ?>

                        </div>
                        <div class="col-md-3 detil-item">
                            <b>Floor Number:</b> <?php echo e($room->floor_number); ?>

                        </div>
                        <div class="col-md-2 detil-item">
                            <b>Room Number:</b> <?php echo e($room->room_number); ?>

                        </div>
                        
                        <div class="col-md-3 detil-item">
                            <?php if(auth()->check() && auth()->user()->hasRole('user')): ?>
                            <button class="btn btn-info"><?php echo e($room->status ? 'Completed' : 'In Progress'); ?></button>
                                <a href="<?php echo e($room->status ? '#' : asset(url('/guest/checkout/'.$booking->id.'/room/'.$room->id))); ?>" 
                                    style="<?php echo e($room->status ? 'cursor: not-allowed; pointer-events:none' : ''); ?>"
                                    class="btn btn-primary" 
                                    onclick="return disableDoubleClick()">Checkout</a>
                            </div>
                            <?php endif; ?>
                        </div>  
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<style>
.detil-item {
    margin-bottom: 15px;
}
.v-p-i img {
    width: 100%;
    height: 250px;
}
</style>
<script type="text/javascript">
    disableDoubleClick = function() {
        if (typeof(_linkEnabled)=="undefined") _linkEnabled = true;
        setTimeout("blockClick()", 100);
        return _linkEnabled;
    }
    blockClick = function() {
        _linkEnabled = false;
        setTimeout("_linkEnabled=true", 1000);
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/guest/detail.blade.php ENDPATH**/ ?>