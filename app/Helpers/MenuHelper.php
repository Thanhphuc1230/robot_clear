<?php


function getUrl($item) {
    $url = '';
    switch ($item->type) {
        case 'page':
            return route('website.page', ['name_page' => $item->slug]);
            break;

        case 'cate_new':
            return route('website.categoryNews', ['name_cate' => $item->slug]);
            break;

        case 'cate_product':
            if ($item->slug == 'san-pham') {
                $url = route('website.categoryAll');
            } else {
                $url = route('website.categoryProduct', ['name_cate' => $item->slug]);
            }
            break;

        case 'link':
            return $item->link ? $item->link . '.html' : route('website.home');
            break;

        default:
            return '';
    }
    return $url;
}