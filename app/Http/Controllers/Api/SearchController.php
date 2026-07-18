<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Recherche générale par mot-clé (titre ou description)
    public function search(Request $request)
    {
        $query = $request->input('q');

        $realisations = Realisation::with(['user', 'skills'])
            ->where('title', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->paginate(12);

        return response()->json($realisations);
    }

    // Filtrer les réalisations par compétence (ex: Premiere Pro)
    public function filterBySkill(Request $request)
    {
        $skillId = $request->input('skill_id');

        $realisations = Realisation::with(['user', 'skills'])
            ->whereHas('skills', function ($q) use ($skillId) {
                $q->where('skills.id', $skillId);
            })
            ->paginate(12);

        return response()->json($realisations);
    }

    // Filtrer les créateurs par tarif (prix par heure)
    public function filterByPrice(Request $request)
    {
        $min = $request->input('min', 0);
        $max = $request->input('max', 999999);

        $users = User::whereBetween('price_per_hour', [$min, $max])
            ->get();

        return response()->json($users);
    }

    // Liste de tous les créateurs (prestataires)
    public function creators()
    {
        $creators = User::where('role', 'creator')
            ->with('skills')
            ->paginate(12);

        return response()->json($creators);
    }
}
