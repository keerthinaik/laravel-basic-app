<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\MultiplePic;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class BrandController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function all_brand()
    {
        $brands = Brand::latest()->paginate(3);
        return view('admin.brand.index', compact('brands'));
    }

    public function add_brand(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:brands|min:4',
            'image' => 'required|mimes:jpg,jpeg,png',
        ], [
            'name.required' => 'Please enter the brands name',
            'name.unique' => 'The Brand already exists',
            'name.min' => 'Enter at least 4 characters'
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $image_ext = strtolower($image->getClientOriginalExtension());
        $image_name = $name_gen . '.' . $image_ext;
        $upload_dir = 'images/brands/';

        // resizing and saving the image
        Image::make($image)->resize(300, 200)->save($upload_dir . $image_name);

        // normal image inserting
        // $image->move($upload_dir, $image_name);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->image = $upload_dir . $image_name;
        $brand->save();

        return Redirect()->back()->with('success', 'Brand inserted successfully');
    }

    public function edit_brand($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update_brand(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:4',
            'image' => 'mimes:jpg,jpeg,png',
        ], [
            'name.required' => 'Please enter the brands name',
            'name.min' => 'Enter at least 4 characters'
        ]);

        $image = $request->file('image');
        if ($image) {
            $old_image = $request->old_image;
            unlink($old_image);
            $name_gen = hexdec(uniqid());
            $image_ext = strtolower($image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $image_ext;
            $upload_dir = 'images/brands/';
            $image->move($upload_dir, $image_name);

            $brand = Brand::find($id);
            $brand->name = $request->name;
            $brand->image = $upload_dir . $image_name;
            $brand->save();

            return Redirect()->back()->with('success', 'Brand updated with img successfully');
        } else {
            $brand = Brand::find($id);
            $brand->name = $request->name;
            $brand->save();
            return Redirect()->back()->with('success', 'Brand updated successfully');
        }
    }

    public function delete_brand($id)
    {
        $brand = Brand::find($id);
        unlink($brand->image);
        $brand->delete();
        return Redirect()->back()->with('success', 'Brand deleted successfully');
    }

    // This is for multi image
    public function multi_pic()
    {
        $images = MultiplePic::all();
        return view('admin.multipic.index', compact('images'));
    }

    public function add_multi_pic(Request $request)
    {
        $validated = $request->validate([
            'images' => 'required',
        ]);

        $images = $request->file('images');

        foreach ($images as $image) {
            $name_gen = hexdec(uniqid());
            $image_ext = strtolower($image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $image_ext;
            $upload_dir = 'images/multipics/';

            // resizing and saving the image
            Image::make($image)->resize(300, 200)->save($upload_dir . $image_name);

            $pic = new MultiplePic();
            $pic->images = $upload_dir . $image_name;
            $pic->save();
        }

        return Redirect()->back()->with('success', 'Images inserted successfully');
    }
}
