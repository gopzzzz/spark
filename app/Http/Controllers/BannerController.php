<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function bannerlist()
    {
        $role = Auth::user()->role;

        $banners = Banner::orderBy('id', 'desc')->get();

        return view('bannerlist', compact('banners', 'role'));
    }

    public function storebanner(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'  => 'nullable|url|max:255',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/banners'), $imageName);
        }

        Banner::create([
            'image' => $imageName,
            'link'  => $request->link,
        ]);

        return redirect()->back()->with('success', 'Banner created successfully!');
    }

    public function banneredit(Request $request)
    {
        $request->validate([
            'id'    => 'required|exists:banners,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link'  => 'nullable|url|max:255',
        ]);

        $banner = Banner::findOrFail($request->id);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/banners'), $imageName);

            $banner->image = $imageName;
        }

        $banner->link = $request->link;
        $banner->save();

        return redirect()->back()->with('success', 'Banner updated successfully!');
    }
}