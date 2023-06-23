<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = array();
        $user = auth()->user();
        $docteur = User::where('type','docteur')->get();
        $docteurdata = Doctor::all();

        foreach($docteurdata as $data){
            foreach($docteur as $info){
                if($data['user_id'] == $info['id']){
                    $data['docteur_name'] = $info['name'];
                    $data['docteur_profile'] = $info['profile_photo_url'];
                }
            }
        }

        $user['docteur'] = $docteurdata;

        return $user;
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user && !Hash::check($request->password, $user->password)) {

            throw ValidationException::withMessages([
                'email' => 'Email ou Mot de passe incorrect'
            ]);
        }
        return $user->createToken($request->email)->plainTextToken;
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'type' => 'utilisateur',
            'password' => Hash::make($request->password)
        ]);

        $userInfon = UserDetail::create([
            'user_id' => $user->id,
            'status' => 'active',
        ]);

        return $user;

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
        //
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
