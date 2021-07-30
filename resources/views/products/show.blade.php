@extends('layouts.master')
@section('content')
<div class="col-md-12">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2" style="color:#44983a">
                @foreach ($product->categories as $category)
                    {{ $category->name }}
                @endforeach
            </strong>
            <h5 class="mb-0">{!! $product->title !!}</h5>
            {{-- <div class="mb-1 text-muted"> {{ $product->created_at->format('d-m-Y') }}</div> --}}
            <p class="card-text mb-2">{!! $product->subtitle !!}</p>
            <strong class="card-text mb-auto" style="font-weight: 400; font-size:30px">{{ $product->getPrice() }} <small style="font-size:18px">/ Kg</small></strong>
            <form action=" {{ route('cart.store') }} " method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                
                <button type="submit" class="stretched-link btn btn-primary" style="background-color: #37a09c; border:none">
                    <i class="fa fa-shopping-cart mr-3"> Ajouter au Panier</i>
                </button>
            </form>
        </div>
        
        <div class="col-auto d-none d-lg-block">
            <img src="{{ asset('storage/'.$product->image) }}" alt="" srcset="" style="width:300px; height:300px; padding-right:20px">
        </div>
    </div>
</div>
@endsection