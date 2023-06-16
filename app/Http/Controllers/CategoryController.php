<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Validator;
use App\Models\Category;


class CategoryController extends Controller
{



    public function index(Request $request)
    {
        $categories = Category::latest();

        if(!empty($request->get('keyword'))){
            $categories = $categories->where('name','like','%'.$request->get('keyword').'%');

        }

        $categories = $categories->paginate(10);
        // dd($categories->all());
        return view('admin.category.index', compact('categories'));
    }



    public function create()
    {

        return view('admin.category.create');
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->status = $request->status;
            $category->slug = $request->slug;
            $category->save();

            $request->session()->flash('success', 'Category added Successfully');
            return response()->json([
                'status' => true,
                'message' => 'Category added Successfully'
            ]);
        } else {

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function edit()
    {
    }


    public function update()
    {
    }


    public function delete()
    {
    }
}
