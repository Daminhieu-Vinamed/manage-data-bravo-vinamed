<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locate extends Model
{
    use HasFactory;
    protected $table = 'locate';
    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'distance',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}