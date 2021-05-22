<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $blogs = Blog::with('category')->where('user_id',$user_id)->latest()->get();
        return view('blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user_id = Auth::user()->id;
        $categories = Category::where('owner_id',$user_id)->get();
        return view('blog.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:blogs',
            'category_id' =>'required',
            'content' => 'required'
        ],[
            'Burası boş bırakılamaz'
        ]);



        $user_id = Auth::user()->id;
        Blog::create($request->all() + ['user_id' => $user_id]);
        return redirect()->route('blog.index')->with('status','Blog başarıyla eklendi!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $user_id = Auth::user()->id;
        $show = Blog::with('category')->where('id',$blog->id)->firstOrFail();
        if (Auth::user()->id == $blog->user_id){
            return view('blog.show',compact('show'));
        }
        else{
            return abort(401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $user_id = Auth::user()->id;
        $category = Category::where('owner_id',$user_id)->pluck('category_name','id');
        if (Auth::user()->id == $blog->user_id){
            return view('blog.edit',compact('blog','category'));
        }
        else{
            return abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required',
            'category_id' =>'required',
            'content' => 'required'
        ],[
            'Burası boş bırakılamaz'
        ]);

        $blog->update($request->all());
        return redirect()->route('blog.index')->with('status','Blog başarıyla düzenlendi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if (Auth::user()->id == $blog->user_id){
            $blog->delete();
            return redirect()->route('blog.index')->with('status','Blog başarıyla silindi!');
        }
        else{
            return abort(401);
        }
    }
}
