<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory;

    public function CompanyIndustry()
    {
        return $this->belongsTo(CompanyIndustry::class, 'company_industry_id');
    }

    public function CompanyLocation()
    {
        return $this->belongsTo(CompanyLocation::class, 'company_location_id');
    }

    public function CompanySize()
    {
        return $this->belongsTo(CompanySize::class, 'company_size_id');
    }
}
