<?php 
    $userBlock = new App\Services\Dashboard\GetUserBlocks();
    $block = $userBlock->handleResponce();
?> 
<section class="content">
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner" style="height: 135px">
                        <h4 align="center">
                       <b>Guest Count</b>
                    </h4>
                    <table>
                        <tbody>
                            <tr style="font-weight: bold">
                                <td width="150px">Today</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #f73209"><?php echo e($block['todayGuest']); ?></span></td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td width="150px">Yesterday</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #dfa620"><?php echo e($block['yesterdayGuest']); ?></span></td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td width="150px">Day before yesterday</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #c5d629"><?php echo e($block['daybeforeYesterdayGuest']); ?></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="icon">
                     <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo e(route('guest.list')); ?>" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner" style="height: 135px">
                <h4 align="center">
                    <b>Checked in Guest</b>
                </h4>
                    <table>
                        <tbody>
                            <tr style="font-weight: bold">
                                <td width="60px">Date</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #86c43c"><?php echo e(date('d-M-Y',time())); ?></span></td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td width="60px">Total</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #2ddc23"><?php echo e($block['totalCheckIn']); ?></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
                <a href="<?php echo e(route('guest.list')); ?>" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner" style="height: 135px">
                <h4>
               <b>Checked out Guest</b>
            </h4>
                <table>
                    <tbody>
                        <tr style="font-weight: bold">
                            <td width="60px">Date</td>
                            <td width="10px">:</td>
                            <td><span class="badge" style="background-color: #86c43c"><?php echo e(date('d-M-Y',time())); ?></span></td>
                        </tr>
                        <tr style="font-weight: bold">
                            <td width="60px">Total</td>
                            <td width="10px">:</td>
                            <td><span class="badge" style="background-color: #86c43c"><?php echo e($block['totalCheckOut']); ?></span></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                
                <div class="icon">
                     <i class="fa fa-sign-out"></i>
                </div>
                <a href="<?php echo e(route('guest.list')); ?>" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="fade-in guest-register">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Guest Name</th>
                                    <th scope="col">Mobile Number</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No of Rooms Booked</th>
                                    <th scope="col">Arrival Date</th>
                                    <th scope="col">Arrival Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($booking->gues_name); ?></th>
                                        <td><?php echo e($booking->mobile_number); ?></td>
                                        <td><?php echo e($booking->email_id); ?></td>
                                        <td><?php echo e($booking->room_booked); ?></td>
                                        <td><?php echo e($booking->arrival_date); ?></td>
                                        <td><?php echo e($booking->arrival_time); ?></td>
                                        <td>
                                            occupied
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-xs" href="<?php echo e(asset(url('/guest/detail/'.$booking->id))); ?>">Proceed to Check-Out</a>
                                            <a class="btn btn-danger btn-xs" href="<?php echo e(asset(url('/mark/suspicious/'.$booking->id))); ?>">Mark as Suspicious</a>
                                            <div class="row text-danger">
                                                <?php if($errors->has('message')): ?>
                                                    <strong><?php echo e($errors->first('message')); ?></strong>
                                                <?php endif; ?>
                                            </div>
                                            <button class="btn btn-github btn-xs" data-toggle="modal" data-target="#quickView" onclick="open_quickView(<?php echo e($booking->id); ?>)"><i class="fa fa-eye"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="quickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="h4 font-weight-400 float-left modal-title" id="exampleModalLabel"> View Guest Details </h4>
                <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal" aria-label="Close">&times;</a>
            </div>
            <div class="modal-body">
                <div class="iframe-div">
                    <iframe></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php $__env->startPush('scripts'); ?>

<script>
    function open_quickView(id){
        $('.iframe-div').find('iframe').attr('src',"<?php echo e(url('/guest/quickinvoice/')); ?>/"+id);
    }

</script>


<?php $__env->stopPush(); ?><?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/dashboard/userblocks.blade.php ENDPATH**/ ?>