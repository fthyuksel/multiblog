<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Http\Request;

class SlugController extends Controller
{
    public function checkSlug(Request $request){
        $text = trim($request->name);
        $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
        $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
        $new_text = str_replace($search,$replace,$text);

        $slug = SlugService::createSlug(Blog::class,'slug',$new_text);
        return response()->json(['slug' => $slug]);
    }
}
