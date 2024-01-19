<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Tontine;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditTontineRequest;
use App\Http\Requests\TontineCreateRequest;

class TontineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'salut';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TontineCreateRequest $request )
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
      /*
     
     'libelle',
    'description',
    'montant',
    'nombre_participant',
    'regles',
    'date_de_debut',
    'periode',
    'etat'
     
     */
    public function demandeCreationTontine(TontineCreateRequest $request)
    {
        try {
            //code...
       
        $tontines = new Tontine();
        $tontines->libelle = $request->libelle;
        $tontines->description = $request->description;
        $tontines->montant = $request->montant;
        $tontines->nombre_participant = $request->nombre_participant;
        $tontines->regles = $request->regles;
        $tontines->date_de_debut = $request->date_de_debut;
        $tontines->periode = $request->periode;
        $tontines->etat = 'en_attente';

        $tontines->save();

        return response()->json([
             'status_code'=> '200',
            'status_message'=> 'votre de demande de création sera approuvé ou décliné par l\'administrateur de ce site. Vous recevrez une notification ',
            'data'=>$tontines]
        );

    } catch (Exception $e) {
        return response()->json($e);
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function tousLesTontines(Tontine $allTontine)
    {
        try {
         
            $allTontine = Tontine::all();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'la liste de tous les tontines',
                'data'=>$allTontine,
            ]);
              
            } catch (Exception $e) {
                return response()->json($e);
            }
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
    public function update(EditTontineRequest $request, Tontine $tontines)
    {
        try {
            
       

        $tontines->libelle = $request->libelle;
        $tontines->description = $request->description;
        $tontines->montant = $request->montant;
        $tontines->nombre_participant = $request->nombre_participant;
        $tontines->regles = $request->regles;
        $tontines->date_de_debut = $request->date_de_debut;
        $tontines->periode = $request->periode;
        $tontines->etat = $request->etat;


        $tontines->save();

        return response()->json([
             'status_code'=> '200',
            'status_message'=> 'les informations cooncernant la tontine ont été modifiés avec succés',
            'data'=>$tontines]
        );

    } catch (Exception $e) {
        return response()->json($e);
    }
    }

   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tontine $tontines)
    {
        try {
           
             if($tontines){
                    $tontines->delete();
    
                    
                    return response()->json([
                        'status_code'=>200,
                        'status_message'=>'la tontine a été supprimée avec succés',
                        'data'=>$tontines
                    ]);
                }
            } catch (Exception $e) {
                return response()->json($e);
            }
              
    }



  
    
}
