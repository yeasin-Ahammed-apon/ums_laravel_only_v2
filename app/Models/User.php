<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function education_info(){
        return $this->hasMany(EducationInfo::class);
    }
    public function permission()
    {
        return $this->hasOne(Permission::class);
    }
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }
    public function hod()
    {
        return $this->hasOne(Hod::class);
    }
    public function cod()
    {
        return $this->hasOne(Cod::class);
    }
    public function account()
    {
        return $this->hasOne(Account::class);
    }
    public function admission()
    {
        return $this->hasOne(Admission::class);
    }
    public function student()
    {
        return $this->hasOne(Student::class);
    }
    public function hr()
    {
        return $this->hasOne(Hr::class);
    }
    public function librarian()
    {
        return $this->hasOne(Librarian::class);
    }
    public function storeManager()
    {
        return $this->hasOne(StoreManager::class);
    }
}
