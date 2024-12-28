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
                <div class="card-body">
                    <form action="<?php echo e(asset(url('guest/report'))); ?>" method="get" id="reportSearch">
                        <div class="form-row" style="margin-bottom: 15px;">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label>From</label>
                                        <input type="date" required class="form-control" placeholder="Select Date" name="searchFrom"
                                               value="<?php echo e((isset($inputs) && isset($inputs['searchFrom'])) ? $inputs['searchFrom'] : ''); ?>"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label>To</label>
                                        <input type="date" required class="form-control" placeholder="Select Date" name="searchTo"
                                               value="<?php echo e((isset($inputs) && isset($inputs['searchTo'])) ? $inputs['searchTo'] : ''); ?>"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="col" style="top: 30px;">
                                <button type="button" class="btn btn-primary" onclick="getFilter()">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Hotel name</th>
                                <th scope="col">Manage Name</th>
                                <th scope="col">Manager Mobile Number</th>
                                <th scope="col">Owner Name</th>
                                <th scope="col">OwnnerMobile Number</th>
                                <th scope="col">Hotel Address</th>
                                <th scope="col">City</th>
                                <th scope="col">Police Station</th>
                                <th scope="col" style="width:8% !important">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td scope="col"><?php echo e($row->hotel_name); ?></td>
                                    <td scope="col"><?php echo e($row->manger_name); ?></td>
                                    <td scope="col"><?php echo e($row->manager_mobile); ?></td>
                                    <td scope="col"><?php echo e($row->owner_name); ?></td>
                                    <td scope="col"><?php echo e($row->id); ?></td>
                                    <td scope="col"><?php echo e($row->address); ?></td>
                                    <td scope="col"><?php echo e(strtolower($row->city_name)); ?></td>
                                    <td scope="col"><?php echo e(strtolower($row->police_station)); ?></td>
                                    <td scope="col"><?php echo e($row->floor); ?></td>
                                    <td scope="col" style="width:8% !important">
                                        <a href="<?php echo e(asset(url('/admin/hotel/detail/'.$row->id))); ?>" class="btn btn-primary btn-sm">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <?php echo e($hotels->links()); ?>

            </div>

        </div>
    </div>
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".accompany-hide").hide();
            $('.accomapny-lable').hide();
            $('.bookin-lable').hide();
            $('#country').on('change', function() {
                var countryId = this.value;
                $('#state').html('');
                $.ajax({
                    url: "<?php echo e(route('getStates')); ?>?country_id=" + countryId,
                    type: 'get',
                    success: function(res) {
                        $('#state').html('<option value="">Select State</option>');
                        $.each(res, function(key, value) {
                            $('#state').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state').on('change', function() {
                var stateId = this.value;
                $('#city').html('');
                $.ajax({
                    url: "<?php echo e(route('getCities')); ?>?state_id=" + stateId,
                    type: 'get',
                    success: function(res) {
                        $('#city').html('<option value="">Select City</option>');
                        $.each(res, function(key, value) {
                            $('#city').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>

    <script>
        function getFilter(){
            $('#reportSearch').attr('action',"<?php echo e(asset(url('admin/irregular_checkin'))); ?>");
            $('#reportSearch').submit();
        }
    </script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sarai_new\resources\views/admin/report/IrregularCheckIn.blade.php ENDPATH**/ ?>