<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    public $table = 'order_details';
    const _id = 'id';
    const _order_id = 'order_id';
    const _food_id = 'food_id';
    const _sid = 'sid';
    const _quantity = 'quantity';
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $timestamp = true;
    protected $fillable = [
        'id',
        'order_id',
        'food_id',
        'sid',
        'quantity'
    ];
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function food(): BelongsTo
    {

        return $this->belongsTo(Food::class);
    }
}
