<?php

namespace App\Models;
use App\Models\Visit;
use Illuminate\Database\Eloquent\Model;

class CopyType extends Model
{
    protected $fillable = ['name'];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}
