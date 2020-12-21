@extends('layouts/front')

@section('content')
    <div class="row front">
        @foreach($products as $key => $prod)
            <div class="col-md-4">
                <div class="card" style="width: 100%;">
                    @if($prod->photos->count())
                        <img src="{{asset('storage/'.$prod->photos->first()->image)}}" alt="" class="card-img-top" />
                    @else
                        <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top" />
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$prod->name}}</h5>
                        <p class="card-text">
                            {{$prod->description}}
                         </p>
                        <h3>{{'R$ '.number_format($prod->price, '2', ',', '.')}}</h3>
                        <a href="{{route('product.single', ['slug'=>$prod->slug])}}" class="btn btn-success">Ver produto</a>
                    </div>
                </div>
            </div>
            @if(($key + 1) % 3 == 0) </div><div class="row front"> @endif
        @endforeach
    </div>
    <div class="row">
        <div class="col-12">
            <h2>Lojas destaques</h2>
            <hr />
        </div>
        @foreach($stores as $store)
        <div class="col-4">
            @if($store->logo)
            <img src="{{asset('storage/'.$store->logo)}}" alt="Logo da loja {{$store->name}}" class="img-fluid" />
            @else
                <img src="https://via.placeholder.com/400X100.png?text=logo" class="img-fluid">
            @endif
            <h3>{{$store->name}}</h3>
            <p>
                {{$store->description}}
            </p>
            <a href="{{route('store.single', ['slug'=>$store->slug])}}" class="btn btn-success">Ver loja</a>
        </div>
         @endforeach
    </div>
@endsection
