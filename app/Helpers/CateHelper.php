<?php

use App\Models\CateNew;
use App\Models\CateProduct;

function getParentCategory($parent_id, $modelType)
{
    switch ($modelType) {
        case 'CateNew':
            $model = \App\Models\CateNew::class;
            $id = 'id_category_new';
            break;
        case 'CateProduct':
            $model = \App\Models\CateProduct::class;
            $id = 'id_category_product';
            break;
        default:
            return null;
    }

    $parent = $model::where($id, $parent_id)->first();

    if ($parent === null) {
        return 'Chủ đề chính';
    }

    $parent_2 = null;
    if ($parent->parent_id !== null) {
        $parent_2 = $model::where($id, $parent->parent_id)->first();
    }

    if ($parent_2 === null) {
        return $parent['name_vn'];
    } else {
        return $parent['name_vn'] . '(' . $parent_2['name_vn'] . ')';
    }
}


// Gọi chủ đề con của chủ đề con, nhớ phải có tên id của category ở biến cuối

if (!function_exists('renderCategoryOptions')) {
    function renderCategoryOptions($categories, $level = 0, $selectedParentId = null, $idAttribute = 'id_category_product') {
        foreach ($categories as $item) {
            $prefix = str_repeat('|---', $level);
            $categoryId = $item->{$idAttribute};  // Access the dynamic ID attribute
            echo '<option value="' . $categoryId . '"' . (($selectedParentId == $categoryId) ? ' selected' : '') . '>' . $prefix . $item->name_vn . '</option>';
            
            if (!empty($item->children)) {
                renderCategoryOptions($item->children, $level + 1, $selectedParentId, $idAttribute);
            }
        }
    }
}


