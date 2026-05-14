<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return response()->json(
            Notification::with('user.ville')
                ->latest('date_envoi')
                ->get()
        );
    }

    public function show(string $id)
    {
        return response()->json(
            Notification::with('user.ville')->findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'type' => 'nullable|in:info,success,warning,danger',
        ]);

        User::findOrFail($data['user_id']);

        $notification = Notification::create([
            'user_id' => $data['user_id'],
            'message' => $data['message'],
            'type' => $data['type'] ?? 'info',
            'lu' => false,
            'date_envoi' => now(),
        ]);

        return response()->json(
            $notification->load('user.ville'),
            201
        );
    }

    public function update(Request $request, string $id)
    {
        $notification = Notification::findOrFail($id);

        $data = $request->validate([
            'message' => 'sometimes|string',
            'type' => 'sometimes|in:info,success,warning,danger',
            'lu' => 'sometimes|boolean',
        ]);

        $notification->update($data);

        return response()->json(
            $notification->load('user.ville')
        );
    }

    public function destroy(string $id)
    {
        $notification = Notification::findOrFail($id);

        $notification->delete();

        return response()->json([
            'message' => 'Notification deleted successfully'
        ]);
    }

    public function markAsRead(string $id)
    {
        $notification = Notification::findOrFail($id);

        $notification->update([
            'lu' => true
        ]);

        return response()->json([
            'message' => 'Notification marked as read',
            'notification' => $notification->load('user.ville')
        ]);
    }

    public function markAsUnread(string $id)
    {
        $notification = Notification::findOrFail($id);

        $notification->update([
            'lu' => false
        ]);

        return response()->json([
            'message' => 'Notification marked as unread',
            'notification' => $notification->load('user.ville')
        ]);
    }

    public function userNotifications(string $userId)
    {
        User::findOrFail($userId);

        return response()->json(
            Notification::with('user.ville')
                ->where('user_id', $userId)
                ->latest('date_envoi')
                ->get()
        );
    }

    public function unreadByUser(string $userId)
    {
        User::findOrFail($userId);

        return response()->json(
            Notification::with('user.ville')
                ->where('user_id', $userId)
                ->where('lu', false)
                ->latest('date_envoi')
                ->get()
        );
    }
}