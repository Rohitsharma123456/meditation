@extends('ecom.layout')
@section('body')
<div class="btn-group" role="group" aria-label="Basic example">
  
    <a href="{{route('cartpage')}}"><button type="button" class="btn btn-primary">
      Cart: <span class="badge bg-secondary" id="cartitemsvalue">{{$cartcount}} Products</span>
    </button></a>
    
    
  </div>
<table style="border: solid 1px" class="table">
    <thead>
<tr><th>S.No</th><th>Item</th><th></th><th>Price</th><th>Qty</th><th>Total</th></tr></thead>
<tbody>
    @php
    $carttotal=0
    @endphp
    @foreach ($cart as $key=>$item)
    <tr><td>{{$key+1}}</td><td>{{$item->name}}</td><td>
        <div class="card" style="width: 18rem;">
            <img src="{{$item->image}}" class="card-img-top" alt="...">
           
          </div>
        {{-- <img src="{{$item->image}}" class="productimage" /> --}}
    </td><td>{{$item->price}}</td><td>{{$item->qty}} nos</td><td>${{($item->qty)*($item->price)}}</td></tr>   
    @php
    $carttotal=$carttotal+($item->qty)*($item->price)
    @endphp
    @endforeach
<tr><td></td><td></td><td></td><td>Grand Total</td><td>${{$carttotal}}</td></tr>
</tbody>
</table>
<form action="{{route('createcheckoutsession')}}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Checkout</button>
  </form>

<style>
    .productimage{
        height: 360px,
        width:360px,
    }
    </style>
@endsection