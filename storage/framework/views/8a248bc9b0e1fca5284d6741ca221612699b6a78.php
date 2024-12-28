<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('users.index')); ?>"><?php echo e(__('User')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create User')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo Form::open(['route' => 'users.store', 'method' => 'POST']); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Create New User')); ?> </div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(__('Name:')); ?>

                    <?php echo Form::text('name', null, ['placeholder' => __('Hotel Name'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo e(__('Email:')); ?>

                    <?php echo Form::text('email', null, ['placeholder' => __('Email'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo e(__('Password:')); ?>

                    <?php echo Form::password('password', ['placeholder' => __('Password'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo e(__('Confirm Password:')); ?>

                    <?php echo Form::password('confirm-password', ['placeholder' => __('Confirm Password'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group ">
                    <?php echo e(__('Role:')); ?>

                    <?php echo Form::select('roles', $roles, null, ['class' => 'form-control']); ?>

                </div>
                <div>
                    <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary '])); ?>


                    <a class="btn btn-secondary" href="<?php echo e(route('users.index')); ?>"> <?php echo e(__('Back')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\sarai_new\resources\views/users/create.blade.php ENDPATH**/ ?>