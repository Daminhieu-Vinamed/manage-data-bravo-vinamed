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
        'company',
        'parent_user_id',
        'parent_user_id_suggestion',
        'username',
        'name',
        'avatar',
        'gender_id',
        'status_id',
        'role_id',
        'is_warehouse_active',
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
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    
    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'id');
    }
    
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_user_id', 'id');
    }
    
    public function parent_suggestion()
    {
        return $this->belongsTo(User::class, 'parent_user_id_suggestion', 'id');
    }
    
    public function children()
    {
        return $this->hasMany(User::class, 'parent_user_id', 'id');
    }
    
    public function children_suggestion()
    {
        return $this->hasMany(User::class, 'parent_user_id_suggestion', 'id');
    }
    
    public function locate()
    {
        return $this->hasMany(Locate::class, 'user_id', 'id');
    }
}