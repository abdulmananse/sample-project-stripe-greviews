<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GooglePlacesService
{
    protected $url;
    protected $apiKey;

    public function __construct()
    {
        $this->url = config('services.google.places_url');
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
        $url = $this->url . 'details/json';

        $response = Http::get($url, [
            'place_id' => $placeId,
            'key'      => $this->apiKey,
            'fields'   => 'rating,user_ratings_total,reviews',
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return $data['result'] ?? [];
        }

        return [];
    }
    
}
