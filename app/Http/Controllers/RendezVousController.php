<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RendezVous;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rendezvous = RendezVous::where('user_id',auth()->user()->id)->get();
        $docteur = User::where('type','docteur')->get();

        foreach($rendezvous as $data){
            foreach($docteur as $info){
                $details = $info->doctor;  
                if($data['doc_id'] == $info['user_id']){
                    $data['docteur_name'] = $info['name'];
                    $data['docteur_profile'] = $info['photo_profile_url'];
                    $data['category'] = $info['category'];
                }
            }
        }

        return $rendezvous;
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
    public function store(Request $request)
    {

        // permet d'enregistrer les rendez vous de l'utilisateur
        $rendezvous = new RendezVous();
        $rendezvous->user_id = auth()->user()->id;
        $rendezvous->doc_id = $request->get('docteur_id');
        $rendezvous->day = $request->get('day');
        $rendezvous->date = $request->get('date');
        $rendezvous->time = $request->get('time');
        $rendezvous->status = 'Encours';
        $rendezvous->save();

        return response()->json([
            'success' => 'Nouveau rendez-vous enregistré avec succès'
        ],200);
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
}
