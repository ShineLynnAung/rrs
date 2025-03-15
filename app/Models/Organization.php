<?php

namespace App\Models;
use App\Models\Researcher;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name'];

    public function researchers()
    {
        return $this->hasMany(Researcher::class);
    }
}
