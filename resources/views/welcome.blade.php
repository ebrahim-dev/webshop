@extends('layouts.master')
@section('content')



<!-- <div id="currentDate"></div>
<div id="currentTime"></div> -->
<!-- {{ Session('date')? 'ahmad':'mohamed' }} -->
{{ Session('username') }}
<div class="row product-lists">

    @foreach ($categories as $item)
    <div class="col-lg-4 col-md-6 text-center strawberry">
        <div class="single-product-item" style="height: 600px">
            <div class="product-image">
                <a href="/products/{{ $item->id }}"><img src="{{ url($item->imagepath) }}" alt=""
                        style="height: 300px !important; margin:20px "></a>
            </div>
            <h3>{{ $item->name }}</h3>
            <p>{{ $item->description }}</p>

        </div>
    </div>
    @endforeach

</div>
<!-- <script>
// Functie om de huidige datum en tijd op te halen en weer te geven
function updateDateTime() {
    var currentDateElement = document.getElementById('currentDate');
    var currentTimeElement = document.getElementById('currentTime');
    var currentDateTime = new Date();
    var date = currentDateTime.toLocaleDateString();
    var time = currentDateTime.toLocaleTimeString();
    currentDateElement.innerHTML = date;
    currentTimeElement.innerHTML = time;
}

// Roept de functie updateDateTime aan om de huidige datum en tijd in te stellen
updateDateTime();

// Update de tijd elke seconde
setInterval(updateDateTime, 1000);
</script> -->
@endsection
