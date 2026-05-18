<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Help; 
use App\Models\Customer; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class HelpController extends Controller
{
    public function helplist() { 
        
    $role = Auth::check() ? Auth::user()->role : null; 
    $helps = DB::table('helps') 
    
    ->leftJoin( 'customers', 'helps.cus_id', '=', 'customers.id' ) 
    ->select( 'helps.*', 'customers.phone_number', 'customers.name' ) 
    ->orderBy('helps.id', 'desc') 
    ->get(); 
    
    $customers = Customer::orderBy('id', 'desc')->get(); 
    return view( 'helplist', compact( 'helps', 'customers', 'role' ) );
    } 
    
    public function helpedit(Request $request) { 
        
    $request->validate([ 
    'id' => 'required|exists:helps,id',
    'cus_id' => 'required|exists:customers,id', 
    'request' => 'nullable|string', 
    'answer' => 'nullable|string', 
    ]); 
    
    $help = Help::findOrFail($request->id); 
    
    $help->cus_id = $request->cus_id; 
    $help->request = $request->request; 
    $help->answer = $request->answer; 
    $help->save(); 
    
    return redirect()->back()->with( 'success', 'Help updated successfully!' ); }
}
