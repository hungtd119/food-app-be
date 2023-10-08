<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Policy extends Model
{
    public $table = 'policies';
    public $_id = 'id';
    public $_title = 'title';
    public $_con_price = 'con_price';
    public $_con_quantity = 'con_quantity';
    public $_order_id = 'order_id';
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $timestamp = true;

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
