<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SalesItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function index()
     {
         $totalProducts = Product::count();
         $totalSales = SalesItem::count();
         $totalSuppliers = Supplier::count();
         $totalInvoices = Sale::count();

         // Fetch monthly sales data from the sales table
        //  $monthlySales = SalesItem::selectRaw('SUM(total_price) as total_amount, Month(created_at) as Month')
        //      ->groupBy(DB::raw('Month(created_at)'))
        //      ->get();

             $monthlySales = SalesItem::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
             ->sum('total_price');
             $weeklySales = SalesItem::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
             ->sum('total_price');
             $todaySales = SalesItem::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
             ->sum('total_price');

$lowStockProducts = Product::where('unit', '<', '20')->orderBy('unit', 'asc')->limit(5)->get();
$lowStockProducts50 = Product::whereBetween('unit',  [20, 100])->orderBy('unit', 'asc')->limit(8)->get();
$lowStockProducts100 = Product::whereBetween('unit',  [100, 500])->orderBy('unit', 'asc')->limit(8)->get();


return view('home', compact([
    'monthlySales',
    'weeklySales',
    'todaySales',
    'totalProducts',
    'totalSales',
    'totalSuppliers',
    'totalInvoices',
    'lowStockProducts',
    'lowStockProducts50',
    'lowStockProducts100',

]));



     }

         public function edit_profile(){
              return view('profile.edit_profile');
         }

         public function update_profile(Request $request, $id){

if($request->filled(['first_name', 'last_name', 'email'])){
    $request->validate([
'first_name' => 'required|min:3',
'last_name' => 'required|min:3',
'email' => 'required|email|min:3'
    ]);
}
             $user = User::find($id);
             $user->first_name = $request->first_name;
             $user->last_name = $request->last_name;
             $user->email = $request->email;

             if($request->filled(['image'])){
                $request->validate([

                    'image'=> 'max:300|mimes:jpg, png, jpeg',
                ]);
             }
             if ($request->hasFile('image')){
            //  $image_path ="images/user/".$user->image;
            //  if (file_exists($image_path)){
            //      unlink($image_path);
            //  }
            $existingImagePath = public_path("images/user/{$user->image}");
            if (file_exists($existingImagePath) && is_file($existingImagePath)) {
                unlink($existingImagePath);
            }

             $imageName =request()->image->getClientOriginalName();
             request()->image->move(public_path('images/user/'), $imageName);
             $user->image = $imageName;
         }

         if ($request->filled(['current_password', 'new_password', 'confirm_password'])) {
             // Validate password change fields
             $request->validate([
                 'current_password' => 'required',
                 'new_password' => 'required|min:8|different:current_password',
                 'confirm_password' => 'required|same:new_password',
             ]);

             // Verify if the entered current password matches the actual password
             if (Hash::check($request->current_password, $user->password)) {
                 // Check if the new and confirm passwords match
                 if ($request->new_password !== $request->confirm_password) {
                     return redirect()->back()->with('error', 'New and confirm passwords do not match');
                 }

                 // Hash and update the new password
                 $user->password = Hash::make($request->new_password);
             } else {
                 return redirect()->back()->with('error', 'Incorrect current password');
             }
         }


         $user->save();

         return redirect()->back()->with('success', 'Profile updated successfully');
         }


         // public function update_password(){
         //     return view('profile.password');
         // }

         // public function update_password() {
         //     return view('profile.password', ['token' => $token]);
         // }
     }

