<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    public $table = 'foods';
    public $_id = 'id';
    public $_title = 'title';
    public $_thumbnail = 'thumbnail';
    public $_description = 'description';
    public $_portion = 'portion';
    public $_calory = 'calory';
    public $_unit = 'unit';
    public $_category_id = 'category_id';
    public $_restaurent_id = 'restaurent_id';
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $timestamp = true;
    protected $fillable = [
        'id',
        'title',
        'thumbnail',
        'description',
        'portion',
        'calory',
        'unit',
        'category_id',
        'restaurent_id'
    ];
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function orderDetail(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
