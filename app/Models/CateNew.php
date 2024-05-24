<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateNew extends Model
{
    use HasFactory;
    protected $table = 'tp_category_new';
    protected $primaryKey = 'id_category_new';
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(CateNew::class, 'parent_id', 'id_category_new');
    }

    public function products()
    {
        return $this->hasMany(News::class, 'category_id', 'id_category_new');
    }
}
