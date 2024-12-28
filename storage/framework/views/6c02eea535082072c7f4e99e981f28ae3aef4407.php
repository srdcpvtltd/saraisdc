<div class="btn-group">
    <button class="btn btn-secondary" type="button"><?php echo e(__('Action')); ?></button>
    <button class="btn btn-secondary dropdown-toggle dropdown-toggle-split" type="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle
            Dropdown</span></button>
    <div class="dropdown-menu" x-placement="bottom-start">
        <a href="#" class="action-item" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i></a>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-user')): ?>
            <a href="<?php echo e(route('users.edit', $user->id)); ?>" class=" dropdown-item"> <i class="cil-pencil action-btn"></i>
                <?php echo e(__('Edit')); ?></a>
        <?php endif; ?>
        <div class="dropdown-divider"></div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-user')): ?>
            <a href="<?php echo e(route('users.index')); ?>" class="dropdown-item  text-danger " data-toggle="tooltip"
                data-original-title="<?php echo e(__('Delete')); ?>" onclick="delete_record('delete-form-<?php echo e($user->id); ?>')"><i
                    class="cil-trash action-btn"></i><?php echo e(__('Delete')); ?></a>
            <?php echo Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'id' => 'delete-form-' . $user->id]); ?>

            <?php echo Form::close(); ?>

        <?php endif; ?>
    </div>
</div>
<?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/users/action.blade.php ENDPATH**/ ?>