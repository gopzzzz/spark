<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubPlan;
use Illuminate\Support\Facades\Auth;

class SubPlanController extends Controller
{
    public function subplanlist()
    {
        $role = Auth::check() ? Auth::user()->role : null;

        $subplans = SubPlan::orderBy('id', 'desc')->get();

        return view(
            'subplanlist',
            compact(
                'subplans',
                'role'
            )
        );
    }

    public function storesubplan(Request $request)
    {
        $request->validate([
            'plan_name'  => 'required|string|max:255',
            'description'=> 'nullable|string',
            'amount'     => 'required|numeric',
            'images'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('images')) {

            $imageName = time() . '.' . $request->images->extension();

            $request->images->move(
                public_path('uploads/subplans'),
                $imageName
            );
        }

        SubPlan::create([
            'plan_name'  => $request->plan_name,
            'description'=> $request->description,
            'amount'     => $request->amount,
            'images'     => $imageName,
        ]);

        return redirect()->back()->with(
            'success',
            'Subscription plan created successfully!'
        );
    }

    public function subplanedit(Request $request)
    {
        $request->validate([
            'id'          => 'required|exists:sub_plans,id',
            'plan_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount'      => 'required|numeric',
            'images'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $subplan = SubPlan::findOrFail($request->id);

        if ($request->hasFile('images')) {

            $imageName = time() . '.' . $request->images->extension();

            $request->images->move(
                public_path('uploads/subplans'),
                $imageName
            );

            $subplan->images = $imageName;
        }

        $subplan->plan_name = $request->plan_name;
        $subplan->description = $request->description;
        $subplan->amount = $request->amount;

        $subplan->save();

        return redirect()->back()->with(
            'success',
            'Subscription plan updated successfully!'
        );
    }
}