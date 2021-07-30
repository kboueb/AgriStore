@extends('layouts.master')

@section('content')
<div class="container" style="margin-bottom:50px; margin-top:25px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mes commandes</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach (Auth()->user()->orders as $order)
                        <div class="card mb-3">
                            <div class="card-header">
                                Commande passée le {{ Carbon\Carbon::parse($order->payment_created_at)->format('d/m/Y à H:i')}} d'un montant de <strong>{{ $order->amount .' FCFA' }}</strong>
                            </div>
                            <div class="card-body">
                                <h6>Liste des produits</h6>
                                @foreach (unserialize($order->products) as $product)
                                    <div>Nom du produit: {{ $product[0] }}</div>
                                    <div>Prix: {{ $product[1] }}</div>
                                    <div>Quantité: {{ $product[2] }}</div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection