<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-compat/3.0.0-alpha1/jquery.min.js" integrity="sha512-4GsgvzFFry8SXj8c/VcCjjEZ+du9RZp/627AEQRVLatx6d60AUnUYXg0lGn538p44cgRs5E2GXq+8IOetJ+6ow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
@extends('layouts.master')
@section('content')
<div class="container mt-5 mb-5">
    <a href="/addproduct" class="btn btn-success "><i class="fas fa-plus"></i>Add product</a>
<table id="myTable" class="display" style="text-align: center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Created at</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->created_at }}</td>
                <td><img src="{{ $item->imagepath }}" alt="" height="75" width="75"></td>
                <td> <a href="/removeproducts/{{ $item->id }}" class="btn btn-danger "><i class="fas fa-trash"></i>Delete</a>
                    <a href="/editproduct/{{ $item->id }}" class="btn btn-primary "><i class="fas fa-pen"></i>Edit</a>
                    <a href="/addproductimages/{{ $item->id }}" class="btn btn-dark "><i class="fas fa-image"></i>Add images</a>
                </td>

            </tr>
        @endforeach


    </tbody>
</table>
</div>
@endsection

<script>
    $(document).ready( function () {
    let table = new DataTable('#myTable');
} );
</script>
