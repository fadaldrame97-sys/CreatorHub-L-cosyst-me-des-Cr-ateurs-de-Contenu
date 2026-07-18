<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RealisationCollection;
use App\Http\Resources\RealisationResource;
use App\Models\Realisation;
use Illuminate\Http\JsonResponse;

class FeedController extends Controller
{
    /**
     * Display the public feed.
     *
     * GET /api/feed
     */
    public function index(): RealisationCollection
    {
        $realisations = Realisation::query()
            ->with([
                'user:id,name,avatar,price_per_hour',
                'skills:id,name',
            ])
            ->withCount([
                'likes',
                'saves',
            ])
            ->latest()
            ->paginate(12);

        return new RealisationCollection($realisations);
    }

    /**
     * Display a single portfolio project.
     *
     * GET /api/feed/{realisation}
     */
    public function show(Realisation $realisation): RealisationResource
    {
        $realisation->load([
            'user:id,name,avatar,price_per_hour',
            'skills:id,name',
        ])->loadCount([
            'likes',
            'saves',
        ]);

        return new RealisationResource($realisation);
    }
}
