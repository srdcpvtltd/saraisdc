<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Module')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('modules.index')); ?>"><?php echo e(__('Module')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Edit')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo Form::model($modual, ['method' => 'PATCH', 'route' => ['modules.update', $modual->id]]); ?>

    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Edit Module')); ?> </div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Name'))); ?>

                    <?php echo Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']); ?>

                    <?php echo Form::hidden('old_name', $modual->name, ['placeholder' => __('Name'), 'class' => 'form-control']); ?>

                </div>
                <?php echo e(Form::submit(__('Update'), ['class' => 'btn btn-primary'])); ?>


                <a class="btn btn-secondary" href="<?php echo e(route('modules.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
            <div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sarai_new\resources\views/moduals/edit.blade.php ENDPATH**/ ?>