<?php $__currentLoopData = $data->slice(0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr >
    <td><a href="<?php echo e(asset(url('/admin/guest/detail/'.$row->id))); ?>"><?php echo e($row->gues_name); ?></a></td>
    <td><?php echo e((isset($row->state)) ? $row->state->name : ''); ?></td>
    <td><?php echo e((isset($row->city)) ? $row->city->name : ''); ?></td>
    <td><?php echo e((isset($row->hotelProfile)) ? $row->hotelProfile->hotel_name : ''); ?></td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/dashboard/invalid_cube.blade.php ENDPATH**/ ?>