@extends('layouts.master')
@section('content')
<div class="checkout-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="checkout-accordion-wrap">
                    <div class="accordion" id="accordionExample">
                        <div class="card single-accordion">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Billing Address
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="billing-address-form">
                                        <form action="{{ route('storeorder') }}" method="post" id="store-order" name="store-order">
                                            @csrf
                                            <p><input type="text" id="name" name="name" placeholder="Name" required></p>
                                            <p><input type="email" id="email" name="email" placeholder="Email" required>
                                            </p>
                                            <p><input type="text" id="addres" name="addres" placeholder="Addres"
                                                    required></p>
                                            <p><input type="tel" id="phone" name="phone" placeholder="Phone" required>
                                            </p>
                                            <p><textarea name="note" id="note" cols="30" rows="10"
                                                    placeholder="Say Something"></textarea></p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card single-accordion">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Cart Details
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="card-details">
                                        <div class="cart-section mt-150 mb-150">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-12">
                                                        <div class="cart-table-wrap">
                                                            <table class="cart-table">
                                                                <thead class="cart-table-head">
                                                                    <tr class="table-head-row">
                                                                        <th class="product-remove"></th>
                                                                        <th class="product-image">Product Image</th>
                                                                        <th class="product-name">Name</th>
                                                                        <th class="product-price">Price</th>
                                                                        <th class="product-quantity">Quantity</th>
                                                                        <th class="product-total">Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($cartProducts as $item)


                                                                    <tr class="table-body-row">
                                                                        <td class="product-remove"><a
                                                                                href="/deletecartitem/{{ $item->id }}"><i
                                                                                    class="far fa-window-close"></i></a>
                                                                        </td>
                                                                        <td class="product-image"><img
                                                                                src="{{ asset($item->product->imagepath) }}"
                                                                                alt=""></td>
                                                                        <td class="product-name"> <a
                                                                                href="/single-product/{{ $item->product->id }}">
                                                                                {{ $item->product->name }} </a></td>
                                                                        <td class="product-price">
                                                                            {{ $item->product->price }} $</td>
                                                                        <td class="product-quantity">
                                                                            {{ $item->quantity }}</td>
                                                                        <td class="product-total">
                                                                            {{ $item->product->price * $item->quantity }}
                                                                            $</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="total-section">
                                                            <table class="total-table">
                                                                <thead class="total-table-head">
                                                                    <tr class="table-total-row">
                                                                        <th>Total</th>
                                                                        <th>Price</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <tr class="total-data">

                                                                        <td><strong>Total: </strong></td>
                                                                        <td>
                                                                            {{$cartProducts->sum(function($item){
                                        return $item->product->price * $item->quantity;
                                    });}} $
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <div class="cart-buttons">
                        <a onclick="event.preventDefault(); document.getElementById('store-order').submit();"
                            class="boxed-btn black">Place order</a>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick" />
                            <input type="hidden" name="hosted_button_id" value="XN6XXDGAYLVBE" />
                            <input type="hidden" name="currency_code" value="EUR" />
                            <input type="image" src="https://www.paypalobjects.com/en_US/NL/i/btn/btn_buynowCC_LG.gif"
                                class="mt-4 w-25" name="submit" title="PayPal - The safer, easier way to pay online!"
                                alt="Buy Now" />
                        </form>
                        <form action="{{route('mollie')}}" method="post">
                            @csrf
                            <input type="hidden" name="product_name" value={{ $item->product->name }}>
                            <input type="hidden" name="quantity" value={{ $item->quantity }}>
                            <input type="hidden" name="id" value={{ $item->id }}>
                            <input type="hidden" name="price" value= {{$cartProducts->sum(function($item){
                                        return $item->product->price * $item->quantity;
                                    });}}.00>
                            <button type="submit">Pay with Mollie </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>


@endsection
