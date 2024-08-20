<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $table = 'competitions';

    protected $fillable = ['competition_name', 'competition_year', 'available_languages', 'maximum_points'];

    protected $casts = [
        'available_languages' => 'array',
    ];

    public $timestamps = false;

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }


    use HasFactory;
}
