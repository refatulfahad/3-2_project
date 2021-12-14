<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use PDF;
use DB;
class OrdersController extends Controller
{
  public function __construct(){
     $this->middleware('auth:admin');
   }
    public function index(){
    $orders=Order::orderBy('id','desc')->get();
      return view('backend.pages.orders.index',compact('orders'));
    }
    public function show($id){
      $orders=Order::find($id);
      $orders->is_seen_by_admin=1;
        $orders->save();
      return view('backend.pages.orders.show',compact('orders'));
    }
     public function completed($id)
    {
      // code...
      $order=Order::find($id);
      if ($order->is_completed) {
        $order->is_completed=0;
      }
      else{
        $order->is_completed=1;
      }
      $order->save();
      session()->flash('success','Order completed status changed ..!');
      return back();
    }

    public function chargeUpdate(Request $request, $id)
   {
     // code...
     $order=Order::find($id);
       $order->shipping_charge=$request->shipping_charge;
       $order->custom_discount=$request->custom_discount;
     $order->save();
     session()->flash('success','Order charge and discount has changed ..!');
     return back();
   }

   public function generateInvoice($id)
  {
    // code...
    $order=Order::find($id);
    //return view('backend.pages.orders.invoice', compact('order'));
    $pdf = PDF::loadView('backend.pages.orders.invoice', compact('order'));
      return $pdf->stream('invoice.pdf');
      //$pdf->download('invoice.pdf');

  }
    public function paid($id)
   {
     // code...
     $order=Order::find($id);
     if ($order->is_paid) {
       $order->is_paid=0;
     }
     else{
       $order->is_paid=1;
     }
     $order->save();
     session()->flash('success','Order completed status changed ..!');
     return back();
   }
  public function delete($id)
  {
    $order = Order::find($id);
    if (!is_null($order)) {
      $order->delete();
    }else {
      return redirect()->route('orders');
    }
    session()->flash('success', 'Order  has deleted !!');
    return back();
  }
}
