@include('navbar');
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<div class="container">
<form action="/edit/unpaid/{{$profile->id}}" method="GET">
<div class="form-group">

<input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"   name="id" value="{{$profile->id}}" hidden>
</div>
<div class="form-group">
<label for="exampleInputname">Name</label>
<input type="text" class="form-control"name="aname" value="{{$profile->a_name}}">
</div>
<label for="exampleInputphone">Phone Number</label>
<div class="form-group">
<input type="text" name="phone" class="form-control" value="{{$profile->phone}}">
</div>

<div class="form-group">
        <label for="exampleInputphone">Room Type</label>
<select class="form-control" name="roomtype">
    <option  value="{{$profile->room}}">Single</option>
    <option  value="Single">Single</option>
    <option value="Double">Double</option>
    <option value="Triple">Triple</option>
    <option value="Fourbed">Fourbed</option>
 </select>
</div>
<div class="form-group">
        <label for="exampleInputphone">Room Number</label>
    <input type="text" class="form-control" name="room_no" value="{{$profile->room_no}}">
</div>
<div class="form-group">
        <label for="exampleInputphone">Check-in</label>
        <input type="date"  class="form-control" name="checkin" value="{{$profile->checkin}}">
</div>
<div class="form-group">
        <label for="exampleInputphone">Check-out</label>
        <input type="date" class="form-control" name="checkout" value="{{$profile->checkout}}">
</div>
<div class="form-group">
        <label for="exampleInputphone">Price</label>
        <input type="text" class="form-control" name="price" value="{{$profile->price}}">
</div>
<div class="form-group">
        <label for="exampleInputphone">Paid</label>
        <input type="text" class="form-control" name="payment" value="{{$profile->payment}}">
</div>

<div class="form-group">
        <label for="exampleInputphone">Not Paid</label>
        <input type="text" class="form-control" value="{{$profile->not_paid}}">
</div>
<div class="form-group">
        <label for="exampleInputphone">Not Paid</label>
        <input type="text" class="form-control" name="total" value="{{$profile->total}}">
</div>
<button class="btn btn-success btn-lg" type="submit">save</button>
</form>
</div>