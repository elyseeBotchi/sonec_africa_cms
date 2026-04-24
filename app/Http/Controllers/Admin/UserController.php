<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\NewUserNotification;
use App\Mail\ResetPasswordUserNotification;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Liste des utilisateurs
        $users = User::all();
        return view('admin.pages.gestion-utilisateurs.index', compact('users'));
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
    public function store(StoreUserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            User::create($validatedData);

            // Envoyer un mail contenant les informations de connexion à l'utilisateur
            \Mail::to($validatedData['email'])->send(new NewUserNotification($validatedData));

            return response()->json([
                'success' => true,
                'message' => 'Utilisateur créé avec succès.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Erreur lors de la création de l\'utilisateur.', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
        try {
            $validatedData = $request->validated();

            if (!empty($validatedData['password'])) {
                $user->password = bcrypt($validatedData['password']);
            }

            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'role' => $validatedData['role'],
            ]);

            // Envoyer un mail contenant les informations de connexion à l'utilisateur si le mot de passe a été mis à jour
            if (!empty($validatedData['password'])) {
                \Mail::to($validatedData['email'])->send(new ResetPasswordUserNotification($validatedData));
            }

            return response()->json([
                'success' => true,
                'message' => 'Utilisateur mis à jour avec succès.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Erreur lors de la mise à jour de l\'utilisateur.', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'Utilisateur supprimé avec succès.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Erreur lors de la suppression de l\'utilisateur.', 
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
