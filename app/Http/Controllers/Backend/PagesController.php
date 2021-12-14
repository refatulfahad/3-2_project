<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Image;
use App\Models\ProductImage;
use App\Models\Product;

class  PagesController extends Controller
{
 public function __construct()
  {
    $this->middleware('auth:admin');
  }
    public function index()
    {
      return view('backend.pages.index');
    }

}
