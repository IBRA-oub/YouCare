<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;

class benevoleController extends Controller
{
    // _____________________red annonce_______________
    
    public function redALLAnnonce(){
        
        $annonces = Annonce::all();
        
        if ($annonces->isNotEmpty()) {
            return response()->json(['msg' => $annonces]);
        } else {
            return response()->json(['msg' => 'There is no data']);
        }
    }

    // _____________________filter by location annonce_______________
    
    public function filterAnnonce(Request $request) {
        $request->validate([
            'filterByLocation'=> 'sometimes|required', 
            'type_id'=> 'sometimes|required', 
        ]);
        
        $query = Annonce::query();
    
        
        if ($request->has('filterByLocation')) {
            $query->where('location', $request->filterByLocation);
        }
    
       
        if ($request->has('type_id')) {
            $query->where('type_id', $request->type_id);
        }
    
        $filteredAnnonces = $query->get();
    
        if ($filteredAnnonces->isNotEmpty()) {
            return response()->json(['annonces' => $filteredAnnonces]);
        } else {
            return response()->json(['msg' => 'Il n\'y a pas de données correspondant aux critères de filtrage']);
        }
    }
    
}