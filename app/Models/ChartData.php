<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartData extends Model
{
    protected $table = 'public.ChartData';

    protected $fillable = [
        'user_id', 
        'chart_date', 
        'chart_amount'
    ];
}