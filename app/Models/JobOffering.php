<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffering extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function interestedUsers()
    {
        return $this->hasMany(InterestedUser::class);
    }
}
