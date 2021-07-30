@extends('layouts.master')

@section('extra-script')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('extra-meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="col-md-12 ">
        <a href="{{ route('cart.index') }}" class="btn btn-sm btn-secondary mt-3">Revenir au panier</a>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h4 class="text-center pt-5">Procéder au paiement</h4>
                        <form action=" {{ route('stripe.store')}} " method="post" class="my-4" id="payment-form">
                            @csrf
                            <div id="card-element">
                            <!-- Elements will create input elements here -->
                            </div>
                        
                            <!-- We'll put the error messages in this element -->
                            <div id="card-errors" role="alert"></div>
                        
                            <button class="btn btn-success btn-block mt-3" id="submit" style="width: 100%;margin-bottom:230px;">
                                <i class="fa fa-credit-card" aria-hidden="true"></i> Payer maintenant ({{ Cart::total(0, '', ''). ' XOF' }})
                            </button>
                        </form>
                </div>
            </div>
    </div>
@endsection

@section('extra-js')
    <script>
        //Suppression de la barre de navigation
        document.getElementsByClassName('blog-header')[0].classList.add("d-none");
        document.getElementsByClassName('nav-scroller')[0].classList.add("d-none");

        var stripe = Stripe('pk_test_51IeehvBg9vdZwhePjJPP8ipI8W0FpSXkI6q3rhOauilGQLW2OBqLHNLO826uladPeJ3hoXUbFvLLtblL6UAf8EaF00mJ6djD3C');
        var elements = stripe.elements();
        var style = {
            base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
                "::placeholder": {
                    color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        };
        var card = elements.create("card", { style: style });
        card.mount("#card-element");
        card.addEventListener('change', ({error}) => {
        const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.classList.add('alert', 'alert-warning', 'mt-3');
                displayError.textContent = error.message;
            } else {
                displayError.classList.remove('alert', 'alert-warning', 'mt-3');
                displayError.textContent = '';
            }
        });
    var submitButton = document.getElementById('submit');
    submitButton.addEventListener('click', function(ev) {
    ev.preventDefault();
    submitButton.disabled = true;
    stripe.confirmCardPayment("{{ $clientSecret }}", {
        payment_method: {
            card: card
        }
        }).then(function(result) {
            if (result.error) {
            // Show error to your customer (e.g., insufficient funds)
            submitButton.disabled = false;
            console.log(result.error.message);
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                    var paymentIntent = result.paymentIntent;
                    var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var form = document.getElementById('payment-form');
                    var url = form.action;
                    var redirect = '/merci';
                    fetch(
                        url,
                        {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json, text-plain, */*",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": token
                            },
                            method: 'post',
                            body: JSON.stringify({
                                payment_intent: paymentIntent
                            })
                        }).then((data) => {
                            console.log(data);
                            form.reset();
                            window.location.href = redirect;
                    }).catch((error) => {
                        console.log(error)
                    })
                }
            }
        });
    });
</script>
@endsection