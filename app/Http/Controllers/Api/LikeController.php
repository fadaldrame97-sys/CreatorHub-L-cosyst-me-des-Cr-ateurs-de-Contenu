<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use App\Models\User;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    // Like ou unlike une réalisation
    public function toggle(Realisation $realisation)
    {
$user = auth()->user();
        if ($user->likes()->where('realisation_id', $realisation->id)->exists()) {
            $user->likes()->detach($realisation->id);
            $message = 'Like retiré';
        } else {
            $user->likes()->attach($realisation->id);
            $message = 'Réalisation likée';
        }

        return response()->json([
            'message' => $message,
            'likes_count' => $realisation->likes()->count(),
        ]);
    }

    public function index()
    {
        $realisations = auth()->user()
            ->likes()
            ->with(['user', 'skills'])
            ->paginate(12);

        return response()->json($realisations);
    }
}
