<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    public $table = 'order_details';
    public $_id = 'id';
    public $_order_id = 'order_id';
    public $_food_id = 'food_id';
    public $_quantity = 'quantity';
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $timestamp = true;
    protected $fillable = [
        'id',
        'order_id',
        'food_id',
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
