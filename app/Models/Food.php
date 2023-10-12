<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    public $table = 'foods';
    const _id = 'id';
    const _title = 'title';
    const _thumbnail = 'thumbnail';
    const _description = 'description';
    const _portion = 'portion';
    const _calory = 'calory';
    const _prize = 'prize';
    const _unit = 'unit';
    const _category_id = 'category_id';
    const _restaurent_id = 'restaurent_id';
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
        'prize',
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
