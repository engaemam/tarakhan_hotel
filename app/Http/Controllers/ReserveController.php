<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\reservations;
use App\rooms;
use Carbon\Carbon;
use App\Request as irequest;
use DB;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dates  =  reservations::all();
        $rooms = rooms::all();
        $dt = Carbon::today();
      foreach($dates as $date){
          foreach($rooms as $room){
           
             if($date->Active =='Reserved'){
                DB::table('rooms')->where('room_no','=',$date->room_no)->update(['Reserved' => '1']);
             }else{
                DB::table('rooms')->where('room_no','=',$date->room_no)->update(['Reserved' => '0']);
             }
            }
          
        DB::table('reservations')->where('checkin','<=', $dt->toDateString())->Where('checkout','>=', $dt->toDateString())->update(['Active' => 'Reserved']);
        DB::table('reservations')->where('checkin','>', $dt->toDateString())->Where('checkout','>=', $dt->toDateString())->update(['Active' => 'Active']); 
        DB::table('reservations')->where('checkin','<', $dt->toDateString())->Where('checkout','<', $dt->toDateString())->update(['Active' => 'Empty']); 
        
    }
      
      return view('res');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
    }
    public function make_res(Request $request){
        
        $user = new reservations();
        $rooms  = rooms::find($request->room_no);
        $room  = rooms::All();
        $dates  =  reservations::all();
        $res  =   new reservations();
        
        $user->a_name=$request->name;
        $user->a_email="Null";
        $user->phone=$request->phone;
        $user->room=$request->roomtype;
        $user->room_no=$request->room_no;
        $user->checkin=$request->check_in;
        $user->checkout=$request->check_out;
        
   
        $dt = Carbon::today();
       // echo $dt->toDateString();
       if($request->check_in < $dt->toDateString() || $request->check_in > $request->check_out){
          
        echo "<script type='text/jscript'>alert('checkin not accepted.')</script>";
            return view('res');
        }
        
        elseif($request->check_out < $dt->toDateString()){
            echo "<script type='text/jscript'>alert('checkout not accepted.')</script>";
            echo $dt->toDateString();
            
            return view('res');
        }
        $user->price = $request->price;
        $user->confirmed=$request->confirmed;
        $user->paid=true;
        
        (int)$roomp = (int)$request->price;
        //echo $roomp;
        
        $diff = abs(strtotime($user->checkin) - strtotime($user->checkout));
       // echo $diff;
       if( $user->checkin ==  $user->checkout){
        $total =(int)(($diff/60/60/24)+1)*(int)$roomp; 
        }
        else{
            $total =(int)($diff/60/60/24)*(int)$roomp;
        }
      
        $user->total=$total;
        $user->payment=$request->paid;
        $user->not_paid=$total - $user->payment;
        foreach($dates as $date){
           
            if((($date->checkin < $user->checkin||($date->checkin > $user->checkin && $user->checkout > $date->checkout )) && $date->checkout > $user->checkin) && $date->room_no == $user->room_no ) {
                echo $user->checkin ;
                echo "<br>";
                echo $date->checkout;
                echo "<br>";
                echo $date->checkin ;
            echo "<script type='text/jscript'>alert('room not available')</script>";
            return view('res');
            
           }
        }
     //  
           if($user->checkin <= $dt->toDateString()){
               
               $user->Active ="Reserved";
           }
           else{
            $user->Active ="Active";
           }
      //    
           if($user->not_paid==0){
               $user->paid = 1;
           }
           else{
            $user->paid = 0;  
           }
  
      foreach($dates as $date){
          
              DB::table('reservations')->where('checkin','<=', $dt->toDateString())->Where('checkout','>=', $dt->toDateString())->update(['Active' => 'Reserved']);
              DB::table('reservations')->where('checkin','>', $dt->toDateString())->Where('checkout','>=', $dt->toDateString())->update(['Active' => 'Active']); 
              DB::table('reservations')->where('checkin','<', $dt->toDateString())->Where('checkout','<', $dt->toDateString())->update(['Active' => 'Empty']); 
            }
        if($user->checkin == $dt->toDateString()) {
            $rooms->reserved = 1;
        }  
        else{
            $rooms->reserved = 0;
        }
        //-----------> i stopped here i was trying to change the value of reserved in rooms to 1 or 0 according to 
        // Active status in reserved table (Thank you )
        foreach($dates as $date){
        
            
            $q= rooms::find($date->room_no);
            if($date->Active == 'Reserved'){
                
                $q->reserved=1;
            }
            else{
              
                $q->reserved=0;
            }
            $q->update();
        }
        
        $rooms->update();
        $user->save();
        echo "<script type='text/jscript'>alert('Room Reserved.')</script>";
        return view('res');
    }

    public function update_res(Request $request,$id){
        
        $user=reservations::find($id);
        
        $user->a_name=$request->aname;
        $user->phone=$request->phone;
        $user->room_no=$request->room_no;
        $user->room=$request->roomtype;
        $user->price = $request->price;
        $user->payment=$request->payment;
        $user->not_paid=$user->total - $request->payment;
        if($request->payment  > $user->total){
            echo "<script type='text/jscript'>alert('paid exceeded total')</script>";
            return "Total < Paid";
        }
        if($request->total < 0 || $request->payment < 0 || $request->not_paid < 0){
            echo "<script type='text/jscript'>alert('request negative')</script>";
            return "Value Negative";
        }
        if($user->total < 0 || $user->payment < 0 || $user->not_paid < 0){
            echo "<script type='text/jscript'>alert('db negative')</script>";
            return "Value Negative";
        }
        if($user->not_paid==0){
            $user->paid = 1;
        }
        else{
            $user->paid = 0;
        }

        (int)$roomp = (int)$request->price;
        //echo $roomp;
        
        $diff = abs(strtotime($request->checkin) - strtotime($request->checkout));
       // echo $diff;
       if( $user->checkin ==  $user->checkout){
        $total =(int)(($diff/60/60/24)+1)*(int)$roomp; 
        }
        else{
            $total =(int)($diff/60/60/24)*(int)$roomp;
        }
        $user->not_paid = $total-$request->payment;
        $user->total = $total;
        $user->update();
        return view('reserverooms');
    }
    public function update_notpaid(Request $request,$id){
        
        $user=reservations::find($id);
        
        $user->a_name=$request->aname;
        $user->phone=$request->phone;
        $user->room_no=$request->room_no;
        $user->room=$request->roomtype;
        $user->payment=$request->payment;
        $user->not_paid=$user->total - $request->payment;
        if($request->payment  > $user->total){
            echo "<script type='text/jscript'>alert('paid exceeded total')</script>";
            return "Total < Paid";
        }
        if($request->total < 0 || $request->payment < 0 || $request->not_paid < 0){
            echo "<script type='text/jscript'>alert('request negative')</script>";
            return "Value Negative";
        }
        if($user->total < 0 || $user->payment < 0 || $user->not_paid < 0){
            echo "<script type='text/jscript'>alert('db negative')</script>";
            return "Value Negative";
        }
        if($user->not_paid==0){
            $user->paid = 1;
        }
        else{
            $user->paid = 0;
        }

        
        
        $user->update();
        return view('notpaid');
    }
    public function res_view($id){
        $pg=24;
        $profile=reservations::find($id);
        return view('viewreserve',compact(['profile','pg']));
    }
    
    public function res_unpaid($id){
        $pg=24;
        $profile=reservations::find($id);
        return view('editunpaid',compact(['profile','pg']));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
       
      
    }
    
    public function hi()
    {
       return view('reserverooms');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = reservations::findOrFail($id);
        $res->delete();
        return back();
    }
}
