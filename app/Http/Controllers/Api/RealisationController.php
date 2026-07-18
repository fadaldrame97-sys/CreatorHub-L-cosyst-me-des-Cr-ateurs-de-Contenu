<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreRealisationRequest;
use App\Models\Realisation;
use Illuminate\Http\Request;

class RealisationController extends Controller
{
    public function index()
    {
        $realisations = Realisation::with(['user', 'skills'])
            ->latest()
            ->paginate(12);

        return response()->json($realisations);
    }

    public function store(StoreRealisationRequest $request)
    {
        $realisation = Realisation::create([
            'user_id'     => $userId = 1,// Simule le user connecté (temporaire)
            'title'       => $request->title,
            'description' => $request->description,
            'media_url'   => $request->media_url,
            'media_type'  => $request->media_type,
        ]);

        $realisation->skills()->attach($request->skills);

        return response()->json([
            'message' => 'Réalisation publiée avec succès',
            'data'    => $realisation->load(['user', 'skills']),
        ], 201);
    }

    public function show(Realisation $realisation)
    {
        return response()->json(
            $realisation->load(['user', 'skills', 'likes', 'saves'])
        );
    }

    public function destroy(Realisation $realisation)
    {
        if ($realisation->user_id !== auth()->id()) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $realisation->delete();

        return response()->json(['message' => 'Réalisation supprimée']);
    }
}
