<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name','email','password'];
    protected $hidden   = ['password','remember_token'];
    protected $casts    = ['email_verified_at'=>'datetime'];

    public function documents() { return $this->hasMany(Document::class); }
    public function categories(){ return $this->hasMany(Category::class); }
    public function activityLogs(){ return $this->hasMany(ActivityLog::class); }
}
