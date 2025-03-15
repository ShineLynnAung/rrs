<?php

namespace App\Models;
use App\Models\Country;
use App\Models\Organization;
use App\Models\ResearcherType;
use Illuminate\Database\Eloquent\Model;

class Researcher extends Model
{
    protected $fillable = [
        'name', 'photo', 'nrc_or_passport_no', 'nrc_or_passport_attach',
        'country_id', 'dob', 'gender', 'current_address', 'permanent_address',
        'designation', 'organization_id', 'department', 'researcher_type_id',
        'registration_date', 'expire_date', 'member_no', 'registration_fees',
        'title', 'attach', 'created_by', 'updated_by'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function researcherType()
    {
        return $this->belongsTo(ResearcherType::class);
    }
}
