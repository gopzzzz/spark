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
            'related_notes' => 'nullable|string',
        ]);

        RelatedNote::create([
            'video_id' => $request->video_id,
            'related_notes' => $request->related_notes,
        ]);

        return redirect()->back()->with('success', 'Related note created successfully!');
    }

    public function relatednoteedit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:related_notes,id',
            'video_id' => 'required|exists:videos,id',
            'related_notes' => 'nullable|string',
        ]);

        $relatednote = RelatedNote::findOrFail($request->id);

        $relatednote->video_id = $request->video_id;
        $relatednote->related_notes = $request->related_notes;
        $relatednote->save();

        return redirect()->back()->with('success', 'Related note updated successfully!');
    }
}