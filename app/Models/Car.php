<?php

namespace App\Models;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Car extends Model
{

    use  HasFactory, SoftDeletes, Loggable;
    protected $guarded = [];
    protected $table = 'cars';
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
