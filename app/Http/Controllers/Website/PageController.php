<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
class PageController extends ProductController
{
    public function page($name_page)
    {
        $data['pageDetail'] = Page::where('slug', $name_page)->first();
      
        if (!$data['pageDetail']) {
            return $this->categoryProduct($name_page);
        }

        return view('website.modules.page.index', $data);
    }
}
