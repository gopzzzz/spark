<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uploads;
use App\Models\Blogs;
use App\Models\Books;
use App\Models\Order_bookings;
use App\Models\Video;
use App\Models\Customer;
use App\Models\Help;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function admin(){
        return view('auth.login');
    }
    public function createblogs(){
         $blogs = Blogs::orderBy('id', 'DESC')->get();
         return view('blogs',compact('blogs'));
    }
    public function createbooks(){
          $books = Books::orderBy('id', 'DESC')->get();
          return view('books',compact('books'));
    }
    public function uploads(){
         $images=DB::table('uploads')->get();
         return view('uploads',compact('images'));
    }
    public function uploadimage(Request $request){
        
  // Validate the request input
    $validated = $request->validate([
        'appname' => 'required',
    ]);

    try {
        // Store the file
            $file = $request->file('appname');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images'), $filename);

           
        // Create a new instance of the Apps model
        $apps = new Uploads();
        $apps->image = $filename;
        $apps->gallary=$request->gallary;
        $apps->save();

        return back()->with('success', 'Image uploaded successfully!');
    } catch (\Exception $e) {
        // Handle errors and return a failure response
        return back()->with('error', 'Failed to upload the Image. ' . $e->getMessage());
    }
    }

public function dashboard()
{
    $role = Auth::check() ? Auth::user()->role : null;

    // Total Videos
    $totalVideos = Video::count();

    // Total Customers
    $totalCustomers = Customer::count();

    // Turn Over
    $turnOver = DB::table('subscriptions')

        ->leftJoin(
            'sub_plans',
            'subscriptions.subscription_id',
            '=',
            'sub_plans.id'
        )

        ->sum('sub_plans.amount');

    // Help Desk Count
    $helpDesk = Help::count();

    return view(
        'dashboard',
        compact(
            'role',
            'totalVideos',
            'totalCustomers',
            'turnOver',
            'helpDesk'
        )
    );
}

    public function insertblog(Request $request){
     
   
    try {
       
        $apps = new Blogs();
        $apps->image =$request->image;
        $apps->heading=$request->heading;
        $apps->description=$request->desc;
        $apps->save();

        return back()->with('success', 'Blog Inserted successfully!');
    } catch (\Exception $e) {
        // Handle errors and return a failure response
        return back()->with('error', 'Failed to insert the blog. ' . $e->getMessage());
    } 
    }
    public function insertbooks(Request  $request){
         
    try {
       
        $apps = new Books();
        $apps->book_image =$request->cover;
      
        $apps->title=$request->heading;
        $apps->desc=$request->desc;
        $apps->price=$request->price;
         $apps->link=$request->link;
        $apps->save();

        return back()->with('success', 'Books Inserted successfully!');
    } catch (\Exception $e) {
        // Handle errors and return a failure response
        return back()->with('error', 'Failed to insert the Book. ' . $e->getMessage());
    } 
    }

    public function toggleGallary($id)
{
    $img = Uploads::find($id);

    if(!$img){
        return back()->with('error', 'Image not found');
    }

    // Toggle logic
    if($img->gallary == NULL){
        $img->gallary = 1;   // Add to gallery
    } else {
        $img->gallary = NULL; // Remove from gallery
    }

    $img->save();

    return back()->with('success', 'Gallery updated successfully');
}

 public function blogfetch(Request $request){
    $id=$request->id;
    $apps=Blogs::find($id);
    print_r(json_encode($apps));
    }
    public function editblogs(Request $request){

    try {
        $id=$request->id;
        $apps =Blogs::find($id);
        $apps->image =$request->image;
        $apps->heading=$request->heading;
        $apps->description=$request->desc;
        $apps->save();

        return back()->with('success', 'Blog Updated successfully!');
    } catch (\Exception $e) {
        // Handle errors and return a failure response
        return back()->with('error', 'Failed to Updated the blog. ' . $e->getMessage());
    } 
    }
    public function bookfetch(Request $request){
  $id=$request->id;
    $apps=Books::find($id);
    print_r(json_encode($apps));
    }
    public function orderfetch(Request $request){
     $id=$request->id;
    $apps=Order_bookings::find($id);
    print_r(json_encode($apps));
        
    }
    public function editbooks(Request $request){
        try {
        $id=$request->id;
        $apps =Books::find($id);
        $apps->book_image =$request->cover;
      
        $apps->title=$request->heading;
          $apps->desc=$request->desc;
            $apps->price=$request->price;
            $apps->link=$request->link;
        $apps->save();

        return back()->with('success', 'Books Updated successfully!');
    } catch (\Exception $e) {
        // Handle errors and return a failure response
        return back()->with('error', 'Failed to Updated the Book. ' . $e->getMessage());
    } 
    }
    public function deleteblog($id){
       
    $app = Blogs::findOrFail($id);
    $app->delete();

    return back()->with('success', 'Blog deleted successfully!');
    }

    public function deletebooks($id){
    $app = Books::findOrFail($id);
    $app->delete();

    return back()->with('success', 'Books deleted successfully!');
    }
    public function orderlist(){
        $orders = Order_bookings::leftJoin('books', 'order_bookings.book_id', '=', 'books.id')
            ->orderBy('order_bookings.orderid', 'DESC')
            ->select('order_bookings.*', 'books.title', 'books.price') // add columns you need
            ->paginate(20);
         return view('orders',compact('orders'));
    
    }
    public function editorder(Request $request){
           try {
        $id=$request->id;
        $apps =Order_bookings::find($id);
        $apps->status =$request->status;
        $apps->deliverynote =$request->deliverynote;
        $apps->save();

        return back()->with('success', 'Books Updated successfully!');
    } catch (\Exception $e) {
        // Handle errors and return a failure response
        return back()->with('error', 'Failed to Updated the Book. ' . $e->getMessage());
    } 
    }

}
