<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $table = 'rounds';

    protected $fillable = ['competition_id', 'round_number', 'location', 'date'];

    public $timestamps = false;

    public function competition() {
        return $this->belongsTo(Competition::class);
    }

    public function competitors()
    {
        return $this->hasMany(Competitor::class);
    }
}
