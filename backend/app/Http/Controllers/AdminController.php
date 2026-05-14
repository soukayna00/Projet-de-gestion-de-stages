<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(
            Admin::with('user.ville')->get()
        );
    }

    public function show(string $id)
    {
        return response()->json(
            Admin::with('user.ville')->findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id|unique:admins,user_id',
        ]);

        $user = User::findOrFail($data['user_id']);

        if ($user->role !== 'admin') {
            return response()->json([
                'message' => 'This user is not an admin'
            ], 422);
        }

        $admin = Admin::create($data);

        return response()->json(
            $admin->load('user.ville'),
            201
        );
    }

    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);

        $admin->delete();

        return response()->json([
            'message' => 'Admin profile deleted successfully'
        ]);
    }
}