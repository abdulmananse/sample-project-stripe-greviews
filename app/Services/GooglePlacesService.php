<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GooglePlacesService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google.places_api_key');
    }

    /**
     * Fetch reviews of a place by Place ID
     *
     * @param string $placeId
     * @return array
     */
    public function getPlaceReviews(string $placeId)
    {
        $url = 'https://maps.googleapis.com/maps/api/place/details/json';

        $response = Http::get($url, [
            'place_id' => $placeId,
            'key'      => $this->apiKey,
            'fields'   => 'reviews',
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return $data['result']['reviews'] ?? [];
        }

        return [];
    }
}
