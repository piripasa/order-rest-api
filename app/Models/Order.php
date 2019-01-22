<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
      'origin_lat',
      'origin_lng',
      'destination_lat',
      'destination_lng',
      'distance',
      'status',
    ];
}
