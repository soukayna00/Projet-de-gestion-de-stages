<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Entreprise;
use App\Models\Stagiaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    /**
     * Register new user and return token
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            // users table fields
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => ['required', Rule::in(['admin', 'stagiaire', 'entreprise'])],
            'telephone' => 'nullable|string|max:50',
            'id_ville' => 'nullable|exists:villes,id',

            // optional stagiaire fields
            'cin' => 'nullable|string|max:255|unique:stagiaires,cin',
            'dateNaissance' => 'nullable|date',
            'cv' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'competence' => 'nullable|string|max:255',

            // optional entreprise fields
            'secteur' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $image = $data['role'] === 'admin'
            ? 'admin-default.png'
            : strtoupper(substr($data['name'], 0, 1));

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'telephone' => $data['telephone'] ?? null,
            'id_ville' => $data['id_ville'] ?? null,
            'image' => $image,
            'is_blocked' => false,
            'is_validated' => true,
        ]);

        if ($user->role === 'admin') {
            Admin::create([
                'user_id' => $user->id,
            ]);
        }

        if ($user->role === 'stagiaire') {
            Stagiaire::create([
                'user_id' => $user->id,
                'cin' => $data['cin'] ?? null,
                'dateNaissance' => $data['dateNaissance'] ?? null,
                'cv' => $data['cv'] ?? null,
                'education' => $data['education'] ?? null,
                'competence' => $data['competence'] ?? null,
            ]);
        }

        if ($user->role === 'entreprise') {
            Entreprise::create([
                'user_id' => $user->id,
                'secteur' => $data['secteur'] ?? null,
                'adresse' => $data['adresse'] ?? null,
                'description' => $data['description'] ?? null,
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Account created successfully',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user->load([
                'ville',
                'admin',
                'stagiaire',
                'entreprise',
            ]),
        ], 201);
    }

    /**
     * Login user and return token
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::with([
            'ville',
            'admin',
            'stagiaire',
            'entreprise',
        ])->where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Email or password is incorrect'
            ], 401);
        }

        if ($user->is_blocked) {
            return response()->json([
                'message' => 'Your account is blocked'
            ], 403);
        }

        if (! $user->is_validated) {
            return response()->json([
                'message' => 'Your account is not validated yet'
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    /**
     * Get authenticated user
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()->load([
                'ville',
                'admin',
                'stagiaire',
                'entreprise',
                'notifications',
            ])
        ]);
    }

    /**
     * Logout current token
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    /**
     * Logout from all devices
     */
    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out from all devices successfully'
        ]);
    }
}