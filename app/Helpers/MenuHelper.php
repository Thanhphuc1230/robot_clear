<?php

function getUrl($item)
{
    switch ($item->type) {
        case 'page':
            return route('website.page', ['name_page' => $item->slug]);
        case 'cate_new':
            return route('website.categoryNews', ['name_cate' => $item->slug]);
        case 'cate_product':
            return route('website.categoryProduct', ['name_cate_product' => $item->slug]);
        case 'link':
            return $item->link ? $item->link . '.html' : route('website.home');
        default:
            return '';
    }
}

function isActiveMenu($item)
{
    return request()->url() == getUrl($item) ? 'active' : '';
}
