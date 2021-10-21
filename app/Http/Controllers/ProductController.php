<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use Stripe\Product;
use Stripe\Stripe;

class ProductController extends Controller
{
    public function index(){
        $products=Products::all();
        $cartitems=0;
        $cartcount=$this->getcartcount();
        return view('ecom.index',compact('products','cartcount'));
        
    }
    public function getcartcount(){
        $userid=Auth::id();
        $cart=DB::table('cart')->where('user_id',$userid)->join('products','cart.product_id','=','products.id')->get();
        $cartcount=$cart->count();
        return $cartcount;
    }
    public function addtocart(Request $data){
     $productid=$data['cartvalue'];
     $userid=Auth::id();
     $ifpoductexistsincart=DB::table('cart')->where('user_id',$userid)->where('product_id',$productid)->count();
     
     if($ifpoductexistsincart){
         $qty=DB::table('cart')->select('qty')->where('user_id',$userid)->where('product_id',$productid)->get('qty')->toArray();
         $newquantity=intval($qty[0]->qty)+1;
         $cart=DB::table('cart')->where('user_id',$userid)->where('product_id',$productid)->update([
            'qty'=>$newquantity
         ]);
        }
     else
     {
         $cart=new Cart();
         $cart->product_id=$productid;
         $cart->user_id=$userid;
         $cart->qty=1;
         $cart->save();
     }
    
    }
    public function getcart(){
        $userid=Auth::id();
        $cart=DB::table('cart')->where('user_id',$userid)->join('products','cart.product_id','=','products.id')->get();
        $cartcount=$this->getcartcount();
        //$cart=Cart::where('user_id',$userid)->get();
        return view('ecom.cart',compact('cart','cartcount'));

    }
    public function createcheckoutsession(){
        $userid=Auth::id();
         $cart=DB::table('cart')->where('user_id',$userid)->join('products','cart.product_id','=','products.id')->get();
         $total=$cart->sum(function($item){
            return ($item->price*$item->qty);
        });
        $totalitems=$cart->sum('qty');
       
         \Stripe\Stripe::setApiKey('sk_test_51JgV91SBcRkJHfrIaAVrX4UjgXcIEeHjqZy5N9H6pWZpZ0CdypXdk9K9tmqKC7cxtarhNM48VEHBriXw0tUViTpk00n1sAGQVY');
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'inr',
                'product_data' => [
                  'name' => 'products',
                ],
                'unit_amount_decimal'=>$total,
              ],
              'quantity' => $totalitems,
              
            ]],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
          ]);
          return redirect($session->url)->with('status',303);

    }
    public function product(Request $request){
     $product=Products::find($request->id);
     $cartcount=$this->getcartcount();
     return view('ecom.product',compact('product','cartcount'));
    }
}
