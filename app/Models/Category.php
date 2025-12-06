<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "categories";

    protected $fillable = [
        'category_name',
        'category_description',
        'parent_id'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
