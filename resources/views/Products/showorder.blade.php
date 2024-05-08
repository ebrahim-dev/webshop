@extends('layouts.master')
@section('content')

<div class="checkout-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="checkout-accordion-wrap">
                    <div class="accordion" id="accordionExample">
                        @foreach ($orders as $item)
                        <div class="card single-accordion">

                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Order number {{ $item->id }}
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="billing-address-form">
                                        <form>
                                            @if ($item->situation=='In progress')
                                            <h4 class="m-4"> <a class="bt btn-success p-2" onclick="return confirm('Are you sure to approve it?')" href="{{ url('approved',$item->id) }}"> Approve </a></h4>
                                            @else
                                            <h4 class="m-4"> <a class="bt btn-primary p-2 " onclick="return confirm('Are you sure to reset it (make it In progress)?')" href="{{ url('reset_order',$item->id) }}"> Reset </a></h4>
                                            @endif
                                            <h4 class="m-4"> <a class="bt btn-danger p-2 " onclick="return confirm('Are you sure to delete it'" href="{{ url('delete_order',$item->id) }}"> Delete </a></h4>
                                            <h4 class="m-4"> <a class="bt btn-danger p-2 " onclick="return confirm('Are you sure to delete it'" href="{{ url('sendemail', $item->orderDetail->first()->order_id) }}"> Send Email </a></h4>
                                            <h3>Customer {{ $item->id }}'s details:</h3>
                                            <p><input type="text" value="{{$item->situation}}" id="name" name="name">
                                            </p>
                                            <p><input type="text" value="{{$item->name}}" id="name" name="name">
                                            </p>
                                            <p><input type="email" value="{{$item->email}}" id="email" name="email">
                                            </p>
                                            <p><input type="text" id="addres" value="{{$item->addres}}" name="addres">
                                            </p>
                                            <p><input type="tel" value="{{$item->phone}}" id="phone" name="phone">
                                            </p>
                                            <p><textarea name="note" id="note" cols="30"
                                                    rows="10"> {{$item->note}} </textarea></p>
                                            <h3>Order-details:</h3>
                                            <p><input type="text" value="Order-date: {{$item->created_at}}"
                                                    id="created_at" name="created_at">
                                            </p>
                                        </form>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <div class="cart-table-wrap">
                                                    <table class="cart-table">
                                                        <thead class="cart-table-head">
                                                            <tr class="table-head-row">
                                                                <th class="product-image">Product Image</th>
                                                                <th class="product-name">Name</th>
                                                                <th class="product-price">Price</th>
                                                                <th class="product-quantity">Quantity</th>
                                                                <th class="product-total">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($item->orderDetail as $detail)


                                                            <tr class="table-body-row">
                                                                <td class="product-image"><img
                                                                        src="{{ asset($detail->product->imagepath) }}"
                                                                        alt=""></td>
                                                                <td class="product-name"> <a
                                                                        href="/single-product/{{ $detail->product->id }}">
                                                                        {{ $detail->product->name }} </a></td>
                                                                <td class="product-price">
                                                                    {{ $detail->product->price }} $</td>
                                                                <td class="product-quantity">
                                                                    {{ $detail->quantity }}</td>
                                                                <td class="product-total">
                                                                    {{ $detail->product->price * $detail->quantity }}
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
                                                                    {{
                                                                        $item->orderDetail->sum(function($item){
                                                                        return $item->product->price * $item->quantity;
                                                                        });
                                                                    }} $
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

                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
