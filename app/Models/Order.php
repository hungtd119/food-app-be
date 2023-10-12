<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    public $table = 'orders';
    const _id = 'id';
    const _sid = 'sid';
    const _restaurent_id = 'restaurent_id';
    const _customer_id = 'customer_id';
    const _total_amount = 'total_amount';

    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $timestamp = true;
    protected $fillable = [
        'id',
        'restaurent_id',
        'sid',
        'customer_id',
        'total_amount',
    ];
    public function order_details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function policies(): HasMany
    {
        return $this->hasMany(Policy::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function restaurent(): BelongsTo
    {
        return $this->belongsTo(Restaurent::class);
    }
}
