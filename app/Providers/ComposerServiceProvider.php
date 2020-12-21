<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $categories = \App\Category::all(['name', 'slug']);

        /**
         * a variavel categories fica disponivel em todas as views
         * /
        //view()->share('categories', $categories);

        /**
         * Outra forma de compartilhar uma valor com as views e via composer
         * essa opcao vc pode compartilhar para uma, duas, ... ou todas '*' as views
         */
//        view()->composer('*', function($view) use($categories){
//           $view->with('categories', $categories);
//        });

        /**
         * Usando o composer sem a funcao anonima
         * Chamando uma class
         */
        view()->composer('*', 'App\Http\Views\CategoryViewComposer@compose');
    }
}
