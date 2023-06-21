<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PortfolioImage extends Model
{
    use HasFactory;

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function getFullImagePathAttribute()
    {
        return asset('storage/' . $this->path);
    }





    // public function getFullImagePathAttribute()
    // {
    //     return asset('storage/' . $this->attributes['path']);
    // }
    // public function getFullImagePathAttribute()
    // {
    //     return asset('storage/' . str_replace('public/', '', $this->path));
    // }
}
