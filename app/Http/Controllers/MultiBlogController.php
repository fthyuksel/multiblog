<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\PersonalInformation;
use App\Models\User;
use Illuminate\Http\Request;

class MultiBlogController extends Controller
{
    public function index($username){
        $userCheck = User::where('username',$username)->firstorFail();
        $blogs = Blog::where('user_id',$userCheck->id)->latest()->simplePaginate(5);
        return view('multiblog.index',compact('blogs','userCheck'));
    }
    public function simpleBlog($username,$slug){
        $userCheck = User::where('username',$username)->firstorFail();
        $blog = Blog::where('user_id',$userCheck->id)->where('slug',$slug)->firstorFail();
        return view('multiblog.simpleblog',compact('blog','userCheck'));
    }
    public function information($username){
        $userCheck = User::where('username',$username)->firstorFail();
        $information = PersonalInformation::where('user_id',$userCheck->id)->firstorFail();
        return view('multiblog.information',compact('userCheck','information'));
    }
}
