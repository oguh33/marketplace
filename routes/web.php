<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/model', function(){
    
    //$products = \App\Product::all(); // select * from Products

    // Ao instanciar como um novo objeto o metodo save ira salvar um novo registro.
    //$user = new \App\User(); 
    // Ao buscar um registro e usar o metodo save ira editar o registro.
    //$user = \App\User::find(1);
    //$user->save(); //Salva os dados acima no banco de forma automatica

    // \App\User::All(); //Busca todos os registros da tabela
    // \App\User::find(5); //Busca apenas o registro do id informado
    // \App\User::where('name', 'Hugo'); // Busca usando o condicional
    // \App\User::paginate(20); //Já busca e retorna a paginacao pronta

    /**
     * Abaixo usando o metodo Mass Assignment - Atribuição em massa.
     */

    //  $user = \App\User::create([
    // 'name' => 'Nome user',
    // 'email' => 'email@gmail.com',
    // 'password' => bcrypt('1233445566')
    //  ]);
     
    // EDITANDO COM MASS UPDATE
    // $user = \App\User::find(83);
    // $user->update([
    //     'name' => 'Atualizando nome com mass update'
    // ]);

    //Criar uma loja para um usuário
    // $user = \App\User::find(10);
    // $store = $user->store()->create([
    //     'name' => 'Nome da loja',
    //     'description' => 'Loja de produtos de informática',
    //     'mobile_phone' => 'xx xxxx-xxx',
    //     'phone' => 'xx xxxx-xxx',
    //     'slug' => 'nome-da-loja',
    // ]);    
    
    //Criar um produto para uma loja
    // $store = \App\Store::find(41);
    // $product = $store->products()->create([
    //     'name' => 'Notebook Dell',
    //     'description' => 'CORE I5',
    //     'body' => 'Uma descrição com detalhes inclusive html',
    //     'price' => 2999.90,
    //     'slug' => 'notebook-dell',
    // ]);    

    //Criar uma categoria
    // \App\Category::create([
    //          'name' => 'Games',
    //          'description' => null,
    //          'slug' => 'games',
    //  ]);
    
    //  \App\Category::create([
    //          'name' => 'Notebooks',
    //          'description' => null,
    //          'slug' => 'notebooks',
    //  ]);

    //     return (\App\Category::All());

    //Adicionar um produto para uma categoria ou vice-versa

    // $product = \App\Product::find(48);
    // dd($product->categories()->sync([2]));

    return \App\User::All();
});

/**
 * DEFINIÇÃO DE ROTA TRADICIONAL
 */
//Route::get('/admin/stores', 'Admin\\StoreController@index');
//Route::get('/admin/stores/create', 'Admin\\StoreController@create');
//Route::post('/admin/stores/store', 'Admin\\StoreController@store');

/**
 * DEFININDO ROTA COM PREFIXO E NAMESPACE
 */

 Route::group(['middleware'=> ['auth']], function(){
     
     Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){
         
         /* Route::prefix('stores')->name('stores.')->group(function(){

             Route::get('/', 'StoreController@index')->name('index');
             Route::get('/create', 'StoreController@create')->name('create');
             Route::post('/store', 'StoreController@store')->name('store');
             Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
             Route::post('/update/{store}', 'StoreController@update')->name('update');
             Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
             
            }); */
            
            
        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
    
    });
});

Auth::routes();