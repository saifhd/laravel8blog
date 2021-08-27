<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $categories=Category::orderBy('id','Desc')->paginate(10)->withQueryString();
        return view('category.index',compact('categories'));
    }


    public function create(){
        return view('category.createCategory');
    }
    public function store(CreateCategoryRequest $request)
    {
        $category=new Category();
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->save();
        $notification=array(
            'messege'=>'New Category Saved succesfully',
            'alert-type'=>'success'
            );
        return redirect()->route('categories')->with($notification);


    }
    public function edit($slug){
        $category=Category::where('slug',$slug)->first();
        return view('category.editCategory',compact('category'));

    }
    public function update(Request $request,$id){

        $category=Category::findOrFail($id);
        $category->update($request->all());


        $notification=array(
            'messege'=>'Category Updated succesfully',
            'alert-type'=>'success'
            );
        return redirect()->route('categories')->with($notification);
    }

    public function delete($id){

        $category=Category::findOrFail($id);
        $category->post()->delete();

        $category->delete();


        $notification=array(
            'messege'=>'Category and Category Related Posts Deleted succesfully',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }



}
