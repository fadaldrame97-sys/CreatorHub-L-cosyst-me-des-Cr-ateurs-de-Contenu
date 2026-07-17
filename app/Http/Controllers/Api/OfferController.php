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
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ["title", "description", "budget"],
            properties: [
                new OA\Property(property: "title", type: "string", example: "Recherche Graphiste"),
                new OA\Property(property: "description", type: "string", example: "Création d'un logo"),
                new OA\Property(property: "budget", type: "number", example: 1000)
            ]
        )
    ),
    responses: [
        new OA\Response(response: 201, description: "Offre créée avec succès")
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
    parameters: [
        new OA\Parameter(
            name: "id",
            in: "path",
            required: true,
            description: "Identifiant de l'offre",
            schema: new OA\Schema(type: "integer")
        )
    ],
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





    public function show(Offre $offre)
    {
    return response()->json($offre);
    }

    

    

#[OA\Put(
    path: "/api/offres/{id}",
    summary: "Modifier une offre",
    tags: ["Offres"],
    parameters: [
        new OA\Parameter(
            name: "id",
            in: "path",
            required: true,
            schema: new OA\Schema(type: "integer")
        )
    ],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            example: [
                "title" => "Recherche Développeur Laravel",
                "description" => "Développement API REST",
                "budget" => 2500
            ]
        )
    ),
    responses: [
        new OA\Response(
            response: 200,
            description: "Offre modifiée avec succès"
        )
    ]
)]


    public function update(UpdateOfferRequest $request, Offre $offre)
   {
    $offre->update($request->validated());

    return response()->json([
        'message' => 'Offre modifiée avec succès.',
        'data' => $offre
    ]);
     }
   

   #[OA\Delete(
    path: "/api/offres/{id}",
    summary: "Supprimer une offre",
    tags: ["Offres"],
    parameters: [
        new OA\Parameter(
            name: "id",
            in: "path",
            required: true,
            description: "Identifiant de l'offre",
            schema: new OA\Schema(type: "integer")
        )
    ],
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
