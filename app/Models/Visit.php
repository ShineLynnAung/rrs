<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visits';
    protected $guarded = [];

    public function researcher()
    {
        return $this->belongsTo(Researcher::class);
    }

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function copyType()
    {
        return $this->belongsTo(CopyType::class);
    }
}
