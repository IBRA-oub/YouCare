<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Type;
use Illuminate\Http\Request;

class organizateurController extends Controller
{
   
    // _____________________red annonce_______________
  /**
     * @OA\Get(
     *     path="/api/get-All-annonce-organisateur",
     *     summary="Get a list of annonces for an organization",
     *     tags={"Annonces"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function redALLAnnonce()
    {
        $user = auth()->user();
        $annonces = Annonce::where('user_id', $user->id)->get();
        
        if ($annonces->isNotEmpty()) {
            return response()->json(['msg' => $annonces]);
        } else {
            return response()->json(['msg' => 'There is no data']);
        }
    }

    // ______________________add annonce________________

    /**
     * @OA\Post(
     *     path="/api/create-annonce",
     *     summary="Create annonces for an organization",
     *     tags={"Annonces"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
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

    
    /**
     * @OA\Put(
     *     path="/api/update-annonce",
     *     summary="update annonces for an organization",
     *     tags={"Annonces"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    
    public function updateAnnonce(Request $request,$id){
        $request->validate([
            'titre'=> 'required',
            'description'=> 'required',
            'location'=> 'required',
            'date'=> 'required',
            'competance'=> 'required',
        ]);

        $updateAnnonce =Annonce::findOrFail($id);
        $updateAnnonce->titre = $request->titre;
        $updateAnnonce->description = $request->description;
        $updateAnnonce->location = $request->location;
        $updateAnnonce->date = $request->date;
        $updateAnnonce->competance = $request->competance;
        $updateAnnonce->type_id = $request->type_id;

        if($updateAnnonce->user_id === auth()->user()->id){
        $updateAnnonce->save();
        }else{
            return response()->json(['msg'=> 'error auth try again']);
        }

       
        if($updateAnnonce){
            return response()->json(['msg'=> 'update successfully']);
        }else{
            return response()->json(['msg'=> 'error']);
        }
    }

    // _________________________delete_____________________
    
     /**
     * @OA\Delete(
     *     path="/api/delete-annonce/{id}",
     *     summary="delete annonces for an organization",
     *     tags={"Annonces"},
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    
    public function deleteAnnonce($id){
        
        $deleteAnnonce = Annonce::findOrFail($id);
        
        if($deleteAnnonce){
            $deleteAnnonce->delete();
            return response()->json(['msg'=>"deleted"]);
        }

        return response()->json(['msg'=>"error"]);
        
    }

}