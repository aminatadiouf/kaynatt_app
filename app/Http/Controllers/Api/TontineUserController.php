<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\Tontine;
use App\Models\UserTontine;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Notifications\AccepteCreationTontine;
use App\Http\Requests\UserTontineCreateRequest;

class TontineUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function ParticiperTontine(Request $request, User $users)
    {
        try {
           
       
        if(Auth()->check())
        {
           $user_id=auth()->user()->id;
        if($user_id->hasRoles('participant_tontine')) 
       { 
        $users->tontine()->attach($request->tontine_id, ['statut' => 'en_attente', 'date' => $request->date]);
       
       
        return response()->json([
            'status_code'=>200,
            'status_message'=>'votre demande de participation est mise en attente.Vous recevrez un courriel confirmant ou non votre participation'
        ]);
    }
    }else {
        return response()->json([
            'status_code' => 401,
            'status_message' => 'Vous devez être connecté pour participer à une tontine'
        ], 401);
    }
    } catch (Exception  $e) {
    return response()->json($e);
    }
 }




    public function attachParticipant(UserTontineCreateRequest $request, Tontine $tontines,User $users)
    {
        $tontine = Tontine::find($tontines);
        if ($tontines->statut() === 'accepte' & $tontines->role() === 'participant_tontine')
        {
        $tontine->users()->attach($users);
    }
        return response()->json([
            'status' => true,
            'message' => 'Utilisateur est enregistré avec succès à la tontine']);
    }


     public function listeparticipant(Tontine $tontines)
     {
        /*
         $archivementor = $mentore::where (['archives' => true])->get();

        return response()->json([
            'data'=>$mentore,
            'liste des mentores archivés' =>$archivementor]);
        */
        $tontines :: find($tontines);

         $getparticipant = $tontines->user()
                                     ->where ('statut' ,'accepte') 
                                     -> where ('role','participant_tontine')
                                     ->get();

        return response()->json([
            'status_code' => 200,
            'status_message'=>'la liste des participants à cette tontine'

        ]);

     }
//supprimer un utilisateur d'une tontine
    public function dettachParticipant(UserTontineCreateRequest $request, Tontine $tontines,User $users)
    {
        $tontine = Tontine::find($tontines);
        if ($tontines->statut() === 'refuse' & $tontines->role() === 'participant_tontine')
        {
        $tontine->users()->detach($users);
    }
        return response()->json([
            'status' => true,
            'message' => 'Utilisateur supprimé avec succès à la tontine']);
    }



    public function attachCreateur(UserTontineCreateRequest $request, Tontine $tontines,User $users)
    {
        $tontine = Tontine::find($tontines);
        if ($tontines->statut() === 'accepte' & $tontines->role() === 'createur_tontine')
        {
        $tontine->users()->attach($users);
    }
        return response()->json([
            'status' => true,
            'message' => 'Le createur est enregistré avec succès à la tontine']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        //
    }

    public function AccepteDemandeTontine(Tontine $tontines)

    {
        try {
            $dataTontine =Tontine ::find($tontines);
            
    
            if (!$dataTontine ) {
                return response()->json([ 
                   "status" => false,
                   "message" => "la tontine n'existe pas "
                ]);
               
            }
    
            if ($dataTontine->statut === 'accepte') {
                return response()->json([ 
                    "status" => false,
                    "message" => "la tontine a déjà été acceptée "
                ]);
            }


            $dataTontine->statutTontine->update(['tontines' => 'accepte']);
            $dataTontine->save();

            $createurTontine = $tontines->createur_tontine;

            $createurTontine->user()->notify(new AccepteCreationTontine());
            return response()->json([ 
                "status" => true,
                "message" => "la demande de création de tontine a été acceptée",
                "data"=>$dataTontine
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
}
