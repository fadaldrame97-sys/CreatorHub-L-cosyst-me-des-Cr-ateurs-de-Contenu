<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCandidatureRequest;
use App\Models\Candidature;
use OpenApi\Attributes as OA;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    
    
   #[OA\Get(
    path: "/api/candidatures",
    summary: "Lister toutes les candidatures",
    tags: ["Candidatures"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Liste des candidatures"
        )
    ]
     )]






    public function index()
   { 
    $candidatures = Candidature::latest()->get();

     return response()->json($candidatures);
   }

    
   #[OA\Post(
    path: "/api/candidatures",
    summary: "Créer une candidature",
    tags: ["Candidatures"],
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ["offer_id"],
            properties: [
                new OA\Property(
                    property: "offer_id",
                    type: "integer",
                    example: 1
                )
            ]
        )
    ),
    responses: [
        new OA\Response(
            response: 201,
            description: "Candidature créée"
        )
    ]
)]
public function store(StoreCandidatureRequest $request)
{
    $candidature = Candidature::create([
        'offer_id' => $request->offer_id,
        'user_id' => 1
    ]);

    return response()->json([
        'message' => 'Candidature créée avec succès.',
        'data' => $candidature
    ], 201);
}
   


    

    #[OA\Get(
    path: "/api/candidatures/{id}",
    summary: "Afficher une candidature",
    tags: ["Candidatures"],
    parameters: [
        new OA\Parameter(
            name: "id",
            in: "path",
            required: true,
            schema: new OA\Schema(type: "integer")
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Candidature trouvée"
        )
    ]
)]





public function show(Candidature $candidature)
{
    return response()->json($candidature);
}







   #[OA\Put(
    path: "/api/candidatures/{id}",
    summary: "Modifier une candidature",
    tags: ["Candidatures"],
    parameters: [
        new OA\Parameter(
            name: "id",
            in: "path",
            required: true,
            schema: new OA\Schema(type: "integer")
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Candidature modifiée"
        )
    ]
)]
public function update(StoreCandidatureRequest $request, Candidature $candidature)
{
    $candidature->update([
        'offer_id' => $request->offer_id
    ]);

    return response()->json([
        'message' => 'Candidature modifiée avec succès.',
        'data' => $candidature
    ]);
}







#[OA\Delete(
    path: "/api/candidatures/{id}",
    summary: "Supprimer une candidature",
    tags: ["Candidatures"],
    parameters: [
        new OA\Parameter(
            name: "id",
            in: "path",
            required: true,
            schema: new OA\Schema(type: "integer")
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Candidature supprimée"
        )
    ]
)]






public function destroy(Candidature $candidature)
{
    $candidature->delete();

    return response()->json([
        'message' => 'Candidature supprimée avec succès.'
    ]);
}
}
