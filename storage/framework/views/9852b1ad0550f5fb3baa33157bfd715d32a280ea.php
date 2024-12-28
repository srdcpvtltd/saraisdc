<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('criminals.index')); ?>"><?php echo e(__('Criminal')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Create')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Criminal')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php echo Form::open(['route' => 'criminals.store', 'enctype' => 'multipart/form-data', 'method' => 'POST']); ?>

    <div class="col-md-12 m-auto">
        <div class="card">
            <div class="card-header"><?php echo e(__('Create New Criminal')); ?> </div>
            <div class="card-body">
                <div class="form-group">
                    <?php echo e(__('Name:')); ?>

                    <?php echo Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo e(__('Photo:')); ?>

                    <input name="photo" type="file" id='photo' class='form-control'>
                    <canvas id= "canvas"></canvas>

                </div>
                <div class="form-group">
                    <?php echo e(__('Age:')); ?>

                    <?php echo Form::text('age', null,['placeholder' => __('Age'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group">
                    <?php echo e(__('Gender:')); ?>

                    <?php echo Form::text('gender', null,['placeholder' => __('Gender'), 'class' => 'form-control']); ?>

                </div>
                <div class="form-group ">
                    <?php echo e(__('Remarks:')); ?>

                    <?php echo Form::text('remarks', null,['placeholder' => __('Remarks'), 'class' => 'form-control']); ?>


                </div>
                <div>
                    <?php echo e(Form::submit(__('Submit'), ['class' => 'btn btn-primary '])); ?>


                    <a class="btn btn-secondary" href="<?php echo e(route('criminals.index')); ?>"> <?php echo e(__('Back')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>



<script language="JavaScript">
    let fileInput = document.getElementById('photo');
    fileInput.addEventListener('change', function(ev) {
    if(ev.target.files) {
        let file = ev.target.files[0];
        var reader  = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = function (e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function(ev) {
                var canvas = document.getElementById('canvas');
                canvas.width = image.width;
                canvas.height = image.height;
                var ctx = canvas.getContext('2d');
                ctx.drawImage(image,0,0);
            }
        }
    }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sarai_new\resources\views/criminals/create.blade.php ENDPATH**/ ?>