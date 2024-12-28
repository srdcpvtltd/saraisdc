<?php
use App\Facades\UtilityFacades;
$users = \Auth::user();
$currantLang = $users->currentLanguage();
$languages = UtilityFacades::languages();
$profile = asset(Storage::url('uploads/avatar'));
?>
<div class="c-wrapper c-fixed-components">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show">
            <span class="c-header-toggler-icon"></span></button>

        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar"
            data-class="c-sidebar-lg-show" responsive="true">
            <span class="c-header-toggler-icon"></span></button>
            <?php
            $hotel = DB::table('hotel_profiles')->where('user_id', Auth::id())->first();
            ?>
            <h5 style="margin-top: 18px;" class="hotel-name"><?php echo e((isset($users) && $users->name) ? $users->name : ''); ?></h5>
        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item d-md-down-none mx-2">
            </li>
            <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar">
                        <img class="c-avatar-img" width="35px"
                            src="<?php echo e(!empty($users->avatar) ? $profile . '/'. $users->avatar : $profile . '/avatar.jpg'); ?>">
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <a class="dropdown-item" href="<?php echo e(route('profile')); ?>">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo e(asset('/icons/sprites/free.svg#cil-user')); ?>"></use>
                        </svg>
                        <?php echo e(__('Profile')); ?>

                    </a>
                    <?php if(auth()->check() && auth()->user()->hasRole('admin')): ?>
                    <a class="dropdown-item" href="<?php echo e(route('settings.index')); ?>">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo e(asset('/icons/sprites/free.svg#cil-settings')); ?>"></use>
                        </svg> <?php echo e(__('Settings')); ?>

                    </a>
                    <?php endif; ?>
                     <?php if(auth()->check() && auth()->user()->hasRole('user')): ?>
                    <a class="dropdown-item" href="<?php echo e(route('changePasswordGet')); ?>">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo e(asset('/icons/sprites/free.svg#cil-settings')); ?>"></use>
                        </svg> <?php echo e(__('Change Password')); ?>

                    </a>
                    <?php endif; ?>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="$('#lgfrm').submit()">
                        <svg class="c-icon mr-2">
                            <use xlink:href="<?php echo e(asset('/icons/sprites/free.svg#cil-account-logout')); ?>"></use>
                        </svg><?php echo e(__('Logout')); ?>

                        <form id="lgfrm" action="<?php echo e(url('/logout')); ?>" method="POST"> <?php echo csrf_field(); ?> </form>
                    </a>
                </div>
            </li>
        </ul>
    </header>
<?php /**PATH /home/u768597266/domains/srdcdemo.co.in/public_html/sarai/resources/views/partial/header.blade.php ENDPATH**/ ?>