@extends('ecom.layout')
@section('body')
<div class="btn-group" role="group" aria-label="Basic example">
  
  <a href="{{route('cartpage')}}"><button type="button" class="btn btn-primary">
    Cart: <span class="badge bg-secondary" id="cartitemsvalue">{{$cartcount}} Products</span>
  </button></a>
  
  
</div>
<hr/>
<hr/>
<div class="container">
  <div class="row">
   
    <div class="col">
    <div class="card" style="width: 40rem;">
  <img src="{{$product->image}}" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{$product->name}}</h5>
    <p class="card-text">${{$product->price}}</p>
    <p class="card-text">{{$product->description}}</p>
    <a href="#" class="btn btn-primary" onclick="addtocart({{$product->id}})">Add to cart</a>
    <a href="#" class="btn btn-primary"  onclick="buynow({{$product->id}})">Buy Now</a>
  </div>
</div>
    </div>
   
  </div>
 
</div>
<hr>
<hr>
<script>
  let cartvalue={{$cartcount}};
  function addtocart(productid){
      
      
      const element=$('#cartitemsvalue');
      document.getElementById('cartitemsvalue').innerHTML=cartvalue;
      $.ajax({
      url: "{{route('addtocart')}}",
      data:{'cartvalue':productid},
      success: function(result){
        window.location.reload(true);
      }});
  }
  function buynow(productid){
      
      
      const element=$('#cartitemsvalue');
      document.getElementById('cartitemsvalue').innerHTML=cartvalue;
      $.ajax({
      url: "{{route('addtocart')}}",
      data:{'cartvalue':productid},
      success: function(result){
        window.location="{{route('cartpage')}}";
      }});
  }
   
    </script>
@endsection