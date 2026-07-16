<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offre;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;
use OpenApi\Attributes as OA;



class OfferController extends Controller
{
    
#[OA\Get(
    path: "/api/offres",
    summary: "Lister toutes les offres",
    tags: ["Offres"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Liste des offres récupérée avec succès"
        )
    ]
)]
    public function index()
    {
           $offres = Offre::latest()->get();

           return response()->json($offres);
    }

   #[OA\Post(
    path: "/api/offres",
    summary: "Créer une nouvelle offre",
    tags: ["Offres"],
    responses: [
        new OA\Response(
            response: 201,
            description: "Offre créée avec succès"
        )
    ]
)]
    public function store(StoreOfferRequest $request)
    {
    $offer = Offre::create([
        'user_id' => 1, 
        'title' => $request->title,
        'description' => $request->description,
        'budget' => $request->budget,
    ]);

    return response()->json([
        'message' => 'Offre créée avec succès.',
        'data' => $offer
    ], 201);
    }
   

    #[OA\Get(
    path: "/api/offres/{id}",
    summary: "Afficher une offre",
    tags: ["Offres"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Offre trouvée"
        ),
        new OA\Response(
            response: 404,
            description: "Offre introuvable"
        )
    ]
    )]

    public function show(Offre $offer)
    {
    return response()->json($offer);
    }

    

    #[OA\Put(
    path: "/api/offres/{id}",
    summary: "Modifier une offre",
    tags: ["Offres"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Offre modifiée avec succès"
        ),
        new OA\Response(
            response: 404,
            description: "Offre introuvable"
        )
    ]
    )]



    public function update(UpdateOfferRequest $request, Offre $offer)
   {
    $offer->update($request->validated());

    return response()->json([
        'message' => 'Offre modifiée avec succès.',
        'data' => $offer
    ]);
     }
   

    #[OA\Delete(
    path: "/api/offres/{id}",
    summary: "Supprimer une offre",
    tags: ["Offres"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Offre supprimée avec succès"
        ),
        new OA\Response(
            response: 404,
            description: "Offre introuvable"
        )
    ]
    )]





    public function destroy(Offre $offre)
    {
    $offre->delete();

    return response()->json([
        'message' => 'Offre supprimée avec succès.'
    ]);
    }
    }
