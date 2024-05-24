<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\CateProduct;
use App\Models\News;
use App\Models\Product;
class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search_text = $request->search;

        Session::put('key', $search_text);
        return redirect()->route('website.searchNow');
    }
    public function searchNow(Request $request)
    {
        $search_text = Session::get('key');
        $data['key'] = $search_text = Session::get('key');
        $data['products'] = Product::with('cate')->has('cate')
            ->where('name_vn', 'like', '%' . $search_text . '%')
            ->OrWhere('price', 'like', '%' . $search_text . '%')
            ->where('status', 1)
            ->paginate(15);

        return view('website.modules.search.index', $data);
    }
}
