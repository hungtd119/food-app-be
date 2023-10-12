<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Account extends Model
{
    public $_id = 'id';
    public $_username = 'username';
    public $_avatar = 'avatar';
    public $_phone = 'phone';
    public $_address = 'address';
    public $_role = 'role';
    public $_user_id = 'user_id';
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $table = 'accounts';

    protected $timestamp = true;
    protected $fillable = [
        'id',
        'username',
        'avatar',
        'phone',
        'address',
        'role',
        'user_id'
    ];
    public function user():HasOne{
        return $this->hasOne(User::class);
    }
}
