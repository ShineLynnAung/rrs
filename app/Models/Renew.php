<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renew extends Model
{
    protected $table = 'renews';

    public function researcher()
    {
        return $this->belongsTo(Researcher::class);
    }   

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function researcher_type(){
        return $this->belongsTo(ResearcherType::class);
    }
}
