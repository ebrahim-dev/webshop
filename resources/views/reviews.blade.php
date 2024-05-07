@extends('layouts.master')
@section('content')

<div class="contact-from-section mt-150 mb-150">
	<div class="container">

		<div class="row">

			<div class="col-lg-12 mb-5 mb-lg-0">
				<div class="form-title">
                    <h3><span class="orange-text">Add</span> Review</h3>
				</div>
				<div id="form_status"></div>
				<div class="contact-form">
						<form method="POST" enctype="multipart/form-data" action="{{ url('/storereview') }}" id="fruitkha-contact" onsubmit="return valid_datas( this );">
							@csrf()
                            <p>
								<input type="text" placeholder="Name" name="name" id="name" required style="width: 100%" value="{{ old('name') }}">
                                    <span class="text-danger">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </span>
							</p>
							<p style="display: flex">
                                <input type="email" placeholder="Email" name="email" id="email" required style="width: 50%" class="mr-4" value="{{ old('email') }}">
                                    <span class="text-danger">
                                    @error('email')
                                    {{ $message }}
                                    @enderror
                                    </span>
								<input type="text" placeholder="Phone" name="phone" id="phone" required style="width: 50%" value="{{ old('phone') }}">
                                    <span class="text-danger">
                                    @error('phone')
                                    {{ $message }}
                                    @enderror
                                </span>
							</p>
                            <p>
                                	<input type="text" placeholder="Subject" name="subject" id="subject" required style="width: 100%" value="{{ old('subject') }}">
                                    <span class="text-danger">
                                    @error('subject')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </p>
                            <p>
                                <input type="text" placeholder="Imagepath" name="imagepath" id="imagepath" style="width: 100%" value="{{ old('imagepath') }}">
                                    <span class="text-danger">
                                    @error('imagepath')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </p>
							<p><textarea name="message" id="message" required cols="30" rows="10" placeholder="Message"> {{ old('message') }}</textarea></p>
                                <span class="text-danger">
                                    @error('message')
                                    {{ $message }}
                                    @enderror
                                </span>
                            <p>
                                <input type="file" name="photo" id="photo" class="form-control">
                            </p>
							<p>
                                <input type="submit" value="Save">
                            </p>
						</form>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="testimonail-section mt-80 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
                        @foreach ($reviews as $item)
                          	<div class="single-testimonial-slider">
                                <div class="client-avater">
                                    <img src="{{ $item -> imagepath }}" alt="">
                                </div>
                                <div class="client-meta">
                                    <h3>{{ $item->name }} <span>{{ $item->subject }}</span></h3>
                                    <p class="testimonial-body">
                                      {{ $item->message }}
                                    </p>
                                    <p class="testimonial-body">
                                      {{ $item->email }}
                                    </p>
                                    <p class="testimonial-body">
                                      {{ $item->phone }}
                                    </p>
                                    <div class="last-icon">
                                        <i class="fas fa-quote-right"></i>
                                    </div>
                                </div>
						</div>
                        @endforeach
					</div>
				</div>
			</div>
		</div>
</div>



@endsection
