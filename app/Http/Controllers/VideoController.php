<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;

class VideoController extends Controller
{
     public function videolist()
    {
        $role = Auth::check() ? Auth::user()->role : null;

        $videos = Video::orderBy('id', 'desc')->get();

        return view('videolist', compact('videos', 'role'));
    }

   public function storevideo(Request $request)
{
    $request->validate([
        'video'       => 'required|file|mimes:mp4,mov,avi,wmv|max:51200',
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status'      => 'required|in:0,1',
    ]);

    $videoName = null;
    $thumbnailName = null;

    if ($request->hasFile('video')) {
        $videoName = time() . '_video.' . $request->video->extension();
        $request->video->move(public_path('uploads/videos'), $videoName);
    }

    if ($request->hasFile('thumbnail')) {
        $thumbnailName = time() . '_thumbnail.' . $request->thumbnail->extension();
        $request->thumbnail->move(public_path('uploads/thumbnails'), $thumbnailName);
    }

    Video::create([
        'video'       => $videoName,
        'title'       => $request->title,
        'description' => $request->description,
        'thumbnail'   => $thumbnailName,
        'status'      => $request->status,
    ]);

    return redirect()->back()->with('success', 'Video created successfully!');
}

    public function videoedit(Request $request)
{
    $request->validate([
        'id'          => 'required|exists:videos,id',
        'video'       => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200',
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'status'      => 'required|in:0,1',
    ]);

    $video = Video::findOrFail($request->id);

    // Update video file
    if ($request->hasFile('video')) {

        $videoName = time() . '_video.' . $request->video->extension();

        $request->video->move(
            public_path('uploads/videos'),
            $videoName
        );

        $video->video = $videoName;
    }

    // Update thumbnail
    if ($request->hasFile('thumbnail')) {

        $thumbnailName = time() . '_thumbnail.' . $request->thumbnail->extension();

        $request->thumbnail->move(
            public_path('uploads/thumbnails'),
            $thumbnailName
        );

        $video->thumbnail = $thumbnailName;
    }

    // Update other fields
    $video->title = $request->title;
    $video->description = $request->description;
    $video->status = $request->status;

    $video->save();

    return redirect()->back()->with('success', 'Video updated successfully!');
}
}
