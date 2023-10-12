<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurent extends Model
{
    public $table = 'restaurents';
    public $_id = 'id';
    public $_user_id = 'user_id';
    public $_name = 'name';
    public $taxCode = 'taxCode';
    public $_thumbnail = 'thumbnail';
    public $_address = 'address';
    public $_rating = 'rating';
    public $_accessUnit = 'accessUnit';

    use HasFactory;
    protected $primaryKey = 'id';
    protected $timestamp = true;
    public $incrementing = false;
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'taxCode',
        'thumbnail',
        'address',
        'rating',
        'accessUnit',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
