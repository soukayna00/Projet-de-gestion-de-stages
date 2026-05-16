<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OffreStageController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\SignalementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\BloqueController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Villes
Route::get('/villes', [VilleController::class, 'index']);

// Users - for testing/admin display
Route::apiResource('users', UserController::class)
    ->except(['destroy']);

// Profiles
Route::apiResource('stagiaires', StagiaireController::class);
Route::apiResource('entreprises', EntrepriseController::class);
Route::apiResource('admins', AdminController::class);

// Offers
Route::apiResource('offres', OffreStageController::class);

// Public comments read
Route::get('/commentaires', [CommentaireController::class, 'index']);
Route::get('/commentaires/{commentaire}', [CommentaireController::class, 'show']);

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Auth user
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);

    // Candidatures
    Route::apiResource('candidatures', CandidatureController::class);
    Route::patch('/candidatures/{id}/accepter', [CandidatureController::class, 'accepter']);
    Route::patch('/candidatures/{id}/refuser', [CandidatureController::class, 'refuser']);

    // Favoris
    Route::delete('/favoris/remove/by-stagiaire-offre', [FavoriController::class, 'removeByStagiaireAndOffre']);
    Route::apiResource('favoris', FavoriController::class);

    // Comments write/edit/delete
    Route::post('/commentaires', [CommentaireController::class, 'store']);
    Route::put('/commentaires/{commentaire}', [CommentaireController::class, 'update']);
    Route::patch('/commentaires/{commentaire}', [CommentaireController::class, 'update']);
    Route::delete('/commentaires/{commentaire}', [CommentaireController::class, 'destroy']);

    // Signalements
    Route::apiResource('signalements', SignalementController::class);
    Route::patch('/signalements/{id}/traiter', [SignalementController::class, 'traiter']);
    Route::patch('/signalements/{id}/rejeter', [SignalementController::class, 'rejeter']);

    // Notifications
    Route::apiResource('notifications', NotificationController::class);
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::patch('/notifications/{id}/unread', [NotificationController::class, 'markAsUnread']);
    Route::get('/users/{userId}/notifications', [NotificationController::class, 'userNotifications']);
    Route::get('/users/{userId}/notifications/unread', [NotificationController::class, 'unreadByUser']);

    // Bloques
    Route::apiResource('bloques', BloqueController::class);
    Route::get('/bloques-active', [BloqueController::class, 'active']);
    Route::patch('/bloques/{id}/unblock', [BloqueController::class, 'unblock']);
});