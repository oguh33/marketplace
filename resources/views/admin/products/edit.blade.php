@extends('layouts.app')

@section('content')
<h1>Atualizar loja</h1>
    <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post">
      @csrf 
      <!-- pode ser usado com o html 
            <input type="hidden" name="_token" value="{{csrf_token()}}">  
            ou apenas @csrf -->

    @method("PUT")
    <!-- pode ser usado com o html 
            <input type="hidden" name="_method" value="PUT">
            ou apenas @method("PUT") -->
    <div class="form-group">
        <label>Nome Loja</label>
        <input type="text" name="name" class="form-control" value="{{$product->name}}">
    </div>
    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="description" class="form-control" value="{{$product->description}}">
    </div>
    <div class="form-group">
        <label>Conteúdo</label>
        <textarea name="body" id="" class="form-control" cols="30" rows="10">{{$product->body}}</textarea>
    </div>
    <div class="form-group">
        <label>Preço</label>
        <input type="price" name="phone" class="form-control" value="{{$product->price}}">
    </div>

    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{$product->slug}}">
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn lg btn-success">Atualizar produto</button>
    </div>
    </form>
@endsection