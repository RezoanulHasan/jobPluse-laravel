<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function Company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function Package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
