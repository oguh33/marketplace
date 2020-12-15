<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function removePhoto(Request $request){
        $namePhoto = $request->get('namePhoto');

        if( Storage::disk('public')->exists($namePhoto) ){
            Storage::disk('public')->delete($namePhoto);
        }

        $removePhoto = ProductPhoto::where('image', $namePhoto);
        $productId = $removePhoto->first()->product_id;

        $removePhoto->delete();

        flash('Arquivo removido com sucesso!')->success();
        return redirect()->route('admin.products.edit', ['product' => $productId]);
    }
}
