<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Type;
use Illuminate\Http\Request;

class organizateurController extends Controller
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

    // ______________________add annonce________________
    public function addAnnonce(Request $request){
        $request->validate([
            'titre'=> 'required',
            'description'=> 'required',
            'location'=> 'required',
            'date'=> 'required',
            'competance'=> 'required',
        ]);

        $annonce = new Annonce();
        $annonce->titre = $request->titre;
        $annonce->description = $request->description;
        $annonce->location = $request->location;
        $annonce->date = $request->date;
        $annonce->competance = $request->competance;
        $annonce->user_id = $request->user_id;
        $annonce->type_id = $request->type_id;

        $annonce->save();

        if($annonce){
            return response()->json(['msg'=> 'added successfully']);
        }else{
            return response()->json(['msg'=> 'error']);
        }
    }

    // ______________________update annonce ____________________

    public function updateAnnonce(Request $request){
        $request->validate([
            'titre'=> 'required',
            'description'=> 'required',
            'location'=> 'required',
            'date'=> 'required',
            'competance'=> 'required',
        ]);

        $updateAnnonce =Annonce::findOrFail($request->id);
        $updateAnnonce->titre = $request->titre;
        $updateAnnonce->description = $request->description;
        $updateAnnonce->location = $request->location;
        $updateAnnonce->date = $request->date;
        $updateAnnonce->competance = $request->competance;
        $updateAnnonce->user_id = $request->user_id;
        $updateAnnonce->type_id = $request->type_id;

        $updateAnnonce->save();

        if($updateAnnonce){
            return response()->json(['msg'=> 'update successfully']);
        }else{
            return response()->json(['msg'=> 'error']);
        }
    }

    // _________________________delete_____________________
    
    public function deleteAnnonce($id){
        
        $deleteAnnonce = Annonce::findOrFail($id);
        
        if($deleteAnnonce){
            $deleteAnnonce->delete();
            return response()->json(['msg'=>"deleted"]);
        }

        return response()->json(['msg'=>"error"]);
        
    }

}