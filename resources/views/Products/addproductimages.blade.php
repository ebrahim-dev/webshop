@extends('layouts.master')
@section('content')
<div class="container" style="text-align: center">

        	<form method="POST" enctype="multipart/form-data" action="{{ url('/storeproductimage') }}" id="fruitkha-contact" onsubmit="return valid_datas( this );">
				@csrf()
                <div class="row  mt-5 mb-5">
                    <input type="hidden" name="product_id" id="product_id" required style="width: 100%" value="{{$product->id }}">
                    <div class="col-9 pt-3">
                        <input type="file"  name="photo" id="photo" class="form-control">
                        <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>

                    </div>
                    <div class="col-3 ">
                        <input type="submit" value="Save" class="w-100">
                    </div>

                    <span class="text-danger">
                        @error('photo')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
			</form>

    <div class="row">
        @foreach ($productImages as $item)
            <div class="col-3">
                <img src="{{ asset($item->imagepath) }}" width="300" height="300" alt="" class="m-2" >
                <a href="{{ route('removeproductphoto', ['imageid' => $item->id]) }}" class="btn btn-danger "><i class="fas fa-trash"></i>Delete</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
