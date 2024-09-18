<?php

namespace App\Http\Controllers;

use App\Services\GooglePlacesService;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    protected $googlePlacesService;

    public function __construct(GooglePlacesService $googlePlacesService)
    {
        $this->googlePlacesService = $googlePlacesService;
    }

    /**
     * Get reviews for a specific place by ID
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReviews(Request $request)
    {
        $placeId = $request->input('place_id');

        if (!$placeId) {
            return response()->json(['error' => 'Place ID is required'], 400);
        }

        $reviews = $this->googlePlacesService->getPlaceReviews($placeId);

        return response()->json($reviews);
    }
}
