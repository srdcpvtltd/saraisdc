<?php
if(!function_exists('format_date')){
    function format_date($date){
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date);
    }
}
if(!function_exists('format_datetime')){
    function format_datetime($datetime){
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('d/M/Y H:i:s');
    }
}
if (!function_exists('user')) {
    /**
     * @return \Corals\User\Models\User
     */
    function user()
    {
        return \Auth::user();
    }
}

if (!function_exists('isSuperUser')) {
    function isSuperUser(\App\Models\User $user = null)
    {
        if (is_null($user)) {
            $user = user();
        }

        if (!$user) {
            return false;
        }

        //$superuser_id = \Settings::get('super_user_id', 1);
        $superuser_id =1;

        return $user->id == $superuser_id || $user->hasRole('superuser');
    }
}
