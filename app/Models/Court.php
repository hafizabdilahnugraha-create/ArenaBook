<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
  protected $fillable = ['name', 'type', 'price_per_hour', 'image', 'specification', 'status'];
   public function reservations() {
        return $this->hasMany(Reservation::class);
    }
}
