<?php

namespace App\Models;
use APP\Models\Researcher;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name'];

    public function researchers()
    {
        return $this->hasMany(Researcher::class);
    }
}
