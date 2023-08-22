<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $table = 'user_profiles';
    protected $fillable = ['user_id','father_name', 'mother_name', 'spouse_name', 'phone', 'profile_picture', 'gender'];

    // relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
