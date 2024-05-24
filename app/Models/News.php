<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'tp_new';
    protected $primaryKey = 'id_new';
    protected $guarded = [];

    public function cate()
    {
        return $this->belongsTo(CateNew::class, 'category_id', 'id_category_new');
    }

   
}
