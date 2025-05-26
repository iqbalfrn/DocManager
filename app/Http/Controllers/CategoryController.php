<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct(){ $this->middleware('auth'); }

    public function index()
    {
        $categories = Category::where('user_id',Auth::id())->paginate(10);
        return view('categories.index',compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $req)
    {
        $data = $req->validate(['name'=>'required|string|max:255']);
        Category::create(['name'=>$data['name'],'user_id'=>Auth::id()]);
        return redirect()->route('categories.index')
                         ->with('success','Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        $this->authorize('update',$category);
        return view('categories.edit',compact('category'));
    }

    public function update(Request $req, Category $category)
    {
        $this->authorize('update',$category);
        $data = $req->validate(['name'=>'required|string|max:255']);
        $category->update(['name'=>$data['name']]);
        return redirect()->route('categories.index')
                         ->with('success','Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete',$category);
        $default = Category::firstOrCreate(['user_id'=>Auth::id(),'name'=>'Umum']);
        Document::where('category_id',$category->id)
                ->update(['category_id'=>$default->id]);
        $category->delete();
        return redirect()->route('categories.index')
                         ->with('success','Kategori berhasil dihapus.');
    }
}
