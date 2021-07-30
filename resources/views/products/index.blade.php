@extends('layouts.master')

@section('content')
    @foreach ($products as $product)
    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2" style="color:#44983a">
                    @foreach ($product->categories as $category)
                        {{ $category->name }}
                    @endforeach
                </strong>
                <h5 class="mb-0">{{ $product->title }}</h5>
                {{-- <div class="mb-1 text-muted"> {{ $product->created_at->format('d-m-Y') }}</div> --}}
                <p class="card-text mb-auto">{{ $product->subtitle }}</p>
                <strong class="card-text mb-auto" style="font-weight: 400; font-size:30px">{{ $product->getPrice() }} <small style="font-size:18px">/ Kg</small></strong>
                <a href=" {{ route('products.show', $product->slug) }}" " class="stretched-link btn btn-primary" style="background-color: #37a09c; border:none">Voir le produit</a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <img src="{{ asset('storage/' .$product->image) }}" alt="" srcset="" style="width:200px; height:250px; margin-right:15px">
            </div>
        </div>
    </div>
    @endforeach

    {{ $products->appends(request()->input())->links() }}
@endsection