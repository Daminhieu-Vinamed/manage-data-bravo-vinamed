<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'EmployeeCode',
        'department_code',
        'company',
        'username',
        'name',
        'avatar',
        'gender_id',
        'status_id',
        'role_code',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_code', 'code');
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_code', 'code');
    }
    
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'id');
    }
    
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    
    public function timekeeping()
    {
        return $this->hasMany(Timekeeping::class, 'EmployeeCode', 'EmployeeCode_user');
    }
}