<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WatchHistory;
use App\Models\Customer;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WatchHistoryController extends Controller
{
    public function watchhistorylist()
    {
        $role = Auth::check() ? Auth::user()->role : null;

        $watchhistory = DB::table('watch_history')

            ->leftJoin('customers', 'watch_history.cus_id', '=', 'customers.id')

            ->leftJoin('videos', 'watch_history.video_id', '=', 'videos.id')

            ->select(
                'watch_history.*',
                'customers.phone_number',
                'videos.title as video_title'
            )

            ->orderBy('watch_history.id', 'desc')
            ->get();

        $customers = Customer::orderBy('id', 'desc')->get();

        $videos = Video::orderBy('id', 'desc')->get();

        return view(
            'watchhistorylist',
            compact(
                'watchhistory',
                'customers',
                'videos',
                'role'
            )
        );
    }

    public function storewatchhistory(Request $request)
    {
        $request->validate([
            'cus_id' => 'required|exists:customers,id',
            'video_id' => 'required|exists:videos,id',
        ]);

        WatchHistory::create([
            'cus_id' => $request->cus_id,
            'video_id' => $request->video_id,
        ]);

        return redirect()->back()->with(
            'success',
            'Watch history added successfully!'
        );
    }

    public function watchhistoryedit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:watch_history,id',
            'cus_id' => 'required|exists:customers,id',
            'video_id' => 'required|exists:videos,id',
        ]);

        $watchhistory = WatchHistory::findOrFail($request->id);

        $watchhistory->cus_id = $request->cus_id;
        $watchhistory->video_id = $request->video_id;

        $watchhistory->save();

        return redirect()->back()->with(
            'success',
            'Watch history updated successfully!'
        );
    }
}