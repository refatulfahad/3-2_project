<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
  public function index(){
    $products=Product::orderBy('id','desc')->paginate(9);
    return view('frontend.pages.product.index')->with('products',$products);
  }

  public function show($slug){
  /*  $products=Product::orderBy('id','desc')->get();
    return view('pages.product.index')->with('products',$products);*/
      $product=Product::where('slug',$slug)->first();
      //dd($product);
      if(!is_null($product)){
         return view('frontend.pages.product.show',compact('product'));
        //return view('frontend.pages.product.show');

      }
      else{
        session()->flash('errors','Sorry !! There is no product by ths URL..');
        return redirect()->route('products');
      }
  }
}
