<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function customerlist()
    {
        $role = Auth::check() ? Auth::user()->role : null;

        $customers = Customer::orderBy('id', 'desc')->get();

        return view('customerlist', compact('customers', 'role'));
    }

    public function storecustomer(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:20',
            'otp'          => 'nullable|string|max:10',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/customers'),
                $imageName
            );
        }

        Customer::create([
            
            'name' => $request->name,
            'qualification' => $request->qualification,
            'phone_number' => $request->phone_number,
            'otp'          => $request->otp,
            'image'        => $imageName,
        ]);

        return redirect()->back()->with(
            'success',
            'Customer created successfully!'
        );
    }

    public function customeredit(Request $request)
    {
        $request->validate([

            'id'           => 'required|exists:customers,id',
            'name' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:20',
            'otp'          => 'nullable|string|max:10',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $customer = Customer::findOrFail($request->id);

        if ($request->hasFile('image')) {

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/customers'),
                $imageName
            );

            $customer->image = $imageName;
        }
        $customer->name = $request->name;
        $customer->qualification = $request->qualification;
        $customer->phone_number = $request->phone_number;
        $customer->otp = $request->otp;

        $customer->save();

        return redirect()->back()->with(
            'success',
            'Customer updated successfully!'
        );
    }

    public function customerprofile($id)
{
    $role = Auth::check() ? Auth::user()->role : null;

    $customer = Customer::findOrFail($id);

    // Subscription Details
    $subscriptions = DB::table('subscriptions')

        ->leftJoin(
            'sub_plans',
            'subscriptions.subscription_id',
            '=',
            'sub_plans.id'
        )

        ->select(
            'subscriptions.*',
            'sub_plans.plan_name',
            'sub_plans.amount'
        )

        ->where('subscriptions.cus_id', $id)

        ->get();

    // Watch History
    $watchhistory = DB::table('watch_history')

        ->leftJoin(
            'videos',
            'watch_history.video_id',
            '=',
            'videos.id'
        )

        ->select(
            'watch_history.*',
            'videos.title as video_title'
        )

        ->where('watch_history.cus_id', $id)

        ->get();

    // Favorites
    $favorites = DB::table('favorites')

        ->leftJoin(
            'videos',
            'favorites.video_id',
            '=',
            'videos.id'
        )

        ->select(
            'favorites.*',
            'videos.title as video_title'
        )

        ->where('favorites.cus_id', $id)

        ->get();

    return view(
        'customer_profile',
        compact(
            'customer',
            'subscriptions',
            'watchhistory',
            'favorites',
            'role'
        )
    );
}
}
