@extends('layouts.master')

@section('extra-meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    @if (Cart::count() > 0)
    <div class="px-4 px-lg-0">
        <div class="pb-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
      
                <!-- Shopping cart table -->
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="border-0 bg-light">
                          <div class="p-2 px-3 text-uppercase">Produit</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Prix</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Quantité</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Supprimer</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach (Cart::content() as $product)
                      <tr>
                        <th scope="row" class="border-0">
                          <div class="p-2">
                            <img src="{{ $product->model->image }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                            <div class="ml-3 d-inline-block align-middle">
                              <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle nav-link">{{$product->model->title}}</a></h5>
                                <span class="text-muted nav-link font-weight-normal font-italic d-block">
                                  
                                </span>
                            </div>
                          </div>
                        </th>
                        <td class="border-0 align-middle"><strong>{{$product->subtotal(0, '', ''). ' FCFA' }}</strong></td>
                        <td class="border-0 align-middle">
                          <select class="custom-select" name="qty" id="qty" data-id="{{ $product->rowId }}">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ $product->qty == $i ? 'selected' : ''}}>
                                    {{ $i }}
                                </option>
                            @endfor
                          </select>
                        </td>
                        <td class="border-0 align-middle">
                            <form action="{{ route('cart.destroy', $product->rowId) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit"class="text-dark btn btn-light" ><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- End -->
              </div>
            </div>
      
            <div class="row py-5 p-4 bg-white rounded shadow-sm">
              <div class="col-lg-6">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Code Coupon</div>
                <div class="p-4">
                  <p class="font-italic mb-4">Si vous disposez d'un code de bon de réduction, veuillez le saisir dans la case ci-dessous</p>
                  <div class="input-group mb-4 border rounded-pill p-2">
                    <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
                    <div class="input-group-append border-0">
                      <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Appliquer le coupon</button>
                    </div>
                  </div>
                </div>
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions pour le vendeur</div>
                <div class="p-4">
                  <p class="font-italic mb-4">Si vous avez des informations pour le vendeur, vous pouvez les laisser dans la case ci-dessous.</p>
                  <textarea name="" cols="30" rows="2" class="form-control"></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Détail de la commande </div>
                <div class="p-4">
                  <p class="font-italic mb-4">Les frais d'expédition et les frais supplémentaires sont calculés en fonction des valeurs que vous avez saisies.</p>
                  <ul class="list-unstyled mb-4">
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sous-total </strong><strong>{{ Cart::subtotal(0, '', '') . ' FCFA' }}</strong></li>
                    {{-- <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li> --}}
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong>{{ Cart::tax(0, '', '') . ' FCFA' }}</strong></li>
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                      <h5 class="font-weight-bold" style="font-family:Noto Sans; font-weight:bold">{{ Cart::total(0, '', '') . ' FCFA' }}</h5>
                    </li>
                  </ul><a href=" {{ route('stripe.index') }} " class="btn btn-dark rounded-pill py-2 btn-block" style=" width:100%;background-color: #37a09c; border:none">Passez à la caisse</a>
                </div>
              </div>
            </div>
      
          </div>
        </div>
    </div>
    @else
    <div class="col-md-12 text-center">
      <h5>Votre panier est vide pour le moment.</h5>
      <p>Mais vous pouvez visiter la <a href="{{ route('products.index') }}">boutique</a> pour faire votre shopping.
      </p>
    </div>
    @endif
@endsection

@section('extra-js')
<script>
    var qty = document.querySelectorAll('#qty');
    Array.from(qty).forEach((element) => {
        element.addEventListener('change', function () {
            var rowId = element.getAttribute('data-id');
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(`/panier/${rowId}`,
                {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'PATCH',
                    body: JSON.stringify({
                        qty: this.value
                    })
            }).then((data) => {
                console.log(data);
                location.reload();
            }).catch((error) => {
                console.log(error);
            });
        });
    });
</script>
@endsection