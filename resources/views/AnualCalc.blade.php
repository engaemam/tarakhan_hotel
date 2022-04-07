@include('navbar');
@php
    use \App\Http\Controllers\ReserveController;
    use Carbon\Carbon;
    $total =0;
    $yearst = '01-01-2018';
    $yearlt = '31-12-2018';
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

<div class="container-fluid" >
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
        </tr>
    </thead>
            


                @foreach ($resarray as $data)   
                
                <tr> 
                     @if ($data->checkin >= $yearst  && $data->checkout <= $yearlt)
                        
                    
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
               
                    @php
                       
                        $total +=$data->total;
                    @endphp
                    @endif
                </tr>              
                               
                @endforeach
               
            
            
    </table>
    <div class="panel panel-default">
        <div class="panel-body">
          Total for Period From {{$yearst}} to {{$yearlt}}
        </div>
        <div class="panel-footer">{{$total}}</div>
      </div>
    </div>
   
</div>
