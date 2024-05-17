<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timekeeping extends Model
{
    use HasFactory;
    protected $table = 'timekeeping';
    protected $fillable = [
        'EmployeeCode_user',
        'start',
        'end',
        'title',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'EmployeeCode_user', 'EmployeeCode');
    }
}