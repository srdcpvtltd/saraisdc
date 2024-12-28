<?php $__env->startSection('title'); ?>
    <?php echo e(__('Profile')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Profile')); ?></span>
<?php $__env->stopSection(); ?>
<?php
use App\Facades\UtilityFacades;
$profile = asset(Storage::url('uploads/avatar/'));
$setting = UtilityFacades::settings();
?>
<?php $__env->startSection('content'); ?>
    <?php echo e(Form::model($userDetail, ['route' => ['update.profile'], 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>


    <div class="col-md-4 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Edit Profile')); ?> </div>
            <div class="card-body">
                <div class="form-group chktxt" >
                    <img alt="" style="height:150px;"
                        src="<?php echo e(!empty($userDetail->avatar) ? $profile . '/' . $userDetail->avatar : $profile . '/avatar.jpg'); ?>"
                        class="c-avatar-img">
                </div>
                <div class="form-group">
                     <?php echo e(Form::label('name', __('Name'), ['class' => 'form-control-label'])); ?>

                    <?php echo e(Form::text('name', null, ['class' => 'form-control font-style', 'placeholder' => __('Enter User Name')])); ?>

                </div>
                <div class="form-group">
                     <?php echo e(Form::label('email', __('Email'), ['class' => 'form-control-label'])); ?>

                    <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter User Email')])); ?>

                </div>
                <div class="form-group">
                    <div class="choose-file">
                        <div for="avatar">
                            <div><?php echo e(__('Choose file here')); ?></div>
                            <input type="file" class="form-control" name="profile" data-filename="profiles">
                        </div>
                        <p class="profiles"></p>
                    </div>
                </div>
                <div>
                    <?php echo e(Form::submit(__('Update'), ['class' => 'btn btn-primary '])); ?>


                    <a class="btn btn-secondary" href="<?php echo e(route('home')); ?>"> <?php echo e(__('Back')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

    <?php if(isset($setting['authentication']) && $setting['authentication'] == 'activate'): ?>
        <?php echo $__env->make('auth.2fa_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/users/profile.blade.php ENDPATH**/ ?>