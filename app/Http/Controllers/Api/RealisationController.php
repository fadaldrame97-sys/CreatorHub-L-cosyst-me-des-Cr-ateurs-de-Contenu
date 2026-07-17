<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use Illuminate\Http\Request;

class RealisationController extends Controller
{
    /**
     * GET /api/feed
     */
    public function index()
    {
        $realisations = Realisation::with([
            'user',
            'skills'
        ])
        ->withCount(['likes', 'saves'])
        ->latest()
        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Feed récupéré avec succès.',
            'data' => $realisations
        ], 200);
    }

    /**
     * POST /api/realisations
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'media_url' => 'required|string',
            'media_type' => 'required|in:image,youtube,vimeo',
            'skills' => 'required|array',
            'skills.*' => 'exists:skills,id',
        ]);

        $realisation = Realisation::create([
            'user_id' => $validated['user_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'media_url' => $validated['media_url'],
            'media_type' => $validated['media_type'],
        ]);

        $realisation->skills()->attach($validated['skills']);

        return response()->json([
            'success' => true,
            'message' => 'Réalisation créée avec succès.',
            'data' => $realisation->load('skills')
        ], 201);
    }

    /**
     * GET /api/search
     */
    public function search(Request $request)
    {
        $query = Realisation::with(['user', 'skills']);

        if ($request->filled('skill')) {
            $query->whereHas('skills', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->skill . '%');
            });
        }

        if ($request->filled('price')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('price_per_hour', '<=', $request->price);
            });
        }

        return response()->json([
            'success' => true,
            'data' => $query->latest()->get()
        ]);
    }
}
