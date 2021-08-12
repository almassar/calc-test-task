<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['pension_contribution',
                           'social_contribution',
                           'vosms',
                           'osms',
                           'ipn',
                           'salary',
                           'salary_result']; 
}
