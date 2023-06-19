<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestedUser extends Model
{
    use HasFactory;

    public function jobOffering()
    {
        return $this->belongsTo(JobOffering::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
