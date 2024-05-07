@extends('layouts.master')
@section('content')


			<div class="row product-lists">
                @foreach ($products as $item)
				<div class="col-lg-4 col-md-6 text-center strawberry">
					<div class="single-product-item" >
						<div class="product-image" >
							<a href="/single-product/{{ $item->id }}"><img src="{{ url($item->imagepath) }}" alt="" style="height: 250px"></a>
						</div>
						<h3>{{ session('local')=='en'? $item->name : $item->nameNL }}</h3>
                        <h6 class="product-price">{{ $item->description }} </h6>
						<p class="product-price">{{ $item->price }}$ </p>
						<a href="/addproducttocart/{{ $item->id }}" class="cart-btn">
                        ><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                         @if (Auth::user()&&(Auth::user()->role=='admin' || Auth::user()->role=='saler'))
                        <a href="/removeproducts/{{ $item->id }}" class="btn btn-danger "><i class="fas fa-trash"></i>Delete</a>
                        <a href="/editproduct/{{ $item->id }}" class="btn btn-primary "><i class="fas fa-pen"></i>Edit</a>
                        @endif
					</div>
				</div>
                @endforeach
                <div style="align-items: center; justify-content: center; width:100%; display: flex; text-align:center;">
                    {{ $products->links() }}
                </div>

			</div>

@endsection
 <style>
    svg{
        height: 50px;
    }
 </style>
