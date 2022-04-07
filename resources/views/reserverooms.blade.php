@include('navbar');
@php
    use \App\Http\Controllers\ReserveController;
    use Carbon\Carbon;
    $dt = Carbon::now(2);
@endphp
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
.custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
.custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }</style>
<div class="container-fluid">
    <div class="row col-md-12  custyle">
           <form action="/search">
                <input class="form-control"  type="text" name="search" placeholder="Search" aria-label="Search">
                <button   class="btn btn-sm btn-success" type="submit">search</button>
                
            </form>
           
    <table class="table table-striped custab">
    <thead>
    
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Room No</th>
            <th>Room Type</th>
            <th>Status</th>
            <th>Check in</th>
            <th>Check out</th>
            <th>Price</th>
            <th>paid</th>
            <th>not paid</th>
            <th>total</th>
            <th>Edit</th>
            <th>Delete</th>
            
        </tr>
    </thead>
            


                @foreach ($resarray as $data)   
                
                <tr> 
                    @if($data->Active == 'Reserved' ||$data->Active == 'Active')    
                    <td>{{$data->id}}</td>                         
                    <td>{{$data->a_name}}</td>
                    <td>{{$data->phone}}</td> 
                    <td>{{$data->room_no}}</td>
                    <td>{{$data->room}}</td>  
                    <td>{{$data->Active}}</td>
                    <td>{{$data->checkin}}</td>
                    <td>{{$data->checkout}}</td>  
                    <td>{{$data->price}}</td> 
                    <td>{{$data->payment}}</td>
                    <td>{{$data->not_paid}}</td> 
                    <td>{{$data->total}}</td> 
               
                
                @if ($data->not_paid > 0 || $data->checkout >= $dt->toDateString())
                <td> <a href="/vres/{{$data->id}}" class="btn btn-success btn-md"> Edit Res </a></td>
                @else 
                <td><button class="btn btn-md btn-warning" disabled="disabled">Contact Admin</button></td>
                @endif
                <td><a href="/delete/{{$data->id}}"  class="btn btn-danger delete-user" >Delete Res</td>
                
                
                    @endif  
                </tr>              
                               
                @endforeach
               
            
            
    </table>
    
    </div>
   
</div>
