<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'tp_product';
    protected $primaryKey = 'id_product';
    protected $guarded = [];

    public function cate()
    {
        return $this->belongsTo(CateProduct::class, 'category_id', 'id_category_product');
    }
}
