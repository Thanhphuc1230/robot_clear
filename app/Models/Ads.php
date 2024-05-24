<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    
    protected $table = 'tp_ads';
    protected $primaryKey = 'id_ads';
    protected $guarded = [];
}
