<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offre;
use App\Http\Requests\StoreOfferRequest;
use App\Http\Requests\UpdateOfferRequest;



class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
 * @OA\Get(
 *     path="/api/offres",
 *     summary="Lister toutes les offres",
 *     tags={"Offres"},
 *     @OA\Response(
 *         response=200,
 *         description="Liste des offres récupérée avec succès"
 *     )
 * )
 */
    public function index()
    {
           $offres = Offre::latest()->get();

           return response()->json($offres);
    }

    /**
     * Store a newly created resource in storage.
     */
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
    /**
     * Display the specified resource.
     */
    public function show(Offre $offer)
    {
    return response()->json($offer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfferRequest $request, Offre $offer)
   {
    $offer->update($request->validated());

    return response()->json([
        'message' => 'Offre modifiée avec succès.',
        'data' => $offer
    ]);
     }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offre $offre)
    {
    $offre->delete();

    return response()->json([
        'message' => 'Offre supprimée avec succès.'
    ]);
    }
    }
