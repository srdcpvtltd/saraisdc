<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
//     protected $table = 'notification';
     public function country() {
        return $this->belongsTo(Country::class,'country');
    }
    public function state() {
        return $this->belongsTo(State::class,'state');
    }
    public function city() {
        return $this->belongsTo(City::class,'city');
    }
}
