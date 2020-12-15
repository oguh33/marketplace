<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    use UploadTrait;
    private $product;

    //Para funcionar se atentar para não usar __constructor e sim construct
    public function __construct(Product $product){

        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userStore = auth()->user()->store;
        $products = $userStore->products()->paginate(10);
//        $products = $this->product->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        $stores = \App\Store::all(['id', 'name']);
        $categories = \App\Category::all(['id','name']);
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $store = auth()->user()->store;
        $product = $store->products()->create($data);

        //Abaixo salva os id do produto e da categoria na tabela associativa
        $product->categories()->sync($data['categories']);

        if($request->hasFile('photos')){ //checa se existe arquivo no campo photos
            $images = $this->imageUpload($request->file('photos'), 'image');
            //insert no banco
            $product->photos()->createMany($images);
        }
        flash('Produto criado com sucesso')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        //$product = $this->product->find($product); Tem que descubrir pq não está funcionando assim.
        $product = $this->product->findOrFail($product);
        $categories = \App\Category::all(['id','name']);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in st                                                                          orage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        $data = $request->all();

        $product = $this->product->find($product);
        $product->update($data);
        $product->categories()->sync($data['categories']);
        if($request->hasFile('photos')){ //checa se existe arquivo no campo photos
            $images = $this->imageUpload($request->file('photos'), 'image');
            //insert no banco
            $product->photos()->createMany($images);
        }

        flash('Produto atualizado com sucesso')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = $this->product->find($product);
        $product->delete();

        flash('Produto removido com sucesso')->success();
        return redirect()->route('admin.products.index');
    }

}
