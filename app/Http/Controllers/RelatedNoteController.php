<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RelatedNote;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RelatedNoteController extends Controller
{
    public function relatednoteslist()
    {
        $role = Auth::check() ? Auth::user()->role : null;

        $relatednotes = DB::table('related_notes')
    ->leftJoin('videos', 'related_notes.video_id', '=', 'videos.id')
    ->select(
        'related_notes.*',
        'videos.title as video_title'
    )
    ->orderBy('related_notes.id', 'desc')
    ->get();

        $videos = Video::orderBy('id', 'desc')->get();

        return view('relatednoteslist', compact('relatednotes', 'videos', 'role'));
    }

   public function storerelatednote(Request $request)
{
    $request->validate([
        'video_id' => 'required|exists:videos,id',
        'related_notes.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:2048',
    ]);

    $filesArray = [];

    if ($request->hasFile('related_notes')) {

        foreach ($request->file('related_notes') as $file) {

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('related_notes'), $filename);

            $filesArray[] = $filename;
        }
    }

    RelatedNote::create([
        'video_id' => $request->video_id,
        'related_notes' => implode(',', $filesArray),
    ]);

    return redirect()->back()->with('success', 'Related note created successfully!');
}

   public function relatednoteedit(Request $request)
{
    $request->validate([
        'id' => 'required|exists:related_notes,id',
        'video_id' => 'required|exists:videos,id',
        'related_notes.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:2048',
    ]);

    $relatednote = RelatedNote::findOrFail($request->id);

    $filesArray = [];

    if ($request->hasFile('related_notes')) {

        foreach ($request->file('related_notes') as $file) {

            $filename = time().'_'.$file->getClientOriginalName();

            $file->move(public_path('related_notes'), $filename);

            $filesArray[] = $filename;
        }

        $relatednote->related_notes = implode(',', $filesArray);
    }

    $relatednote->video_id = $request->video_id;

    $relatednote->save();

    return redirect()->back()->with('success', 'Related note updated successfully!');
}
}