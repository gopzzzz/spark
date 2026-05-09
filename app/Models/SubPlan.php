<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPlan extends Model
{
    use HasFactory;

    protected $table = 'sub_plans';

    protected $fillable = [
        'plan_name',
        'description',
        'amount',
        'images',
    ];
}