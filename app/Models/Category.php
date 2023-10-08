<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $_id = 'id';
    public $_title = 'title';
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $table = 'categories';

    protected $timestamp = true;
    protected $fillable = [
        'id',
        'title'
    ];
    public function foods(): HasMany
    {
        return $this->hasMany(Food::class);
    }
}
