@extends('layouts.customer.master')
@section('content')

<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if(isset($cartItems) && $cartItems->count() > 0)
                <div class="shoping__cart__table">
                    <table>
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">{{ __('messages.product') }}</th>
                                <th class="text-center">{{ __('messages.image') }}</th>
                                <th class="text-center">{{ __('messages.price') }}</th>
                                <th class="text-center">{{ __('messages.quantity') }}</th>
                                <th class="text-center">{{ __('messages.subtotal') }}</th>
                                <th class="text-center">{{ __('messages.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp 
                            @foreach($cartItems as $cartItem)
                                @php 
                                    $product = $cartItem->product;
                                    $price = $product->price;
                        
                                    // Check for active Big Sale for each product in the cart
                                    $activeBigSale = App\Models\BigSale::where('status', true)
                                        ->where('start_time', '<=', now())
                                        ->where('end_time', '>=', now())
                                        ->whereHas('products', function ($query) use ($product) {
                                            $query->where('t_product.id', $product->id);
                                        })
                                        ->first();
                        
                                    if ($activeBigSale) {
                                        // Apply Big Sale discount
                                        if ($activeBigSale->discount_amount) {
                                            $price = $product->price - $activeBigSale->discount_amount;
                                        } elseif ($activeBigSale->discount_percentage) {
                                            $price = $product->price - ($activeBigSale->discount_percentage / 100) * $product->price;
                                        }
                                    } elseif ($product->discount_price) {
                                        // Use product-specific discount price if no Big Sale
                                        $price = $product->discount_price;
                                    }
                        
                                    $subtotal = $price * $cartItem->quantity;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td class="shoping__cart__item align-middle text-center">
                                        {{ $product->name ?? __('messages.product_name_unavailable') }}

                                        @if ($activeBigSale)
                                            <span class="badge bg-success text-white">Big Sale</span>
                                        @endif
                                    </td>
                                    <td class="shoping__cart__item align-middle text-center">
                                        <img src="{{ asset($product->images->first()->images ?? 'default.png') }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 100px;">
                                    </td>
                                    <td class="shoping__cart__price align-middle text-center">
                                        Rp {{ number_format($price, 0, ',', '.') }}
                                    </td>
                                    <td class="shoping__cart__quantity align-middle text-center">
                                        <input type="number" name="quantity" value="{{ $cartItem->quantity }}" class="form-control quantity" data-id="{{ $cartItem->id }}" data-max="{{ $product->stock }}" min="1" style="width: 70px; padding: 8px; text-align: center; margin: 0 auto; border-radius: 8px; border: 1px solid #ced4da; box-shadow: 0px 2px 5px rgba(0,0,0,0.1);"
                                        onchange="updateQuantity(this)">
                                    </td>                                    
                                    <td class="shoping__cart__total subtotal align-middle text-center" data-id="{{ $cartItem->id }}">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="removeFromCart({{ $cartItem->id }})">
                                            {{ __('messages.remove') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="shoping__checkout">
                                <h5>{{ __('messages.cart_total') }}</h5>
                                <ul>
                                    <li>{{ __('messages.total') }} <span id="total">Rp {{ number_format($total, 0, ',', '.') }}</span></li>
                                </ul>

                                @if(auth()->user()->userAddresses->isNotEmpty())
                                <form action="{{ route('customer.checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn text-white" style="background: #416bbf;">{{ __('messages.proceed_to_checkout') }}</button>
                                </form>
                            @else
                                <p class="text-danger">{{ __('messages.complete_address_data') }}</p>
                                <a href="{{ route('user.create') }}" class="btn text-white" style="background: #416bbf;">{{ __('messages.fill_address_data') }}</a>
                            @endif
                            
                            </div>
                        </div>
                    </div>

                @else
                <div class="card mb-3 mt-4 shadow rounded border-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center" style="min-height: 300px;">
                        <h5 class="mb-1">{{ __('messages.cart_empty') }}</h5>
                        <a href="{{ route('shop') }}" class="btn text-white mt-3" style="background-color: #416bbf;">{{ __('messages.shop_now') }}</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    function updateQuantity(element) {
    let quantity = parseInt(element.value);
    let cartItemId = element.getAttribute('data-id');
    let maxQuantity = parseInt(element.getAttribute('data-max'));

    if (quantity > maxQuantity) {
        quantity = maxQuantity;
        element.value = quantity;
    } else if (quantity < 1) {
        quantity = 1;
        element.value = quantity;
    }

    $.ajax({
        url: '/cart/update',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: cartItemId,
            quantity: quantity
        },
        success: function(response) {
            if (response.success) {
                document.querySelector(`.subtotal[data-id="${cartItemId}"]`).textContent = 'Rp ' + response.subtotal.toLocaleString();
                document.getElementById('total').textContent = 'Rp ' + response.total.toLocaleString();
            } else {
                alert(response.message || 'Could not update quantity. Please try again.');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error, xhr.responseText);
            alert('An error occurred while updating the cart. Please try again.');
        }
    });
}


</script>

<script>
    function removeFromCart(cartItemId) {
        console.log("Attempting to remove item from cart:", cartItemId);

        $.ajax({
            url: `/customer/cart/remove/${cartItemId}`, // Updated URL to match the route
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}' // Include CSRF token for security
            },
            success: function(response) {
                console.log("AJAX call success response:", response); // Log the full response

                if (response.success) {
                    $(`tr[data-id="${cartItemId}"]`).remove(); // Remove item row from the table
                    location.reload(); // Optionally reload to update totals
                } else {
                    alert("Failed to remove item from cart: " + (response.message || "Unknown error."));
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX error details:", {
                    status: status,
                    error: error,
                    responseText: xhr.responseText
                });

                // Display the error message from the server response if available
                const errorMessage = xhr.responseJSON?.message || "An error occurred. Please try again.";
                alert(errorMessage);
            }
        });
    }
</script>

@endsection
