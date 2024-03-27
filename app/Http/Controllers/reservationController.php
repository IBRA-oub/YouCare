<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class reservationController extends Controller
{
    // ______________________add resrvation by bénévole ________________
   public function addReservation(Request $request){

    $request->validate([
        'user_id'=> 'required',
        'annonce_id'=> 'required',
      
    ]);
   
    $resrvation = new Reservation();
    $resrvation->annonce_id = $request->annonce_id;
    $resrvation->user_id = $request->user_id;
    $resrvation->status = 'pending';
 

    $resrvation->save();

    if($resrvation){
        return response()->json(['msg'=> 'added reservation successfully']);
    }else{
        return response()->json(['msg'=> 'error']);
    }
   }

//    ___________________red reservation for organisateur_____________________

   public function pendingReservation(){
    $user = auth()->user();
    
    $pendingReservations = Reservation::with('annonce')
        ->where('status', 'pending')
        ->whereHas('annonce',  fn($q) => $q->where('user_id',  $user->id))
        ->get();
    
    if ($pendingReservations->isNotEmpty()) {
        return response()->json(['msg' => $pendingReservations]);
    } else {
        return response()->json(['msg' => 'There is no data']);
    }
   }
   
//    ______________________accepte reservation by organisateur___________________

   public function acceptReservation($id){
    
   

    $acceptReservation =Reservation::findOrFail($id);
    $acceptReservation->status = 'accepted';

    $acceptReservation->save();

    if($acceptReservation){
        return response()->json(['msg'=> 'accepted successfully']);
    }else{
        return response()->json(['msg'=> 'error']);
    }
   }

   //    ______________________refused reservation by organisateur___________________

   public function refuseReservation($id){
    

    $refuseReservation =Reservation::findOrFail($id);
    $refuseReservation->status = 'refused';

    $refuseReservation->save();

    if($refuseReservation){
        return response()->json(['msg'=> 'refused successfully']);
    }else{
        return response()->json(['msg'=> 'error']);
    }
   }

   //    ___________________get me reservation for bénévole_____________________

   public function getMeReservation(){
    $user = auth()->user();
    $Reservations = Reservation::where('user_id', $user->id)->get();
    
    if ($Reservations->isNotEmpty()) {
        return response()->json(['msg' => $Reservations]);
    } else {
        return response()->json(['msg' => 'There is no data']);
    }
   }
}