<?php $__env->startSection('breadcrumb'); ?>
    <a class="breadcrumb-item" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a><a class="breadcrumb-item"
        href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Roles')); ?></a><span
        class="breadcrumb-item active"><?php echo e(__('Show')); ?></span>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Show Permissions')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-8 m-auto">
        <div class="card">
            <div class="card-header"><strong><?php echo e(__('Add/Edit Permissions to ')); ?> <?php echo e($role->name); ?> <?php echo e(__(' Role')); ?>

                </strong> </div>
            <div class="card-body">
                <?php echo Form::model($role, ['method' => 'POST', 'route' => ['roles_permit', $role->id]]); ?>


                <?php echo csrf_field(); ?>
                <div class="card-body">
                    <table class="table table-flush permission-table">
                        <thead class="thead-light">
                            <tr>
                                <th width="200px"><?php echo e(__('Module')); ?></th>
                                <th><?php echo e(__('Permissions')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $moduals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td> <?php echo e(__(ucfirst($row))); ?></td>
                                    <td>
                                        <div class="row">
                                            <?php $default_permissions = ['manage', 'create', 'edit', 'delete', 'show']; ?>
                                            <?php $__currentLoopData = $default_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(in_array($permission . '-' . $row, $allpermissions)): ?>
                                                    <?php ($key = array_search($permission . '-' . $row, $allpermissions)); ?>
                                                    <div class="col-3 custom-control custom-checkbox">
                                                        <?php echo e(Form::checkbox('permissions[]', $key, in_array($permission . '-' . $row, $permissions), ['class' => 'custom-control-input', 'id' => 'permission_' . $key])); ?>

                                                        <?php echo e(Form::label('permission_' . $key, ucfirst($permission), ['class' => 'custom-control-label'])); ?>

                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $modules = []; ?>
                            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $s_name = $module; ?>
                                <tr>
                                    <td>
                                        <?php echo e(__(ucfirst($module))); ?>

                                    </td>
                                    <td>
                                        <div class="row">
                                            <?php if(in_array('manage-' . $s_name, $allpermissions)): ?>
                                                <?php ($key = array_search('manage-' . $s_name, $allpermissions)); ?>
                                                <div class="col-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]', $key, in_array($key, $permissions), ['class' => 'custom-control-input', 'id' => 'permission_' . $key])); ?>

                                                    <?php echo e(Form::label('permission_' . $key, __('Manage'), ['class' => 'custom-control-label'])); ?>

                                                </div>
                                            <?php endif; ?>
                                            <?php if(in_array('create-' . $module, $allpermissions)): ?>
                                                <?php ($key = array_search('create-' . $module, $allpermissions)); ?>
                                                <div class="col-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]', $key, in_array($key, $permissions), ['class' => 'custom-control-input', 'id' => 'permission_' . $key])); ?>

                                                    <?php echo e(Form::label('permission_' . $key, __('Create'), ['class' => 'custom-control-label'])); ?>

                                                </div>
                                            <?php endif; ?>
                                            <?php if(in_array('edit-' . $module, $allpermissions)): ?>
                                                <?php ($key = array_search('edit-' . $module, $allpermissions)); ?>
                                                <div class="col-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]', $key, in_array($key, $permissions), ['class' => 'custom-control-input', 'id' => 'permission_' . $key])); ?>

                                                    <?php echo e(Form::label('permission_' . $key, __('Edit'), ['class' => 'custom-control-label'])); ?>

                                                </div>
                                            <?php endif; ?>
                                            <?php if(in_array('delete-' . $module, $allpermissions)): ?>
                                                <?php ($key = array_search('delete-' . $module, $allpermissions)); ?>
                                                <div class="col-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]', $key, in_array($key, $permissions), ['class' => 'custom-control-input', 'id' => 'permission_' . $key])); ?>

                                                    <?php echo e(Form::label('permission_' . $key, __('Delete'), ['class' => 'custom-control-label'])); ?>

                                                </div>
                                            <?php endif; ?>
                                            <?php if(in_array('view-' . $module, $allpermissions)): ?>
                                                <?php ($key = array_search('view-' . $module, $allpermissions)); ?>
                                                <div class="col-3 custom-control custom-checkbox">
                                                    <?php echo e(Form::checkbox('permissions[]', $key, in_array($key, $permissions), ['class' => 'custom-control-input', 'id' => 'permission_' . $key])); ?>

                                                    <?php echo e(Form::label('permission_' . $key, __('show'), ['class' => 'custom-control-label'])); ?>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                    <div class="col-sm-12 mx-auto">
                        <?php echo e(Form::submit(__('Update Permission'), ['class' => 'btn btn-primary '])); ?>

                        <a class="btn btn-secondary" href="<?php echo e(route('roles.index')); ?>"> <?php echo e(__('Back')); ?></a>


                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sarai_new\resources\views/roles/show.blade.php ENDPATH**/ ?>