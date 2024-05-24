<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'tp_menu';
    protected $primaryKey = 'id_menu';
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id_menu');
    }
}
