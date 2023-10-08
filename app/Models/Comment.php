<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    public $table = 'comments';
    public $_sid = 'id';
    public $_user_id = 'user_id';
    public $_food_id = 'food_id';
    public $_msg = 'msg';
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $timestamp = true;
    protected $fillable = [
        'id',
        'user_id',
        'food_id',
        'msg',
    ];
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
