<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateProduct extends Model
{
    use HasFactory;
    protected $table = 'tp_category_product';
    protected $primaryKey = 'id_category_product';
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(CateProduct::class, 'parent_id', 'id_category_product');
    }

    public function products()
    {   
        return $this->hasMany(Product::class, 'category_id', 'id_category_product');
    }
}
