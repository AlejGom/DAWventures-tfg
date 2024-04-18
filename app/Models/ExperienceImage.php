<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceImage extends Model
{
    use HasFactory;

    protected $fillable = ['experience_id', 'user_id', 'name', 'route'];

    protected $table = 'images';

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
