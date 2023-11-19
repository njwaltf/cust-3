<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = ['id'];
    public function scopeSearch($query, $keyword)
    {
        if ($keyword) {
            return $query->where('title', 'like', "%$keyword%")
                ->orWhere('desc', 'like', "%$keyword%")
                ->orWhere('writer', 'like', "%$keyword")
                ->orWhere('publisher', 'like', "%$keyword")
                ->orWhere('type', 'like', "%$keyword");
        }
        return $query;
    }

    public function type()
    {
        // wan tu wan
        return $this->belongsTo(Type::class);
    }
    use HasFactory;
}
