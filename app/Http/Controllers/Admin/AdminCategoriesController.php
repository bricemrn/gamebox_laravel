<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categories;

class AdminCategoriesController extends Controller
{
    /**
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getCategories()
    {
        $categories = Categories::all();

        return view('admin.admin_categories', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255'
        ]);

        $category = new Categories;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();

        if($category == true){
            return redirect()->back()->with('success', 'La catégorie a bien été ajoutée.');

        } else {
            return redirect()->back()->with('error', 'Attention ! La catégorie n\'a pas été ajoutée.');
        }
    }

    public function updateCategory(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255'
        ]);

        $id = $request->id;

        $category = Categories::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();

        return redirect()->back();
    }

    public function deleteCategory(Request $request)
    {
        $id = $request->id;

        $category = Categories::where('id', $id);
        $category->delete();

        return redirect()->back();
    }
}