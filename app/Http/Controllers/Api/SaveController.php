<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Realisation;
use App\Models\User;

use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function toggle(Realisation $realisation)
    {
$user = auth()->user();
        if ($user->saves()->where('realisation_id', $realisation->id)->exists()) {
            $user->saves()->detach($realisation->id);
            $message = 'Retiré des favoris';
        } else {
            $user->saves()->attach($realisation->id);
            $message = 'Ajouté aux favoris';
        }

        return response()->json([
            'message' => $message,
            'saves_count' => $realisation->saves()->count(),
        ]);
    }

    public function index()
    {
        $realisations = auth()->user()
            ->saves()
            ->with(['user', 'skills'])
            ->paginate(12);

        return response()->json($realisations);
    }
}
