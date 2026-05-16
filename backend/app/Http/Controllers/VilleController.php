<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function index()
    {
        return response()->json(Ville::all());
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nom' => 'required|string|max:255|unique:villes,nom',
    //     ]);

    //     $ville = Ville::create([
    //         'nom' => $request->nom,
    //     ]);

    //     return response()->json($ville, 201);
    // }
    

    
}