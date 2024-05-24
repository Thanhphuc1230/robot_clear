<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CateNew;
use App\Models\News;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
class NewsController extends Controller
{
    public function categoryNews($name_cate_new,$name_child)
    {
        $data['categoryNews'] = CateNew::where('slug', $name_cate_new)->first();

        $data['news'] = News::with('cate')
            ->where('category_id', $data['categoryNews']->id_category_new)
            ->paginate(12);
        $uuidNews = $data['news']->pluck('slug')->toArray();
        // Bài viết tương tự
        $data['sameNews'] = News::with('cate')->whereNotIn('slug',$uuidNews)->where('status',1)->orderBy('stt','asc')->take(5)->get();
    
        return view('website.modules.news.category', $data);
    }

    public function detailNew($name_cate_new, $title_new)
    {
        $data['categoryNews'] = CateNew::where('slug', $name_cate_new)->first();

        // if (!$data['categoryNews']) {
        //     return $this->categoryProductChild($name_cate_new,$title_new);
        // }
        
        $data['detailNew'] = News::with('cate')->where('slug', $title_new)->first();

        // Set session for + view
        $sessionKey = 'post_' . $title_new;
        $sessionView = Session::get($sessionKey);

        if (!$sessionView) {
            Session::put($sessionKey, true);
            $data['detailNew']->increment('views');
        }

        // Bài viết tương tự
        $data['sameNews'] = News::with('cate')->where('slug','!=',$title_new)->where('status',1)->orderBy('stt','asc')->take(3)->get();

        $uuidNews = $data['sameNews']->pluck('uuid')->toArray();//lay uuid cua same new
        $data['sameNews2'] = News::with('cate')->whereNotIn('slug',$uuidNews)->where('status',1)->whereNotIn('uuid',$uuidNews)->orderBy('created_at','desc')->take(5)->get();
        return view('website.modules.news.detail', $data);
    }

}
