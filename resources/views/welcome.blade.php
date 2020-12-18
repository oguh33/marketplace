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
@endsection
