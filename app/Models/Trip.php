<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = [
        'destination',
        'start_date',
        'end_date',
        'max_participants',
        'price',
        'description',
        'city',
        'status',
        'image_1',
        'image_2',
        'image_3',
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    public function tripusers()
    {
        return $this->hasMany(Tripuser::class);
    }
}
