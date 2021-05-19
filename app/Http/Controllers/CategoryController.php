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
        $trash_categories = Category::onlyTrashed()->paginate(2);

        // All categories
        // $categories = Category::all();
        // $categories = Category::paginate(2);
        return view('admin.category.index', compact('categories', 'trash_categories'));
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

    public function edit_category($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update_category(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:20',
        ], [
            'name.required' => 'Please enter the category name',
            'name.unique' => 'The Category already exists',
            'name.max' => 'Maximum 20 characters allowed'
        ]);
        $category = Category::find($id)->update([
            'name' => $request->name,
        ]);
        return Redirect()->route('all.category')->with('success', 'Category updated successfully');
    }

    public function softdelete_category($id)
    {
        $category = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category Soft Delete Successfully');
    }

    public function restore_category($id)
    {
        $category = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category Restored Successfully');
    }

    public function delete_category($id)
    {
        $category = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
