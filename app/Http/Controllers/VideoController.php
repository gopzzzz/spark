<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Video;
use App\Models\RelatedNote;

class VideoController extends Controller
{
    public function videolist()
{
    $role = Auth::check() ? Auth::user()->role : null;

    $videos = DB::table('videos')

        ->leftJoin('categories', 'videos.category_id', '=', 'categories.id')

        ->select(
            'videos.*',
            'categories.category_name'
        )

        ->orderBy('videos.id', 'desc')
        ->get();

    $categories = Category::orderBy('category_name')->get();

    return view(
        'videolist',
        compact(
            'videos',
            'categories',
            'role'
        )
    );
}

  public function storevideo(Request $request)
{
    $request->validate([

        'video'       => 'required|file|mimes:mp4,mov,avi,wmv|max:51200',

        'title'       => 'required|string|max:255',

        'category_id' => 'required|exists:categories,id',

        'description' => 'nullable|string',

        'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'status'      => 'required|in:0,1',

        // related documents
        'related_notes.*' => 'nullable|mimes:pdf,jpg,jpeg,png,webp|max:5120',

    ]);

    $videoName = null;

    $thumbnailName = null;

    // Upload Video
    if ($request->hasFile('video')) {

        $videoName = time() . '_video.' .
            $request->video->extension();

        $request->video->move(
            public_path('uploads/videos'),
            $videoName
        );
    }

    // Upload Thumbnail
    if ($request->hasFile('thumbnail')) {

        $thumbnailName = time() . '_thumbnail.' .
            $request->thumbnail->extension();

        $request->thumbnail->move(
            public_path('uploads/thumbnails'),
            $thumbnailName
        );
    }

    // Create Video
    $video = Video::create([

        'video'       => $videoName,

        'title'       => $request->title,

        'category_id' => $request->category_id,

        'description' => $request->description,

        'thumbnail'   => $thumbnailName,

        'status'      => $request->status,

    ]);

    // Upload Related Notes/Documents
    if ($request->hasFile('related_notes')) {

        $files = [];

        foreach ($request->file('related_notes') as $file) {

            $fileName = time() . '_' .
                rand(1000,9999) . '.' .
                $file->extension();

            $file->move(
                public_path('related_notes'),
                $fileName
            );

            $files[] = $fileName;
        }

        RelatedNote::create([

            'video_id' => $video->id,

            'related_notes' => implode(',', $files),

        ]);
    }

    return redirect()->back()->with(
        'success',
        'Video created successfully!'
    );
}

    public function videoedit(Request $request)
{
    $request->validate([
        'id'          => 'required|exists:videos,id',
        'video'       => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200',
        'title'       => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
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
    $video->category_id = $request->category_id;
    $video->description = $request->description;
    $video->status = $request->status;

    $video->save();

    return redirect()->back()->with('success', 'Video updated successfully!');
}
}
