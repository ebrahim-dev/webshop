@extends('layouts.master')
@section('content')
<div class="section-title text-center mt-4">
    <h3><span class="orange-text">Product</span> details</h3>
</div>
	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="{{ asset($product->imagepath) }}" alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3>{{ $product->name }}</h3>
						<p class="single-product-pricing"> ${{ $product->price }}</p>
						<p>{{ $product->description }}</p>
                        <p>Quantity: {{$product->quantity  }} </p>
						<div class="single-product-form">
							<a href="/addproducttocart/{{ $product->id }}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
							<p><strong>Categories: </strong>{{ $product->Category->name }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single product -->
    @if ($product->ProductPhoto->count() > 1)


<div class="testimonail-section mt-80 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
                        @foreach ($product->ProductPhoto as $item)
                          	<div class="single-testimonial-slider">
                                <div class="client-avater">
                                    <img style="max-width: none !important; width:30%; height:300px;" src="{{asset($item -> imagepath) }}" alt="">
                                </div>
						    </div>
                        @endforeach
					</div>
				</div>
			</div>
		</div>

</div>

@endif
        <div class="container">
            	<div class="section-title text-center mt-4">
                    <h3><span class="orange-text">Related</span> products</h3>
				</div>
            <div class="row product-lists">
                @foreach ($relatedProducts as $item)
				<div class="col-lg-4 col-md-6 text-center " style="display: flex;">
					<div class="single-product-item" >
						<div class="product-image" >
							<a href="/single-product/{{ $item->id }}"><img src="{{ url($item->imagepath) }}" alt="" style="height: 250px"></a>
						</div>
						<h3>{{ $item->name }}</h3>
                        <h6 class="product-price">{{ $item->description }} </h6>
						<p class="product-price">{{ $item->price }}$ </p>
						<a href="/addproducttocart/{{ $item->id }}" class="cart-btn">
                        ><i class="fas fa-shopping-cart"></i> Add to Cart</a>
					</div>
				</div>
                @endforeach

			</div>
        </div>
@endsection

