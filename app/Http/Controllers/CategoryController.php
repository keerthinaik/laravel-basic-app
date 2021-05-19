<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function all_category()
    {
        // All categories with latest first
        $categories = Category::latest()->paginate(3);

        // All categories
        // $categories = Category::all();
        // $categories = Category::paginate(2);
        return view('admin.category.index', compact('categories'));
    }

    public function add_category(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:20',
        ], [
            'name.required' => 'Please enter the category name',
            'name.unique' => 'The Category already exists',
            'name.max' => 'Maximum 20 characters allowed'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->user_id = Auth::user()->id;
        $category->save();
        return Redirect()->back()->with('success', 'Category inserted successfully');
    }
}
