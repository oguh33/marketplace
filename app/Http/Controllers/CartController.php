<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        //pega os dados da sessao cart
        $cart = session()->has('cart') ? session()->get('cart') : [];
        //dd($cart);
        return view('cart', compact('cart'));
    }
    public function add(Request $request){
        $productData = $request->get('product');

        $product = \App\Product::whereSlug($productData['slug']);

        if(!$product->count() || $productData['amount'] == 0) return redirect()->route('home');

        $product = array_merge($productData, $product->first(['name', 'price'])->toArray());

        //verifica se o chave cart ja existe na sessao
        if(session()->has('cart')){

            $products = session()->get('cart');
            $productsSlug = array_column($products, 'slug');

            //Checar se ja existe esse produto no carrinho e acrescenta um item
            if( in_array($product['slug'], $productsSlug) ){
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart', $products);
            }else{
                //Add o valor na sessao cart
                session()->push('cart', $product);
            }

        }else{
            $products[] = $product;
            //Cria a sessao cart com o primeiro produto (o segundo parametro tem que ser um array)
            session()->put('cart', $products);
        }

        flash('Produto adicionado no carrinho!')->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }

    public function remove($slug){
        if(!session()->has('cart')){
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');

        $products = array_filter($products, function($line) use ($slug){
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products); //sobrescreve ou criar a sessao cart

        return redirect()->route('cart.index');
    }

    public function cancel(){
        session()->forget('cart');
        flash('Desistência da compra realizada com sucesso!')->success();
        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount, $products){
        $products = array_map(function ($line) use($slug, $amount){
            if($slug == $line['slug']){
                    $line['amount'] += $amount;
            }
            return $line;
        }, $products);

        return $products;
    }
}
