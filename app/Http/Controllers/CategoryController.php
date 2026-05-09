<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categorylist()
    {
        $role = Auth::check() ? Auth::user()->role : null;

        $categories = Category::orderBy('id', 'desc')->get();

        return view('categorylist', compact('categories', 'role'));
    }

    public function storecategory(Request $request)
    {
        $request->validate([
    'category_name' => 'required|string|max:255',
    'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/category'), $imageName);
        }

        Category::create([
            
            'category_name'  => $request->category_name,
            'image' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function categoryedit(Request $request)
    {
        $request->validate([
            'id'    => 'required|exists:categories,id',
            'category_name'  => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $categories = Category::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/category'), $imageName);

            $categories->image = $imageName;
        }

        $categories->category_name= $request->category_name;
        $categories->save();

        return redirect()->back()->with('success', 'Category updated successfully!');
    }
}
