<?php 
    $userBlock = new App\Services\Dashboard\GetAdminUserBlocks();
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
                                <td><span class="badge" style="background-color: #f73209">{{$block['todayGuest']}}</span></td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td width="150px">Yesterday</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #dfa620">{{$block['yesterdayGuest']}}</span></td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td width="150px">Day before yesterday</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #c5d629">{{$block['daybeforeYesterdayGuest']}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="icon">
                     <i class="fa fa-users"></i>
                </div>
                <a href="../guest/visitor_list.php?role_code=T2dEdU1mU2s3MGJaL3dTVkhudlFQQT09&amp;type=QWxs" class="small-box-footer">
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
                                <td><span class="badge" style="background-color: #86c43c">{{date('d-M-Y',time())}}</span></td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td width="60px">Total</td>
                                <td width="10px">:</td>
                                <td><span class="badge" style="background-color: #2ddc23">{{$block['totalCheckIn']}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
                <a href="../guest/visitor_list.php?role_code=T2dEdU1mU2s3MGJaL3dTVkhudlFQQT09&amp;type=Q2hlY2tlZF9Jbg==" class="small-box-footer">
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
                            <td><span class="badge" style="background-color: #86c43c">{{date('d-M-Y',time())}}</span></td>
                        </tr>
                        <tr style="font-weight: bold">
                            <td width="60px">Total</td>
                            <td width="10px">:</td>
                            <td><span class="badge" style="background-color: #86c43c">{{$block['totalCheckOut']}}</span></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="icon">
                     <i class="fa fa-sign-out"></i>
                </div>
                <a href="../guest/visitor_list.php?role_code=T2dEdU1mU2s3MGJaL3dTVkhudlFQQT09&amp;type=Q2hlY2tlZF9PdXQ=" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner" style="height: 165px">
                <h4>
               <b>Notification</b>
            </h4>
                <table class="invalid_users table">
                </table>
                </div>
                <div class="icon">
                     <i class="fa fa-sign-out"></i>
                </div>
                <a href="{{url('/all_wnotification')}}" class="small-box-footer">
                    View All <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>
