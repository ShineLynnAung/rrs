<?php

namespace App\Models;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['group_code', 'name'];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
