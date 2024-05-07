@extends('layouts.master')
@section('content')

<div class="contact-from-section mt-150 mb-150">
		<div class="container">

			<div class="row">

				<div class="col-lg-12 mb-5 mb-lg-0">
					<div class="form-title">
                        <h3><span class="orange-text">Add</span> Product</h3>
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form">
						<form method="POST" enctype="multipart/form-data" action="{{ url('/storeproduct') }}" id="fruitkha-contact" onsubmit="return valid_datas( this );">
							@csrf()
                            <p> <input type="hidden" placeholder="Id" name="id" id="id" required style="width: 100%" value="{{$product -> id }}">
                            </p>
                            <p>
								<input type="text" placeholder="Name" name="name" id="name" required style="width: 100%" value="{{$product -> name }}">
                                    <span class="text-danger">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </span>
							</p>
							<p style="display: flex">
                                <input type="number" placeholder="Price" name="price" id="price" required style="width: 50%" class="mr-4" value="{{ $product->price }}">
                                    <span class="text-danger">
                                    @error('price')
                                    {{ $message }}
                                    @enderror
                                    </span>
								<input type="number" placeholder="Quantity" name="quantity" id="quantity" required style="width: 50%" value="{{ $product->quantity }}">
                                    <span class="text-danger">
                                    @error('quantity')
                                    {{ $message }}
                                    @enderror
                                </span>
							</p>
                            <p>
                                <input type="text" placeholder="Imagepath" name="imagepath" id="imagepath"  style="width: 100%" value="{{ $product->imagepath }}">
                                    <span class="text-danger">
                                    @error('quantity')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </p>
							<p><textarea name="description" id="description" required cols="30" rows="10" placeholder="Description" >{{ $product->description }}</textarea></p>
                                <span class="text-danger">
                                    @error('description')
                                    {{ $message }}
                                    @enderror
                                </span>
                                <p>
                                    <select class="form-control" name="category_id" id="category_id" required>

                                        @foreach ($allcategories as $item)
                                        @if ($item->id == $product->category_id)
                                            <option value="{{ $item->id }}" selected>{{ $item -> name }}</option>

                                            @else
                                            <option value="{{ $item->id }}">{{ $item -> name }}</option>
                                            @endif

                                        @endforeach

                                    </select>
                                    <span class="text-danger">
                                        @error('category_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </p>
                                                                <p>
                                <input type="file" name="photo" id="photo" class="form-control"  onchange="displayImage(this)">
                                </p>
                                <div style="display: flex">
                                    <div style="width:50%"> <h3>Current image</h3> <img src="{{ asset($product->imagepath) }}" alt="" width="250" height="250"></div>
                                    <div id="newImage" style="display: none; width:50%"> <h3>New image</h3> <img id="preview" src="" alt="" width="250" height="250"> </div>
							    </div>
                                  <p>

                                <input type="submit" value="Save">
                            </p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
    function displayImage(input) {
        var preview = document.getElementById('preview');
        var oldImagePath=document.getElementById('imagepath');
        oldImagePath.value='';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src =  e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
            newImage.style.display = 'block';
        }

    }
</script>
@endsection
