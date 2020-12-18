<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $product;

    public function __construct(Product $product){

        $this->product = $product;
    }

    public function index()
    {
        $products = $this->product->limit(8)->orderBy('id', 'Desc')->get();
        return view('welcome', compact('products'));
    }

    public function single($slug){
        //campo e valor a buscar (funciona)
        //$product = $this->product->where('slug', $slug)->get();

        // aqui o nome do campo fica junto do where iniciando com maiuscula (tbm funfa)
        //O first traz apenas o primeiro registro para trazer todos usar get()

        $product = $this->product->whereSlug($slug)->first();

        return view('single', compact('product'));
    }
}
