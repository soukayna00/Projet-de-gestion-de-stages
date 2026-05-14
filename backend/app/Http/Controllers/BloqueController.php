<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Bloque;
use App\Models\User;
use Illuminate\Http\Request;

class BloqueController extends Controller
{
    public function index()
    {
        return response()->json(
            Bloque::with([
                'admin.user.ville',
                'user.ville'
            ])->latest('date_blocage')->get()
        );
    }

    public function show(string $id)
    {
        return response()->json(
            Bloque::with([
                'admin.user.ville',
                'user.ville'
            ])->findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'user_id' => 'required|exists:users,id',
            'raison' => 'required|string|max:255',
        ]);

        $admin = Admin::findOrFail($data['admin_id']);
        $user = User::findOrFail($data['user_id']);

        if ($admin->user_id === $user->id) {
            return response()->json([
                'message' => 'Admin cannot block himself.'
            ], 422);
        }

        $alreadyBlocked = Bloque::where('user_id', $user->id)
            ->where('is_active', true)
            ->exists();

        if ($alreadyBlocked) {
            return response()->json([
                'message' => 'This user is already blocked.'
            ], 409);
        }

        $bloque = Bloque::create([
            'admin_id' => $admin->id,
            'user_id' => $user->id,
            'raison' => $data['raison'],
            'date_blocage' => now(),
            'is_active' => true,
        ]);

        $user->update([
            'is_blocked' => true,
        ]);

        return response()->json(
            $bloque->load([
                'admin.user.ville',
                'user.ville'
            ]),
            201
        );
    }

    public function update(Request $request, string $id)
    {
        $bloque = Bloque::findOrFail($id);

        $data = $request->validate([
            'raison' => 'sometimes|string|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        $bloque->update($data);

        $bloque->user->update([
            'is_blocked' => $bloque->is_active,
        ]);

        return response()->json(
            $bloque->load([
                'admin.user.ville',
                'user.ville'
            ])
        );
    }

    public function destroy(string $id)
    {
        $bloque = Bloque::findOrFail($id);

        $bloque->user->update([
            'is_blocked' => false,
        ]);

        $bloque->delete();

        return response()->json([
            'message' => 'Blocage deleted successfully and user unblocked.'
        ]);
    }

    public function unblock(string $id)
    {
        $bloque = Bloque::findOrFail($id);

        $bloque->update([
            'is_active' => false,
        ]);

        $bloque->user->update([
            'is_blocked' => false,
        ]);

        return response()->json([
            'message' => 'User unblocked successfully.',
            'bloque' => $bloque->load([
                'admin.user.ville',
                'user.ville'
            ])
        ]);
    }

    public function active()
    {
        return response()->json(
            Bloque::with([
                'admin.user.ville',
                'user.ville'
            ])
            ->where('is_active', true)
            ->latest('date_blocage')
            ->get()
        );
    }
}