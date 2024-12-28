<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Module')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('modules.index')); ?>"><?php echo e(__('Modules')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo Form::open(['route' => 'modules.store', 'method' => 'POST']); ?>

    <div class="col-md-6 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Create New Module')); ?> </div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(Form::label('name', __('Name'))); ?>

                    <?php echo Form::text('name', null, ['placeholder' => __('Name'), 'required' => true, 'class' => 'form-control']); ?>

                </div>
                <div class="form-group row">
                    <?php echo e(Form::label('permissions', __('Permissions'), ['class' => 'col-md-3 col-form-label'])); ?>


                    <div class="col-md-9 col-form-label">
                        <div class="form-check form-check-inline mr-1">
                            <?php echo e(Form::checkbox('permissions[]', 'M'), ['class' => 'form-check-label', 'id' => 'inline-checkbox1']); ?>

                            <?php echo e(Form::label('manage', __('Manage'), ['class' => 'form-check-label'])); ?>



                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <?php echo e(Form::checkbox('permissions[]', 'C'), ['class' => 'form-check-label', 'id' => 'inline-checkbox2']); ?>

                            <?php echo e(Form::label('create', __('Create'), ['class' => 'form-check-label'])); ?>


                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <?php echo e(Form::checkbox('permissions[]', 'D'), ['class' => 'form-check-label', 'id' => 'inline-checkbox3']); ?>

                            <?php echo e(Form::label('delete', __('Delete'), ['class' => 'form-check-label'])); ?>


                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <?php echo e(Form::checkbox('permissions[]', 'S'), ['class' => 'form-check-label', 'id' => 'inline-checkbox4']); ?>

                            <?php echo e(Form::label('show', __('Show'), ['class' => 'form-check-label'])); ?>


                        </div>
                        <div class="form-check form-check-inline mr-1">
                            <?php echo e(Form::checkbox('permissions[]', 'E'), ['class' => 'form-check-label', 'id' => 'inline-checkbox5']); ?>

                            <?php echo e(Form::label('edit', __('Edit'), ['class' => 'form-check-label'])); ?>


                        </div>
                    </div>
                </div>
                <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary'])); ?>


                <a class="btn btn-secondary" href="<?php echo e(route('modules.index')); ?>"> <?php echo e(__('Back')); ?></a>
            </div>
            <div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sarai_new\resources\views/moduals/create.blade.php ENDPATH**/ ?>