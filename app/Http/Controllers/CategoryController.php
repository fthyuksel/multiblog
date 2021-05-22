<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceResponse;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        $categories = Category::where('owner_id',$user_id)->latest()->get();
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'category_name' => 'required',
        ],[
            'Burası boş bırakılamaz'
        ]);

        $user_id = Auth::user()->id;
        Category::create([
            'category_name' => $request->category_name,
            'owner_id' => $user_id
        ]);
        return redirect()->route('category.index')->with('status','Kategori başarıyla eklendi!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (Auth::user()->id == $category->owner_id){
            return view('category.edit',compact('category'));
        }
        else{
            return abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required',
        ],[
            'Burası boş bırakılamaz'
        ]);

        $category->update($request->all());
        return redirect()->route('category.index')->with('status','Kategori başarıyla düzenlendi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $blogs = Blog::where('category_id',$category->id)->first();

        if ($blogs!=''){
            return redirect()->route('category.index')->with('status','Kategori Silinemedi! Bu kategoriyi kullanan blog bulunuyor! Kategoriyi silmek için bu kategoriyi kullanan blogların kategorilerini değiştirin veya blogları silin!');
        }
        else{
            if (Auth::user()->id == $category->owner_id){
                $category->delete();
                return redirect()->route('category.index')->with('status','Kategori başarıyla silindi!');
            }
            else{
                return abort(401);
            }
        }
    }
}
