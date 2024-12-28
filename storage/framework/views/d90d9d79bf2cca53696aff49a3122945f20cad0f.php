
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
                        
                        <div class="col">
                            <label>Gender</label>
                            <select  class="form-select form-select-lg form-control" name="gender" id="gender">
                                <option value="" selected>Select Gender</option>
                                <option value="male"    <?php if(isset($inputs) && isset($inputs['gender']) && $inputs['gender'] == 'male'): ?> selected <?php endif; ?>>Male</option>
                                <option value="female"  <?php if(isset($inputs) && isset($inputs['gender']) && $inputs['gender'] == 'female'): ?> selected <?php endif; ?>>Female</option>
                                <option value="other"   <?php if(isset($inputs) && isset($inputs['gender']) && $inputs['gender'] == 'other'): ?> selected <?php endif; ?>>Other</option>
                            </select>
                        </div>
                        
                        <div class="col">
                            <label>Country</label>
                            <select  class="form-select form-select-lg form-control" name="country" id="country">
                                <option value="" selected>Select country</option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>" <?php if(isset($inputs) && isset($inputs['country']) && $inputs['country'] == $country->id): ?> selected <?php endif; ?>><?php echo e($country->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col">
                            <div>
                                <label>State</label>
                                <select  name="state" class="form-select form-select-lg form-control" id="state">
                                    <option value="">Select State</option>
                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($state->id); ?>" <?php if(isset($inputs) && isset($inputs['state']) && $inputs['state'] == $state->id): ?> selected <?php endif; ?>><?php echo e($state->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <label>City</label>
                                <select  name="city" class="form-select form-select-lg form-control" id="city">
                                    <option value="">Select City</option>
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($city->id); ?>" <?php if(isset($inputs) && isset($inputs['city']) && $inputs['city'] == $city->id): ?> selected <?php endif; ?>><?php echo e($city->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <label>Nationality</label>
                                <select name="nationality" class="form-select form-select-lg form-control">
                                    <option value="" selected>Select Nationality</option>
                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country->id); ?>" <?php if(isset($inputs) && isset($inputs['nationality']) && $inputs['nationality'] == $country->id): ?> selected <?php endif; ?>><?php echo e($country->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <label>Transport</label>
                                <select name="transport" class="form-select form-select-lg form-control" >
                                    <option value="">Select Transport</option>
                                    <option value="car"   <?php if(isset($inputs) && isset($inputs['transport']) && $inputs['transport'] == 'car'): ?> selected <?php endif; ?>>Car</option>
                                    <option value="bus"   <?php if(isset($inputs) && isset($inputs['transport']) && $inputs['transport'] == 'bus'): ?> selected <?php endif; ?>>Bus</option>
                                    <option value="train"     <?php if(isset($inputs) && isset($inputs['transport']) && $inputs['transport'] == 'train'): ?> selected <?php endif; ?>>Train</option>
                                    <option value="flight"  <?php if(isset($inputs) && isset($inputs['transport']) && $inputs['transport'] == 'flight'): ?> selected <?php endif; ?>>Flight</option>
                                    <option value="own_taxi"    <?php if(isset($inputs) && isset($inputs['transport']) && $inputs['transport'] == 'own_taxi'): ?> selected <?php endif; ?>>Own Taxi</option>
                                    <option value="auto"    <?php if(isset($inputs) && isset($inputs['transport']) && $inputs['transport'] == 'auto'): ?> selected <?php endif; ?>>Auto</option>
                                    <option value="Others"  <?php if(isset($inputs) && isset($inputs['transport']) && $inputs['transport'] == 'Others'): ?> selected <?php endif; ?>>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label>From Age</label>
                        <input type="text" required class="form-control" name="fromAge" id="fromAge" />
                        </div>
                        <div class="col">
                            <label>To Age</label>
                        <input type="text" required class="form-control" name="toAge" id="toAge" />
                        </div>
                        <div class="col">
                         <label>Name</label>
                        <input type="text" required class="form-control" name="gues_name" id="gues_name" />
                        </div>
                        <div class="col">
                            <div>
                                <label>Police Station</label>
                                <select  name="police_station" class="form-select form-select-lg form-control" id="police_station">
                                    <option value="">Select Station</option>
                                    <?php $__currentLoopData = $police_stations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($station->code); ?>" <?php if(isset($inputs) && isset($inputs['police_station']) && $inputs['police_station'] == $station->code): ?> selected <?php endif; ?>><?php echo e($station->desc); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <label>Status</label>
                                <select name="status" class="form-select form-select-lg form-control">
                                    <option value="">All</option>
                                    <option value="in" <?php if(isset($inputs) && isset($inputs['status']) && $inputs['status'] == 'in'): ?> selected <?php endif; ?>>In</option>
                                    <option value="out" <?php if(isset($inputs) && isset($inputs['status']) && $inputs['status'] == 'out'): ?> selected <?php endif; ?>>Out</option>
                                </select>
                            </div>
                        </div>
                        <div class="col" style="top: 30px;">
                            
                            <button type="button" class="btn btn-primary" onclick="getFilter()">Filter</button>
                            <button type="button" class="btn btn-success" onclick="getExport()">Export</button>
                        </div>
                    </div>
                </form>
                <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Hotel name</th>
                            <th scope="col">Hotel Address</th>
                            <th scope="col">Guest name</th>
                            <th scope="col">Mobile Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Guest From</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">nationality</th>
                            <th scope="col">Address</th>
                            <th scope="col">Lane</th>
                            <th scope="col">Country</th>
                            <th scope="col">State</th>
                            <th scope="col">Dist</th>
                            <th scope="col">Pin</th>
                            <th scope="col">Mean Of Transport</th>
                            <th scope="col">Number Of Children</th>
                            <th scope="col">Number Of Adults</th>
                            <th scope="col">Extra Guest Name</th>
                            <th scope="col">Whom To Visit</th>
                            <th scope="col">Host Name</th>
                            <th scope="col">Host Mobile Number</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Arrival Date</th>
                            <th scope="col">In Time</th>
                            <th scope="col">Out Date</th>
                            <th scope="col">Out Time</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td scope="col"><a href="<?php echo e(asset(url('/admin/hotel/detail/'.$row->hotel_id))); ?>"><?php echo e((isset($row->hotelProfile) && isset($row->hotelProfile->hotel_name)) ? $row->hotelProfile->hotel_name : ''); ?></a></td>
                            <td scope="col"><?php echo e((isset($row->hotelProfile) && isset($row->hotelProfile->address)) ? $row->hotelProfile->address : ''); ?></td>
                            <td scope="col"><?php echo e($row->gues_name); ?></td>
                            <td scope="col"><?php echo e($row->mobile_number); ?></td>
                            <td scope="col"><?php echo e($row->email_id); ?></td>
                            <td scope="col"><?php echo e($row->arrived_from); ?></td>
                            <td scope="col"><?php echo e($row->age); ?></td>
                            <td scope="col"><?php echo e($row->gender); ?></td>
                            <td scope="col"><?php echo e((isset($row->nationalityName)) ? $row->nationalityName->name : ''); ?></td>
                            <td scope="col"><?php echo e($row->house_number .' '.$row->land_mark); ?></td>
                            <td scope="col"><?php echo e($row->lane); ?></td>
                            <td scope="col"><?php echo e((isset($row->country)) ? $row->country->name : ''); ?></td>
                            <td scope="col"><?php echo e((isset($row->state)) ? $row->state->name : ''); ?></td>
                            <td scope="col"><?php echo e((isset($row->city)) ? $row->city->name : ''); ?></td>
                            <td scope="col"><?php echo e($row->pin); ?></td>
                            <td scope="col"><?php echo e($row->transport); ?></td>
                            <td scope="col"><?php echo e($row->accompany_children); ?></td>
                            <td scope="col"><?php echo e($row->accompany_adult); ?></td>
                            <td scope="col">
                                <?php if($row->accompanies): ?>
                                    <?php $__currentLoopData = $row->accompanies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span><?php echo e($acc->guest_name); ?>,</span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                            <td scope="col"><?php echo e($row->whom_to_visit); ?></td>
                            <td scope="col"><?php echo e($row->whom_to_visit_name); ?></td>
                            <td scope="col"><?php echo e($row->whom_to_visit_mobile); ?></td>
                            <td scope="col"><?php echo e($row->remarks); ?></td>
                            <td scope="col"><?php echo e($row->arrival_date); ?></td>
                            <td scope="col"><?php echo e($row->arrival_time); ?></td>
                            <td scope="col">
                                    <?php if($row->rooms): ?>
                                        <?php $__currentLoopData = $row->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span><p><?php echo e($room->checkout_date != '' ? $room->checkout_date : 'occupy'); ?></p></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </td>
                                <td scope="col">
                                    <?php if($row->rooms): ?>
                                        <?php $__currentLoopData = $row->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span><p><?php echo e($room->checkout_time != '' ? $room->checkout_time : 'occupy'); ?></p></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </td>
                                <td scope="col">
                                    <?php if($row->rooms): ?>
                                        <?php $__currentLoopData = $row->rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span>
                                            <?php if($room->checkout_date != ''): ?>
                                                <?php  
                                                        date_default_timezone_set('asia/kolkata');
                                                        $datetime1=new DateTime($row->arrival_datetime); 
                                                        $datetime2=new DateTime($room->checkout_datetime);
                                                        $diff=date_diff($datetime1,$datetime2); 
                                                        echo ($diff->format("%a") > 0) ? '<p>'.$diff->format("%a days").'</p>' : '<p>'.$diff->format("%i mins").'<p>'; ?>
                                            <?php endif; ?>
                                        </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </td> 
                            <td scope="col"><a class="btn btn-primary btn-xs" href="<?php echo e(asset(url('/admin/guest/detail/'.$row->id))); ?>">View</a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <div class="text-center">
            <?php echo e($bookings->links()); ?>

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
    function getExport(id){
        $('.iframe-div').find('iframe').attr('src',"<?php echo e(url('/guest/quickinvoice/')); ?>/"+id);
    }
    function getFilter(){
        $('#reportSearch').attr('action',"<?php echo e(asset(url('admin/report'))); ?>");
        $('#reportSearch').submit();
    }
    function getExport(){
        $('#reportSearch').attr('action',"<?php echo e(asset(url('admin/report/export'))); ?>");
        $('#reportSearch').submit();
    }

</script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/admin/report/simpleReport.blade.php ENDPATH**/ ?>