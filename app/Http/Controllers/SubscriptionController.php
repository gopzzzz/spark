<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Customer;
use App\Models\SubPlan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
   public function subscriptionlist()
{
    $role = Auth::check() ? Auth::user()->role : null;

    $subscriptions = DB::table('subscriptions')

        ->leftJoin(
            'customers',
            'subscriptions.cus_id',
            '=',
            'customers.id'
        )

        ->leftJoin(
            'sub_plans',
            'subscriptions.subscription_id',
            '=',
            'sub_plans.id'
        )

        ->select(
            'subscriptions.*',
            'customers.phone_number',
            'sub_plans.plan_name'
        )

        ->orderBy('subscriptions.id', 'desc')
        ->get();

    $customers = Customer::orderBy('id', 'desc')->get();

    $subplans = SubPlan::orderBy('id', 'desc')->get();

    return view(
        'subscriptionlist',
        compact(
            'subscriptions',
            'customers',
            'subplans',
            'role'
        )
    );
}

    public function storesubscription(Request $request)
    {
        $request->validate([
            'cus_id' => 'required|exists:customers,id',
            'subscription_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        Subscription::create([
            'cus_id' => $request->cus_id,
            'subscription_id' => $request->subscription_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->back()->with(
            'success',
            'Subscription created successfully!'
        );
    }

    public function subscriptionedit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:subscriptions,id',
            'cus_id' => 'required|exists:customers,id',
            'subscription_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $subscription = Subscription::findOrFail($request->id);

        $subscription->cus_id = $request->cus_id;
        $subscription->subscription_id = $request->subscription_id;
        $subscription->start_date = $request->start_date;
        $subscription->end_date = $request->end_date;

        $subscription->save();

        return redirect()->back()->with(
            'success',
            'Subscription updated successfully!'
        );
    }
}