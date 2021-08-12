<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    public static function getPercent($id_month, $id_year)
    {
        return Tax::where('id_month',  $id_month)
                    ->where('id_year', $id_year)
                    ->first();     
    }
}
