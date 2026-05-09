<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Customer;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function favoritelist()
    {
        $role = Auth::check() ? Auth::user()->role : null;

        $favorites = DB::table('favorites')

            ->leftJoin('customers', 'favorites.cus_id', '=', 'customers.id')

            ->leftJoin('videos', 'favorites.video_id', '=', 'videos.id')

            ->select(
                'favorites.*',
                'customers.phone_number',
                'videos.title as video_title'
            )

            ->orderBy('favorites.id', 'desc')
            ->get();

        $customers = Customer::orderBy('id', 'desc')->get();

        $videos = Video::orderBy('id', 'desc')->get();

        return view(
            'favoritelist',
            compact(
                'favorites',
                'customers',
                'videos',
                'role'
            )
        );
    }

    public function storefavorite(Request $request)
    {
        $request->validate([
            'cus_id' => 'required|exists:customers,id',
            'video_id' => 'required|exists:videos,id',
        ]);

        Favorite::create([
            'cus_id' => $request->cus_id,
            'video_id' => $request->video_id,
        ]);

        return redirect()->back()->with(
            'success',
            'Favorite created successfully!'
        );
    }

    public function favoriteedit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:favorites,id',
            'cus_id' => 'required|exists:customers,id',
            'video_id' => 'required|exists:videos,id',
        ]);

        $favorite = Favorite::findOrFail($request->id);

        $favorite->cus_id = $request->cus_id;
        $favorite->video_id = $request->video_id;

        $favorite->save();

        return redirect()->back()->with(
            'success',
            'Favorite updated successfully!'
        );
    }
}